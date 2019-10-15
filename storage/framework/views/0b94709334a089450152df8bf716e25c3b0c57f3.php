<script src="js/file-explore.js"></script>
<link href="css/file-explore.css" rel="stylesheet">
<script src="js/table2excel.js"></script>

<style>
* {
  box-sizing:border-box;
}

.left {
  //background-color:#2196F3;
  background-color:#f1f1f1;
  padding:20px;
  float:left;
  margin-right: 5px;
}

.main {
  background-color:#f1f1f1;
  padding:20px;
  float:left;
	margin-right: 5px;
}

.right {
  background-color:#f1f1f1;
  padding:20px;
  float:left;
}

/* Use a media query to add a break point at 800px: */
@media  screen and (max-width:800px) {
  .left, .main, .right {
    width:100%; /* The width is 100%, when the viewport is 800px or smaller */
  }
}
</style>




<h2><?php echo e($layout); ?></h2>
<?php if($layout == 'Customizing(Inline)'): ?>
<div class="left small-section">
  <ul class="file-tree">
	  <?php $__currentLoopData = $tree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		  <li><a class="openTree cur_pointer"><?php echo e($t->description); ?></a>
			<ul>
				<?php $__currentLoopData = $t->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><a class="openTree cur_pointer"><?php echo e($ch->description); ?></a>
						  <ul>
							<?php $__currentLoopData = $ch->child1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$ch1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							  <li> 
							  <a OnClick="shownew(this.id);" data-layout="<?php echo e($layout); ?>" class="" id="last_<?php echo e($ch1->id); ?>" style="cursor: pointer;"><?php echo e($ch1->description); ?></a> </li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
						   </ul>
						</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  </ul>
		  </li>
	  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</div>

<div class="main big-section" id="result">
  <p>Content</p>
</div>

<div class="right hide-section">
  <p>Edit Content</p>
  <a class="cur_pointer closeSection" id="">Close</a>
</div>
<?php else: ?>

	<div class="left small-section " >
	  <ul class="file-tree">
		  <?php $__currentLoopData = $tree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  <li><a class="openTree cur_pointer"><?php echo e($t->description); ?></a>
				<ul>
					<?php $__currentLoopData = $t->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li><a class="openTree cur_pointer"><?php echo e($ch->description); ?></a>
							  <ul>
								<?php $__currentLoopData = $ch->child1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$ch1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								  <li> 
								  <a OnClick="shownew(this.id);" data-layout="<?php echo e($layout); ?>" class="" id="last_<?php echo e($ch1->id); ?>" style="cursor: pointer;"><?php echo e($ch1->description); ?></a> </li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
							   </ul>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				  </ul>
			  </li>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  </ul>
	</div>
	<div class="main medium-section" style="background-color:#e5e5e5 !important;">
	  
	</div>
	<div class="right small-section " style="background-color:#e5e5e5 !important;">
	  
	</div>
	

<?php endif; ?>
	<div id="importmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import your data</h4>
      </div>
	 <form action="import" method="post" enctype="multipart/form-data" id="uploadform">
      <div class="modal-body" id="edit_table">
         
		<div class="form-group">
                  <div class="control-label">
                     <label for="avatar">Import</label>
                  </div>
                   <input type="file" name="importdata" id="importdataval"/>
               </div>
		
      </div>
      <div class="modal-footer">
	   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default" id="import-data" data-url="import">Submit</button>
      </div>
	  </form>
	 
    </div>

  </div>
</div>
<script>
$(document).ready(function() {
  $(".file-tree").filetree();
});

$(document).ready(function() {
  $(".file-tree").filetree({
    animationSpeed: 'fast'
  });
});

$(document).ready(function() {
  $(".file-tree").filetree({
    collapsed: true,
  });
});

</script>
