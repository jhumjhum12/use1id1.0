@extends('layouts.app')

@section('content')

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
    </style>

    <div style="padding: 0 20px 20px 20px; color:#43566c">
    <div class="row">
		<div class="col-md-3 available-templates" style="padding:0 2px 0 0; border: solid 1px #ddd;">
            <div style="background: #fff; padding: 10px">

                <h4> {{ Label::get('available_templates') }}</h4>
                <hr />
    			@foreach($templates as $key => $val)
    			<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn download-populated-template" href="{{route('resume_template.download', $key)}}" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;{{ $val }}
            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="{{route('resume_template.delete', $key)}}"><i class="fa fa-trash-o pull-right" aria-hidden="true"></i></a>
                    </div>
    			</div>
    			@endforeach
				<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn" href="{{route('example_template.download')}}" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;{{ Label::get('template_example') }}
            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
				<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn download-populated-template" href="{{route('resume_template.download', 'example')}}" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;{{ Label::get('populated_template') }}
            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
				<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn" href="{{route('example_template2.download')}}" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;{{ Label::get('template_two_rows') }}
            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
				<div class="row templates">
                    <div class="col-xs-10">
                        <a class="cvb-inline-btn download-populated-template" href="{{route('resume_template.download', 'example2')}}" ><i class="fa fa-download" aria-hidden="true"></i>
                            &nbsp;{{ Label::get('populated_two_rows') }}
            			</a>
                    </div>
                    <div class="col-xs-2">
        			    <a class="cvb-inline-btn" href="#"></a>
                    </div>
    			</div>
				@if(sizeof($templates)==0)
					<!--<p><i class="fa fa-info-circle"></i> <i>No templates available</i></p>-->
				@endif
    			<hr/>
    			{{ Form::open(['url'=>route('resume_template.upload'), 'files'=>true]) }}
    			{{ method_field('POST') }}
    			{{ Form::label('file', 'Upload new', ['id'=>'','class'=>'']) }}
                <small> (docx, doc, odt)</small>
    			{{ Form::file('template', '', ['id'=>'','class'=>'']) }}
    			<br/>

    			{{ Form::submit('Save', ['class'=>'btn btn-primary']) }}
    			{{ Form::reset('Reset', ['class'=>'btn btn-default']) }}

    			{{ Form::close() }}
            </div>

		</div>

		<div class="col-md-9 fields" style="padding:10px; color:#000; background: #fff; border: solid 1px #ddd;">
			<div class="cvb-info">
				<p>
					<strong>{{ Label::get('important') }}: </strong><br />{{ Label::get('important_text') }}
				</p>
			</div>
			
			<div class="row">
				<div class="row">
					<div class='col-xs-12' style='padding: 20px 50px'>
						
						<h4>{{ Label::get('photo') }}:</h4>
						<p>
							{!! Label::get('photo_text') !!}
						</p>
						<div class="form-group">
							<div class="control-label">
								<label for="revisions">{{ Label::get('revision_cv') }}</label>
							</div>
							<select class="form-control input-sm" id="revision-selector" name="revision">
								<option value="1" selected>Revision 1</option>
								<option value="2">Revision 2</option>
								<option value="3">Revision 3</option>
								<option value="4">Revision 4</option>
								<option value="5">Revision 5</option>
							</select>
						</div>
					</div>
				</div>
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
	<br>


    </div>

    <div style="clear:both"></div>
    <br />
    <br />
@endsection
