@extends('dashboard.layout')

@section('content')

    <section class="content-header">
        <h1>
            Organic
            <small>{{ $title }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= asset('admin_dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                        <a href="{{ route('add_product')}}" class="btn btn-primary pull-right identity"  >Add Products</a>
                    </div>
                    <div class="box-body">
                        <table id="full_feature_datatable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Product</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Featured Image</th>
                                <th>User</th>
                                <th>Unit</th>
                                <th>Category</th>

                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sr_num = 1
                            @endphp

                            @foreach ($products as $data)
                                <tr>
                                    <td>
                                        {{ $sr_num }}
                                        @php
                                            $sr_num++;
                                        @endphp
                                    </td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>{{ $data->quantity }}</td>
                                    <td><img src="{{ asset(isset($data->getFeaturedImage) ? $data->getFeaturedImage->path : 'public/images/images.png' )}}" class="img-circle" width="90px" height="100"></td>
                                    <td>{{ isset($data->getUser) ? $data->getUser->name : ''  }}</td>
                                    <td>{{ isset($data->getUnit) ? $data->getUnit->name : ''}}</td>
                                    <td>{{ isset($data->getCategory) ? $data->getCategory->name : ''}}</td>

                                    <td>
                                        <a href="{{ route('detail_product',['id'=>$data->id]) }}" class="text-primary"><i class="fa  fa-eye"></i></a>
                                        <a href="javascript:void(0)"  data-toggle="modal" data-target="#confirm-delete{{ $data->id }}" class="text-danger delete"><i class="fa fa-trash-o"></i></a>
                                        <a href="{{ route('add_product',['id'=>$data->id]) }}" class="text-primary"><i class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="confirm-delete<?=$data->id?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3>Confirm</h3>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete this category?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default close_modal" data-dismiss="modal">Cancel</button>
                                                <a href="{{ route('delete_product',['id'=>$data->id]) }}"  class="btn btn-danger btn-ok" >Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                            </tbody>
                        </table>

                        <div class="pull-right">
                            <?php // echo $HashTag->render(); ?>
                            {{ $products->render() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>

    <!-- /Interest modal End-->

    <!--Edit Interest Modal start-->


@endsection
@section('js')
    <script>
        $("#add_category").validate({
            rules: {
                category: {
                    required: true,
                    minlength: 3,
                }

            },
        });
        $('body').on('click','.cat',function(){
            var a = $(this).data('id');

// alert(a);
            $('.update_cat'+a).validate({

                rules: {

                    category: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        }

                    }
                }


            });
        });
    </script>
@endsection
