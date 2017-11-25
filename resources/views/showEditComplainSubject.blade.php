<!DOCTYPE html>
<html>
<head>
	<title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link  rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.css')}}"></link>
  <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
  <script type="text/javascript">
     @if($errors->any())
    $( document ).ready(function() {
       toastr.success('{{$errors->first()}}');
    });
    @endif
  </script>
</head>
<body style="margin: 40px; direction: rtl; text-align: right; "> 
	
  <form action="/editComplaintSubject" method="post">
    <div class="form-group">
     {{ csrf_field() }}
     <input type="text" name="Id" value="{{$ComplaintsSubject->fld_Id}}" style="display: none;">
     <label for="Subject">موضوع :</label>
     <input type="text" class="form-control" name="Subject" id="Subject" value="{{$ComplaintsSubject->fld_Complaints_Subjects}}" >
   </div>
<button type="submit" class="btn btn-primary">ثبت</button>
</form> 
</body>
</html>