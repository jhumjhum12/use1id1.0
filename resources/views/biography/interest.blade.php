@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"> Interest  </div>

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
									 <li class="breadcrumb-item">Interest</li>
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
                    

                   
                           <div style="margin-top:30px;">
                           {!! Form::open(array('method' => 'POST', 'url' => 'post-interest-data' ,'class'=>'', 'id' => 'post-form','files'=>true)) !!}
						  
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
                                        <label for="id" class="label-required">Interest:</label>
                                        
                                        </div>
										<div class="col-md-8">
                                        {{ Form::text('interest',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'Interest','id'=>'Interest')) }}
										</div>
                                    </div>
									
									
									
									<div class="clearfix"></div>
									<div class="form-group row">
                                      <div class="control-label col-md-4">
                                        <label for="id" class="label-required">Description:</label>
                                        
                                        </div>
										<div class="col-md-12">
                                        {{ Form::textarea('description',null,array( 'class'=>'form-control input-sm', 'required'=>'true' , 'placeholder'=>'','id'=>'des')) }}
										</div>
                                    </div>

                                   
                                    
                                <div style="clear:both" class="form-group">
                                   <input type="hidden" name="id" value="{{ Auth::user()->id }}">
								   <input type="hidden" name="int_id" id="InterestId" value="">
                                    <button type="submit" name="submit" class="btn btn-primary">{{ __('message.000018') }}</button>
                                </div>
								
                           {!! Form::close() !!}
                        </div>
						
						
						
						<h2>Your Interests</h2>
               <table class="table">
                  <thead>
                     <tr>
                        <th>Interest</th>                        
                        <th>Description</th>
						<th>Version</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
					<tr>
                       @if($interestlist)
					@foreach($interestlist as $int)	
                     <tr id="row-{{$int->id}}">
						<td>{{$int->interest }}</td>						
						<td>{{$int->description}}</td>
						<td>{{$int->version_link->version_name}}</td>
                        <td>
							<a id="editInterest"  data-id="{{$int->id}}" data-url="get-interest-data" data-method="post" title="Edit Interest" class="cur_pointer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							
							<a id="deleteData" data-id="{{$int->id}}" data-url="delete-interest-data" data-msg=""  data-method="post" title="Delete Interest" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a>
							
							
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
