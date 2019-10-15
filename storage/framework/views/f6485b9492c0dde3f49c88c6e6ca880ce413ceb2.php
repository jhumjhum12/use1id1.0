<div class="table-wrapper-scroll-y my-custom-scrollbar">
<h4 style="font-weight:bold;" ><?php echo e($table_name); ?>   <a href="#" style="padding-left:50px;" Onclick="add_data();">ADD</a></h4>

  <table class="table table-bordered table-striped mb-0">
                        <tr> 
							<?php $__currentLoopData = $table_column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
						<?php if(($column!='id') && ($column!='created_at') && ($column!='updated_at')): ?>							
								<td style="border: solid 1px gray"><?php echo e($column); ?></td>	
								<?php endif; ?>	
							  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							  <td style="border: solid 1px gray">Action</td>
                        </tr>
                  

					<?php $__currentLoopData = $table_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr style="border: solid 1px gray" class="trow_<?php echo e($tab1->id); ?>">
						<?php $__currentLoopData = $table_column; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
						<?php if(($column!='id') && ($column!='created_at') && ($column!='updated_at')): ?>	
                        <td><span style="font-size:12px;" class="namecoun_<?php echo e($tab1->id); ?>"><?php echo e($tab1->$column); ?></span> <input type="textbox" value="<?php echo e($tab1->$column); ?>" id="<?php echo e($column.'_'.$tab1->id); ?>" style="display: none;" class="tabcolumn_<?php echo e($tab1->id); ?>" style="font-size:12px;"/></td>
						<?php endif; ?>	
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      
                        <td style="border: solid 1px gray"><a href="javascript:void(0)" Onclick="editcountry(<?php echo e($tab1->id); ?>);" id="editcountry_<?php echo e($tab1->id); ?>">Edit</a>
                        <a href="javascript:void(0)" Onclick="savecountry(<?php echo e($tab1->id); ?>);" id="savecountry_<?php echo e($tab1->id); ?>" style="display:none;">Save</a>

                       </td>
						
					   
					</tr>
                      
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                      </table>  
					  <input type="hidden" id="table_name" value="<?php echo e($table_name); ?>" name="table_name"/>
					   <input type="hidden" id="table_id" value="<?php echo e($table_id); ?>" name="table_id"/>
               
</div>
<script type="text/javascript">

 
    function editcountry(counid)
    {
        
		$('.tabcolumn_'+counid).show();
		$('.namecoun_'+counid).hide();
		$('#editcountry_'+counid).hide();
		$('#savecountry_'+counid).show();
       
           
    }



    function savecountry(counid)
    {
		
		var myarray = [];
		jQuery('.tabcolumn_'+counid).each(function() {
			var currentElement = $(this);
			myarray.push(currentElement.val());
	
		});
		
		var table_name=$('#table_name').val();
	
		var table_id=$('#table_id').val();
		
		

         $.ajax({

                headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
                type: "POST",    
                url: "savecountry",
                data:{table_name:table_name,data_row:myarray,row_id:counid}, 

                success: function(result){					

                   show(table_id);
                    
            }});
    }

</script>