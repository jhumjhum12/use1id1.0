<?php for($i=0; $i<(sizeof($data)+1); $i++): ?>
<div class="tags-form">
	<div class="form-group">
	<div class="control-label">
		<label class="tags-label" for="tag-input">Tags</label>
	</div>
	<!-- <div class="tags-input"> -->
	<i class="fa fa-minus-circle remove-tag" aria-hidden="true"></i>
		<input name="tags[<?php echo e($i); ?>]"
	       autocomplete="off"
	       type="search"
	       list="languages"
	       value="<?php if(isset($data[$i])): ?><?php echo e($data[$i]->name); ?><?php endif; ?>"
	       class="form-control input-sm tags-input-field"
	       id="tag-input">
	<!-- </div>  -->
	<!-- <div class="remove-tags-input"> -->
	    
	<!-- </div> -->
	</div>
</div>
<?php endfor; ?>
<div class="new-tags-form">
</div>
<div class="form-group">
<div class="add-tags-form">
	<div class="control-label">
		<label class="tags-label" for="add-more-tags"></label>
	</div>
	<span id="add-more-tags" class="add-tag"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add more tags</span>
</div>
</div>

<datalist id="languages">
    <?php $__currentLoopData = $autocomplete; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <option value="<?php echo e($tag->name); ?>" />
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</datalist>