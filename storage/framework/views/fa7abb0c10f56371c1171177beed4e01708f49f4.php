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
	
  <form action="/editComplaint" method="post">
    <div class="form-group">
     <?php echo e(csrf_field()); ?>

     <input type="text" name="Id" value="<?php echo e($Complaint->fld_Id); ?>" style="display: none;">
     <label for="Consignment">شماره بارنامه :</label>
     <input type="text" class="form-control" name="Consignment" id="Consignment" value="<?php echo e($Complaint->fld_Consignment); ?>" placeholder="بارنامه">
   </div>
   <div class="form-group">
    <label id="Complaints" >موضوع :</label>
    <select class="form-control" name="Complaints" id="Complaints">
     <?php $__currentLoopData = $ComplaintsSub; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     <?php if($Sub->fld_Id==$Complaint->fld_Subject): ?>
      <option selected="true" value="<?php echo e($Sub->fld_Id); ?>"><?php echo e($Sub->fld_Complaints_Subjects); ?></option>
     <?php else: ?>
     <option value="<?php echo e($Sub->fld_Id); ?>"><?php echo e($Sub->fld_Complaints_Subjects); ?></option>
     <?php endif; ?>
     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </select>
 </div>
 <div class="form-group">
  <label for="Description" class="form-control">توضیح :</label>
  <textarea type="text" class="form-control" name="Description" id="Description"   rows="4" cols="50"><?php echo e($Complaint->fld_Description); ?></textarea>
</div>
  <div class="form-group">
    <label id="Level" >مرحله :</label>
    <select class="form-control" name="Level" id="Level">
      <option <?php if($Complaint->fld_Level==1): ?> selected="true" <?php endif; ?> value="1"> ثبت شده است</option>
      <option <?php if($Complaint->fld_Level==2): ?> selected="true" <?php endif; ?> value="2">در حال انجام</option>
      <option <?php if($Complaint->fld_Level==3): ?> selected="true" <?php endif; ?> value="3"> به اتمام رسیده</option>
   </select>
 </div>
<button type="submit" class="btn btn-primary">ثبت</button>
</form> 
</body>
</html>