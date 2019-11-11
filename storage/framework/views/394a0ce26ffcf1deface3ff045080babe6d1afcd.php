<?php if(\App\ScreenBuilder\ScreenNew::helpAvailable()): ?>
<div class="sidebar">
    <?php if(!empty( \App\ScreenBuilder\ScreenNew::$screen->video)): ?>
        <iframe id="playerid"  width="100%" height="200" src="https://www.youtube.com/embed/<?php echo e(App\ConfScrIncludedVideos::get(App\ScreenBuilder\ScreenNew::$screen->video)); ?>" frameborder="0" allowfullscreen></iframe>
    <?php endif; ?>

    <?php if(!empty(\App\ScreenBuilder\ScreenNew::$screen->help_text)): ?>
        <p><?php echo nl2br(App\ConfLangInterfaceTexts::get(App\ScreenBuilder\ScreenNew::$screen->help_text)); ?></p>
	<?php endif; ?>

</div>
<?php endif; ?>