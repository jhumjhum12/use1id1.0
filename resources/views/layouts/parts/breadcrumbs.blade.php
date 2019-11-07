<div class="breadcrumbs" >
@if(count(\App\ScreenBuilder\ScreenNew::$breadcrumbs)>1)	
    <ol class="breadcrumb">
        @foreach(\App\ScreenBuilder\Screen::$breadcrumbs as $slug=>$name)
            <li class="breadcrumb-item"><a href="{{ URL::to($slug) }}">{{ $name }}</a></li>
        @endforeach
    </ol>
@endif
</div>

@if(isset($submenu) && is_array($submenu))
    <div class="tab-nav">
        <div class="parent-submenu">
            <ul>
                @foreach($submenu as $name=>$url)
                    <li><a href="{{ $url }}">{{ $name }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
@elseif(count(\App\ScreenBuilder\ScreenNew::$sameParent)>1)
<div class="tab-nav">
    <div class="parent-submenu">
        <ul>
            @foreach(\App\ScreenBuilder\ScreenNew::$sameParent as $slg=>$name)
                <li><a @if($slug==$slg) class="active" @endif href="{{ URL::to($slg) }}">{{ $name }}</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endif


<div class="heading text-center"><h1>
        @if(isset($title)){{$title}}
        @elseif(isset(App\ScreenBuilder\ScreenNew::$screen))
            {{ Label::get(\App\ScreenBuilder\ScreenNew::$screen->label) }}
        @endif
    </h1></div>

@if (count($errors) > 0)
    <div class="notifications">
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    </div>
@endif

