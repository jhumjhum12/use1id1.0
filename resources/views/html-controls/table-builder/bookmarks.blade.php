@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="70%">{{ Label::get('url') }}</th>
            <th width="10%">{{ Label::get('starred') }}</th>
            @if(!isset($noActions))
            <th width="20%">{{ Label::get('actions') }}</th>
            @endif
        </tr>
    </thead>
    <tbody>
    @foreach($data as $key=>$value)
        <tr>
            <td>
                <a href="{{ Label::getURL($value->url) }}" target="_blank"><strong>{{ $value->title }} &rarr; </strong></a>
                <small class="bookmark-link"><a href="{{ $value->url }}" target="_blank">{{ $value->url }}</a></small>

                <p>
                @foreach($value->tags as $tag)
                    <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
                </p>

            </td>
            <td>
                @if($value->starred)
                    <h3 style="margin: 0"><i class="fa fa-star"></i></h3>
                @else
                @endif
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