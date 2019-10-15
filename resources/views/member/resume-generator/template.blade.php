<?php
//echo '<pre>';print_r($othertemplate);exit;
?>
<style>
.avtemp{
	margin:20px;
}

</style>
<input type="hidden" name="versionid" id="versionId" value="{{ $versionid }}"/>
<input type="hidden" name="popupid" id="popupid" value="{{ $popid }}"/>
@if($popid =='upload_new_template')
<div style="margin-top:30px;" id="resume-template">

                <div class="card-header" style="text-align:center"> {{ Label::get('your_cv_template') }} </div>
							
							
									   {!! Form::open(array('method' => 'POST', 'url' => '' ,'class'=>'', 'id' => 'template-form','files'=>true)) !!}
									   
									   
									  
							
						<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label">{{ Label::get('upload_new') }} :</label>
                                        
                                        </div>
										
										<div class="col-md-8">
                                      
							{{ Form::file('template',array( 'class'=>'form-control', 'placeholder'=>'Image','id'=>'template')) }}
										</div>
                                    </div>
						
                                <div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label">{{ Label::get('template_name') }} :</label>
                                        
                                        </div>
										<div class="col-md-8">
                                       {{ Form::text('name',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Template Name','id'=>'name')) }}
										</div>
                                    </div>
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label">{{ Label::get('template_description') }} :</label>
                                        
                                        </div>
										<div class="col-md-8">
										{{ Form::textarea('description',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'','id'=>'des','style'=>'width: 280px; height: 110px;')) }}
                                        
										</div>
                                    </div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label">{{ Label::get('private_template') }} :</label>
                                        
                                        </div>
										<div class="col-md-8">
										
                                        <input type="checkbox" class="" id="shared" name="shared" style="margin-left:120px;"/>
										
										</div>
                                    </div>
									
                                    
                                <div style="clear:both" class="form-group">
                                   <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">								   
                                    <button type="button" name="submit" class="btn btn-primary" id="resume_template">Upload</button>								
									<button id="closeDialogBox" class="btn btn-primary btn-danger" style="margin-right:10px;">Cancel</button>
                                </div>
								
                           {!! Form::close() !!}
                       
						</div>
						
 @endif
@if($popid=='sample_templates')


<h4> {{ Label::get('default_templates') }}</h4>
                <hr />
				<div class="row templates avtemp">
    			@foreach($defaulttemplate as $key => $val)
    			<div class="avtemp1">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn download-populated-template downloadResumenew" data-template="example"  href="{{ $val->filename }}" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;{{ $val->name }}
            			</a>
                    </div>
                    
    			</div>
    			@endforeach	
</div>				
				<button id="closeDialogBox" class="btn btn-primary btn-danger" style="margin-right:10px;">Cancel</button>
@endif

	@if($popid=='your_cv_templates')	
 <h4> {{ Label::get('available_templates') }}</h4>
                <hr />
				<div class="row templates avtemp">
				@if($templates)				
    			@foreach($templates as $key => $val)
    			<div class="avtemp1">
                    <div class="col-xs-8">
                        <a class="cvb-inline-btn download-populated-template downloadResumenew" data-template="{{ $key }}"  ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;{{ $val }}
            			</a>
                    </div>
                    <div class="col-xs-4">
        			    <a class="cvb-inline-btn" href="{{route('resume_template_new.delete', $key)}}"><i class="fa fa-trash-o pull-right" aria-hidden="true"></i></a>
                    </div>
    			</div>
    			@endforeach	
					@else
					{{ Label::get('no_template_found ') }}
				@endif		
				</div>
				<button id="closeDialogBox" class="btn btn-primary btn-danger" style="margin-right:10px;">Cancel</button>	
				
	@endif	

@if($popid=='templates_shared')

<h4> {{ Label::get('other_templates') }}</h4>
                <hr />
				<div class="row templates avtemp">				
				@if(!$othertemplate->isEmpty())
    			@foreach($othertemplate as  $val)
    			<div class="avtemp1">
                    <div class="col-xs-10">
                       <a class="cvb-inline-btn download-populated-template downloadResumenew" data-template="{{ $val->id }}"  ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;{{ $val->name }}
            			</a>
                    </div>
                    
    			</div>
    			@endforeach	
				@else
					{{ Label::get('no_template_found ') }}
				@endif
</div>				
				<button id="closeDialogBox" class="btn btn-primary btn-danger" style="margin-right:10px;">Cancel</button>
@endif	
	<script>
	$("#resume_template").click(function(){
		 var temname=$('#name').val();
		// var temdes=$('#des').val();
		 //var share=$('#shared').is(':checked');
		// $('#tempname').val(temname);
		// $('#tempdes').val(temdes);
		// $('#tempshare').val(share);
		if($("#template").val() == ''){
			alert('Please Choose your template');
		}
		
		 var formData =$("#template-form").submit(function(e){
				return ;
			});
		// var formData1 =$("#template-form").submit(function(e){
				// return ;
			// });
		
		var formData = new FormData(formData[0]); 
		//formData.push({ temname: temname, temdes: temdes, share:share}); 
		//var formData1 = new FormData(formData1[0]); 
		if((temname!='') && ($("#template").val() != ''))	
		{
			$.ajax({
						url: 'post-resume-template',
						enctype: 'multipart/form-data',
						type: 'post',               
						processData: false,
						contentType: false,
						data: formData,
						success: function(data) {
						    	
							$("#dialogBox3").hide();
							$("#fade").hide();
						
							alert('Your template save successfully.');
							
						}
				});
		
		}
		else
		{
			alert('Please enter your template name');
		}
	});
	
	
	
	$(".downloadResumenew").each(function(){
	var template = $(this).attr('data-template');
	var verId = $("#versionId").val();
	var popupid = $("#popupid").val();
	var linkadd = 'resume-generator-new/download/'+template+'/'+verId+'/'+popupid;	
	$(this).attr('href',linkadd);	
});

	</script>