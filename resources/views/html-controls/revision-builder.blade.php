<hr style="margin: 10px 0" />
<div id="revisions">
 <?php $i = 0; ?>

 <div class="form-group">

  <div class="control-label">
    <label>{{ Label::get("revision") }}</label>
  </div>

  <div id="revision-selector">
      
  </div>

   @foreach($data as $key=>$text)

    <div style="clear: both" class="revision" data-id="{{ $key }}">

     
    </div>

   @endforeach

 </div>
</div>

