
<div class="col-md-12">
<div class="col-md-10"><h4><?php echo e($table_name); ?></h4></div>
 
<div class="col-md-2">
<?php if($layout != 'Customizing(Inline)'): ?>
<button id="closeDialogBox"  class="btn btn-primary cur_pointer">X</button>
<?php endif; ?>
</div>
</div>
<div class="col-md-12">
<?php echo $data->long_text; ?>
</div>
