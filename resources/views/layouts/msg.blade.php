<div class="row">
    <div class="col-md-12">
        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                        <li><i class="fa fa-exclamation-circle"></i> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                <i class="fa fa-check-circle"></i> {{ session('status') }}
            </div>
        @endif
    </div>
</div>

