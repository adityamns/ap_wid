<?php 

	/*
	 * This file is ready to run as standalone example. However, please do:
	 * 1. Add tags <html><head><body> to make a complete page
	 * 2. Change relative path in $KoolControlFolder variable to correctly point to KoolControls folder 
	 */

	$KoolControlsFolder = "KoolControls";//Relative path to "KoolPHPSuite/KoolControls" folder

	require $KoolControlsFolder."/KoolPivotTable/koolpivottable.php";
	
	$db_con = pg_connect('host=localhost port=5432 dbname=SIAK_UNHAN user=postgres password=12345');
	
	$ds = new PostgreSQLPivotDataSource($db_con);//This $db_con link has been created inside KoolPHPSuite/Resources/runexample.php
	$ds	->select("*")
		->from("v_jum_mhs");


	$pivot = new KoolPivotTable("pivot");
	$pivot->scriptFolder = $KoolControlsFolder."/KoolPivotTable";
	$pivot->styleFolder = "office2007";
	$pivot->DataSource = $ds;

	//Set the Width of pivot and use horizontal scrolling
	$pivot->Width = "1200px";
	$pivot->HorizontalScrolling = true;

	//Set the Height of pivot and use Vertical Scrolling
	$pivot->Height = "650px";
	$pivot->VerticalScrolling = true;

	//Allow filtering
	$pivot->AllowFiltering = true;
	//Allow sorting
	$pivot->AllowSorting = true;
	//Allow reordering
	$pivot->AllowReorder = true;
	$pivot->AllowPagination = true;
	
	
	//Make the RowHeader wider.
	$pivot->Appearance->RowHeaderMinWidth = "250px";

	//Use the Prev and Next Numneric Pager
	$pivot->Pager = new PivotPrevNextAndNumericPager();
	$pivot->Pager->PageSize = 20;

	//Turn on caching to help pivot working faster.
	$pivot->AllowCaching = true;
	
	
	//Data Field
	$field = new PivotSumField("jumlah");
	$field->Text = "Jumlah";
	$field->FormatString = "{n}";
	$field->AllowReorder = false;
	$pivot->AddDataField($field);

	//Row Fields
	$field = new PivotField("fakultas");
	$field->Text = "Fakultas";
	$pivot->AddRowField($field);

	//Column Fields
	$field = new PivotField("prodi");
	$field->Text = "Program Studi";
	$pivot->AddRowField($field);
	
	$field = new PivotField("nama_tahun");
	$field->Text = "Tahun Akademik";
	$pivot->AddColumnField($field);	
	
	//Process the pivot
	$pivot->Process();

?>

<form id="form1" method="post">	
	<div style="padding-top:10px; margin:">
		<?php echo $pivot->Render();?>
	</div>
	<div style="margin-top:10px;"><i>* <u>Note</u>:</i>Generate your own pivot table with <a style="color:#B8305E;" target="_blank" href="http://codegen.koolphp.net/pivot_table/">Code Generator</a></div>
	
</form>
