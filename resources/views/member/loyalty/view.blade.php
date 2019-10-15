@extends('layouts.app', ['slug'=>'loyalty-cards'])
@section('content')


    <div class="row">
        <div class="col-md-3">
            <ul class="loyalty-class">
            @foreach($cards as $card)
                <li><a data-id="{{ $card['barcode'] }}"
                       data-company="{{ $card['name'] }}"
                       class="loyalty-card"
                       href="javascript:void(0)">
                        <img src="{{$card['logo']}}" class="img-circle img-responsive" /> <span>{{ $card['name'] }}</span></a></li>
            @endforeach
            </ul>
        </div>
        <div class="col-md-9">
            <h2 id="company"></h2>
            <div id="largeImage"></div>
        </div>
    </div>


    <script>
        window.onload = function() {

            $('.loyalty-card').click(function() {


                var newImg = '<img src="' + $(this).data('id') + '" alt="Loyalty Card" />';
                $('#largeImage').html(newImg);
                $("#company").text($(this).data('company'));



            });
        };
    </script>

@endsection
