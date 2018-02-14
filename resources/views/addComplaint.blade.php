<!DOCTYPE html>
<html>
<head>
	<title></title>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <link  rel="stylesheet" type="text/css" href="{{URL::asset('css/Style.css')}}"></link>
  <link  rel="stylesheet" type="text/css" href="{{URL::asset('css/bootstrap.css')}}"></link>
  <script type="text/javascript" src="{{URL::asset('css/bootstrap.min.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('css/jtoastr.min.css') }}" />

  <style type="text/css">
  body {
    /* place the blurred image below the normal one */
    background-color:  #323232;
    /* repeat only the blurred one */
    background-size: contain;
  }
</style>
<script type="text/javascript">
  @if(session('success'))
  $( document ).ready(function() {
   toastr.success("{{session('success')}}");
 });
  @endif
  @if($errors->any())
  $( document ).ready(function() {
   toastr.error('{{$errors->first()}}');
 });
  @endif
  $( document ).ready(function() {
    var colors = ['steelblue', 'salmon', 'lightcoral', 'cadetblue', 'dimgray', 'cornflowerblue','#0881A3'];
    color = colors[Math.floor(Math.random() * colors.length)];
    $('body').css("background-color",color);
  });  
</script>
</head>
<body style="margin: 40px; direction: rtl; text-align: right; color: white;"> 
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 text-center" style="margin-bottom: 40px;">
        <h2 style="color: white;">شرکت کالا رسانان چاپار</h2> 
        <h5 >شکایات و پیگیری</h5>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-12">
        <form action="newComplaint" method="post">
          <div class="form-group">
            {{ csrf_field() }}
            <label for="Consignment">شماره بارنامه :</label>
            <input autocomplete="off" type="text" class="form-control" name="Consignment" id="Consignment" placeholder="بارنامه">
          </div>
          <div class="form-group">
           <label for="Consignment">پیگیری از طرف :</label>
           <div class="radioHolder"> 
             <label class="containerRadio">نماینده
              <input type="radio" value="1" name="Registrar" >
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="radioHolder">
              <label class="containerRadio">مشتری
              <input type="radio" value="2" name="Registrar" >
              <span class="checkmark"></span>
            </label>
         </div>
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
        <label for="Description" >توضیح :</label>
        <textarea type="text" class="form-control" name="Description" id="Description"  rows="4" cols="50"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">ثبت</button>
    </form>
  </div>
</div> 
</div>

</body>
</html>