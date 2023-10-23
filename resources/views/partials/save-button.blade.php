@if(!isset($showSave) || $showSave)
    <button
        class="btn btn-success text-white ml-1"
        id="submitButton"
        title="Salvar"
        onclick="this.disabled=true; this.form.submit();"
        @include('partials.disabled', ['model' => $model ?? null, ''])
    >
        <i class="fa fa-save"></i> Salvar
    </button>
@endIf

{{--<a href="{{ isset($id) ? route($backUrl, $id) : route($backUrl) }}"--}}
{{--url()->previous()--}}
@if(!isset($showCancel) || $showCancel)
    <a href="{{ isset($id) ? route($backUrl, $id) : route($backUrl) }}"
       id="cancelButton"
       title="Cancelar"
       class="btn btn-danger text-white ml-1"
    >
        <i class="fas fa-ban"></i> Cancelar
    </a>
@endIf
