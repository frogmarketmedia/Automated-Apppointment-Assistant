@extends('layout')

@section('content')
<?php 
  $user = Auth::user();
?>
<div class="container">
    <h2 align="center">Add Educational Status</h2>  
    <div class="form-group">
         <form name="add_name" id="add_name" method="POST" action="/user/{{ $user->id }}/edit/editexperience">  
            {{ csrf_field() }}
            <div class="alert alert-danger print-error-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="alert alert-success print-success-msg" style="display:none">
            <ul></ul>
            </div>

            <div class="table-responsive">  
              <div>
              <div class="dynamic-added" id="dynamic_field">
                <table class="table table-bordered">  
                  <tr>
                    <td>Company Name:</td>
                    <td>
                      <input type="text" name="workplace[]" placeholder="Enter Company Name" class="form-control name_list" required/></td>
                    </tr>
                  <tr>
                    <td>Designation:</td>
                    <td><input type="text" name="designation[]" placeholder="Enter Your Designation" class="form-control name_list" required/></td>
                  </tr>
                  <tr>
                    <td>Current Working Place or Not</td>
                    <td><input type="text" name="present[]" placeholder="Is It Your Current Working Place?(True/False)" class="form-control name_list" required/></td>
                    </tr>  

                </table>  
                <button type="button" name="add" id="add" class="btn btn-success">Add More</button><br>
              </div>
            </div>
                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />  
            </div>

         </form>  
    </div> 
</div>

<script type="text/javascript">
    $(document).ready(function(){      

      var postURL = "https://localhost.com/";
      var i=1;  

      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<div id="row'+i+'"><table class="table table-bordered" ><tr><td>Company Name:</td><td><input type="text" name="workplace[]" placeholder="Enter Company Name" class="form-control name_list" required/></td></tr><tr><td>Designation:</td><td><input type="text" name="designation[]" placeholder="Enter Your Designation" class="form-control name_list" required/></td></tr><tr><td>Current Working Place or Not</td><td><input type="text" name="present[]" placeholder="Is It Your Current Instituion?(True/False)" class="form-control name_list" required/></td></tr></table><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Delete</button></div>');  
      });  

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script>
<div style="clear: both"></div>
@endsection
