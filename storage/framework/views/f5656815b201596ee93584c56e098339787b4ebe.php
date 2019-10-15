<div class="col-md-12">
<div class="col-md-4"><h4><?php echo e($table_name); ?></h4></div>
 
<div class="col-md-3"><input type="text" class="form-control" id="searchLayoutData" placeholder="Search"></div>
<div class="col-md-1"><button id="addNewData"  class="btn btn-primary cur_pointer">Add</button> 
<?php if($layout == 'Customizing(Popup)'): ?>
<button id="closeDialogBox"  class="btn btn-primary cur_pointer">X</button> 
<?php endif; ?>
</div>
<div class="col-md-4">
<?php if($table_name=='SY_TAB_TABLE_DEFINITIONS'): ?>
	<a  class="btn btn-primary cur_pointer exportAll " id="exportAllCsv"  >CSV</a>  
	<a  class="btn btn-primary cur_pointer exportAll " id="exportAllExcel"  >EXCEL</a>
<?php else: ?> 
	<a id="export"  class="btn btn-primary cur_pointer" data-url="export">CSV</a>  
	<a id="export1"  class="btn btn-primary cur_pointer" Onclick="exportF(this);">EXCEL</a>
<?php endif; ?>
 <a class="btn btn-primary cur_pointer" data-toggle="modal" data-target="#importmodal">import</a>
</div>


</div>
<table class="table table-bordered table-striped mb-0" id="table">
   <thead>
      <tr> 
		<?php if($table_name=='SY_TAB_TABLE_DEFINITIONS'): ?>
				<th class="col"><input type="checkbox" class="chkParent"></th>
			<?php endif; ?>
         <?php $__currentLoopData = $table_column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
         					
      <th class="col"><?php echo e($column->field); ?></th>
     
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <th class="hidedata" style="width: 11%;">Action</th>
      </tr>
   </thead>
   
    <tbody id="myTable">
		<tr style="border: solid 1px gray" class="hidedata hide-section"  id="addData" >
		<?php if($table_name=='SY_TAB_TABLE_DEFINITIONS'): ?>
				<td class="col"></td>
			<?php endif; ?>
		<?php $__currentLoopData = $table_column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
		 
			<td>
				<input type="text" name="<?php echo e($column->field); ?>" class=" form-control inputnew cls<?php echo e($column->field); ?> inputsnew <?php if($column->field == 'long_text') { ?> popupdatanew" id="openTxtAreaBox" data-id="new" <?php } else { ?> " <?php } ?> />
			</td>
		
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<td>
				<a class="btn btn-success cur_pointer saveData" id="saveAddNew" data-id="new"  data-url="savelayoutdata">Save</a>
				<a class="btn btn-success cur_pointer " id="closeAddData" data-id="">X</a>
			</td>
		</tr>
   <?php $__currentLoopData = $table_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <tr style="border: solid 1px gray" id="row-<?php echo e($tab1->id); ?>" class="allrow trow_<?php echo e($tab1->id); ?>">
   <?php if($table_name=='SY_TAB_TABLE_DEFINITIONS'): ?>
				<td class="col"><input type="checkbox" class="chkChild" value="<?php echo e($tab1->id); ?>"></td>
			<?php endif; ?>
      <?php $__currentLoopData = $table_column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
     <?php
	 $fld=$column->field;
	 ?>
	
		
		<td class="allspan span<?php echo e($tab1->id); ?>">	
			<?php if($column->field=='long_text'): ?>
				<?php 
				$out = strlen($tab1->$fld) > 50 ? substr($tab1->$fld,0,50)."..." : $tab1->$fld;
				?>
				<span style="font-size:12px;" class=""><?php echo e($out); ?></span>
			<?php else: ?>
				<?php if(($table_name=='SY_TAB_TABLE_DEFINITIONS') && ($column->field=='description')): ?>
					<span style="font-size:12px;color:blue;" class=""><?php echo e($tab1->$fld); ?></span>
				<?php else: ?>
					<span style="font-size:12px;" class=""><?php echo e($tab1->$fld); ?></span>
				<?php endif; ?>
			<?php endif; ?>
		</td>
   <td class="hidedata allinput hide-section input<?php echo e($tab1->id); ?>">
			<input type="text" name="<?php echo e($column->field); ?>" class="form-control  inputs<?php echo e($tab1->id); ?> <?php if($column->field == 'long_text') { ?> popupdata<?php echo e($tab1->id); ?> " id="openTxtAreaBox" data-id="<?php echo e($tab1->id); ?>" <?php } else { ?> " <?php } ?> value="<?php echo e($tab1->$fld); ?>">	
		</td>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <td class="hidedata">
		<a title="Edit" class="cur_pointer editData" data-id="<?php echo e($tab1->id); ?>" id="edit<?php echo e($tab1->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
		<a title="Copy"  class="cur_pointer copyData" data-id="<?php echo e($tab1->id); ?>" id="copy<?php echo e($tab1->id); ?>"><i class="fa fa-clone" aria-hidden="true" ></i></a>
		
		<a id="deleteCustomizeData<?php echo e($tab1->id); ?>" data-id="<?php echo e($tab1->id); ?>" data-url="deletecustomizedata"   data-method="post" title="Delete" class="cur_pointer deleteCustomizeData"><i class="fa fa-trash" aria-hidden="true"></i></a>
		
		<a class="btn btn-success cur_pointer saveData hide-section" id="save<?php echo e($tab1->id); ?>" data-id="<?php echo e($tab1->id); ?>" data-url="savelayoutdata">Save</a>
		<a class="btn btn-success cur_pointer closeEditData hide-section" id="closeEditData<?php echo e($tab1->id); ?>" data-id="<?php echo e($tab1->id); ?>">X</a>
      </td>
   </tr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
   </tbody>
  
</table>
<input type="hidden" id="table_name" value="<?php echo e($table_name); ?>" name="table_name"/>
<input type="hidden" id="table_id" value="<?php echo e($table_id); ?>" name="table_id"/>



