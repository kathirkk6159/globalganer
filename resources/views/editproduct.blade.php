@extends('layouts.header')

@section('content')
<style>

input[type="file"] {
  display: block;
}
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
  background: #ffffff;
  border: 1px solid black;
  color: 333333;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: #ff471a;
  color: black;
}
</style>

              @if(Session::get('Success'))
    <div class="alert alert-success" style="margin-left: 900px;text-align: center;">
    {{Session::get('Success')}}
    </div>
    @endif
    
    @if(Session::get('fail'))
    <div class="alert alert-danger" style="margin-left: 900px;text-align: center;">
    {{Session::get('fail')}}
    </div>
    @endif
    
    
<a class="btn btn-danger btn-sm" href="{{ url('/manageproduct')}}">Back</a>

<h2 class="card-title" style="text-align:center; margin-bottom: 35px;"><b>Edit Product</b></h2>
<form role="form" action="" method= "post" id="submit_form" enctype="multipart/form-data" runat="server">
@csrf
     <div class="modal-header">      
      <h4 class="modal-title">Edit product</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
     </div>
     <div class="modal-body">     
      <div class="form-group">
       <label>Name</label>
       <input type="text" id="name" name="name" value="{{ $data->name }}"required="">
      </div>
      <div class="form-group">
       <label>Price</label>
       <input type="number"id="price" name="price" value="{{ $data->price }}" class="form-control" required="">
      </div>
      <div class="form-group">
       <label>Description</label>
       <textarea class="form-control" id="description" name="description" required="">{!! $data->description !!} </textarea>
      </div>
      <div class="form-group">
       <label>Image</label>
       <input type="file" class="form-control"  name="image" id="exampleInputFile" accept="image/png, image/jpeg"
       value="{{asset('/storage/'.$data->image)}}" required="">
      </div>     
     </div>
     <div class="modal-footer">
      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
      <input type="submit" class="btn btn-success" value="Add">
     </div>
    </form>
    
<script>
$(document).ready(function() {
if (window.File && window.FileList && window.FileReader) {
$("#exampleInputFile").on("change", function(e) {
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
"</span>").insertAfter("#exampleInputFile");
$(".remove").click(function(){
$(this).parent(".pip").remove();
});



});
fileReader.readAsDataURL(f);
}
});
} else {
alert("Your browser doesn't support to File API")
}
});

</script> 

<script>
            
function fileValidation(file) {



            var fileInput =
                document.getElementById('exampleInputFile');

            var filePath = fileInput.value;

            // Allowing file type
            var allowedExtensions =
                    /(\.jpg|\.jpeg|\.png)$/i;

            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type, File Type should be in (JPEG, JPG, PNG) only');
                fileInput.value = '';
                return false;
            }

            else
            {
              var FileSize = file.files[0].size / 1024 / 1024; // in MB

                if (FileSize > 2)
                {
                alert('File size exceeds 2 MB');
                fileInput.value = '';
                return false;

                 }

                 else
                 {
                                          
                            // Image preview
                             if (fileInput.files && fileInput.files[0]) {
                              var reader = new FileReader();
                              reader.onload = function(e) {
                                  document.getElementById(
                                      'imagePreview').innerHTML =
                                      '<img src="' + e.target.result
                                      + '" width="150px"/>';
                              };

                              reader.readAsDataURL(fileInput.files[0]);
                          }

                          }
                          
                          return true;
                      };
      
                  }

                  


</script>

    @endsection