<div class="row" wire:ignore>
    <div class="col-md-12">
        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa fa-lg fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('message'))
            <div class="alert alert-success">
                <i class="fa fa-lg fa-check-circle"></i> {{ session('message') }}
            </div>
        @endif
    </div>
</div>

