@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="20%">Name</th>
            <th width="20%">Url</th>
            <th width="10%">Username</th>
            <th width="10%">Password</th>
			<th width="20%">Notes</th>
            <th width="20%">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
        <tr>
            <td><strong>{{ $value->name }}</strong></td>
            <td>{{ $value->url }}</td>
            <td>{{ $value->username }}</td>
            <td><span><i class="fa fa-lock"></i></span></td>
			<td>{{ $value->notes }}</td>
            <td>
                <a class="btn btn-primary" href="?{{ $db_table }}={{ $value->id }}">{{ \App\Label::get('Edit') }}</a>
                @include('html-controls.table-builder.includes.delete-btn', ['seg'=> $seg->id, 'value'=> $value->id ] )
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</div>
@else
    <div class="well">{{ Label::get('no_results_found') }}</div>
@endif