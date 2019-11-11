<?php $__env->startSection('content'); ?>

			<div class="clearfix"></div>
		
            <?php echo Form::open(array('method' => 'POST', 'url' => 'biography/post-version-data' ,'class'=>'', 'id' => 'post-form','files'=>true)); ?>

            <div class="col-md-12">
               <div class="col-md-6" style="float:left;">
               
                     <div class="control-label">
                        <label for="id" class="label-required"><?php echo e(__('message.000056')); ?></label>
                     </div>
					 <div class="clearfix"></div>
                     <?php echo e(Form::text('version',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Version Name', 'id'=>'verName'))); ?>

                 
               </div>
               <div class="col-md-6" style="float:left;">
                
                     <div class="control-label">
                        <label for="id" class="label-required"><?php echo e(__('message.000057')); ?></label>
                     </div>
					 <div class="clearfix"></div>
                     <?php echo e(Form::textarea('introduction',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Version Description', 'id'=>'verDesc','style'=>"width: 380px; height: 110px;"))); ?>

                  
                  <div style="float:right;clear:both" class="form-group" >
                     <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>">
					 <input type="hidden" name="version_id" id="versionId" value="">
                     <button type="submit" name="submit" class="btn btn-primary"><?php echo e(__('message.000018')); ?></button>
                  </div>
               </div>
            </div>
            <?php echo Form::close(); ?>

        
				<div class="clearfix"></div>
               <h2><?php echo e(__('message.000058')); ?></h2>
               <table class="table">
                  <thead>
                     <tr>
                        <th><?php echo e(__('message.000056')); ?></th>
                        <th><?php echo e(__('message.000057')); ?></th>
                        <th><?php echo e(__('message.000059')); ?></th>
                        <th><?php echo e(__('message.000060')); ?></th>
                     </tr>
                  </thead>
                  <tbody>
					<?php if($versions): ?>
					<?php $__currentLoopData = $versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				
                     <tr id="row-<?php echo e($vs->id); ?>">
                        <td><?php echo e($vs->version); ?></td>
                        <td><?php echo e($vs->introduction); ?></td>
                        <td><?php echo e($vs->summary); ?> entries</td>
                        <td>						
							<a id="editVersion"  data-id="<?php echo e($vs->id); ?>" data-url="biography/get-version-data" data-method="post" title="Edit Version" class="cur_pointer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							
							
							<a id="deleteData" data-id="<?php echo e($vs->id); ?>" data-url="biography/delete-version-data"   data-method="post" data-msg ="<?php echo $vs->delmsg;?>" title="Delete Version" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a>
							
							<a id="showDialogBox" data-id="<?php echo e($vs->id); ?>" data-url="biography/copy-version-data" title="Copy Version" data-method="post" class="cur_pointer"><i class="fa fa-clone" aria-hidden="true" ></i></a>
						</td>
                     </tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
					<?php else: ?>
					  <tr>
						<td colspan="3">No Results Found!</td>
					  </tr>	
					<?php endif; ?>		
                  </tbody>
               </table>
           
         </div>
      </div>
   </div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', ['slug'=>'Biography', 'title'=>'Biography Version'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>