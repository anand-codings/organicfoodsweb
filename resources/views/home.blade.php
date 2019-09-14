@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <?php if (Session::has('success')) { ?>
                        <div class="alert alert-success">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                            <?php echo Session::get('success') ?>
                        </div>
                        <?php } ?>

                        <?php if (Session::has('error')) { ?>
                        <div class="alert alert-danger">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times</a>
                            <?php echo Session::get('error') ?>
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

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
