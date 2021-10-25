@extends('layouts.header')

@section('content')
<form role="form" action="{{ url('addnewproduct')}}" method= "post" id="submit_form" enctype="multipart/form-data" runat="server">
@csrf
     <div class="modal-header">      
      <h4 class="modal-title">Add Product</h4>
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
     </div>
     <div class="modal-body">     
      <div class="form-group">
       <label>Name</label>
       <input type="text" id="name" name="name" required="">
      </div>
      <div class="form-group">
       <label>Price</label>
       <input type="number"id="price" name="price" class="form-control" required="">
      </div>
      <div class="form-group">
       <label>Description</label>
       <textarea class="form-control" id="description" name="description" required=""></textarea>
      </div>
      <div class="form-group">
       <label>Image</label>
       <input type="file" class="form-control"  name="image" id="exampleInputFile" accept="image/png, image/jpeg" required="">
      </div>     
     </div>
     <div class="modal-footer">
      <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
      <input type="submit" class="btn btn-success" value="Add">
     </div>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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

<script type="text/javascript">
$( document ).ready(function() {
$("#class_field").change(function(){
var class_field =   $('#class_field');
var course_div = $('#course_div');
if(class_field.val()=="XII"){
    course_div.show();
    $('#course').attr('required','required');
} else {
    course_div.hide();
    $('#course').removeAttr('required');
}
});
});
</script>
    @endsection