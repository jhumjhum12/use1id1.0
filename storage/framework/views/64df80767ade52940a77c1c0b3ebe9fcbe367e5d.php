<?php
// echo '<pre>';print_r($versions);
// echo $summary;exit;
?>
<table class="table">
                  <thead>
                     <tr>
                        <th><?php echo e(Label::get('version_des')); ?></th>
                        <th><?php echo e(Label::get('version_summery')); ?></th>                        
                     </tr>
                  </thead>
                  <tbody>
					<?php if($versions): ?>
					
				
                     <tr >                        
                        <td><?php echo e($versions->introduction); ?></td>
                        <td><?php echo e($summary); ?> entries</td>                       
                     </tr>
					
					<?php else: ?>
					  <tr>
						<td colspan="3">No Results Found!</td>
					  </tr>	
					<?php endif; ?>		
                  </tbody>
               </table>