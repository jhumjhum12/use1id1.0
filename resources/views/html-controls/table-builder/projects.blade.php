@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="15%">{{ Label::get('company_name') }}</th>
            <th width="15%">{{ Label::get('customer') }}</th>
            <th width="15%">{{ Label::get('project_name') }}</th>
            <th width="15%">{{ Label::get('job_title') }}</th>
            <th width="15%">{{ Label::get('duration') }}</th>
            <th width="10%">{{ Label::get('revisions') }}</th>
            @if(!isset($noActions))
            <th width="20%">{{ Label::get('actions') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
        <tr>
            <td><strong>@if(isset($value->workExperience->company_name )) {{ $value->workExperience->company_name }} @endif</strong></td>
            <td>{{ $value->customer_name }}</td>
            <td>{{ $value->project_name }}</td>
            <td>{{ $value->job_title }}</td>
            <td>{{ $value->start_date }} - {{ $value->end_date }}</td>
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