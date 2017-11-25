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
	
  <form action="/editComplaint" method="post">
    <div class="form-group">
     {{ csrf_field() }}
     <input type="text" name="Id" value="{{$Complaint->fld_Id}}" style="display: none;">
     <label for="Consignment">شماره بارنامه :</label>
     <input type="text" class="form-control" name="Consignment" id="Consignment" value="{{$Complaint->fld_Consignment}}" placeholder="بارنامه">
   </div>
   <div class="form-group">
    <label id="Complaints" >موضوع :</label>
    <select class="form-control" name="Complaints" id="Complaints">
     @foreach ($ComplaintsSub as $Sub)
     @if ($Sub->fld_Id==$Complaint->fld_Subject)
      <option selected="true" value="{{$Sub->fld_Id}}">{{$Sub->fld_Complaints_Subjects}}</option>
     @else
     <option value="{{$Sub->fld_Id}}">{{$Sub->fld_Complaints_Subjects}}</option>
     @endif
     @endforeach
   </select>
 </div>
 <div class="form-group">
  <label for="Description" class="form-control">توضیح :</label>
  <textarea type="text" class="form-control" name="Description" id="Description"   rows="4" cols="50">{{$Complaint->fld_Description}}</textarea>
</div>
  <div class="form-group">
    <label id="Level" >مرحله :</label>
    <select class="form-control" name="Level" id="Level">
      <option @if ($Complaint->fld_Level==1) selected="true" @endif value="1"> ثبت شده است</option>
      <option @if ($Complaint->fld_Level==2) selected="true" @endif value="2">در حال انجام</option>
      <option @if ($Complaint->fld_Level==3) selected="true" @endif value="3"> به اتمام رسیده</option>
   </select>
 </div>
<button type="submit" class="btn btn-primary">ثبت</button>
</form> 
</body>
</html>