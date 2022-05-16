<button
    type="submit"
    class="btn btn-outline-success ml-1"
    id="submitButton"
    @include('partials.disabled', ['model' => $model ?? null])
>
    <i class="fa fa-save"></i> Salvar
</button>
&nbsp;
<a href="{{route($backUrl)}}"
   id="cancelButton"
   class="btn btn-outline-danger ml-1"
>
    <i class="fas fa-ban"></i> Cancelar
</a>
