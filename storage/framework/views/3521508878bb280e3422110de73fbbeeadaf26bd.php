<?php
//echo '<pre>';print_r($data);
?>

<input type="hidden" name="table_name" id="table_name" value="<?php echo e($table_name); ?>">
<input type="hidden" name="segment_id" id="segment_id" value="<?php echo e($segmentid); ?>"/>

   <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <tr >
<?php $__currentLoopData = $row; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(!in_array($key, ['id', 'user_id','is_active','created_at','updated_at','description'])): ?>
                        <td>
                             <?php if(filter_var($value, 273)): ?>
                                <a target="_blank" href="<?php echo e($value); ?>"><?php echo e($value); ?></a>
							 <?php else: ?>
								<?php if($key=='language_id'): ?>
									<?php ( $language = \App\LanguagesList::find($value)); ?>  
									<?php echo e($language->name); ?>

									<?php elseif($key=='version_id'): ?>
									<?php ( $version = \App\Models\BiographyVersion::find($value)); ?>  
									<?php echo e($version->version); ?>

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
					<td>
								
								<a class="btn btn-primary" href="?<?php echo e($table_name); ?>=<?php echo e($row->id); ?>">edit</a>
								<form method="post" style="padding: 0; width: auto" onsubmit="if(!confirm('Please confirm delete')){return false;}">
    <input type="hidden" name="function" value="<?php echo e($segmentid); ?>::delete">
    <input type="hidden" name="id" value="<?php echo e($row->id); ?>">
    <button class="btn btn-danger submit-delete"><i class="fa fa-trash-o"></i></button>
</form>
								</td>
					</tr>
					    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
						