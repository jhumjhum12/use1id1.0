
<tr class="">
   <td>
	  {{ Form::select('version_id['.$rowval.']',$version,null,array( 'class'=>'form-control input-sm', 'required'=>'true','id'=>'VersionList')) }}
   </td>
   <td>
	  {{ Form::select('language_id['.$rowval.']',$language,null,array( 'class'=>'form-control input-sm', 'required'=>'true','id'=>'VersionList')) }}
   </td>
   <td>{{ Form::checkbox('listening['.$rowval.']',1,null, array('id'=>'listening','class'=>'form-control')) }}</td>
   <td>{{ Form::checkbox('speaking['.$rowval.']',1,null, array('id'=>'speaking','class'=>'form-control')) }}</td>
   <td>{{ Form::checkbox('reading['.$rowval.']',1,null, array('id'=>'reading','class'=>'form-control')) }}</td>
   <td>{{ Form::checkbox('writing['.$rowval.']',1,null, array('id'=>'writing','class'=>'form-control')) }}</td>
   <td><a id="deleteRow" title="Delete Row" class="cur_pointer"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
</tr>
                   