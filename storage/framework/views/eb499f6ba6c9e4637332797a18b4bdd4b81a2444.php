<?php $__env->startSection('content'); ?>

    <div style="padding: 0 20px 20px 20px;">

	<?php if($mode=='list'): ?>
		<h4>Translator</h4>
        <?php echo e(Form::open(['method'=>'get', 'route'=>['translator']])); ?>

		<div class="row">

			<div class="col-xs-4"><?php echo e(Form::select('cat', [null=>'Select Category'] + $categories, $selectedCat, ['class'=>'form-control'])); ?></div>
			<div class="col-xs-4"><?php echo e(Form::select('lng', $languages, $selectedLng, ['class'=>'form-control'])); ?></div>
			<div class="col-xs-2"><button class="btn btn-primary" type="submit">View</button></div>
		</div>
        <?php echo e(Form::close()); ?>


		<?php if(!empty($selectedCat)): ?>
		<?php echo e(Form::open(['method'=>'post', 'route'=>['translator.new']])); ?>

		<?php echo e(Form::text("cat", $selectedCat, ['hidden'])); ?>

		<div class="row">
			<div class="col-xs-4"><?php echo e(Form::text('key', null, ['class'=>'form-control', 'placeholder' => 'Enter new key'])); ?></div>
			<div class="col-xs-4"><?php echo e(Form::text('EN', null, ['class'=>'form-control', 'placeholder' => 'English'])); ?></div>

			<div class="col-xs-2"><button class="btn btn-primary" type="submit">Add New</button></div>
		</div>
        <?php echo e(Form::close()); ?>

		<?php endif; ?>
		<?php if($selectedCat == 'messages'): ?>
		<?php echo e(Form::open(['method'=>'post', 'route'=>['translator.compile']])); ?>

		<?php echo e(Form::text("lng", $selectedLng, ['hidden'])); ?>

		<div class="row">
			<div class="col-xs-2"><button class="btn btn-primary" type="submit">Compile Messages</button></div>
		</div>
        <?php echo e(Form::close()); ?>

		<?php endif; ?>
		<?php if(Session::has('message')): ?>
		<p class="alert <?php echo e(Session::get('alert-class', 'alert-info')); ?>"><?php echo e(Session::get('message')); ?></p>
		<?php endif; ?>
		<?php if(!empty($rows)): ?>
		<?php $cols = $selectedLng=='EN'?'col-xs-4':'col-xs-3';?>
		<div class="screen-item">
			<div class="row">
				<div class="<?php echo e($cols); ?>"><strong>Key</strong></div>
				<div class="<?php echo e($cols); ?>"><strong>English</strong></div>
				<?php if($selectedLng !== 'EN'): ?>
				<div class="col-xs-3"><strong><?php echo e($languages[$selectedLng]); ?></strong></div>
				<?php endif; ?>
				<div class="<?php echo e($cols); ?> text-right"><strong>Missing Translations</strong></div>
			</div>
		</div>
    <div class="data-rows">
			<?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $row): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<div class="screen-item">
                    <div class="row">
                        <div class="<?php echo e($cols); ?>">
							<?php echo e($key); ?>

                        </div>
                        <div class="<?php echo e($cols); ?>">
                            <?php echo e($row['EN']['msg_txt']); ?>


                        </div>
						<?php if($selectedLng !== 'EN'): ?>
              <div class="col-xs-3">
                <input type="text" class="edit-trans"  style="height: 30px;width:70%;"
                  data-lang="<?php echo e($selectedLng); ?>"
                  data-cat="<?php echo e($selectedCat); ?>"
                  data-key="<?php echo e($key); ?>"
                  data-id="<?php echo e(isset($row[$selectedLng]['id']) ? $row[$selectedLng]['id'] : '0'); ?>"
                  data-text="<?php echo e(isset($row[$selectedLng]['msg_txt']) ? $row[$selectedLng]['msg_txt'] : ''); ?>"
                  value="<?php echo e(isset($row[$selectedLng]['msg_txt']) ? $row[$selectedLng]['msg_txt'] : ''); ?>"/>
                &nbsp;&nbsp;
                <span class="success-msg" style="color:green;display:none">Saved</span>
                <span class="error-msg" style="color:red;display:none">Error</span>
              </div>
						<?php endif; ?>
                        <div class="<?php echo e($cols); ?> text-right">
                            <div class="btn-group">
                            <a tabindex="-1" href="<?php echo e(route('translator', $key)); ?>?cat=<?php echo e($selectedCat); ?>&lng=<?php echo e($selectedLng); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>
							<?php $__currentLoopData = $row['_missing']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                            <a tabindex="-1" href="<?php echo e(route('translator', $key)); ?>?cat=<?php echo e($selectedCat); ?>&lng=<?php echo e($selectedLng); ?>" class="btn btn-danger btn-xs"><?php echo e($m); ?></a>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                            </div>
                        </div>
                    </div>

                </div>

			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
    </div>
		<?php endif; ?>

		<hr />

	<p>Auto Translate: <br/>
		<small>Click on one of available languages to auto-translate all missing translations.
			It may take some time. New page will show up with report.</small>
	</p>
		<ul>
			<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$l): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				<li><a href="<?php echo e(route('translator.yandex', ['id'=>$key])); ?>" target="_blank"><?php echo e($l); ?></a></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
		</ul>

	<?php endif; ?>

	<?php if($mode=='edit'): ?>
	    <h3>Key: <?php echo e($key); ?></h3>
        <?php echo e(Form::open(['method'=>'post', 'route'=>['translator.update', $key ]])); ?>

		<?php echo e(Form::text("cat", $selectedCat, ['hidden'])); ?>

		<?php echo e(Form::text("lng", $selectedLng, ['hidden'])); ?>


		<?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$v): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
		<?php
		$txt = empty($rows[$key][$k]['msg_txt']) ? '' : $rows[$key][$k]['msg_txt'];
		?>
			<div class="row form-group" style="max-width: none;">
				<div class="col-xs-4">
					<?php echo e(Form::label($k, $v, ['class' => ''])); ?>

					<?php echo e(Form::textarea($k, $txt, ['class'=>'form-control', 'style' => 'width:250px;height:100px'])); ?>

					<?php if(!empty($rows[$key][$k]['id'])): ?>
						<?php echo e(Form::text($k.":id", $rows[$key][$k]['id'], ['hidden'])); ?>

					<?php endif; ?>
				</div>
			</div>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>

		<div class="row form-group">
            <div><button class="btn btn-primary" type="submit" style='float:none;margin-left:-20px;'>Update</button></div>
        </div>
        <?php echo e(Form::close()); ?>


	<?php endif; ?>
	</div>
  <!--<script type="text/javascript" src="<?php echo e(asset('js/jquery-3.1.1.min.js')); ?>"></script>-->
  <script type="text/javascript" src="<?php echo e(asset('js/translator.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-original', ['class'=>'page-screen-builder'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>