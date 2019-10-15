@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="25%">{{ Label::get('customer') }}/{{ Label::get('project_name') }} </th>
            <th width="20%">{{ Label::get('person') }}</th>
            <th width="15%">{{ Label::get('job_title') }}</th>
            <th width="10%">{{ Label::get('date') }}</th>
            <th width="10%">{{ Label::get('referee_position') }}</th>
            <th width="5%">{{ Label::get('revisions') }}</th>
            @if(!isset($noActions))
            <th width="15%">{{ Label::get('actions') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)	
        <tr>
            <td><strong>@if(isset($value->project->work_experience_id)) {{ $value->project->customer_name }}/{{ $value->project->project_name }}@endif</strong> </td>
            <td>{{ $value->person_name }}</td>
            <td>{{ $value->job_title }}</td>
            <td>{{ $value->reference_date }}</td>
            <td>{{ $value->job_position }}</td>
            <td>@php( $version = \App\Models\BiographyVersion::find($value->version_id))  
									{{ $version->version}}</td>
            @if(!isset($noActions))
            <td>
                <a class="btn btn-primary" href="?{{ $db_table }}={{ $value->id }}">{{ \App\Label::get('Edit') }}</a>
                @include('html-controls.table-builder.includes.delete-btn', ['seg'=> $seg->id, 'value'=> $value->id ] )
            </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@else
    <div class="well">{{ Label::get('no_results_found') }}</div>
@endif
@if(isset($value->project->customer)) {{ $value->project->customer }}/{{ $value->project->project_name }}@endif