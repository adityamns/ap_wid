<?php

/* Author: Swapnil Joshi */
/* mail:   swapnil.gnu@gmail.com */

/******************************************************************************/
/*                                                                            */
/* The MIT License Copyright                                                  */ 						
/*                                                                            */
/* Copyright (c) 2012 Swapnil M. Joshi                                        */

/* Permission is hereby granted, free of charge, to any person obtaining a    */
/* copy of this software and associated documentation files (the "Software"), */
/* to deal in the Software without restriction, including without limitation  */
/* the rights to use, copy, modify, merge, publish, distribute, sublicense,   */
/* and/or sell copies of the Software, and to permit persons to whom the      */
/* Software is furnished to do so, subject to the following conditions:       */
/*                                                                            */
/* The above copyright notice and this permission notice shall be included in */
/* all copies or substantial portions of the Software.                        */
/*                                                                            */
/* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR */
/* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,   */
/* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL    */
/* THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER */
/* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING    */
/* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER        */
/* DEALINGS IN THE SOFTWARE.                                                  */
/*                                                                            */
/******************************************************************************/




?>
<?php

	include_once('lib.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
	<title>Visual Query Designer</title>

	<link rel="stylesheet" type="text/css" href="css/design.css" />
	<link rel="stylesheet" type="text/css" href="css/tbl_list_overlay.css" />
	
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
	
<!-- 	<link rel="stylesheet" type="text/css" href="js/dt/css/jquery.dataTables.css"> -->
	<link rel="stylesheet" type="text/css" href="js/dt/css/jquery.dataTables.min.css">
	
	
	<script type="application/x-javascript" src="js/jquery.min.js" ></script>
	<!--<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>-->
	
	<script type="application/x-javascript" src="js/jquery-ui.js" ></script>
	<script type="application/x-javascript" src="js/jquery.ui.dialog.js" ></script>
	
	<script type="application/x-javascript" src="js/jquery.cookie.js" ></script>

	<script type="application/x-javascript" src="js/underscore-min.js"></script>
	<script type="application/x-javascript" src="js/backbone-min.js"></script>       
	<script src="js/backbone-localstorage.js"></script>
	<script type="application/x-javascript" src="js/jsplumb.js"> </script>

	<script type="text/javascript" src="coffee/core.js"> </script>
	<script type="text/javascript" src="coffee/core.panes.js"> </script>
	<script type="text/javascript" src="coffee/design.js"> </script>
	
	
<!--	<script type="text/javascript" src="js/dt/js/jquery.dataTables.js"> </script>
	<script type="text/javascript" src="js/dt/js/jquery.dataTables.min.js"> </script>-->
	<script type="text/javascript" src="//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"> </script>
	
	
	<script type="application/x-javascript" src="js/tbl-selection.js"></script>

	<!--<script type="text/javascript" src="coffee/demo.js"> </script>-->
	
	<script type="application/x-javascript">
	window.swapnil = {};
	$(function(){
		if(localStorage) localStorage.clear();
		$.cookie('schema','');

		$('.btn-refresh').click(function () {
			$('.output > pre').html(QueryBuilder.GenerateSQL()); 
		});

		$('.bool.expr').draggable({
			helper:'clone'
		});
		
		App.setAppVisibility();
		bindAddTableEvts();
	})
	</script>
</head>

<body>

<div id="content">
	<div id="right-pane" class="design-mode">
		<div id="tool-bar" >
				<span id="project-logo" style="float: right;">
					<span style="" class="wb">  UNHAN </span>
					<span style="" class="vqd"> DATABASE </span>
				</span>
				<span style="float: left;">
				Schema : 
					<select name="schema" >
						<option value="" > -- Pilih Schema -- </option>
						<?php

							$query= '
								SELECT pg_database.datname as "Database",
								      pg_user.usename as "Owner"
							    FROM pg_database, pg_user
								WHERE pg_database.datdba = pg_user.usesysid

								UNION

								SELECT pg_database.datname as "Database",
								      NULL as "Owner" 
								FROM pg_database
								WHERE pg_database.datdba NOT IN (SELECT usesysid FROM pg_user)
								ORDER BY "Database"
								';
								
								
							$query2 = "select schema_name from information_schema.schemata";
							$result= $db->query($query2)->fetchALL(PDO::FETCH_ASSOC);
							
							foreach($result as $row){
							if($row['schema_name'] != 'public'){ }else{
	// 						var_dump($row);
						?>
						<option value="<?php echo $row['schema_name']; ?>"><?php echo $row['schema_name'] ?></option>
						<?php } } ?>
					</select>
				</span>
				
				<span id="btn-add-table" class="tool-bar-btn"> Tambah Tabel / Lihat
				</span>
		</div>
		
		<div class="pane output-mode" id="sql-out">
			<div class="output">
				<!-- SQL output -->
				<pre id="sql-text-op">
					Pilih Schema dan Tambah Tabel / Lihat
				</pre>
			</div>
		</div>
		
		<div id="design-pane" class="pane">
            <!--design pane-->
            
		</div>
		
		<fieldset id="pane-select" class="pane inline-pane">
			<legend> SELECTED FIELDS </legend>
		</fieldset>
		
		<div class="inline-pane">    
			<fieldset id="pane-join" class="pane">
				<legend>JOIN</legend>
			</fieldset>
		
			<fieldset id="pane-order-by" class="pane">
				<legend>  ORDER BY </legend>
			</fieldset>
		</div>
		
		<fieldset id="pane-where" class="pane inline-pane">
			<legend> WHERE </legend>
			<textarea id="" cols="30" rows="5"></textarea>
		</fieldset>
		
		<fieldset id="pane-where" class="pane inline-pane">
			<legend> COMMAND </legend>
			
			<button id="btn-run-query" >RUN QUERY</button>
			
		</fieldset>
		
		
	</div>
	
	<div id="table-selection">
		<div id="">
			Tambah Tabel
		</div>
		<div id="table-list">
		
		</div>	
		<div id="table-btns">
			<span class="butn ok">
				Lanjut
			</span>
			<span class="butn cancel">
				Batal
			</span>
			
		</div>
	</div>
	
		<div id="dialog">
			<div id="table-list">
			<div style="overflow: auto; overflow-y: hidden;">
				<div id="table-query-list">
				
				</div>
			</div>
			</div>
			<div id="table-btns-query">
				<span class="butn cancel">
					Tutup
				</span>
				
			</div>
		</div>
</div>
</div>

<div id="ddd" title="Query Result">

	<div id="table-list">
		<div id="query-result">
		
		</div>
	</div>

</div>

<script type="text/javascript">

$(function(){
	window.showTableListQuery = function(show){
		if(show){
			$('#dialog').show()
			
		}
		else{
			$('#dialog').hide(0)
		}
	}
	showTableListQuery(false)
	$( "#ddd" ).dialog({
		autoOpen: false,
		resizable: false,
		modal: true,
		autoResize:true,
		width: 'auto'
	});
})

$('#btn-run').on('click', function(event){
	var sql = $('#sql-text-op').text();
	
	$.ajax({
		url: 'query.php',
		type:"post",
		data:{sql:sql},
		async: false,
		success: function (data) {
			$('#table-query-list').html(data);
// 			$(document).trigger('datatable_loaded');
		}
	});
	showTableListQuery(true);
	
});

$('#btn-run-query').on('click', function(){
	var sql = $('#sql-text-op').text();
	
	$.ajax({
		url: 'query.php',
		type:"post",
		data:{sql:sql},
		async: false,
		success: function (data) {
			$('#query-result').html(data);
		}
	});
	$( "#ddd" ).dialog("open");
});

$('#table-btns-query .cancel').on('click', function(event){
	showTableListQuery(false);
})

</script>

<script id="table-label-template" type="text/template" >
	<div class="close " title="">
		X
	</div>
		<%= TableName %>

</script>

<script id="table-field-template" type="text/template" >
		
<%
	strSign = '';
	strTitle = '';
		
	switch(Sort){
		case 'ASC':
			strSign = 'A';
			strTitle = 'Asc';
		break;
		case 'DESC':
			strSign = 'D';
			strTitle = 'Desc';
		break;
		default:

		strSign = '+';
		strTitle = 'Click to add sort order';
	}
%>
		
<div class="cell-dragger" title="">
	<div class="cell-edit">
 
	<span class=" <%= Sort=='UNSORTED' ? 'hoverable' : '' %> orderby " title=" <%= strTitle %> " >
		<%= strSign %>
	</span>
</div>
 
<input type="checkbox" name="" <%= Selected ? 'checked=checked':''  %>  />

<% var cellClass= (IsPrimaryKey) ? 'primary-key':''  %>

	<span class="field-name <%= cellClass %>" style="" >
	    <%= ColumnName %>
	    <%= (Selected)? '': '' %>
	</span>
</div>
     
</script>
 
<script id="paneLi-select-template" type="text/template" >
	<div class="<%= Selected ? 'line-item': 'hidden-item' %> ">

        <div class="icon delete"></div>
        <div class="property-editor">
		<div class="editable ">
			<span class="label">
			AS
			</span>
			<input type="text" class="alias" value="<%= Alias %>" />
		</div>
						
		<div class="field-name">
			<%=  TableName  %>.<%= ColumnName %>
		</div>
	</div>
</div>

</script>
 
<script id="paneLI-join-template" type="text/template" >
	<div class="line-item">
		<div class="property-editor">
			<div class="field-name">
				<%=  LeftTable %><%=  (LeftField=='') ? '' : '.'+ LeftField  %>
			</div>
			<div class="" style="padding-right:10px;">
			<%
				selInner =  (Type == 'INNER') ? " selected='selected' " : "";
				selLeftOut =  (Type == 'LEFT_OUTER') ? "selected='selected'" : "";

				selRightOut =   (Type == "RIGHT_OUTER") ? "selected='selected'" : ""
				/*

				*/
			%>
			
                        <% if(Type =='CROSS_JOIN') { %>
                            Cross Join
                        <% }else{ %>
                        
				<select name="">
				    <option <%= selInner %> value=<%= 'INNER_JOIN' %>   > Inner </option>
				    <option <%= selLeftOut %>  value=<%= 'LEFT_OUTER' %>  > Left outer</option>
				    <option <%= selRightOut %> value=<%= 'RIGHT_OUTER' %>  > Right outer </option>
				</select>
                        
                        <% } %>
		</div>
		<div class="field-name">
			<%=  RightTable %><%=  (RightField=='') ? '' : '.'+ RightField  %>
                </div>
        </div>
</div>

</script>

<script id="paneLI-orderby-template" type="text/template" >
<div class="<%= (Sort !== 'UNSORTED') ? 'line-item': 'hidden-item' %> ">                
	<div class="icon delete"></div>
		<div class="property-editor">
			<div class="field-name">
				<%=  TableName  %>.<%= ColumnName %>
			</div>
		<div class="" style="padding-right:10px;float: right;">
			<select name="">
			<% var selAsc = (Sort== 'ASC') ? "selected='selected'" : ""  %>
			<% var selDesc = (Sort== 'DESC') ? "selected='selected'" : ""  %>
				<option <%= selAsc %> value="ASC" > Asc </option>
				<option <%= selDesc %> value="DESC"  > Desc </option>
			</select>
		</div>
	</div>
</div>
    
</script>

<script id="sql-pane-template" type="text/template" >
</script>

<script id="menu-item-template" type="text/template" >
<div class="menu-item">
	<a href="<%= link %>">
		<%= label %>
	</a>
</div> 
</script>

</body>
</html>
