<style>
/* Remove default bullets */
ul, #myUL {
  list-style-type: none;
}

/* Remove margins and padding from the parent ul */
#myUL {
  margin: 0;
  padding: 0;
}

/* Style the caret/arrow */
.caret1 {
  cursor: pointer;
  user-select: none; /* Prevent text selection */
}

/* Create the caret/arrow with a unicode, and style it */
.caret1::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

/* Rotate the caret/arrow icon when clicked on (using JavaScript) */
.caret1-down::before {
  transform: rotate(90deg);
}

/* Hide the nested list */
.nested {
  display: none;
}

/* Show the nested list when the user clicks on the caret/arrow (with JavaScript) */
.active {
  display: block;
} 



.select{
	background-color:white;
	// padding:5px;
	// width:150px;
}


.my-custom-scrollbar {
  position: relative;
  height: 600px;
  overflow: auto;
}
.table-wrapper-scroll-y {
  display: block;
}

.tab button{
	padding: 6px 8px !important;
	font-size:12px !important;
}
.table > tbody > tr > td
{
	padding:4px !important;
	width:50px;
}

td, th {

    padding: 5px !important;;

}

</style>
<?php $__env->startSection('content'); ?>
<div class="tab">
<?php $__currentLoopData = $layouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
<?php if($layout != 'Download Multiple Tables')  { ?>
      <button class="tablinks changeLayout <?php if($layout == 'Customizing(Inline)')  { ?>layoutfour <?php } ?>"  data-layout="<?php echo e($layout); ?>"><?php echo e($layout); ?></button>
	
   <?php } else { ?>
	<button class="" OnClick="shownew(this.id);" data-layout="Customizing(Inline)" class="" id="last_1" ><?php echo e($layout); ?></button>
   <?php } ?>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="col-md-12" id="displayLayout">

</div>

<script>


var toggler = document.getElementsByClassName("caret1");
var i;

for (i = 0; i < toggler.length; i++) {
  toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret1-down");
  });
} 

function show(elem_id)
{	
	$('span').removeClass('select');
	$('ul li').removeClass('select');
	$('#'+elem_id).addClass('select');
	var dclass=$('#'+elem_id).attr('class');
	var url = 'get-tree-data';
	
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'post',    
		url: url,
		cache: false,
		data:{id:elem_id,dclass:dclass}, 
		async: false,
		success: function(result){
			//alert(result);
			$('#result').html(result);
			
		}
	});
}

function edit_data()
{
	var id=$(".select").attr('id');
	var dclass=$('#'+id).attr('class');
	var url = 'get-tree-data';
	var type = $(this).attr('data-method');
	
	
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'post',    
		url: url,
		cache: false,
		data:{id:id,dclass:dclass}, 
		async: false,
		success: function(result){
			
			$('#edit_table').html(result);
			
		}
	});
	$('#myModal').modal('show');
	 //alert($(".select").attr('id'));
}


function add_data()
{
	var table_name=$("#table_name").val();
	var table_id=$("#table_id").val();
	var url = 'get-add-layout';


	
	$.ajax({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		type: 'post',    
		url: url,
		cache: false,
		data:{table_name:table_name,table_id:table_id}, 
		async: false,
		success: function(result){
			
			$('#modal_body').html(result);
				$('#addModal').modal('show');
			
		}
	});
	 //alert($(".select").attr('id'));
}

function opentabletree(evt)
{	
	evt.currentTarget.className += " active";
	$('#result').html($('#table_tree').html());
}


function addrowtable()
{
	var myarray = [];
		jQuery('.addcolumn').each(function() {
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
                url: "addnewrow",
                data:{table_name:table_name,data_row:myarray}, 

                success: function(result){					
					$('#addModal').modal('hide');
                   show(table_id);
                    
            }});
}


</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-original', ['class'=>'page-screen-builder'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>