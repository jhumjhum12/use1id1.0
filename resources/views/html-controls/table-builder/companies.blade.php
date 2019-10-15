@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="5%">{{ Label::get('logo') }}</th>
            <th width="40%">{{ Label::get('company_name') }}</th>
            <th width="20%">{{ Label::get('registration_number') }}</th>
            <th width="20%">{{ Label::get('website') }}</th>
            @if(!isset($noActions))
            <th width="15%">{{ Label::get('actions') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
        <tr>
            <td><img src="{{ $value->getImage() }}" height="32" /></td>
            <td>{{ $value->name }}</td>
            <td>{{ $value->registration_number }}</td>
            <td><a href="{{ Label::getURL($value->website) }}" target="_blank">{{ $value->website }}</a></td>
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