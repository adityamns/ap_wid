<?php

/* Siak autocomplet controller class */

class Siak_autocomplete extends Siak_controller{

	function __construct(){
		parent::__construct();
		parent::siak_logstat();
		$this->siak_roles();
	}

	function mahasiswa($jenis,$keyword){
		//echo $keyword;
			if($jenis=='nim'){
				$query="Select nim,nama_depan,nama_belakang from view_mahasiswa where nim like '%".$keyword."%'";
			}else{
				$query="select * from (Select nim,nama_depan,nama_belakang from view_mahasiswa where nama_depan like '%".	$keyword."%' union Select nim,nama_depan,nama_belakang from view_mahasiswa where nama_belakang like '%".$keyword."%' )as nama order by nim asc";
			}
			//echo $keyword;
		$data = $this->siak_model->siak_query("select", $query);
		$sugestion=array();
		$hasilsugestion=array();
			foreach($data as $key =>$val){
				
				$arr['suggestions'][] = array(
					'value'	=>$val['nim']." - ".$val['nama_depan']." ".$val['nama_belakang'],
					'data'	=>$val['nim'],
					'nama'	=>$val['nama_depan']." ".$val['nama_belakang'],
					// 'nim'	=>$val['nim'],
				);
				
			}
		echo json_encode($arr);
	}
	function dosen($jenis,$keyword){
		//echo $keyword;
			if($jenis=='nip'){
				$query="Select * from dosen where nip like '%".$keyword."%'";
			}else{
				$query="select * from dosen where nama like '%".$keyword."%' order by nip asc";
			}
			//echo $keyword;
		$data = $this->siak_model->siak_query("select", $query);
		$sugestion=array();
		$hasilsugestion=array();
			foreach($data as $key =>$val){
				
				$arr['suggestions'][] = array(
					'value'	=>$val['nip']." - ".$val['gelar_dpn']." ".$val['nama']." ".$val['gelar_blkng'],
					'data'	=>$val['nip'],
					'nama'	=>$val['gelar_dpn']." ".$val['nama']." ".$val['gelar_blkng'],
					// 'nim'	=>$val['nim'],
				);
				
			}
		echo json_encode($arr);
	}
}
	
?>