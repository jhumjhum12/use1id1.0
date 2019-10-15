<table class="table">
    @foreach($value as $k=>$v)
        <tr>
            <th width="20%">{{ $k }}</th>
            <td width="80%">
                @if(is_array($v))
                    @include('member.contacts.partials.details-recursive-table', ['value'=>$v])
                @else
                    <strong>{{$v}}</strong>
                @endif           </td>
        </tr>
    @endforeach
</table>