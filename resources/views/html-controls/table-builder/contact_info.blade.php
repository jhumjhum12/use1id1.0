<?php $options = \App\Models\ContactInfo::optionsProvider() ?>
@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="20%">Contact Type</th>
            <th width="80%">Info</th>
            @if(!isset($noActions))
            <th width="20%">{{ Label::get('actions') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
        <tr>
            <td>
                @if(isset($options[$value->type])) {{ $options[$value->type] }} @endif
            </td>
            <td>
                {{ $value->content }}
            </td>
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