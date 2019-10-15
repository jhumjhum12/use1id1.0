<?php if(\App\ScreenBuilder\Screen::helpAvailable()): ?>
<div class="sidebar">
    <?php if(!empty( \App\ScreenBuilder\Screen::$screen->help_video_url)): ?>
        <iframe id="playerid"  width="100%" height="200" src="https://www.youtube.com/embed/<?php echo e(\App\ScreenBuilder\Screen::$screen->help_video_url); ?>" frameborder="0" allowfullscreen></iframe>
    <?php endif; ?>

    <?php if(!empty(\App\ScreenBuilder\Screen::$screen->help_label)): ?>
        <p><?php echo nl2br(Label::get(\App\ScreenBuilder\Screen::$screen->help_label)); ?></p>
    <?php else: ?>
        <p><?php echo nl2br(\App\ScreenBuilder\Screen::$screen->help_html); ?></p>
    <?php endif; ?>

</div>
<?php endif; ?>