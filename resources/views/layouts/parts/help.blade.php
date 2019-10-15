@if(\App\ScreenBuilder\Screen::helpAvailable())
<div class="sidebar">
    @if(!empty( \App\ScreenBuilder\Screen::$screen->help_video_url))
        <iframe id="playerid"  width="100%" height="200" src="https://www.youtube.com/embed/{{ \App\ScreenBuilder\Screen::$screen->help_video_url }}" frameborder="0" allowfullscreen></iframe>
    @endif

    @if(!empty(\App\ScreenBuilder\Screen::$screen->help_label))
        <p>{!! nl2br(Label::get(\App\ScreenBuilder\Screen::$screen->help_label)) !!}</p>
    @else
        <p>{!!  nl2br(\App\ScreenBuilder\Screen::$screen->help_html)  !!}</p>
    @endif

</div>
@endif