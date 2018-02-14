<!DOCTYPE html>
<html>
<head>
	<title></title>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <link  rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.css')}}"></link>
  <script type="text/javascript" src="{{URL::asset('js/bootstrap.min.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('css/jtoastr.min.css') }}"/>
  <script src="{{ asset('js/toastr.min.js') }}" ></script>
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