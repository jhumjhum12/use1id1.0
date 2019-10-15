<button type="button" class="btn btn-primary btn-modal-feedback btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm"><i class="fa fa-comments" aria-hidden="true"></i> Feedback</button>

<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="row">
      	<div class="col-md-12 modal-col">
      		<button type="button" class="close" data-dismiss="modal">&times;</button>
      		<h3>Feedback</h3>
      	</div>
      </div>
      <!-- <form class="feedback-form" method="POST" action="<?php echo e(route('send.feedback')); ?>"> -->
      <?php echo e(Form::open(array('route' => 'send.feedback'))); ?>

      <div class="row">
	      <div class="col-md-12 modal-col">
	      	<?php echo e(Form::label('feedback-label', 'Feedback Type', array('class' => 'awesome'))); ?>

	      	
	      		<?php echo e(Form::select('feedback_type', ['Other' => 'Other','Problem' => 'Problem','Question' => 'Question','Credits' => 'Credits','Suggestion' => 'Suggestion'], null,  array('class' => 'form-control', 'id' => 'feedback-type'))); ?>

	      	</div>
      </div>
      <div class="row">
      	<div class="col-md-12 modal-col">
      	 <?php echo e(Form::textarea('feedback', null, ['class' => 'form-control', 'required' => 'required'])); ?>

      		
      	</div>
      </div>
      <div class="row">
      	<div class="col-md-12 modal-col modal-col-btn">
      			<?php echo e(Form::submit('Submit Feedback', array('class' => 'btn btn-primary'))); ?>

      			
      	</div>
      </div> 
      <input type="hidden" name="current_url" value='<?php echo e(Request::fullUrl()); ?>'>
      <?php echo e(Form::close()); ?>

      
     

    </div>
  </div>
</div>


