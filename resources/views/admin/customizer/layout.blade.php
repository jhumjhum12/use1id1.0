<script src="js/file-explore.js"></script>
<link href="css/file-explore.css" rel="stylesheet">
<script src="js/table2excel.js"></script>

<style>
* {
  box-sizing:border-box;
}

.left {
  //background-color:#2196F3;
  background-color:#f1f1f1;
  padding:20px;
  float:left;
  margin-right: 5px;
}

.main {
  background-color:#f1f1f1;
  padding:20px;
  float:left;
	margin-right: 5px;
}

.right {
  background-color:#f1f1f1;
  padding:20px;
  float:left;
}

/* Use a media query to add a break point at 800px: */
@media screen and (max-width:800px) {
  .left, .main, .right {
    width:100%; /* The width is 100%, when the viewport is 800px or smaller */
  }
}
</style>




<h2>{{$layout}}</h2>
@if($layout == 'Customizing(Inline)')
<div class="left small-section scrollClass">
  <ul class="file-tree">
	  @foreach($tree as $t)
		  <li><a class="openTree cur_pointer">{{$t->description}}</a>
			<ul>
			@if(count($t->childs) >0)
				@foreach($t->child as $ch)
					 
						<li>
						
						<a class="openTree cur_pointer">{{$ch->description}}</a>
						  <ul>
							@foreach($ch->child1 as $k=>$ch1)
							  <li> 
							  <i class="fa fa-info-circle info-icon"  data-id="{{$ch1->id}}" aria-hidden="true"></i>
							  <a OnClick="shownew(this.id);" data-layout="{{$layout}}" class="" id="last_{{$ch1->id}}" style="cursor: pointer;">{{$ch1->description}}</a> </li>
							@endforeach  
						   </ul>
						</li>
					
				@endforeach
			@else
				@if(!empty($t->child1))
					@foreach($t->child1 as $ch)
						 
							 <li> 
							 <i class="fa fa-info-circle info-icon"  data-id="{{$ch->id}}" aria-hidden="true"></i>
							 <a OnClick="shownew(this.id);" data-layout="{{$layout}}" class="" id="last_{{$ch->id}}" style="cursor: pointer;">{{$ch->description}}</a> </li>
							
						
					@endforeach
				@endif
			@endif
			  </ul>
		  </li>
	  @endforeach
  </ul>
</div>

<div class="main big-section scrollClass" id="result">
  <p>Content</p>
</div>

<div class="right hide-section">
  <p>Edit Content</p>
  <a class="cur_pointer closeSection" id="">Close</a>
</div>
@else

	<div class="left small-section " >
	  <ul class="file-tree">
		  @foreach($tree as $t)
			  <li><a class="openTree cur_pointer">{{$t->description}}</a>
				<ul>
				@if(count($t->childs) >0)
					@foreach($t->child as $ch)
							<li><a class="openTree cur_pointer">{{$ch->description}}</a>
							  <ul>
								@foreach($ch->child1 as $k=>$ch1)
								  <li> 
								  <i class="fa fa-info-circle info-icon"  data-id="{{$ch1->id}}" aria-hidden="true"></i>
								  <a OnClick="shownew(this.id);" data-layout="{{$layout}}" class="" id="last_{{$ch1->id}}" style="cursor: pointer;">{{$ch1->description}}</a> </li>
								@endforeach  
							   </ul>
							</li>
						@endforeach
				@else
					@if(!empty($t->child1))
						@foreach($t->child1 as $ch)
							 
								 <li> 
								 <i class="fa fa-info-circle info-icon"  data-id="{{$ch->id}}" aria-hidden="true"></i>
								 <a OnClick="shownew(this.id);" data-layout="{{$layout}}" class="" id="last_{{$ch->id}}" style="cursor: pointer;">{{$ch->description}}</a> </li>
								
							
						@endforeach
					@endif
				@endif	
				  </ul>
			  </li>
		  @endforeach
	  </ul>
	</div>
	<div class="main medium-section" style="background-color:#e5e5e5 !important;">
	  
	</div>
	<div class="right small-section " style="background-color:#e5e5e5 !important;">
	  
	</div>
	

@endif
	<div id="importmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Import your data</h4>
      </div>
	 <form action="import" method="post" enctype="multipart/form-data" id="uploadform">
      <div class="modal-body" id="edit_table">
         
		<div class="form-group">
                  <div class="control-label">
                     <label for="avatar">Import</label>
                  </div>
                   <input type="file" name="importdata" id="importdataval"/>
               </div>
		
      </div>
      <div class="modal-footer">
	   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-default" id="import-data" data-url="import">Submit</button>
      </div>
	  </form>
	 
    </div>

  </div>
</div>
<script>
$(document).ready(function() {
  $(".file-tree").filetree();
});

$(document).ready(function() {
  $(".file-tree").filetree({
    animationSpeed: 'fast'
  });
});

$(document).ready(function() {
  $(".file-tree").filetree({
    collapsed: true,
  });
});

</script>
