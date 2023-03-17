@if(isset($model) && ! is_null($model->id))
<button
    type="submit"
    class="btn btn-primary ml-1"
    id="editButton"
>
    <i class="fa fa-save"></i> Alterar
</button>
&nbsp;
<a href="{{route($backUrl)}}"
   id="cancelButton"
   class="btn btn-danger text-white ml-1"
>
    <i class="fas fa-ban"></i> Cancelar
</a>

@endif
