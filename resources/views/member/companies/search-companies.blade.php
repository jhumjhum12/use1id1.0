@extends('layouts.app')

@section('content')

    <form method="GET" action="{{ route('contacts.companies.search') }}">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" value="{{ $searchString }}" placeholder="Search 1iD">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit">Search</button>
          </span>
                </div>
            </div>
        </div>
    </form>

    @include('member.contacts.partials.companies-grid')

@endsection

