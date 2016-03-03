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
		->from("v_lap_nilai");


	$pivot = new KoolPivotTable("pivot");
	$pivot->scriptFolder = $KoolControlsFolder."/KoolPivotTable";
	$pivot->styleFolder = "office2007";
	$pivot->DataSource = $ds;

	//Set the Width of pivot and use horizontal scrolling
	$pivot->Width = "1000px";
	$pivot->HorizontalScrolling = true;

	//Set the Height of pivot and use Vertical Scrolling
	$pivot->Height = "600px";
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
	$field->Text = "Jumlah Mahasiswa";
	$field->FormatString = "{n}";
	$field->AllowReorder = false;
	$pivot->AddDataField($field);

	//Row Fields
	$field = new PivotField("prodi");
	$field->Text = "Program Studi";
	$pivot->AddRowField($field);

	
	$field = new PivotField("nama_matkul");
	$field->Text = "Mata Kuliah";
	$pivot->AddRowField($field);
	
	$field = new PivotField("semester");
	$field->Text = "Semester";
	$pivot->AddRowField($field);
	
	//Column Fields
	$field = new PivotField("grade");
	$field->Text = "Grade";
	$pivot->AddColumnField($field);	
	
	//Process the pivot
	$pivot->Process();

?>

<form id="form1" method="post">
		<?php echo $pivot->Render();?>
</form>
