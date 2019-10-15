 <table class="table table-bordered table-striped mb-0">
 @foreach($table_column as $column) 
@if(($column!='id') && ($column!='created_at') && ($column!='updated_at'))	
 <tr><td>{{ $column}}</td><td><input type="text" name="{{ $column}}" class="addcolumn"/></td></tr>
 @endif	
@endforeach
 </table>