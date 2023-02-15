<button
    type="submit"
    class="btn btn-success ml-1"
    id="submitButton"
    @include('partials.disabled', ['model' => $model ?? null, $permission])
>
    <i class="fa fa-save"></i> Salvar
</button>
&nbsp;@if(isset($id))
<a href="{{route($backUrl,$id)}}"
   id="cancelButton"
   class="btn btn-danger ml-1"
>
    @else
        <a href="{{route($backUrl)}}"
           id="cancelButton"
           class="btn btn-danger ml-1"
        >
        @endif
    <i class="fas fa-ban"></i> Cancelar
</a>
