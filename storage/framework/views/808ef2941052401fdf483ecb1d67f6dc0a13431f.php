<?php $__env->startSection('content'); ?>

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

    <div style="padding: 0 20px 20px 20px; color:#43566c">
    <div class="row">
		<div class="col-md-3 available-templates" style="padding:0 2px 0 0; border: solid 1px #ddd;">
            <div style="background: #fff; padding: 10px">

                <h4> <?php echo e(Label::get('available_templates')); ?></h4>
                <hr />
    			<?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
    			<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn download-populated-template" href="<?php echo e(route('resume_template.download', $key)); ?>" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;<?php echo e($val); ?>

            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="<?php echo e(route('resume_template.delete', $key)); ?>"><i class="fa fa-trash-o pull-right" aria-hidden="true"></i></a>
                    </div>
    			</div>
    			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
                        <a class="cvb-inline-btn download-populated-template" href="<?php echo e(route('resume_template.download', 'example')); ?>" ><i class="fa fa-download" aria-hidden="true"></i>
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
                        <a class="cvb-inline-btn download-populated-template" href="<?php echo e(route('resume_template.download', 'example2')); ?>" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;<?php echo e(Label::get('populated_two_rows')); ?>

            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
				<?php if(sizeof($templates)==0): ?>
					<!--<p><i class="fa fa-info-circle"></i> <i>No templates available</i></p>-->
				<?php endif; ?>
    			<hr/>
    			<?php echo e(Form::open(['url'=>route('resume_template.upload'), 'files'=>true])); ?>

    			<?php echo e(method_field('POST')); ?>

    			<?php echo e(Form::label('file', 'Upload new', ['id'=>'','class'=>''])); ?>

                <small> (docx, doc, odt)</small>
    			<?php echo e(Form::file('template', '', ['id'=>'','class'=>''])); ?>

    			<br/>

    			<?php echo e(Form::submit('Save', ['class'=>'btn btn-primary'])); ?>

    			<?php echo e(Form::reset('Reset', ['class'=>'btn btn-default'])); ?>


    			<?php echo e(Form::close()); ?>

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
							<select class="form-control input-sm" id="revision-selector" name="revision">
								<option value="1" selected>Revision 1</option>
								<option value="2">Revision 2</option>
								<option value="3">Revision 3</option>
								<option value="4">Revision 4</option>
								<option value="5">Revision 5</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('user_data_fields')); ?>:</h4>
					<textarea style="width:100%; height: 140px"><?php $__currentLoopData = $fields['user']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".$f['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('reference_data_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="references" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="references" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="references-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['references']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".$f['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
					<textarea id="references-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['references']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".(empty($f['alias2']) ? $f['alias'] : $f['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
					<textarea id="experience-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['experience']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
					<textarea id="experience-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['experience']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('projects_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="projects" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="projects" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="projects-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".$f['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
					<textarea id="projects-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['projects']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".(empty($f['alias2']) ? $f['alias'] : $f['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
					<textarea id="education-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['education']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
					<textarea id="education-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['education']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('spoken_languages_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="spoken" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="spoken" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="spoken-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
					<textarea id="spoken-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
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
					<textarea id="interests-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['interests']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
					<textarea id="interests-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['interests']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4><?php echo e(Label::get('qualifications_fields')); ?>:
						<div class="btn-group pull-right">
						  <button type="button" data-section="qualifications" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="qualifications" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="qualifications-1" style="width:100%; height: 140px"><?php $__currentLoopData = $fields['qualifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".$fe['alias']); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
					<textarea id="qualifications-2" style="display:none; width:100%; height: 140px"><?php $__currentLoopData = $fields['qualifications']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fe): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?><?php echo e("\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])); ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
					</textarea>
				</div>
			</div>	
		</div>
	</div>
	<br>


    </div>

    <div style="clear:both"></div>
    <br />
    <br />



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>