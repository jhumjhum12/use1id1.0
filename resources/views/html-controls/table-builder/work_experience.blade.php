@if($data)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="20%">{{ Label::get('company_name') }}</th>
            <th width="20%">{{ Label::get('job_title') }}</th>
            <th width="15%">{{ Label::get('start_date') }}</th>
            <th width="15%">{{ Label::get('end_date') }}</th>
            <th width="15%">{{ Label::get('revisions') }}</th>
            @if(!isset($noActions))
            <th width="15%">{{ Label::get('actions') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
        <tr>
            <td><strong>{{ $value->company_name }}</strong></td>
            <td>{{ $value->job_title }}</td>
            <td>{{ $value->start_date }}</td>
            <td>{{ $value->end_date }}</td>
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