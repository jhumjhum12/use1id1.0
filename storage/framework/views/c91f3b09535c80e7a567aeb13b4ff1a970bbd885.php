
<?php $__env->startSection('content'); ?>
<div class="tab">
  <button class="tablinks active" onclick="openCity(event, 'layout1')">Layout 1</button>
  <button class="tablinks" onclick="openCity(event, 'layout2')">Layout 2</button>
  <button class="tablinks" onclick="openCity(event, 'layout3')">Config_tree_builder</button>
</div>
<div id="layout1" class="tabcontent " style="display:block;">
	<div style="padding: 20px 20px 20px 20px;">
	   <ul>
		  <?php $__currentLoopData = $tree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
		  <li>
			 <a class="showChild cur_pointer" data-id="<?php echo e($t->config_group); ?>" data-type="parent"><?php echo e($t->description); ?></a>
			 <ul style="padding-left:50px" class="hidechild" id="show-<?php echo e($t->config_group); ?>">
				<?php $__currentLoopData = $t->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li>
				   <a class="showChild cur_pointer " data-id="<?php echo e($ch->config_group); ?>" data-type="child"><?php echo e($ch->description); ?></a>
				   <ul class="hidechild hdchl" id="show-<?php echo e($ch->config_group); ?>">
					  <?php $__currentLoopData = $ch->child1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><a ><?php echo e($ch1->description); ?></a></li>
					  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				   </ul>
				</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			 </ul>
		  </li>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	   </ul>
	</div>
</div>
<div id="layout2" class="tabcontent">
  <div style="padding: 20px 20px 20px 20px;">
	   <ul>
		  <?php $__currentLoopData = $tree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
		  <li>
			 <a class=" cur_pointer" ><?php echo e($t->description); ?></a>
			 <ul style="padding-left:50px" >
				<?php $__currentLoopData = $t->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<li>
				   <a class=" cur_pointer " ><?php echo e($ch->description); ?></a>
				   <ul>
					  <?php $__currentLoopData = $ch->child1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li><a ><?php echo e($ch1->description); ?></a></li>
					  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				   </ul>
				</li>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			 </ul>
		  </li>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	   </ul>
	</div> 
</div>

<div id="layout3" class="tabcontent">
 <div style="padding: 20px 20px 20px 20px;">
   <table style="width:100%" style="border: 1px solid black;
      border-collapse: collapse;">
      <?php $__currentLoopData = $tree; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
		  <tr>
			 <td>CONF_GMD_CUSTOMIZING_TREE</td>
			 <td><?php echo e($t->config_group); ?></td>
			 <td><?php echo e($t->description); ?></td>
		  </tr>
		  <?php $__currentLoopData = $t->child; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			  <tr>
				 <td>CONF_GMD_CUSTOMIZING_TREE</td>
				 <td><?php echo e($ch->config_group); ?></td>
				 <td><?php echo e($ch->description); ?></td>
			  </tr>
			  <?php $__currentLoopData = $ch->child1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ch1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				  <tr>
					 <td>ST_TAB_TABLE_DEFFINATION</td>
					 <td><?php echo e($ch1->table); ?></td>
					 <td><?php echo e($ch1->description); ?></td>
				  </tr>
			  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </table>
 </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-original', ['class'=>'page-screen-builder'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>