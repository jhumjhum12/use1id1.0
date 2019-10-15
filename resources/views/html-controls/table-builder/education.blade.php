@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="30%">{{ Label::get('institution') }} </th>
            <th width="25%">{{ Label::get('course_name') }}</th>
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
            <td><strong>{{ $value->institution_name }}</strong></td>
            <td>{{ $value->course_name }}</td>
            <td>{{ $value->start_date }}-{{ $value->end_date }}</td>
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