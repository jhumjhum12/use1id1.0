<?php $data = $data->toArray(); 
//echo '<pre>';print_r($data);exit;
?>
@if(is_array($data) && isset($data[0]))
<div class="table-wrap">
    <table class="table">
        <thead>
            <tr>

                @foreach($data[0] as $key=>$value)
                    @if(!in_array($key, ['id', 'user_id','is_active','created_at','updated_at','description']))
                    <th>{{ \App\Label::get($key) }}</th>
                    @endif
                @endforeach

                @if(is_array($buttons))
                    @foreach($buttons as $button)
                        <th>{{ Label::get('actions') }}</th>
                    @endforeach
                @endif
				
				
            </tr>
        </thead>
        <tbody id="filter_row">
		  @foreach($data as $row)
				
			
                <tr>
                    @foreach($row as $key=>$value)
                        @if(!in_array($key, ['id', 'user_id','is_active','created_at','updated_at','description']))
                        <td>
                            @if (filter_var($value, FILTER_VALIDATE_URL))
                                <a target="_blank" href="{{ $value }}">{{ $value }}</a>
                            @else
								@if($key=='language_id')
									@php( $language = \App\LanguagesList::find($value))  
									{{ $language->name}}
									@elseif($key=="version_id")
									@php( $version = \App\Models\BiographyVersion::find($value)) 
									@if(!empty($version->version))
									{{ $version->version }}
									@else
                                        
                                    @endif
									@elseif($key=='work_experience_id')
									@php( $company = \App\Models\WorkExperience::find($value))  
									{{ $company->company_name }}
									
									@elseif($key=='project_id')
									@php( $project = \App\Models\Project::find($value))  
									{{ $project->project_name }}	
								@else
                                {{ $value }}
							@endif							
                            @endif
                        </td>
                        @endif
                    @endforeach
                        @if(is_array($buttons))
                            @foreach($buttons as $button)
                                <td>
								<input type="hidden" name="table_name" id="table_name" value="{{ $db_table }}"/>
								<input type="hidden" name="segment_id" id="segment_id" value="{{ $seg->id }}"/>
								<a class="btn btn-primary" href="?{{ $db_table }}={{ $row['id'] }}">{{ \App\Label::get($button) }}</a>
								@include('html-controls.table-builder.includes.delete-btn', ['seg'=> $seg->id, 'value'=> $row['id'] ] )
								</td>
                            @endforeach
                        @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
@endif