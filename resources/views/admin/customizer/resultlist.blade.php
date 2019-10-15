<div class="table-wrapper-scroll-y my-custom-scrollbar">
<h4 style="font-weight:bold;" >{{ $table_name }}   <a href="#" style="padding-left:50px;" Onclick="add_data();">ADD</a></h4>

  <table class="table table-bordered table-striped mb-0">
                        <tr> 
							@foreach($table_column as $column) 
						@if(($column!='id') && ($column!='created_at') && ($column!='updated_at'))							
								<td style="border: solid 1px gray">{{ $column}}</td>	
								@endif	
							  @endforeach
							  <td style="border: solid 1px gray">Action</td>
                        </tr>
                  

					@foreach($table_data as $tab1)
					<tr style="border: solid 1px gray" class="trow_{{ $tab1->id }}">
						@foreach($table_column as $column) 
						@if(($column!='id') && ($column!='created_at') && ($column!='updated_at'))	
                        <td><span style="font-size:12px;" class="namecoun_{{$tab1->id}}">{{$tab1->$column}}</span> <input type="textbox" value="{{$tab1->$column}}" id="{{$column.'_'.$tab1->id}}" style="display: none;" class="tabcolumn_{{ $tab1->id }}" style="font-size:12px;"/></td>
						@endif	
						@endforeach
                      
                        <td style="border: solid 1px gray"><a href="javascript:void(0)" Onclick="editcountry({{$tab1->id}});" id="editcountry_{{$tab1->id}}">Edit</a>
                        <a href="javascript:void(0)" Onclick="savecountry({{$tab1->id}});" id="savecountry_{{$tab1->id}}" style="display:none;">Save</a>

                       </td>
						
					   
					</tr>
                      
					@endforeach 
                      </table>  
					  <input type="hidden" id="table_name" value="{{ $table_name }}" name="table_name"/>
					   <input type="hidden" id="table_id" value="{{ $table_id }}" name="table_id"/>
               
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