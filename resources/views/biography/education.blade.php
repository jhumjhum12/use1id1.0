@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Education  </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class="breadcrumbs">
						<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="home">1iD Home</a></li>
									<li class="breadcrumb-item"><a href="Personal Data">{{ __('message.000026') }}</a></li>
									<li class="breadcrumb-item" ><a href="biography-data">Biography Data</a></li>
									 <li class="breadcrumb-item">Education</li>
							</ol>
					</div>

				<div class="tab-nav">
							<div class="parent-submenu">
								<ul>
									@foreach($tab as $t)									
										<li><a href="{{$t->url}}" {{ $t->url ==Request::path() ? 'class=active':''}}>{{$t->name}}</a></li>
									@endforeach
								</ul>

							</div>
				</div>
				<div class="clearfix"></div>
                            <div style="margin:30px;">
                           {!! Form::open(array('method' => 'POST', 'url' => 'post-education-data' ,'class'=>'', 'id' => 'post-form','files'=>true)) !!}
						  
                                <div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Version:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::select('version_id',$version,null,array( 'class'=>'form-control input-sm', 'required'=>'true','id'=>'VersionList')) }}
										</div>
                                    </div>
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Course Name:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('course_name',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Course Name','id'=>'CourseName')) }}
										</div>
                                    </div>
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Institution Name:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('institution_name',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Institution Name','id'=>'Insname')) }}
										</div>
                                    </div>
									
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Start Date:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('start_date',null,array( 'class'=>'form-control input-sm datepicker', 'required'=>'true' , 'placeholder'=>'Start Date','id'=>'StartDate')) }}
										</div>
                                    </div>
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">End Date:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('end_date',null,array( 'class'=>'form-control input-sm datepicker', 'required'=>'true' , 'placeholder'=>'End Date' ,'id'=>'EndDate')) }}
										</div>
                                    </div>
									
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    
										<div class="col-md-12">
                                        {{ Form::textarea('description',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'','description'=>'','id'=>'des')) }}
										</div>
                                    </div>

                                   
                                    
                                <div style="clear:both" class="form-group">
                                   <input type="hidden" name="id" value="{{ Auth::user()->id }}">
								    <input type="hidden" name="education_id" id="EducationId" value="">
                                    <button type="submit" name="submit" class="btn btn-primary">{{ __('message.000018') }}</button>
                                </div>
								
                           {!! Form::close() !!}
                        </div>
                        <h2>Education Details Listing</h2>
               <table class="table">
                  <thead>
                     <tr>
                        <th>Course Name</th>
                        <th>Institution Name</th>						 
                        <th>Description</th>
						<th>Version</th>						
						<th>Start date</th>
						<th>End date</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
					<tr>
                       @if($educationlist)
					@foreach($educationlist as $edu)	
                     <tr id="row-{{$edu->id}}">
						<td>{{$edu->course_name }}</td>
						<td>{{$edu->institution_name}}</td>						
						<td>{{$edu->description}}</td>
						<td>{{$edu->version_link->version_name}}</td>						
						<td>{{$edu->start_date}}</td>
						<td>{{$edu->end_date}}</td>
                        <td>
							<a id="editEducation"  data-id="{{$edu->id}}" data-url="get-education-data" data-method="post" title="Edit Version" class="cur_pointer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							
							<a id="deleteData" data-id="{{$edu->id}}" data-url="delete-education-data"  data-msg="" data-method="post" title="Delete Version" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a>
							
							
						</td>
                     </tr>
					@endforeach 
					@else
					  <tr>
						<td colspan="3">No Results Found!</td>
					  </tr>	
					@endif		
                     </tr>
                  </tbody>
               </table>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

