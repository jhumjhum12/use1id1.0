
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
    </style>
<?php $__env->startSection('content'); ?>

<div style="padding: 0 20px 20px 20px; color:#43566c">
 <div class="row">
 <div class="col-md-3 available-templates" style="padding:0 2px 0 0; border: solid 1px #ddd;">
            <div style="background: #fff; padding: 10px">

                <h4> <?php echo e(Label::get('available_templates')); ?></h4>
                <hr />
    			<?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    			<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn download-populated-template downloadResume" data-template="<?php echo e($key); ?>" href="" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;<?php echo e($val); ?>

            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="<?php echo e(route('resume_template.delete', $key)); ?>"><i class="fa fa-trash-o pull-right" aria-hidden="true"></i></a>
                    </div>
    			</div>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn" href="<?php echo e(route('example_template.download')); ?>" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;<?php echo e(Label::get('template_example')); ?>

            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
				<div class="row templates">
                    <div class="col-xs-10">
                       <a class="cvb-inline-btn download-populated-template downloadResume" data-template="example" href="" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;<?php echo e(Label::get('populated_template')); ?>

            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
				<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn" href="<?php echo e(route('example_template2.download')); ?>" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;<?php echo e(Label::get('template_two_rows')); ?>

            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
				<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn download-populated-template downloadResume" data-template="example2" href="" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;<?php echo e(Label::get('populated_two_rows')); ?>

            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
			<?php if(count($templates)==0): ?>
					<!--<p><i class="fa fa-info-circle"></i> <i>No templates available</i></p>-->
				<?php endif; ?>
    			<hr/>
    			<?php echo Form::open(['url'=>route('resume_template.upload'), 'files'=>true]); ?>

				<?php echo e(method_field('POST')); ?>

    			<?php echo e(Form::label('file', 'Upload new', ['id'=>'','class'=>''])); ?>

				<small> (docx, doc, odt)</small>
				<?php echo e(Form::file('template',array( 'class'=>'form-control', 'placeholder'=>'Image'))); ?>

				
    			<br/>
    		    <?php echo e(Form::hidden('version','', array('id' => 'versionId'))); ?>

    			<?php echo e(Form::submit('Save', ['class'=>'btn btn-primary'])); ?>

    			<?php echo e(Form::reset('Reset', ['class'=>'btn btn-default'])); ?>	
    			<?php echo Form::close(); ?>

    			
            </div>

		</div>
		
		
		<div class="col-md-9 fields" style="padding:10px; color:#000; background: #fff; border: solid 1px #ddd;">
			<div class="cvb-info">
				<p>
					<strong><?php echo e(Label::get('important')); ?>: </strong><br /><?php echo e(Label::get('important_text')); ?>

				</p>
			</div>
			
			<div class="row">
				<div class="row">
					<div class='col-xs-12' style='padding: 20px 50px'>
						
						<h4><?php echo e(Label::get('photo')); ?>:</h4>
						<p>
							<?php echo Label::get('photo_text'); ?>

						</p>
        					<div class="form-group">
        							<div class="control-label">
        								<label for="revisions"><?php echo e(Label::get('revision_cv')); ?></label>
        							</div>
        							<select class="form-control input-sm" id="version-selector" name="version">
        							    <?php if($versions): ?>
        							<?php $__currentLoopData = $versions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        								<option value="<?php echo e($v->id); ?>" ><?php echo e($v->version); ?></option>
        							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
        							<?php endif; ?>
        							</select>
        						</div>
					</div>
				</div>
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
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>