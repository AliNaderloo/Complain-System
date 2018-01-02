<!DOCTYPE html>
<html>
<head>
	<title></title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link  rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('css/bootstrap.css')); ?>"></link>
  <script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.min.js')); ?>"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
  <script type="text/javascript">
     <?php if($errors->any()): ?>
    $( document ).ready(function() {
       toastr.error('<?php echo e($errors->first()); ?>');
    });
    <?php endif; ?>
  </script>
</head>
<body style="margin: 40px; direction: rtl; text-align: right; "> 
	
  <form action="Login" method="post">
    <div class="form-group">
     <?php echo e(csrf_field()); ?>


     <label for="username">نام کاربری :</label>
     <input type="text" class="form-control" name="username" id="username" value="<?php echo e(old('username')); ?>" placeholder="نام کاربری ">
   </div>
 <div class="form-group">
  <label for="password" >گذرواژه :</label>
  <input type="password" class="form-control" name="password" id="password"  rows="4" cols="50">
</div>
<button type="submit" class="btn btn-primary">ورود</button>
</form> 
</body>
</html>