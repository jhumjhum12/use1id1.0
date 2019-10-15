<!--You are logged in!-->
<h2 style="text-align:center">Copy Version</h2>

			<?php echo Form::open(array('method' => 'POST', 'url' => 'biography/postcopy-version-data' ,'class'=>'', 'id' => 'post-form','files'=>true)); ?>

				
					  <div class="form-group">
						 <div class="control-label">
							<label for="id" class="label-required">Version Name</label>
						 </div>
						 <?php echo e(Form::text('version',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Version Name', 'id'=>'verName'))); ?>

					  </div>
				  
				  
					  <div class="form-group">
						 <div class="control-label">
							<label for="id" class="label-required">Version Description</label>
						 </div>
						 <?php echo e(Form::textarea('introduction',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Version Description', 'id'=>'verDesc'))); ?>

					  </div>
					  <div style="float:right;clear:both" class="form-group" >
						<input type="hidden" name="id" id="versionId" value="<?php echo e($versionId); ?>">
						 <button type="submit" name="submit" class="btn btn-primary"><?php echo e(__('message.000018')); ?></button>
						 <button id="closeDialogBox"  class="btn btn-primary cur_pointer">Close</button> 
					  </div>
				  
			 <?php echo Form::close(); ?>

  