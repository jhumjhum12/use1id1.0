@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="30%">{{ Label::get('language') }}</th>
            <th width="15%">{{ Label::get('listening') }}</th>
            <th width="15%">{{ Label::get('speaking') }}</th>
            <th width="15%">{{ Label::get('reading') }}</th>
            <th width="10%">{{ Label::get('writing') }}</th>
            @if(!isset($noActions))
            <th width="15%">{{ Label::get('actions') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
    @php( $language = \App\LanguagesList::find($value->language_id)) 
    
        <tr>
            <td><strong>{{ $language->name }}</strong></td>
            <td>{{ $value->listening }}</td>
            <td>{{ $value->speaking }}</td>
            <td>{{ $value->reading }}</td>
            <td>{{ $value->writing }}</td>
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