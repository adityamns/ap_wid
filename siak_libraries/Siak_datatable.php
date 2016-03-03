<?php

/* Main Siak Datatable Class */

define("DEBUG", false);

class Siak_datatable{
	
	private static $instance = null;
	private $db;
	private $aColumns = array();
	private $sIndexColumn;
	private $sTable;
	private $get;

	function __construct($cols, $indexcol, $table, $get){
		
		if ($cols === false || $indexcol === false || $table === false || $get === false) {
			die("One or more parameters are missing.");
		}else{
			$this->aColumns = $cols;
            $this->sIndexColumn = $indexcol;
            $this->sTable = $table;
            $this->get = $get;
		}

		try {
			$this->db = new Siak_database();
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
        } catch (PDOException $ex) {
			echo $ex->getMessage();
			exit();
		}
		$this->returnData();
	}

	private function __clone(){

	}

	public static function getInstance($cols = FALSE, $indexcol = FALSE, $table = FALSE, $get = FALSE){
        if(self::$instance === null)
        {
            $c = __CLASS__; 
            self::$instance = new $c($cols, $indexcol, $table, $get);
        }
        return self::$instance;
	}

	private function GET($var){
		return array_key_exists($var, $this->getvars) ? (!empty($this->getvars[$var]) ? (is_numeric($this->getvars[$var]) ? intval($this->getvars[$var]) : $this->getvars[$var]) : '') : '';
	}

	private function returnData(){
		$bindValues = array();
		/* Paging */
		$slimit = '';
		if (isset($this->get['iDisplayStart']) && isset($this->get['iDisplayLength']) && $this->get['iDisplayLength'] != '-1') {
            $sLimit = "LIMIT :iDisplayStart, :iDisplayLength";
            $bindvalues[] = array(':iDisplayStart',intval($this->get['iDisplayStart']),PDO::PARAM_INT); 
            $bindvalues[] = array(':iDisplayLength',intval($this->get['iDisplayLength']),PDO::PARAM_INT);
            //The actual values HERE need to be converted with intval, otherwise PDO puts them in quotes and the query raises an exception
		}

		/* Ordering */
		$sOrder = "";
        $colsortval = isset($this->get['iSortingCols']) ? intval( $this->get['iSortingCols'] ) : 0;
		if (isset($this->get['iSortCol_0'])) {
			$sOrder = "ORDER BY ";
			for ($i=0; $i < $colsortval; $i++) { 
				if (isset($this->get['bSortable_'.intval($this->get['iSortCol_'.$i])]) && $this->get['bSortable_'.intval($this->get['iSortCol_'.$i])] == true ) {
					if (isset($this->get['sSortdir_'.$i])) {
						if (isset($this->aColumns[ intval( $this->get['iSortCol_'.$i])])) {
                            $sOrder .= $this->aColumns[ intval( $this->get['iSortCol_'.$i] ) ].(strtoupper($this->get['sSortDir_'.$i]) == "ASC" ? " ASC" : " DESC").", ";
                            //PDO always wants to quote everything unless it's an integer, so we're not going to bindvalues here
						}
					}
				}
			}
			$sOrder = substr_replace($sOrder, "", -2);
			if ($sOrder == "ORDER BY ") {
				$sOrder = "";
			}
		}

		/* Filtering */
		$colnum = count($this->aColumns);
		$sWhere = "";
		if (!empty($this->get['sSearch'])) {
			$sWhere = "WHERE( ";
			for ($i=0; $i < $colnum; $i++) { 
				$sWhere .= $this->aColumns[$i]." LIKE :searchterm OR ";
			}
            $bindvalues[] = array(':searchterm', '%'.$this->get['sSearch'].'%',PDO::PARAM_STR);
            $sWhere = substr_replace( $sWhere, "", -3 );
            $sWhere .= ')';
		}

		/* Individual Column Filtering */
        $colnum = count($this->aColumns);
		for ($i=0; $i < $colnum; $i++) { 
			if (isset($this->get['bSearchable_'.$i]) && $this->get['bSearchable_'.$i] == "true" && isset($this->get['sSearch_'.$i]) && $this->get['sSearch_'.$i] != '') {
				if ($sWhere == "") {
					$sWhere = "WHERE ";
				}else{
					$sWhere .= " AND "; 
				}
		        $sWhere .= $this->aColumns[$i]." LIKE :searchcol".$i." OR ";
		        $bindvalues[] = array(':searchcol'.$i, '%'.$this->get['sSearch'.$i].'%',PDO::PARAM_STR);
			}
		}

		/* SQL queries and get data to display */
		$sQuery = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $this->aColumns))." FROM ".$this->sTable." $sWhere $sOrder $sLimit";
		$this->DebugOut($sQuery);

		/* Finally prepare the statement */
		$rResult = $this->db->prepare($sQuery);
		$len = count($bindvalues);
		for($i = 0; $i < $len; ++$i)
		{
		    $this->DebugOut($bindvalues[$i][0].", ".$bindvalues[$i][1].", ".$bindvalues[$i][2]);
		    $rResult->bindparam($bindvalues[$i][0], $bindvalues[$i][1],$bindvalues[$i][2]);
		}

		$rResult->execute();
        $iFilteredTotal = $this->db->query('SELECT FOUND_ROWS()')->fetchColumn(0); //Get the number of rows while ignoring the LIMIT 

		$sQuery = "SELECT COUNT(".$this->sIndexColumn.") FROM ".$this->sTable;
        $iTotal = $this->db->query($sQuery)->fetchColumn(0); //Get the total amount of rows in the table

		$output = array(
			"sEcho"					=> isset($this->get['sEcho']) ? intval($this->get['sEcho']) : 0,
			"iTotalRecord"			=> $iTotal,
			"iTotalDisplayRecord"	=> $iFilteredTotal,
			"aaData"				=> array()
			);

		while ($aRow = $rResult->fetch()) {
			$row = array();
			foreach ($aRow as $rowdata) {
				$row[] = $rowdata;
			}
			$output['aaData'][] = $row;
		}
		$jsondata = json_encode($output);
		echo $jsondata;
	}

	private function DebugOut($data){
		if(DEBUG){
            echo '<p style="background-color:#000;color:#FFF">',nl2br($data),'</p>';
		}
	}
}
header('Content-type: text/html; charset=UTF-8');
//Usage: PDO_Datatable::getInstance(array('column','names','comma','seperated'), 'the index column', 'the table name', $_GET);
Siak_datatable::getInstance(array('id','integer_1','string_1'),'id','test',$_GET);
?>