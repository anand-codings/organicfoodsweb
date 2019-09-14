@extends('layouts.user_layout')
@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Farmer Login</p>
        <form action="{{route('farmer.login.post')}}" method="post">
            @csrf
            <?php if (Session::has('error')) { ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                <?php echo Session::get('error') ?>
            </div>
            <?php } ?>


            <?php if (Session::has('success')) { ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                <?php echo Session::get('success') ?>
            </div>
            <?php } ?>

            <?php if ($errors->any()) { ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors->all() as $error) { ?>
                    <li><?= $error ?></li>
                    <?php }
                    ?>
                </ul>
            </div>
            <?php } ?>
            <div class="form-group has-feedback">
                <input id="email" placeholder="Email" type="email"
                       class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                       required autocomplete="email" autofocus>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror

            </div>
            <div class="form-group has-feedback">
                <input id="password" placeholder="Password" type="password"
                       class="form-control @error('password') is-invalid @enderror" name="password" required
                       autocomplete="current-password">

                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember_me"> Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    {{--        <div class="social-auth-links text-center">--}}
    {{--            <p>- OR -</p>--}}
    {{--            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using--}}
    {{--                Facebook</a>--}}
    {{--            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using--}}
    {{--                Google+</a>--}}
    {{--        </div>--}}
    <!-- /.social-auth-links -->

        <a href="{{route('password.request')}}">I forgot my password</a><br>
        <a href="{{route('farmer.register')}}" class="text-center">Register as a new farmer</a>

    </div>
@endsection
