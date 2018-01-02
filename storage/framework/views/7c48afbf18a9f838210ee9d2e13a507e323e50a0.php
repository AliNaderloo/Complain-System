<!DOCTYPE html>
<html>
<head>
	<title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link  rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('css/Style.css')); ?>"></link>
  <link  rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('css/bootstrap.css')); ?>"></link>
  <script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>

  <style type="text/css">
  body {
    /* place the blurred image below the normal one */
    background-color:  #323232;
    /* repeat only the blurred one */
    background-size: contain;
  }
</style>
<script type="text/javascript">
  <?php if(session('success')): ?>
  $( document ).ready(function() {
   toastr.success("<?php echo e(session('success')); ?>");
 });
  <?php endif; ?>
  <?php if($errors->any()): ?>
  $( document ).ready(function() {
   toastr.error('<?php echo e($errors->first()); ?>');
 });
  <?php endif; ?>
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
            <?php echo e(csrf_field()); ?>

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
          <?php $__currentLoopData = $Complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($Complaint->fld_Id); ?>"><?php echo e($Complaint->fld_Complaints_Subjects); ?></option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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