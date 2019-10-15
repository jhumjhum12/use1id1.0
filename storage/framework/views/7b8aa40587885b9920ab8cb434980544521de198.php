<?php $data = $data->toArray(); 
//echo '<pre>';print_r($data);exit;
?>
<?php if(is_array($data) && isset($data[0])): ?>
<div class="table-wrap">
    <table class="table">
        <thead>
            <tr>

                <?php $__currentLoopData = $data[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!in_array($key, ['id', 'user_id','is_active','created_at','updated_at','description'])): ?>
                    <th><?php echo e(\App\Label::get($key)); ?></th>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(is_array($buttons)): ?>
                    <?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e(Label::get('actions')); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
				
				
            </tr>
        </thead>
        <tbody id="filter_row">
		  <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				
			
                <tr>
                    <?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!in_array($key, ['id', 'user_id','is_active','created_at','updated_at','description'])): ?>
                        <td>
                            <?php if(filter_var($value, FILTER_VALIDATE_URL)): ?>
                                <a target="_blank" href="<?php echo e($value); ?>"><?php echo e($value); ?></a>
                            <?php else: ?>
								<?php if($key=='language_id'): ?>
									<?php ( $language = \App\LanguagesList::find($value)); ?>  
									<?php echo e($language->name); ?>

									<?php elseif($key=="version_id"): ?>
									<?php ( $version = \App\Models\BiographyVersion::find($value)); ?> 
									<?php if(!empty($version->version)): ?>
									<?php echo e($version->version); ?>

									<?php else: ?>
                                        
                                    <?php endif; ?>
									<?php elseif($key=='work_experience_id'): ?>
									<?php ( $company = \App\Models\WorkExperience::find($value)); ?>  
									<?php echo e($company->company_name); ?>

									
									<?php elseif($key=='project_id'): ?>
									<?php ( $project = \App\Models\Project::find($value)); ?>  
									<?php echo e($project->project_name); ?>	
								<?php else: ?>
                                <?php echo e($value); ?>

							<?php endif; ?>							
                            <?php endif; ?>
                        </td>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(is_array($buttons)): ?>
                            <?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $button): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td>
								<input type="hidden" name="table_name" id="table_name" value="<?php echo e($db_table); ?>"/>
								<input type="hidden" name="segment_id" id="segment_id" value="<?php echo e($seg->id); ?>"/>
								<a class="btn btn-primary" href="?<?php echo e($db_table); ?>=<?php echo e($row['id']); ?>"><?php echo e(\App\Label::get($button)); ?></a>
								<?php echo $__env->make('html-controls.table-builder.includes.delete-btn', ['seg'=> $seg->id, 'value'=> $row['id'] ] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								</td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php else: ?>
<?php endif; ?>