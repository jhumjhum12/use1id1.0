@if(sizeof($data)>0)
<div class="table-wrap">
    <table class="table">
    <thead>
        <tr>
            <th width="5%">{{ Label::get('logo') }}</th>
            <th width="40%">{{ Label::get('company_name') }}</th>
            <th width="20%">{{ Label::get('registration_number') }}</th>
            <th width="20%">{{ Label::get('website') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $value)
            <tr>
                <td><img src="{{ $value->company->getImage() }}" height="32" /></td>
                <td>{{ $value->company->name }}</td>
                <td>{{ $value->company->registration_number }}</td>
                <td><a href="{{ Label::getURL($value->company->website) }}" target="_blank">{{ $value->company->website }}</a></td>
            </tr>
    @endforeach

    </tbody>
</table>
</div>
@else
    <div class="well">{{ Label::get('no_results_found') }}</div>
@endif