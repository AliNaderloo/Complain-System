<?php $__env->startSection('title'); ?>
<title>پنل مدیریت | شکایات</title>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('sidebar'); ?>
<li class="active">
  <a href="/">
    <i class="fa fa-th"></i> <span>شکایات</span>
    <!--    <small class="label pull-right bg-green">جدید</small> -->
  </a>
</li>
<li>
</li>
<li class=" treeview">
  <a href="#">
    <i class="fa fa-gear"></i> <span>تنظیمات</span> <i class="fa fa-angle-left pull-left"></i>
  </a>
  <ul class="treeview-menu">
    <li ><a href="/Subjects"><i class="fa  fa-quote-left "></i> <span>موضوعات شکایات</span></a></li>
    <li ><a href="/Admins"><i class="fa  fa-users"></i> <span>مدیران</span></a></li>
  </ul>
</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
       <table id="DataTable" style="font-size: 14px" class="table direction table-bordered table-hover dataTable" role="grid" >
        <thead>
          <tr  role="row" >
            <th>شماره</th>
            <?php $__currentLoopData = $Table->head; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th><?php echo e($head); ?></th>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <th>اقدامات</th>
          </tr>
        </thead>
        <tbody>
          <?php $i=0 ?>
          <?php $__currentLoopData = $Table->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaints): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr role="row" >
            <th style="text-align: center;"><?php echo ++$i ?></th>
            <th class="consignment"><?php echo e($complaints->fld_Consignment); ?></th>
            <th><?php echo e($complaints->fld_Complaints_Subjects); ?></th>
            <th><p style="width: 210px;word-break: break-all;"><?php echo e($complaints->fld_Description); ?></p></th>
            <th style="min-width: 60px">
            <?php if($complaints->fld_Registrar==1): ?>
            نماینده
            <?php else: ?>
            مشتری
            <?php endif; ?>
            </th>
            <th><?php echo e($complaints->fld_Name); ?></th>
            <th><span style="display: none;"><?php echo e($complaints->created_at); ?></span>
            <p style="min-width: 115px"><?php echo e(jDate::forge($complaints->created_at)->format('%y/%m/%d %H:%M')); ?></p>
            </th>
            <th>
            <span style="display: none;"><?php echo e($complaints->fld_Level); ?></span>
            <select style="background-color:#3c8dbc;color: white" class="form-control level" name="<?php echo e($complaints->fld_Id); ?>" >
            <option <?php if($complaints->fld_Level==1): ?> selected="true" <?php endif; ?> value="1"> ثبت شده است</option>
            <option <?php if($complaints->fld_Level==2): ?> selected="true" <?php endif; ?> value="2">در حال انجام</option>
            <option <?php if($complaints->fld_Level==3): ?> selected="true" <?php endif; ?> value="3"> به اتمام رسیده</option>
            </select>
            </th>
            <!--      <th>
            <a  href="/Complain/$complaints->fld_Id" target="_blank">
            <div >
            <button style="background-color: #3c8dbc;color: white;font-size: 14px" type="button" class="btn btn-default btn-sm">
            <span class="glyphicon glyphicon-edit"></span> تغیر
            </button>
            </div>
            </a>
            </th> -->
            <th>
            <button  value="<?php echo e($complaints->fld_Id); ?>" style="display: none;background-color: tomato;color: white" type="button" class="btn btn-default btn-sm deleteComplainBtn">
            <span class="glyphicon glyphicon-trash"></span> حذف
            </button>
            <button class="btn btn-default btn-sm history" value="<?php echo e($complaints->fld_Consignment); ?>" style="background-color: #545454;color: white" type="button" class="btn btn-default btn-sm deleteComplainBtn">
            <span class="glyphicon glyphicon-repeat"></span> تاریخچه &nbsp;
            <span class="countOfRecords"><?php echo e($complaints->count); ?></span>
            </button>
            </th>
            </tr> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            </table>
            <button class="btn btn-default btn-sm newComplaint" style=" line-height: 18px;background-color: #239D60;font-size:13px;color: white" type="button">
            <span style="vertical-align: -2px;" class="glyphicon glyphicon-plus"></span> شکایت جدید
            </button>
            </div>
            </div>
            </div>
            </div>
            <?php $__env->stopSection(); ?>
            <div class="remodal" data-remodal-id="modal" style="max-width: 100%;width: 95%;">
            <button data-remodal-action="close" class="remodal-close"></button>
            <h4 style="margin: 0 auto;margin-bottom: 15px">: تاریخچه شکایات بارنامه <span id="selConsignment" style="color:#3c8dbc;font-weight: bold;"></span></h4>
            <div id="modalTable">
            </div>


            <br>
            </div>


            <div class="remodal" data-remodal-id="createModal" style="max-width: 100%;width: 95%;">
            <button data-remodal-action="close" class="remodal-close"></button>
            <h4 style="margin: 0 auto;margin-bottom: 15px;text-align:center;color:#2196F3">ثبت شکایت جدید<span id="selConsignment" style="color:#3c8dbc;font-weight: bold;"></span></h4>
            <form id="newComplaintForm" action="newComplaint" method="get" style="text-align:right;">
            <div class="form-group">
            <?php echo e(csrf_field()); ?>

            <label for="Consignment" class="formHeader">: شماره بارنامه</label>
            <input autocomplete="off" style="direction:ltr"  type="text" class="form-control" name="Consignment" id="Consignment" placeholder="بارنامه">
            </div>
            <div class="form-group">

            <div class="radioHolder"> 
            <label  class="containerRadio">نماینده
            <input type="radio" value="1" name="Registrar" >
            <span class="checkmark"></span>
            </label>
            </div>
            <div class="radioHolder">
            <label  class="containerRadio">مشتری
            <input type="radio" value="2" name="Registrar" >
            <span class="checkmark"></span>
            </label>
            </div>
            <label class="formHeader" for="Consignment">: پیگیری از طرف</label>
            </div>
            <div class="form-group">
            <label class="formHeader"  id="Complaints" >: موضوع</label>
            <select class="form-control" name="Complaints" id="Complaints">
            <?php $__currentLoopData = $Subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $Complaint): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($Complaint->fld_Id); ?>"><?php echo e($Complaint->fld_Complaints_Subjects); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            </div>
            <div class="form-group">
            <label class="formHeader"  for="Description" >: توضیح</label>
            <textarea style="resize: vertical;" type="text" class="form-control" name="Description" id="Description"  rows="10" cols="50"></textarea>
            </div>
            <button type="submit" id="submitNewComplaint" class="btn btn-primary">ثبت</button>
            </form>
            <br>
            </div>
            <?php $__env->startSection('extensions'); ?>
            <script>
            $(function () {
              String.prototype.toEnDigit = function() {
                return this.replace(/[\u06F0-\u06F9]+/g, function(digit) {
                  var ret = '';
                  for (var i = 0, len = digit.length; i < len; i++) {
                    ret += String.fromCharCode(digit.charCodeAt(i) - 1728);
                  }
                  return ret;
                });
              };
              toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
              }
              $('#Consignment').keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
                 (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
                 (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
             }
        // Ensure that it is a number and stop the keypress
             if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              toastr.warning('تنها عدد مجاز است');
              e.preventDefault();
            }
            if ($('#Consignment').val().length >= 17) {

              toastr.error('بیشتر از ۱۷ رقم وارد کردید');


              
              e.preventDefault();
            }
          });
              var MainDataTable=  $('#DataTable').DataTable({
               aaSorting: [[6, 'desc']],
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
              $('#newComplaintForm').on('submit', function(e){ 
               $('#Consignment').val($('#Consignment').val().toEnDigit());               
                e.preventDefault();
                if ($('#Consignment').val().length < 17) {
                  toastr.error('! شماره بارنامه کمتر از ۱۷ رقم است ');
                  return 0;
                }
                if (!$.trim($("#Description").val())) {
                  toastr.error('! توضیحات را وارد کنید');
                  return 0;
                }
               
                if ($("input[name='Registrar']:checked").val()==undefined) {
                  toastr.error('! نماینده یا مشتری را مشخص نمایید ');
                  return 0;
                }
                if ($('#Consignment').val().substr(0,7)!=5410000 || $('#Consignment').val().substr(14,3)!=101 ){
                  toastr.error('فرمت بارنامه درست نیست',$('#Consignment').val());
                  return 0;
                }
               
                $.ajax({
                  type: 'GET',
                  url: '/newComplaint',
                  data: $('#newComplaintForm').serialize(),
                  success: function(data) {
                    $('#DataTable_wrapper').remove();
                    $('.box-body').prepend(data);
                    MainDataTable=  $('#DataTable').DataTable({
                     aaSorting: [[6, 'desc']],
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

                    var inst = $('[data-remodal-id=createModal]').remodal();
                    inst.close();
                    $('[data-remodal-id=createModal] input[type="text"]').val('');
                    $('[data-remodal-id=createModal] textarea').val('');
                    $('[data-remodal-id=createModal] input[type="radio"]').prop('checked', false);

                    toastr.success('شکایت با موفقیت ثبت شد', {timeOut: 7000});


                  }

                });
              });


              $(document).on('click', '.deleteComplainBtn', function(e) {
               $id= $(this).attr('value');
               $target= $( "#DataTable th:contains("+$globHistory+")").parent();
               $btn=$(this);
               $.ajax({
                 method: "get",
                 url: "<?php echo e(URL::to('/RemoveComplaint')); ?>",
                 data: {
                   id: $id
                 },
                 success: function(data){
                   $btn.parent().parent().hide('slow', function(){ 
                     var selRow= $btn.parent().parent().remove();
                     historyTable.row(selRow).remove().draw();
                     if (!(historyTable.rows().any())) {
                       MainDataTable.row( $target ).remove().draw();
                     }
                     var inst = $('[data-remodal-id=modal]').remodal();
                     inst.close();
                   });
                   toastr.success('شکایت با موفقیت حذف شد ', {timeOut: 7000});
                   $globHistory="";
                 }
               });
             });

              $(".newComplaint" ).click(function() {
                var inst = $('[data-remodal-id=createModal]').remodal();
                inst.open();
              });
              $(document).on('click', '.history', function(e) {
               $id= $(this).attr('value') ;
               $globHistory=$id;
               $.ajax({
                 method: "GET",
                 url: "<?php echo e(URL::to('/ComplaintHistory')); ?>",
                 data: {
                   id: $id
                 },
                 success: function(data){
                  var inst = $('[data-remodal-id=modal]').remodal();
                  $( "#modalTable" ).append(data);
                  $('#selConsignment').text($id);
                  historyTable = $('#history').DataTable({
                    aaSorting: [[6, 'desc']],
                    "pageLength": 9,
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

                  inst.open();
                }
              });
             });
              $(document).on('closing', '[data-remodal-id=modal]', function (e) {
               $( "#modalTable" ).html('');
             });
              $(document).on('change', '.level', function (e) {
                $btn=$(this);
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
                    $btn.parent().find('span').text($level);
                  }
                });
              });
              $('[data-remodal-id=modal]').remodal();
            });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('struct', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>