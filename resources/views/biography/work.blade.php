@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Work-Experience  </div>

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
									<li class="breadcrumb-item" ><a href="biography-data">{{ __('message.000047') }}</a></li>
									 <li class="breadcrumb-item">{{ __('message.000049') }}</li>
							</ol>
					</div>

				<div class="tab-nav">
							<div class="parent-submenu">
								<ul>
									@foreach($tab as $t)
										<li><a href="{{$t->url}}" {{ $t->url ==Request::path() ? 'class=active':''}}>{{ __('message.'.$t->text_id) }}</a></li>
									@endforeach
								</ul>

							</div>
				</div>
				<div class="clearfix"></div>
                        
                    
							
                    <div style="margin:30px;">
                           {!! Form::open(array('method' => 'POST', 'url' => 'post-work-data' ,'class'=>'', 'id' => 'post-form','files'=>true)) !!}
						  
                                <div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">{{ __('message.000056') }}:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::select('version_id',$version,null,array( 'class'=>'form-control input-sm', 'required'=>'true','id'=>'VersionList')) }}
										</div>
                                    </div>
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">{{ __('message.000061') }}:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('job_title',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Job Title','id'=>'JobTitle')) }}
										</div>
                                    </div>
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">{{ __('message.000062') }}:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('company_name',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Company Name','id'=>'CompanyName')) }}
										</div>
                                    </div>
									
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">{{ __('message.000063') }}:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('start_date',null,array( 'class'=>'form-control input-sm datepicker', 'required'=>'true' , 'placeholder'=>'Start Date','id'=>'StartDate')) }}
										</div>
                                    </div>
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">{{ __('message.000064') }}:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('end_date',null,array( 'class'=>'form-control input-sm datepicker', 'placeholder'=>'End Date','id'=>'EndDate')) }}
										</div>
                                    </div>
									
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    
										<div class="col-md-12">
                                        {{ Form::textarea('description',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'','id'=>'Description')) }}
										</div>
                                    </div>

                                   
                                    
                                <div style="clear:both" class="form-group">
                                   <input type="hidden" name="id" value="{{ Auth::user()->id }}">
								   <input type="hidden" name="work_id" id="WorkId" value="">
                                    <button type="submit" name="submit" class="btn btn-primary">{{ __('message.000018') }}</button>
                                </div>
								
                           {!! Form::close() !!}
                        </div>
						
						
						
						   <h2>Work-Experience Listing</h2>
               <table class="table">
                  <thead>
                     <tr>
                        <th>Job Title</th>
                        <th>Company Name</th>
						 <th>Version</th>
                        <th>Description</th>
						<th>Start date</th>
						<th>End date</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
					<tr>
                       @if($workexp)
					@foreach($workexp as $work)	
                     <tr id="row-{{$work->id}}">
						<td>{{$work->job_title }}</td>
						<td>{{$work->company_name}}</td>
						<td>{{$work->ver->version_name}}</td>
						<td>{{$work->description}}</td>
						<td>{{$work->start_date}}</td>
						<td>{{$work->end_date}}</td>
                        <td>
							<a id="editWork"  data-id="{{$work->id}}" data-url="get-work-data" data-method="post" title="Edit Work-Experience" class="cur_pointer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							
							<a id="deleteData" data-id="{{$work->id}}" data-url="delete-work-data"   data-method="post" data-msg="" title="Delete Work-Experience" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a>							
							
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
