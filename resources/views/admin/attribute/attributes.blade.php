@extends('dashboard.layout')

@section('content')

    <section class="content-header">
        <h1>
            Organic
            <small>{{ $title }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="<?= asset('hash_tags') ?>">{{ $title }}</a></li>
        </ol>
        <div class="box-header">
            <div class="alert alert-success  in alert-dismissible ajax-label" style="display: none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <span class="ajax-label-body"></span>
            </div>
            <div id="successMessage">
                @include('includes.messages')
            </div>

        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?= $title;?></h3>
                    </div>
                    <div class="col-md-12">
                        <input type="button" class="btn btn-primary pull-right identity" data-toggle="modal"
                               data-target="#add-tag-modal" value="Add Attribute">
                    </div>
                    <div class="box-body">
                        <table id="full_feature_datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Name</th>
                                <th>Value</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sr_num = 1
                            @endphp

                            @foreach ($attributes as $data)
                                <tr>
                                    <td>
                                        {{ $sr_num }}
                                        @php
                                            $sr_num++;
                                        @endphp
                                    </td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->value }}</td>

                                    <td>
                                        <a href="javascript:void(0)" data-toggle="modal"
                                           data-target="#confirm-delete{{ $data->id }}" class="text-danger delete"><i
                                                class="fa fa-trash-o"></i></a>
                                        <a href="javascript:void(0)" data-toggle="modal"
                                           data-target="#edit-modal{{ $data->id }}" class="text-primary"><i
                                                class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="confirm-delete<?=$data->id?>" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Confirm</h3>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete this attribute?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default close_modal"
                                                        data-dismiss="modal">Cancel
                                                </button>
                                                <a href="{{ asset('admin/delete_attribute/'.$data->id)}}"
                                                   class="btn btn-danger btn-ok">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade view_details" id="edit-modal{{ $data->id }}">
                                    <form class="update_cat{{$data->id}}" action="{{ route('attribute.update')}}"
                                          method="Post">
                                        {{ csrf_field() }}
                                        <div class="modal-dialog">


                                            <div class="modal-content" id="test">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title">Update Attribute</h4>
                                                </div>
                                                <div class="modal-body show_details">
                                                    <input type="hidden" name="attribute_id" value="{{ $data->id }}">
                                                    <label for="name">Name</label>
                                                    <input id="name" name="name" type="text" class="form-control"
                                                           value="{{ $data->name }}" required>
                                                    <label for="value">Value</label>
                                                    <input id="value" name="value" type="text" class="form-control"
                                                           value="{{ $data->value }}" required>

                                                </div>

                                                <div class="col-md-12">
                                                    <!--<span class="error_title" style="color:red; display:none;">This field is required.</span>-->
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="btn btn-success pull-left cat"
                                                           data-id="{{  $data->id }}" value="Save">
                                                    <button type="button" class="btn btn-default pull-right close_modal"
                                                            data-dismiss="modal">Exit
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->

                                        </div>
                                        <!-- /.modal-dialog -->
                                    </form>
                                </div>





                            @endforeach
                            </tbody>
                        </table>

                        <div class="pull-right">
                            <?php // echo $HashTag->render(); ?>
{{--                            {{ $attributes->render() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    <div class="modal fade" id="add-tag-modal">
        <form id="add_attribute" action="{{ route('attribute.store') }}" method="post">
            {{ csrf_field() }}
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Attribute</h4>
                    </div>
                    <div class="modal-body">
                        <label>Name: </label>
                        <input name="name" class="form-control" type="text" required>

                        <label>Value: </label>
                        <input name="value" class="form-control" type="text" required>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success pull-left" value="Save">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    <!-- /Interest modal End-->

    <!--Edit Interest Modal start-->


@endsection
@section('js')
    <script>
        $("#add_attribute").validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3,
                },
                value: {
                    required: true,
                    // minlength: 3,
                },

            },
        });
        $('body').on('click', '.cat', function () {
            var a = $(this).data('id');

// alert(a);
            $('.update_cat' + a).validate({

                rules: {

                    name: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                    },
                    value: {
                        required: true,
                        // normalizer: function (value) {
                        //     return $.trim(value);
                        }

                    },

                }


            });
        });
    </script>
@endsection
