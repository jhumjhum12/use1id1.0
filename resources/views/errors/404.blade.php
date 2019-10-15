@extends('layouts.app')

@section('content')

        <div class="container">
            <div class="content">
                <div class="title title-404">{{ $error or "404 Error" }}</div>
            </div>
        </div>
    </body>
</html>

@endsection
