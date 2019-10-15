@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="30%">{{ Label::get('name') }} </th>
            <th width="50%">{{ Label::get('revisions') }}</th>
            @if(!isset($noActions))
            <th width="20%">{{ Label::get('actions') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
        <tr>
            <td><strong>{{ $value->name }}</strong></td>
            <td><i class="fa fa-comment-o"></i> {{ sizeof($value->revisions) }}</td>
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
