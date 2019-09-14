@extends('dashboard.layout')

@section('content')

<style>
  
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
</style>
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
<section class="content">
                    <div class="row">
                        <div class="col-xs-12">
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="add_product" action="{{ route('post_add_product')}}" method="Post" enctype='multipart/form-data'>
                {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter product name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <textarea type="text" name="description" class="form-control" id="exampleInputPassword1" placeholder="Description Here"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Price</label>
                  <input type="text" name="price" class="form-control" id="exampleInputPassword1" placeholder="$0.00">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Quantity</label>
                  <input type="text" name="quantityy" class="form-control" id="exampleInputPassword1" placeholder="Quantity Here">
                </div>
                  <div class="form-group">
                  <label>Select Category</label>
                  <select name= "category_id" class="form-control">
                    @foreach ($categories as $category)
                      <option value="{{ $category->id}}">{{ $category->name}}</option>
                      
                    @endforeach
                    
                  </select>
                </div>
                  <div class="form-group">
                  <label>Select</label>
                  <select name="unitt_id" class="form-control">
                      
                     @foreach ($units as $unit)
                      <option value="{{ $unit->id}}">{{ $unit->name}}</option>
                      
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Featured Image</label>
                  <input type="file" name="image" id="exampleInputFile" class="form-group" accept="image/x-png,image/gif,image/jpeg">
                  <img id="blah" src="{{ asset('public/images/images.png')}}" width="250px" alt="your image"  />
                  
                </div>
<!--                <div class="form-group">
                  <label for="file-input">Product Images</label>
                  <input type="file" name="image" id="file-input" class="form-group" multiple accept="image/x-png,image/gif,image/jpeg" >
                  <div id="preview"></div>
                  
                </div>-->
                  <div class="field" align="left">
                <h3>Product Images</h3>
                    <input type="file"  id="files" name="product_images[]"  accept="image/x-png,image/gif,image/jpeg" multiple/>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          </div>
          </div>
</section>

@endsection
@section('js')
<script>

 
 function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#exampleInputFile").change(function() {
  readURL(this);
});

$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});

$("#add_product").validate({
    rules: {
        name: {
            required: true,
//            minlength: 3,
        },
        
        price: {
            required: true,
            decimal: true,
        },
        quantityy: {
//            required: true,
            number: true,
        },
        image: {
            required: true, 
            accept:"jpg,png,jpeg,gif"
        }
        
       
        
      }
 });

</script>
@endsection