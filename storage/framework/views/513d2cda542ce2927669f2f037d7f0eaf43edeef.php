<?php $i=0 ?>

<?php $__env->startSection('title'); ?>
<title>پنل مدیریت | شکایات</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('sidebar'); ?>
<li >
 <a href="/">
  <i class="fa fa-th"></i> <span>شکایات</span>
  <!--    <small class="label pull-right bg-green">جدید</small> -->
</a>
</li>
<li class="active treeview">
 <a href="#">
   <i class="fa fa-gear"></i> <span>تنظیمات</span> <i class="fa fa-angle-left pull-left"></i>
 </a>
 <ul class="treeview-menu">
  <li class="active"><a href="/Subjects"><i class="fa  fa-quote-left "></i> <span>موضوعات شکایات</span></a></li>
  <li ><a href="/Admins"><i class="fa  fa-users"></i> <span>مدیران</span></a></li>
</ul>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php 
$flds=array(
array(
"name" => "subject",
"placeholder" => "موضوع",
"type" => "text"
),
array(
"name" => "id",
"placeholder" => "آیدی",
"type" => "text",
"visible" => false 
)
);
$obj=new Modal($flds,"ثبت موضوع","modal","addSubject");
$obj->Deploy();


$flds=array(
array(
"name" => "subject",
"placeholder" => "موضوع",
"type" => "text"
),
array(
"name" => "id",
"placeholder" => "آیدی",
"type" => "text",
"visible" => false 
)
);
$obj=new Modal($flds,"تغیر موضوعات","modal2","editSubject");
$obj->Deploy();
?>
<div class="row">
 <div class="col-md-12">
  <div class="box box-primary">
   <div class="box-body">
    <table id="DataTable" class="table direction table-hover dataTable" role="grid" >
     <thead>
      <tr  role="row" >
       <th>شماره</th>
       <?php $__currentLoopData = $Table->head; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <th><?php echo e($head); ?></th>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <th>اقدامات</th>
     </tr>
   </thead>

 <tbody >
  <?php $__currentLoopData = $Table->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Complaints_Subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php $i++ ?>
  <tr role="row" >
   <th><?php echo e($i); ?></th>
   <th name="subject"><?php if(isset($Complaints_Subject->fld_Complaints_Subjects)): ?> <?php echo e($Complaints_Subject->fld_Complaints_Subjects); ?> <?php endif; ?></th>
   <th>
    <a data-remodal-target="modal2" value="<?php if(isset($Complaints_Subject->fld_Id)): ?><?php echo e($Complaints_Subject->fld_Id); ?> <?php endif; ?>" href="#">
      <button  style="background-color: #434343;color: white" type="button" class="btn btn-default btn-sm ">
        <span class="glyphicon glyphicon-edit"></span> تغیر
      </button>
    </a>
    <button value="<?php if(isset($Complaints_Subject->fld_Id)): ?> <?php echo e($Complaints_Subject->fld_Id); ?><?php endif; ?>" style="background-color: tomato;color: white" type="button" class="btn btn-default btn-sm deleteSubject">
      <span class="glyphicon glyphicon-trash"></span> حذف
    </button>
  </th>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
<a data-remodal-target="modal" value="<?php if(isset($Complaints_Subject->fld_Id)): ?> <?php echo e($Complaints_Subject->fld_Id); ?><?php endif; ?>" href="#">
  <button style="background-color: steelblue;color :white" type="submit" class="btn btn-default btn-sm">
   <span class="glyphicon glyphicon-save-file  Try it"></span> اضافه کردن
 </button>
