@extends('layouts.user_layout')
@section('content')
    <div class="register-box-body">
        <p class="login-box-msg">Register a new Farmer</p>

        <form action="{{route('farmer.register')}}" method="post">
            @csrf
            <?php
            if ($errors->any()) {
            foreach ($errors->all() as $error) {
            ?>
            <h6 class="alert alert-danger"> <?php echo $error ?></h6>
            <?php
            }
            }
            if (Session::has('error')) {
            ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                <?php echo Session::get('error') ?>
            </div>
            <?php } ?>
            <input type="hidden" id="lat" name="lat">
            <input type="hidden" id="long" name="long">
            <div class="form-group has-feedback">
                <input id="name" placeholder="Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" placeholder="Retype Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember_me" onchange="isChecked(this, 'submit_btn')"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" id="submit_btn">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

{{--        <div class="social-auth-links text-center">--}}
{{--            <p>- OR -</p>--}}
{{--            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using--}}
{{--                Facebook</a>--}}
{{--            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using--}}
{{--                Google+</a>--}}
{{--        </div>--}}

        <a href="{{route('farmer.login')}}" class="text-center">I already have a account</a>
    </div>
@endsection
