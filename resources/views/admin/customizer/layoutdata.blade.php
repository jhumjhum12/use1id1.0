<div class="col-md-12">
<div class="col-md-4"><h4>{{$table_name}}</h4></div>
 
<div class="col-md-3"><input type="text" class="form-control" id="searchLayoutData" placeholder="Search"></div>
<div class="col-md-1"><button id="addNewData"  class="btn btn-primary cur_pointer">Add</button> 
@if($layout == 'Customizing(Popup)')
<button id="closeDialogBox"  class="btn btn-primary cur_pointer">X</button> 
@endif
</div>
<div class="col-md-4">
@if($table_name=='SY_TAB_TABLE_DEFINITIONS')
	<a  class="btn btn-primary cur_pointer exportAll " id="exportAllCsv"  >CSV</a>  
	<a  class="btn btn-primary cur_pointer exportAll " id="exportAllExcel"  >EXCEL</a>
@else 
	<a id="export"  class="btn btn-primary cur_pointer" data-url="export">CSV</a>  
	<a id="export1"  class="btn btn-primary cur_pointer" Onclick="exportF(this);">EXCEL</a>
@endif
 <a class="btn btn-primary cur_pointer" data-toggle="modal" data-target="#importmodal">import</a>
</div>


</div>
<table class="table table-bordered table-striped mb-0" id="table">
   <thead>
      <tr> 
		@if($table_name=='SY_TAB_TABLE_DEFINITIONS')
				<th class="col"><input type="checkbox" class="chkParent"></th>
			@endif
         @foreach($table_column as $column)
			
         					
      <th class="col">{{ $column->field}}</th>
     
      @endforeach
      <th class="hidedata" style="width: 11%;">Action</th>
      </tr>
   </thead>
   
    <tbody id="myTable">
		<tr style="border: solid 1px gray" class="hidedata hide-section"  id="addData" >
		@if($table_name=='SY_TAB_TABLE_DEFINITIONS')
				<td class="col"></td>
			@endif
		@foreach($table_column as $column) 
		 
			<td>
				<input type="text" name="{{$column->field}}" class=" form-control inputnew cls{{$column->field}} inputsnew <?php if($column->field == 'long_text') { ?> popupdatanew" id="openTxtAreaBox" data-id="new" <?php } else { ?> " <?php } ?> />
			</td>
		
		@endforeach
			<td>
				<a class="btn btn-success cur_pointer saveData" id="saveAddNew" data-id="new"  data-url="savelayoutdata">Save</a>
				<a class="btn btn-success cur_pointer " id="closeAddData" data-id="">X</a>
			</td>
		</tr>
   @foreach($table_data as $tab1)
   <tr style="border: solid 1px gray" id="row-{{$tab1->id}}" class="allrow trow_{{ $tab1->id }}">
   @if($table_name=='SY_TAB_TABLE_DEFINITIONS')
				<td class="col"><input type="checkbox" class="chkChild" value="{{$tab1->id}}"></td>
			@endif
      @foreach($table_column as $column) 
     <?php
	 $fld=$column->field;
	 ?>
	
		
		<td class="allspan span{{$tab1->id}}">	
			@if($column->field=='long_text')
				<?php 
				$out = strlen($tab1->$fld) > 50 ? substr($tab1->$fld,0,50)."..." : $tab1->$fld;
				?>
				<span style="font-size:12px;" class="">{{$out}}</span>
			@else
				@if(($table_name=='SY_TAB_TABLE_DEFINITIONS') && ($column->field=='description'))
					<span style="font-size:12px;color:blue;" class="">{{$tab1->$fld}}</span>
				@else
					<span style="font-size:12px;" class="">{{$tab1->$fld}}</span>
				@endif
			@endif
		</td>
   <td class="hidedata allinput hide-section input{{$tab1->id}}">
			<input type="text" name="{{$column->field}}" class="form-control  inputs{{$tab1->id}} <?php if($column->field == 'long_text') { ?> popupdata{{$tab1->id}} " id="openTxtAreaBox" data-id="{{$tab1->id}}" <?php } else { ?> " <?php } ?> value="{{$tab1->$fld}}">	
		</td>
      @endforeach
      <td class="hidedata">
		<a title="Edit" class="cur_pointer editData" data-id="{{$tab1->id}}" id="edit{{$tab1->id}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
		<a title="Copy"  class="cur_pointer copyData" data-id="{{$tab1->id}}" id="copy{{$tab1->id}}"><i class="fa fa-clone" aria-hidden="true" ></i></a>
		
		<a id="deleteCustomizeData{{$tab1->id}}" data-id="{{$tab1->id}}" data-url="deletecustomizedata"   data-method="post" title="Delete" class="cur_pointer deleteCustomizeData"><i class="fa fa-trash" aria-hidden="true"></i></a>
		
		<a class="btn btn-success cur_pointer saveData hide-section" id="save{{$tab1->id}}" data-id="{{$tab1->id}}" data-url="savelayoutdata">Save</a>
		<a class="btn btn-success cur_pointer closeEditData hide-section" id="closeEditData{{$tab1->id}}" data-id="{{$tab1->id}}">X</a>
      </td>
   </tr>
   @endforeach 
   </tbody>
  
</table>
<input type="hidden" id="table_name" value="{{ $table_name }}" name="table_name"/>
<input type="hidden" id="table_id" value="{{ $table_id }}" name="table_id"/>



