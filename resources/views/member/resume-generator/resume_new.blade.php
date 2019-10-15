@extends('layouts.app')
 <style>
		a:hover, a {cursor: pointer; }

		.cvb-info {
			padding: 10px;
    		background: #ddd;
    		border-radius: 5px;
		}
		.fa-trash-o {
			color:#f44336;
			line-height: 1.7;
		}
        .fa-download {
			line-height: 1.7;
		}
		.label-default {
			font-size:12px;
		}
		.cvb-info {
			margin-top:10px;
		}
        .templates {
            margin-top: 5px;
        }
		.available-templates form {
			padding: 0;
		}
		.card-body{
			margin-left:50px;
		}
		.resumebt{
			width:100% !important;
			font-size:20px !important;
			font-weight: bold !important;
			text-align: left !important;
		}
    </style>
@section('content')

<div style="padding: 0 20px 20px 20px; color:#43566c;border:solid 1px #ddd">
 <div class="row">
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn resumebt" type="button collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          {{ Label::get('select_cv_version') }}
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">       
	  <div class="row">
					<div class='col-xs-10' >
						
						<div class="form-group">
							<div class="control-label">
								<label for="revisions">{{ Label::get('revision_cv') }}</label>
							</div>
							<select class="form-control input-sm" id="version-selector" name="version">
							@if($versions)
							@foreach($versions as $v)
								<option value="{{ $v->id}}">{{ $v->version}}</option>
							@endforeach	
							@endif
							</select>
						</div>
					</div>
					
					<div id="version_details" class="col-xs-10"></div>
				</div>			
   
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn collapsed resumebt" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="margin-top:20px;">
         {{ Label::get('select_cv_template') }}
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
	  <div class="row templates">
	  @foreach($chiledscreen as $chield)
	  <div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);"  onclick="openpopup('{{ $chield->label }}');">{{ $chield->name }}</a></div>
	   
	  @endforeach
	  </div>
        <!--<div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);"  onclick="openpopup(1);">Your CV Templates</a></div>
	   </div>
	   	  <div class="row templates">
        <div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);" onclick="openpopup(2);">Upload a new Template</a></div>
	   </div>
	   	  <div class="row templates">
        <div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);" onclick="openpopup(3);">Templates shared by other users</a></div>
	   </div>
	   	  <div class="row templates">
        <div class="col-xs-10">
       <a class="cvb-inline-btn" href="javascript:void(0);" onclick="openpopup(4);">Sample templates of 1iD</a></div>
	   </div>-->
	  
	   </div>
	   </div>
      </div>
    </div>
  </div>
   
  <h2>{{ Label::get('guidelines') }}</h2>

  <div class="cvb-info">
				<p>
					<strong>{{ Label::get('important') }}: </strong><br />{{ Label::get('important_text') }}
				</p>
			</div>
			
  
  <div class="resumebt">{{ Label::get('additional_explanation') }}</div>
	<div class='col-xs-12' style='padding: 10px 20px'>
		
		<h4>{{ Label::get('photo') }}:</h4>
		<p>
			{!! Label::get('photo_text') !!}
		</p>
					
	</div>

 <div class="resumebt">{{ Label::get('available_fields') }}</div>
 
 
 <div class="col-xs-6">
					<h4>{{ Label::get('user_data_fields') }}:</h4>
					<textarea style="width:100%; height: 140px">@foreach($fields['user'] as $f){{"\n".$f['alias']}} @endforeach
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4>{{ Label::get('reference_data_fields') }}:
						<div class="btn-group pull-right">
						  <button type="button" data-section="references" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="references" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="references-1" style="width:100%; height: 140px">@foreach($fields['references'] as $f){{"\n".$f['alias']}} @endforeach
					</textarea>
					<textarea id="references-2" style="display:none; width:100%; height: 140px">@foreach($fields['references'] as $f){{"\n".(empty($f['alias2']) ? $f['alias'] : $f['alias2'])}} @endforeach
					</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h4>{{ Label::get('experience_data_fields') }}:
						<div class="btn-group pull-right">
						  <button type="button" data-section="experience" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="experience" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="experience-1" style="width:100%; height: 140px">@foreach($fields['experience'] as $fe){{"\n".$fe['alias']}} @endforeach
					</textarea>
					<textarea id="experience-2" style="display:none; width:100%; height: 140px">@foreach($fields['experience'] as $fe){{"\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])}} @endforeach
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4>{{ Label::get('projects_fields') }}:
						<div class="btn-group pull-right">
						  <button type="button" data-section="projects" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="projects" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="projects-1" style="width:100%; height: 140px">@foreach($fields['projects'] as $f){{"\n".$f['alias']}} @endforeach
					</textarea>
					<textarea id="projects-2" style="display:none; width:100%; height: 140px">@foreach($fields['projects'] as $f){{"\n".(empty($f['alias2']) ? $f['alias'] : $f['alias2'])}} @endforeach
					</textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h4>{{ Label::get('education_fields') }}:
						<div class="btn-group pull-right">
						  <button type="button" data-section="education" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="education" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="education-1" style="width:100%; height: 140px">@foreach($fields['education'] as $fe){{"\n".$fe['alias']}} @endforeach
					</textarea>
					<textarea id="education-2" style="display:none; width:100%; height: 140px">@foreach($fields['education'] as $fe){{"\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])}} @endforeach
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4>{{ Label::get('spoken_languages_fields') }}:
						<div class="btn-group pull-right">
						  <button type="button" data-section="spoken" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="spoken" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="spoken-1" style="width:100%; height: 140px">@foreach($fields['language'] as $fe){{"\n".$fe['alias']}} @endforeach
					</textarea>
					<textarea id="spoken-2" style="display:none; width:100%; height: 140px">@foreach($fields['language'] as $fe){{"\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])}} @endforeach
					</textarea>
				</div>
			</div>	
			<div class="row">
				<div class="col-xs-6">
					<h4>{{ Label::get('interests_fields') }}:
						<div class="btn-group pull-right">
						  <button type="button" data-section="interests" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="interests" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="interests-1" style="width:100%; height: 140px">@foreach($fields['interests'] as $fe){{"\n".$fe['alias']}} @endforeach
					</textarea>
					<textarea id="interests-2" style="display:none; width:100%; height: 140px">@foreach($fields['interests'] as $fe){{"\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])}} @endforeach
					</textarea>
				</div>
				<div class="col-xs-6">
					<h4>{{ Label::get('qualifications_fields') }}:
						<div class="btn-group pull-right">
						  <button type="button" data-section="qualifications" class="single-row-btn btn btn-primary active btn-xs">One Row</button>
						  <button type="button" data-section="qualifications" class="double-row-btn btn btn-primary btn-xs">Two Rows</button>
						</div>
					</h4>
					<textarea id="qualifications-1" style="width:100%; height: 140px">@foreach($fields['qualifications'] as $fe){{"\n".$fe['alias']}} @endforeach
					</textarea>
					<textarea id="qualifications-2" style="display:none; width:100%; height: 140px">@foreach($fields['qualifications'] as $fe){{"\n".(empty($fe['alias2']) ? $fe['alias'] : $fe['alias2'])}} @endforeach
					</textarea>
				</div>

 </div>
 
 
 

</div>
</div>

@endsection
