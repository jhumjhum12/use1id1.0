<div class="grid">
@foreach($companies as $company)

    <div class="grid-item">

        <p style="line-height: 100px; height: 100px; ">
        <img width="80" src="{{ $company->getImage() }}" />
        </p>

        <h4 style="margin-bottom: 0">{{ $company->name }}</h4>

        <hr style="margin: 4px 0" />
        

        <form style="padding: 0" method="POST" action="{{ route('contacts.company.post', ['id' => $company->id]) }}">
        <div class="grid-buttons">
        
        <p>{{ Label::get('register_as') }}</p>
        <button type="submit" name="type" value="customer" class="btn @if($company->isContact(Auth::user()->id, 'customer')) btn-primary @else btn-default @endif ">{{ Label::get('customer') }}</button>
        <button type="submit" name="type" value="employee" class="btn @if($company->isContact(Auth::user()->id, 'employee')) btn-primary @else btn-default @endif">{{ Label::get('employee') }}</button>
        </div>
        </form>

    </div>

@endforeach

    @if(sizeof($companies)==0)
        <div class="well">{{ Label::get('no_results_found') }}</div>
    @endif

</div>