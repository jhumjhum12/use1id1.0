@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header"> Language Settings  </div>
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
                     <li class="breadcrumb-item">Language</li>
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
                  {!! Form::open(array('method' => 'POST', 'url' => 'post-language-data' ,'class'=>'', 'id' => 'post-form','files'=>true)) !!}
				<div style="float: right;padding: 0px 0px 8px 0px;">
					<button type="button" class="btn btn-primary" id="addRow" data-url="addrow-language-data" data-method="post" data-val="0">Add Language</button>
					<button type="submit" class="btn btn-primary">{{ __('message.000018') }}</button>
			   </div>
                  <table class="table">
                     <thead>
                        <tr>
                           <th>Version</th>
                           <th>Language</th>
                           <th>Listening </th>
                           <th>Speaking</th>
                           <th>Reading </th>
                           <th>Writing </th>
						   <th>Action </th>
                        </tr>
                     </thead>
                     <tbody id="rowAdd">
                        <tr class="">
                           <td>
                              {{ Form::select('version_id[0]',$version,null,array( 'class'=>'form-control input-sm', 'required'=>'true','id'=>'VersionList')) }}
                           </td>
                           <td>
                              {{ Form::select('language_id[0]',$language,null,array( 'class'=>'form-control input-sm', 'required'=>'true','id'=>'langList')) }}
                           </td>
                           <td>{{ Form::checkbox('listening[0]',1,null, array('id'=>'listening','class'=>'form-control')) }}</td>
                           <td>{{ Form::checkbox('speaking[0]',1,null, array('id'=>'speaking','class'=>'form-control')) }}</td>
                           <td>{{ Form::checkbox('reading[0]',1,null, array('id'=>'reading','class'=>'form-control')) }}</td>
                           <td>{{ Form::checkbox('writing[0]',1,null, array('id'=>'writing','class'=>'form-control')) }}</td>
						   <td><a id="deleteRow" title="Delete Row" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                     </tbody>
                  </table>
                  <div style="clear:both" class="form-group">
                     <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                     <input type="hidden" name="lang_id" id="LangId" value="">
                    
                  </div>
                  {!! Form::close() !!}
               </div>
			   
			   <h2>Language Listing</h2>
               <table class="table">
                  <thead>
                     <tr>
                       <th>Version Name</th>
                       <th>Language</th>
                       <th>Listening </th>
					   <th>Speaking</th>
					   <th>Reading </th>
					   <th>Writing </th>
					   <th>Action </th>
                     </tr>
                  </thead>
                  <tbody>
					@if($languageList)
					@foreach($languageList as $vs)	
				
                     <tr id="row-{{$vs->id}}">
                        <td>{{$vs->ver->version_name}}</td>
                        <td>{{$vs->lng->language}}</td>
                        <td>{{ Form::checkbox('listening',1,$vs->listening, array('class'=>'form-control', 'disabled'=>'true')) }}</td>
                        <td>{{ Form::checkbox('speaking',1,$vs->speaking, array('class'=>'form-control', 'disabled'=>'true')) }}</td>
                        <td>{{ Form::checkbox('reading',1,$vs->reading, array('class'=>'form-control', 'disabled'=>'true')) }}</td>
                        <td>{{ Form::checkbox('writing',1,$vs->writing, array('class'=>'form-control', 'disabled'=>'true')) }}</td>
                        <td>						
							<a id="editVerLang"  data-id="{{$vs->id}}" data-url="get-language-data" data-method="post" title="Edit Language" class="cur_pointer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
							<a id="deleteData" data-id="{{$vs->id}}" data-url="delete-language-data"   data-method="post" data-msg ="" title="Delete Language" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a>
							
						</td>
                     </tr>
					@endforeach 
					@else
					  <tr>
						<td colspan="3">No Results Found!</td>
					  </tr>	
					@endif		
                  </tbody>
               </table>
			   
			   
            </div>
         </div>
      </div>
   </div>
</div>
@endsection