@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Projects  </div>

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
								<li class="breadcrumb-item">Projects</li>
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
                           {!! Form::open(array('method' => 'POST', 'url' => 'post-project-data' ,'class'=>'', 'id' => 'post-form','files'=>true)) !!}
						  
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
                                        <label for="id" class="label-required">Work:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::select('work_experience_id',$workexp,null,array( 'class'=>'form-control input-sm', 'required'=>'true','id'=>'WorkList')) }}
										</div>
                                    </div>
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Customer Name:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('customer_name',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Customer Name','id'=>'Cname')) }}
										</div>
                                    </div>
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Project Name:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('project_name',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Project Name','id'=>'Pname')) }}
										</div>
                                    </div>
									
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Job Title:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('job_title',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Job Title','id'=>'JobTitle')) }}
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
                                        {{ Form::text('end_date',null,array( 'class'=>'form-control input-sm datepicker', 'required'=>'true' , 'placeholder'=>'End Date','id'=>'EndDate')) }}
										</div>
                                    </div>
									
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    
										<div class="col-md-12">
                                        {{ Form::textarea('description',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'','id'=>'Des')) }}
										</div>
                                    </div>

                                   
                                    
                                <div style="clear:both" class="form-group">
                                   <input type="hidden" name="id" value="{{ Auth::user()->id }}">
								   <input type="hidden" name="project_id" id="ProjectId" value="">
                                    <button type="submit" name="submit" class="btn btn-primary">{{ __('message.000018') }}</button>
                                </div>
								
                           {!! Form::close() !!}
                        </div>
						
						
						<h2>Project Listing</h2>
               <table class="table">
                  <thead>
                     <tr>
                        <th>Job Title</th>
                        <th>Customer Name</th>
						 <th>Project Name</th>
                        <th>Description</th>
						<th>Version</th>
						<th>Company Name</th>
						<th>Start date</th>
						<th>End date</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
					<tr>
                       @if($projectlist)
					@foreach($projectlist as $project)	
                     <tr id="row-{{$project->id}}">
						<td>{{$project->job_title }}</td>
						<td>{{$project->customer_name}}</td>
						<td>{{$project->project_name}}</td>
						<td>{{$project->description}}</td>
						<td>{{$project->version_link->version_name}}</td>
						<td>{{$project->work_link->company_name}}</td>
						<td>{{$project->start_date}}</td>
						<td>{{$project->end_date}}</td>
                        <td>
							<a id="editProject"  data-id="{{$project->id}}" data-url="get-project-data" data-method="post" title="Edit Project" class="cur_pointer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							
							<a id="deleteData" data-id="{{$project->id}}" data-url="delete-project-data"  data-msg="" data-method="post" title="Delete Project" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a>							
							
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