</a>
</div>
</div>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('extensions'); ?>
<script>
 $(function () {
  $('#DataTable').DataTable({
   "language": {
     "sEmptyTable":     "هیچ داده ای در جدول وجود ندارد",
     "sInfo":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
     "sInfoEmpty":      "نمایش 0 تا 0 از 0 رکورد",
     "sInfoFiltered":   "(فیلتر شده از _MAX_ رکورد)",
     "sInfoPostFix":    "",
     "sInfoThousands":  ",",
     "sLengthMenu":     "نمایش _MENU_ رکورد",
     "sLoadingRecords": "در حال بارگزاری...",
     "sProcessing":     "در حال پردازش...",
     "sSearch":         "جستجو:",
     "sZeroRecords":    "رکوردی با این مشخصات پیدا نشد",
     "oPaginate": {
       "sFirst":    "ابتدا",
       "sLast":     "انتها",
       "sNext":     "بعدی",
       "sPrevious": "قبلی"
     },
     "oAria": {
       "sSortAscending":  ": فعال سازی نمایش به صورت صعودی",
       "sSortDescending": ": فعال سازی نمایش به صورت نزولی"
     }
   },
   
 });
  $('.level').change(function() {
   $id=$(this).attr('name');
   $level=jQuery(this).val();
   $con=$(this).parent().parent().find('.consignment:first').text();
   $.ajax({
     method: "GET",
     url: "<?php echo e(URL::to('/ChangeLevel')); ?>",
     data: {
       id: $id,
       level:$level
     },
     success: function(data){
       toastr.success('بارنامه '+": "+$con, 'وضعیت شکایت تغیر پیدا کرد', {timeOut: 7000});
     }
   });
 });
  <?php if($errors->any()): ?>

  toastr.success('<?php echo e($errors->first()); ?>');

  <?php endif; ?>
  $("a[data-remodal-target='modal2']").click(function(){
   $id=$(this).attr('value') ;
   $chgBtn=$(this);
   $subject=$(this).parent().parent().find("th[name='subject']").text();
   $("div[data-remodal-id='modal2']").find("input[name='id']").val($id);
   $("div[data-remodal-id='modal2']").find("input[name='subject']").val($subject);
 });
   $('#addSubject').click(function(){
         $btn=$(this);
         $subject= $btn.prev().find("input[name='subject']").val();
         $.ajax({
           method: "GET",
           url: "<?php echo e(URL::to('/addSubject')); ?>",
           data: {
             sub:$subject
           },
           success: function(data){
             toastr.success('اکانت با موفقیت اضافه شد ', {timeOut: 7000});
             $('tbody').append("<tr role="+"row"+" ><th>*</th><th>"+$subject+"</th></tr>");
           },
           error: function(data){
                // Something went wrong
                // HERE you can handle asynchronously the response 

                // Log in the console
                var errors = data.responseJSON;
                $.each( errors, function( key, value ) {
                  toastr.error(value);
                });
              }
            });
       });
  $(".deleteSubject" ).click(function() {
   $id= $(this).attr('value') ;
   $btn=$(this);
   $.ajax({
     method: "GET",
     url: "<?php echo e(URL::to('/RemoveSubject')); ?>",
     data: {
       id: $id
     },
     success: function(data){
       $btn.parent().parent().hide('slow', function(){  $btn.parent().parent().remove(); });
       toastr.success('موضوع با موفیقت حذف شد ', {timeOut: 7000});
     }
   });
  });
   $("#editSubject" ).click(function() {
   $id=$("div[data-remodal-id='modal2']").find("input[name='id']").val();
   $subject=$("div[data-remodal-id='modal2']").find("input[name='subject']").val();
   $.ajax({
     method: "GET",
     url: "<?php echo e(URL::to('/EditSubject')); ?>",
     data: {
       id: $id,
       sub:$subject
     },
     success: function(data){
      toastr.success('موضوع با موفیقت تغیر یافت ', {timeOut: 7000});
      $chgBtn.parent().parent().find('th:nth-child(2)').text($subject);

    },
    error: function(data){
                // Something went wrong
                // HERE you can handle asynchronously the response 
                // Log in the console
                var errors = data.responseJSON;
                $.each( errors, function( key, value ) {
                  toastr.error(value);
                });
              }
          });
 });

//Validate
  String.prototype.toEnDigit = function() {
    return this.replace(/[\u06F0-\u06F9]+/g, function(digit) {
      var ret = '';
      for (var i = 0, len = digit.length; i < len; i++) {
        ret += String.fromCharCode(digit.charCodeAt(i) - 1728);
      }
      return ret;
    });
  };
});

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('struct', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>