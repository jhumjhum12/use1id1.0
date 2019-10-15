@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> References  </div>

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
								<li class="breadcrumb-item">References</li>
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
                           {!! Form::open(array('method' => 'POST', 'url' => 'post-reference-data' ,'class'=>'', 'id' => 'post-form','files'=>true)) !!}
						  
                                <div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Version:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::select('version_id',$version,null,array( 'class'=>'form-control input-sm', 'required'=>'true','id'=>'VersionList')) }}
										</div>
                                    </div>
									<div class="clearfix"></div>
									
									
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
                                        <label for="id" class="label-required">Person Name:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('person_name',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Person Name','id'=>'Pname')) }}
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
                                        <label for="id" class="label-required">Job Position:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('job_position',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Job Position','id'=>'JobPosition')) }}
										</div>
                                    </div>
									
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                    <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Date:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('date',null,array( 'class'=>'form-control input-sm datepicker', 'required'=>'true' , 'placeholder'=>'Date','id'=>'Date')) }}
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
								   <input type="hidden" name="reference_id" id="ReferenceId" value="">
                                    <button type="submit" name="submit" class="btn btn-primary">{{ __('message.000018') }}</button>
                                </div>
								
                           {!! Form::close() !!}
                        </div>
						
						
						<h2>Reference Listing</h2>
               <table class="table">
                  <thead>
                     <tr>
                        <th>Version Name</th>
                        <th>Customer Name</th>
						<th>Person Name</th>
						<th>Job Title</th>
						<th>Job Position</th>
						<th>Date</th>
                        <th>Description</th>
						<th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
					<tr>
                       @if($referencelist)
					@foreach($referencelist as $ref)	
                     <tr id="row-{{$ref->id}}">
						<td>{{$ref->version_link->version_name}}</td>
						<td>{{$ref->customer_name}}</td>
						<td>{{$ref->person_name}}</td>
						<td>{{$ref->job_title }}</td>
						<td>{{$ref->job_position }}</td>
						<td>{{$ref->date }}</td>
						<td>{{$ref->description}}</td>
						<td>
							<a id="editReference"  data-id="{{$ref->id}}" data-url="get-reference-data" data-method="post" title="Edit Reference" class="cur_pointer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							
							<a id="deleteData" data-id="{{$ref->id}}" data-url="delete-reference-data"  data-msg="" data-method="post" title="Delete Reference" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a>							
							
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
