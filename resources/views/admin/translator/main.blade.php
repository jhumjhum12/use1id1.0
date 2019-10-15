@extends('layouts.app-original', ['class'=>'page-screen-builder'])

@section('content')

    <div style="padding: 0 20px 20px 20px;">

	@if ($mode=='list')
		<h4>Translator</h4>
        {{ Form::open(['method'=>'get', 'route'=>['translator']]) }}
		<div class="row">

			<div class="col-xs-4">{{ Form::select('cat', [null=>'Select Category'] + $categories, $selectedCat, ['class'=>'form-control']) }}</div>
			<div class="col-xs-4">{{ Form::select('lng', $languages, $selectedLng, ['class'=>'form-control']) }}</div>
			<div class="col-xs-2"><button class="btn btn-primary" type="submit">View</button></div>
		</div>
        {{ Form::close() }}

		@if (!empty($selectedCat))
		{{ Form::open(['method'=>'post', 'route'=>['translator.new']]) }}
		{{ Form::text("cat", $selectedCat, ['hidden']) }}
		<div class="row">
			<div class="col-xs-4">{{ Form::text('key', null, ['class'=>'form-control', 'placeholder' => 'Enter new key']) }}</div>
			<div class="col-xs-4">{{ Form::text('EN', null, ['class'=>'form-control', 'placeholder' => 'English']) }}</div>

			<div class="col-xs-2"><button class="btn btn-primary" type="submit">Add New</button></div>
		</div>
        {{ Form::close() }}
		@endif
		@if ($selectedCat == 'messages')
		{{ Form::open(['method'=>'post', 'route'=>['translator.compile']]) }}
		{{ Form::text("lng", $selectedLng, ['hidden']) }}
		<div class="row">
			<div class="col-xs-2"><button class="btn btn-primary" type="submit">Compile Messages</button></div>
		</div>
        {{ Form::close() }}
		@endif
		@if(Session::has('message'))
		<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
		@endif
		@if (!empty($rows))
		<?php $cols = $selectedLng=='EN'?'col-xs-4':'col-xs-3';?>
		<div class="screen-item">
			<div class="row">
				<div class="{{$cols}}"><strong>Key</strong></div>
				<div class="{{$cols}}"><strong>English</strong></div>
				@if ($selectedLng !== 'EN')
				<div class="col-xs-3"><strong>{{ $languages[$selectedLng] }}</strong></div>
				@endif
				<div class="{{$cols}} text-right"><strong>Missing Translations</strong></div>
			</div>
		</div>
    <div class="data-rows">
			@foreach ($rows as $key => $row)
				<div class="screen-item">
                    <div class="row">
                        <div class="{{$cols}}">
							{{ $key }}
                        </div>
                        <div class="{{$cols}}">
                            {{ $row['EN']['msg_txt'] }}

                        </div>
						@if ($selectedLng !== 'EN')
              <div class="col-xs-3">
                <input type="text" class="edit-trans"  style="height: 30px;width:70%;"
                  data-lang="{{$selectedLng}}"
                  data-cat="{{$selectedCat}}"
                  data-key="{{$key}}"
                  data-id="{{$row[$selectedLng]['id'] or '0'}}"
                  data-text="{{ $row[$selectedLng]['msg_txt'] or ''}}"
                  value="{{ $row[$selectedLng]['msg_txt'] or ''}}"/>
                &nbsp;&nbsp;
                <span class="success-msg" style="color:green;display:none">Saved</span>
                <span class="error-msg" style="color:red;display:none">Error</span>
              </div>
						@endif
                        <div class="{{$cols}} text-right">
                            <div class="btn-group">
                            <a tabindex="-1" href="{{route('translator', $key)}}?cat={{$selectedCat}}&lng={{$selectedLng}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
							@foreach ($row['_missing'] as $m)
                            <a tabindex="-1" href="{{route('translator', $key)}}?cat={{$selectedCat}}&lng={{$selectedLng}}" class="btn btn-danger btn-xs">{{$m}}</a>
							@endforeach
                            </div>
                        </div>
                    </div>

                </div>

			@endforeach
    </div>
		@endif

		<hr />

	<p>Auto Translate: <br/>
		<small>Click on one of available languages to auto-translate all missing translations.
			It may take some time. New page will show up with report.</small>
	</p>
		<ul>
			@foreach($languages as $key=>$l)
				<li><a href="{{ route('translator.yandex', ['id'=>$key])  }}" target="_blank">{{ $l }}</a></li>
			@endforeach
		</ul>

	@endif

	@if ($mode=='edit')
	    <h3>Key: {{ $key }}</h3>
        {{ Form::open(['method'=>'post', 'route'=>['translator.update', $key ]]) }}
		{{ Form::text("cat", $selectedCat, ['hidden']) }}
		{{ Form::text("lng", $selectedLng, ['hidden']) }}

		@foreach($languages as $k=>$v)
		<?php
		$txt = empty($rows[$key][$k]['msg_txt']) ? '' : $rows[$key][$k]['msg_txt'];
		?>
			<div class="row form-group" style="max-width: none;">
				<div class="col-xs-4">
					{{ Form::label($k, $v, ['class' => '']) }}
					{{ Form::textarea($k, $txt, ['class'=>'form-control', 'style' => 'width:250px;height:100px']) }}
					@if (!empty($rows[$key][$k]['id']))
						{{ Form::text($k.":id", $rows[$key][$k]['id'], ['hidden']) }}
					@endif
				</div>
			</div>

		@endforeach

		<div class="row form-group">
            <div><button class="btn btn-primary" type="submit" style='float:none;margin-left:-20px;'>Update</button></div>
        </div>
        {{ Form::close() }}

	@endif
	</div>
  <!--<script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>-->
  <script type="text/javascript" src="{{ asset('js/translator.js') }}"></script>
@endsection
