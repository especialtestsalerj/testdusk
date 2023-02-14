
{{--

<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-sm-12 col-md-8 col-lg-5 my-4">
            <div>
                {{ $logo }}
            </div>

            <div class="card shadow-sm px-1 mx-4">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

--}}


<div class="container">
    <div class="row">
        <div class="Absolute-Center is-Responsive">

            <div class="col-sm-12 col-md-10 col-md-offset-1 card px-4 py-4">

                <div class="">
                    {{ $logo }}
                </div>

                <div class="">
                    {{ $slot }}
                </div>
{{--
                <form action="" id="loginForm">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" type="text" name='username' placeholder="username"/>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input class="form-control" type="password" name='password' placeholder="password"/>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">Terms and Conditions</a>
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-def btn-block">Login</button>
                    </div>
                    <div class="form-group text-center">
                        <a href="#">Forgot Password</a>&nbsp;|&nbsp;<a href="#">Support</a>
                    </div>
                </form>
                --}}
            </div>
        </div>
    </div>
</div>
