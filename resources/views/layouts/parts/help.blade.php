@if(\App\ScreenBuilder\ScreenNew::helpAvailable())
<div class="sidebar">
    @if(!empty( \App\ScreenBuilder\ScreenNew::$screen->video))
        <iframe id="playerid"  width="100%" height="200" src="https://www.youtube.com/embed/{{ App\ConfScrIncludedVideos::get(App\ScreenBuilder\ScreenNew::$screen->video) }}" frameborder="0" allowfullscreen></iframe>
    @endif

    @if(!empty(\App\ScreenBuilder\ScreenNew::$screen->help_text))
        <p>{!! nl2br(App\ConfLangInterfaceTexts::get(App\ScreenBuilder\ScreenNew::$screen->help_text)) !!}</p>
	@endif

</div>
@endif