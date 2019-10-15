
 <style>
		a:hover, a {cursor: pointer; }

		.cvb-info {
			padding: 10px;
    		background: #ddd;
    		border-radius: 5px;
		}
		.fa-trash-o {
			color:#f44336;
			line-height: 1.7;
		}
        .fa-download {
			line-height: 1.7;
		}
		.label-default {
			font-size:12px;
		}
		.cvb-info {
			margin-top:10px;
		}
        .templates {
            margin-top: 5px;
        }
		.available-templates form {
			padding: 0;
		}
		.card-body{
			margin-left:50px;
		}
		.resumebt{
			width:100% !important;
			font-size:20px !important;
			font-weight: bold !important;
			text-align: left !important;
		}
    </style>
<?php $__env->startSection('content'); ?>

<div style="padding: 0 20px 20px 20px; color:#43566c;border:solid 1px #ddd">
 <div class="row">
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn resumebt" type="button collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <?php echo e(Label::get('select_cv_version')); ?>

        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">       
	  <div class="row">
					<div class='col-xs-10' >
						
						<div class="form-group">
							<div class="control-label">
								<label for="revisions"><?php echo e(Label::get('revision_cv')); ?></label>
							</div>
							<select class="form-control input-sm" id="version-selector" name="version">
							<?php if($versions): ?>
							<?php $__currentLoopData = $versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($v->id); ?>"><?php echo e($v->version); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
							<?php endif; ?>
							</select>
						</div>
					</div>
					
					<div id="version_details" class="col-xs-10"></div>
				</div>			
   
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn collapsed resumebt" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="margin-top:20px;">
         <?php echo e(Label::get('select_cv_template')); ?>

        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
	  <div class="row templates">
	  <?php $__currentLoopData = $chiledscreen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	  <div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);"  onclick="openpopup('<?php echo e($chield->label); ?>');"><?php echo e($chield->name); ?></a></div>
	   
	  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  </div>
        <!--<div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);"  onclick="openpopup(1);">Your CV Templates</a></div>
	   </div>
	   	  <div class="row templates">
        <div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);" onclick="openpopup(2);">Upload a new Template</a></div>
	   </div>
	   	  <div class="row templates">
        <div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);" onclick="openpopup(3);">Templates shared by other users</a></div>
	   </div>
	   	  <div class="row templates">
        <div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);" onclick="openpopup(4);">Sample templates of 1iD</a></div>
	   </div>-->
	  
	   </div>
	   </div>
      </div>
    </div>
  </div>
   
  <h2><?php echo e(Label::get('guidelines')); ?></h2>

  <div class="cvb-info">
				<p>
					<strong><?php echo e(Label::get('important')); ?>: </strong><br /><?php echo e(Label::get('important_text')); ?>

				</p>
			</div>
			
  
  <div class="resumebt"><?php echo e(Label::get('additional_explanation')); ?></div>
	<div class='col-xs-12' style='padding: 10px 20px'>
		
		<h4><?php echo e(Label::get('photo')); ?>:</h4>
		<p>
			<?php echo Label::get('photo_text'); ?>

		</p>
					
	</div>

 <div class="resumebt"><?php echo e(Label::get('available_fields')); ?></div>
 
 
 <div class="col-xs-6">
					<h4><?php echo e(Label::get('user_data_fields')); ?>:</h4>
					<textarea style="width:100%; height: 140px"><?php $__currentLoopData = $fields['user']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".$f['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('reference_data_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="references" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="references" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="references-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['references']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".$f['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
					<textarea id="references-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['references']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".(empty($f['alias2']) ? $f['alias'] : $f['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('experience_data_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="experience" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="experience" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="experience-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['experience']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
					<textarea id="experience-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['experience']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('projects_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="projects" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="projects" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="projects-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".$f['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
					<textarea id="projects-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".(empty($f['alias2']) ? $f['alias'] : $f['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('education_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="education" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="education" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="education-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['education']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
					<textarea id="education-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['education']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('spoken_languages_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="spoken" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="spoken" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="spoken-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
					<textarea id="spoken-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
				</div>
			</div>	
			<div class="row">
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('interests_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="interests" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="interests" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="interests-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['interests']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
					<textarea id="interests-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['interests']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('qualifications_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="qualifications" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="qualifications" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="qualifications-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['qualifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
					<textarea id="qualifications-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['qualifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</textarea>
				</div>

 </div>
 
 
 

</div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>