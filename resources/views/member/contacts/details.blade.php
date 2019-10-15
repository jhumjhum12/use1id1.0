@extends('layouts.app', ['slug'=>'contacts', 'title'=>'' ,'submenu'=>\App\Http\Controllers\ContactsController::getViewSubmenu()])

@section('content')

    @if($user->id != Auth::user()->id)
    <form method="POST" action="{{ route('contacts.update-sharing.post', ['id'=>$user->id]) }}">

    <h2>Sharing Options</h2>

        <table class="sharing-table">
            <tr class="row-one">
                <th class="first-field"></th>
                <th>Basic Info</th>
                @foreach($contact->sharingOptions() as $k=>$v)
                <th>{{ $v }}</th>
                @endforeach
            </tr>
            <tr class="row-two">
                <td class="first-field">{{$user->first_name}} vs You:</td>
                <td><input type="checkbox" checked="checked" disabled="disabled"></td>
                @foreach($contact->sharingOptions() as $k=>$v)
                    <td><input type="checkbox" @if(in_array($k, $shareInverted)) checked="checked" @endif disabled="disabled" /></td>
                @endforeach
            </tr>
            <tr class="row-three">
                <td class="first-field">You vs {{$user->first_name}}:</td>
                <td><input type="checkbox" checked="checked" disabled="disabled" /></td>
                @foreach($contact->sharingOptions() as $k=>$v)
                    <td><label><input type="checkbox" name="share[]" @if(in_array($k, $share)) checked="checked" @endif value="{{ $k }}" /></label></td>
                @endforeach
            </tr>
            <tr>
                <td colspan="9"><button class="btn btn-danger">Submit</button></td>
            </tr>
        </table>
        
    </form>
    @endif



    <h2>{{ Label::get('basic_data') }}</h2>
    @include('member.contacts.partials.basic-data')
    <hr />

    @if($user->companies->count()>0 || $user->employee->count()>0)
        <h2>{{ Label::get('companies') }}</h2>
        @if($myOwn ||  in_array(2, $share) && in_array(2, $shareInverted) )

            @if($user->companies->count()>0)
                <h4><b>{{ Label::get('owner_of') }}</b></h4>
                @include('html-controls.table-builder.companies', ['data'=>$user->companies, 'noActions'=>true])
            @endif

            @if($user->employee->count()>0)
                <h4><b>{{ Label::get('employee_of') }}</b></h4>
                @include('html-controls.table-builder.companies-employee', ['data'=>$user->employee, 'noActions'=>true])
            @endif

        @else
            @include('member.contacts.partials.no-share')
        @endif
        <hr />
    @endif

    <h2>{{ Label::get('work_experience') }}</h2>
        @if($myOwn ||  in_array(1, $share) && in_array(1, $shareInverted) )
            @include('html-controls.table-builder.work_experience', ['data'=>$user->workExperience, 'noActions'=>true])
        @else
            @include('member.contacts.partials.no-share')
        @endif
    <hr />

    <h2>{{ Label::get('projects') }}</h2>
        @if($myOwn ||  in_array(3, $share) && in_array(3, $shareInverted) )
            @include('html-controls.table-builder.projects', ['data'=>$user->projects, 'noActions'=>true])
        @else
            @include('member.contacts.partials.no-share')
        @endif
    <hr />

    <h2>{{ Label::get('references') }}</h2>
        @if($myOwn ||  in_array(4, $share) && in_array(4, $shareInverted) )
            @include('html-controls.table-builder.references', ['data'=>$user->references, 'noActions'=>true])
        @else
            @include('member.contacts.partials.no-share')
        @endif
    <hr />

    <h2>{{ Label::get('education') }}</h2>
        @if($myOwn ||  in_array(5, $share) && in_array(5, $shareInverted) )
            @include('html-controls.table-builder.education', ['data'=>$user->education, 'noActions'=>true])
        @else
            @include('member.contacts.partials.no-share')
        @endif
    <hr />

    <h2>{{ Label::get('spoken_languages') }}</h2>
        @if($myOwn ||  in_array(6, $share) && in_array(6, $shareInverted) )
            @include('html-controls.table-builder.spoken_languages', ['data'=>$user->spokenLanguages, 'noActions'=>true])
        @else
            @include('member.contacts.partials.no-share')
        @endif
    <hr />

    <h2>{{ Label::get('contact_info') }}</h2>
        @if($myOwn ||  in_array(7, $share) && in_array(7, $shareInverted) )
            @include('html-controls.table-builder.contact_info', ['data'=>$user->contactInfo, 'noActions'=>true])
        @else
            @include('member.contacts.partials.no-share')
        @endif
    <hr />


    <script>
        window.onload = function(e){

            var count = 0;
            var len = $('.sharing-table tr:nth-child(2) td').length;

            for(i=0; i<=len; i++) {
                var checked = 0;
                $(".sharing-table tr:nth-child(2) td:nth-child("+i+"):has(:checkbox:checked)").each(function(){
                    checked++;
                });
                $(".sharing-table tr:nth-child(3) td:nth-child("+i+"):has(:checkbox:checked)").each(function(){
                    checked++;
                });
                var css="";
                if(checked==2) css = "match";
                if(checked==1) css = "semi-match";
                if(css!="") {
                    // set classes
                    $(".sharing-table tr:nth-child(1) th:nth-child("+i+")").addClass(css);
                    $(".sharing-table tr:nth-child(2) td:nth-child("+i+")").addClass(css);
                    $(".sharing-table tr:nth-child(3) td:nth-child("+i+")").addClass(css);
                }
            }

            // $('sharing-table')
        };

    </script>

@endsection
