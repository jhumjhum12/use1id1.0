@extends('layouts.app')

@section('content')


    <div class="page">

        <div class="main">

            <h1>E-Mail Activation</h1>

            @if($activationSuccess)

                <h3>Activation Successful!</h3>
                <p>Thank you!</p>
            @else
                <h3>Code is already used, expired or invalid.</h3>

            @endif


</div>

</div>

@endsection
