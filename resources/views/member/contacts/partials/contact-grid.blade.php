<div class="grid">
@foreach($contacts as $contact)

    <div class="grid-item">

        <img width="80" class="img-circle" src="{{ $contact->member->getImage() }}" />

        <h4 style="margin-bottom: 0">{{ $contact->member->getName() }}</h4>

        @if($contact->status==1)
        <small>{{ $contact->member->email }}</small>
            <br />
        @endif

        @if($contact->status_txt)
        <strong>{{ $contact->status_txt }}</strong>
        <br />
        @endif

        <div class="grid-buttons">

        @if($contact->status===null)
            <a class="btn btn-default" href="{{ route('contacts.invite.get', ['id'=>$contact->member->personal_id]) }}">{{ Label::get('send_invite') }}</a>
        @endif
        @if($contact->user_1 == Auth::user()->id && $contact->status==0)
            <a class="btn btn-default disabled" href="javascript:void(0)">{{ Label::get('request_pending') }}</a>
        @endif
        @if($contact->user_2 == Auth::user()->id && $contact->status==0)
            <a class="btn btn-default" href="{{ route('contacts.accept-invite', ['email'=>$contact->member->email]) }}">{{ Label::get('accept') }}</a>
        @endif
        @if($contact->status==1)
            <a class="btn btn-primary" href="{{ route('contacts.view.details', $contact->member->id) }}">{{ Label::get('view_profile') }}</a>
        @endif
        </div>


    </div>

@endforeach

    @if(count($contacts)==0)
        <div class="well">{{ Label::get('no_results_found') }}</div>
    @endif
</div>