<?php
//echo '<pre>';print_r($data);
?>

<input type="hidden" name="table_name" id="table_name" value="{{ $table_name }}">
<input type="hidden" name="segment_id" id="segment_id" value="{{ $segmentid }}"/>

   @foreach($data as $row)
   <tr >
@foreach($row as $key=>$value)
                        @if(!in_array($key, ['id', 'user_id','is_active','created_at','updated_at','description']))
                        <td>
                             @if (filter_var($value, 273))
                                <a target="_blank" href="{{ $value }}">{{ $value }}</a>
							 @else
								@if($key=='language_id')
									@php( $language = \App\LanguagesList::find($value))  
									{{ $language->name}}
									@elseif($key=='version_id')
									@php( $version = \App\Models\BiographyVersion::find($value))  
									{{ $version->version}}
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
					<td>
								
								<a class="btn btn-primary" href="?{{ $table_name }}={{ $row->id}}">edit</a>
								<form method="post" style="padding: 0; width: auto" onsubmit="if(!confirm('Please confirm delete')){return false;}">
    <input type="hidden" name="function" value="{{ $segmentid }}::delete">
    <input type="hidden" name="id" value="{{ $row->id}}">
    <button class="btn btn-danger submit-delete"><i class="fa fa-trash-o"></i></button>
</form>
								</td>
					</tr>
					    @endforeach
						
						