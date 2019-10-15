<form method="post" style="padding: 0; width: auto" onSubmit="if(!confirm('Please confirm delete')){return false;}">
    <input type="hidden" name="function" value="{{ $seg }}::delete" />
    <input type="hidden" name="id" value="{{ $value }}" />
    <button class="btn btn-danger submit-delete"><i class="fa fa-trash-o"></i></button>
</form>
