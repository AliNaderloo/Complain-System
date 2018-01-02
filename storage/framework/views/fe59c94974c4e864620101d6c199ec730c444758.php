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
       toastr.success('<?php echo e($errors->first()); ?>');
    });
    <?php endif; ?>
  </script>
</head>
<body style="margin: 40px; direction: rtl; text-align: right; "> 
	
  <form action="newComplaint" method="get">
    <div class="form-group">
     <?php echo e(csrf_field()); ?>


     <label for="Consignment">شماره بارنامه :</label>
     <input type="text" class="form-control" name="Consignment" id="Consignment" placeholder="بارنامه">
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
  <label for="Description" class="form-control">توضیح :</label>
  <textarea type="text" class="form-control" name="Description" id="Description"  rows="4" cols="50"></textarea>
</div>
<button type="submit" class="btn btn-primary">ثبت</button>
</form> 
</body>
</html>