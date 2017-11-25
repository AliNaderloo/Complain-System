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
 <style type="text/css">
 body {
  /* place the blurred image below the normal one */
  background-color:
  #323232;
  /* repeat only the blurred one */
  background-size: contain;
}
</style>
</head>
<body style="margin: 40px; direction: rtl; text-align: right; color: white;"> 
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 text-center" style="margin-bottom: 40px;">
        <h4 style="color: white;">سیستم شکایت شرکت</h4> 
        <h3 > چاپار</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12">
        <form action="newComplaint" method="get">
          <div class="form-group">
            {{ csrf_field() }}
            <label for="Consignment">شماره بارنامه :</label>
            <input type="text" class="form-control" name="Consignment" id="Consignment" placeholder="بارنامه">
          </div>
          <div class="form-group">
            <label id="Complaints" >موضوع :</label>
            <select class="form-control" name="Complaints" id="Complaints">
              @foreach ($Complaints as $Complaint)
              <option value="{{$Complaint->fld_Id}}">{{$Complaint->fld_Complaints_Subjects}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="Description" class="form-control">توضیح :</label>
            <textarea type="text" class="form-control" name="Description" id="Description"  rows="4" cols="50"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">ثبت</button>
        </form>
      </div>
    </div> 
  </div>

</body>
</html>