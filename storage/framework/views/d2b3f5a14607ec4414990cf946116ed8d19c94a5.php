<?php for($i=0; $i<(sizeof($data)+1); $i++): ?>
<?php
if(isset($data[$i])) {
	$type = $data[$i]->type;
	$content = $data[$i]->content;
} else {
	$type = null;
	$content = null;
}
?>
<div class="tags-form">
	<div class="form-group">
	<div class="control-label">
		<label class="tags-label" for="tag-input"> </label>
	</div>
		<div class="tags-fields">
		<i class="fa fa-minus-circle remove-tag" aria-hidden="true"></i>
		
		<?php echo e(Form::select('contacts[' . $i . '][type]', $contactOptions, $type, ['class'=>'form-control contact-select']  )); ?>

		<?php echo e(Form::text('contacts[' . $i . '][content]', $content,  ['class'=>'form-control contact-input'])); ?>

		</div>
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
