@php $i=0 @endphp
@extends('struct')
@section ('title')
<title>پنل مدیریت | شکایات</title>
@endsection
@section('sidebar')
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
@endsection
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="box box-primary">
         <div class="box-body">
            <table id="DataTable" class="table direction table-bordered table-hover dataTable" role="grid" >
               <thead>
                  <tr  role="row" >
                     <th>شماره</th>
                     @foreach ($Table->head as $head)
                     <th>{{$head}}</th>
                     @endforeach
                     <th>اقدامات</th>
                  </tr>
               </thead>
               <tfoot>
                  <tr role="row" >
                     <th>شماره</th>
                     @foreach ($Table->head as $head)
                     <th>{{$head}}</th>
                     @endforeach
                     <th>اقدامات</th>
                  </tr>
               </tfoot>
               <tbody >
                  <tr role="row" >
                     <form method="post" action="addSubject">
                        {{ csrf_field() }}
                        <th>+</th>
                        <th><input  class="lsInput" type="text" name="Subject"></th>
                        <th>
                           <button style="background-color: steelblue;color :white" type="submit" class="btn btn-default btn-sm">
                           <span class="glyphicon glyphicon-save-file  Try it
                              "></span> اضافه کردن
                           </button>
                        </th>
                     </form>
                  </tr>
                  @foreach ($Table->data as $Complaints_Subject)
                  @php $i++ @endphp
                  <tr role="row" >
                     <th>{{$i}}</th>
                     <th><input  class="lsInput" style="padding-right: 8px" type="text" name="Subject" value="{{$Complaints_Subject->fld_Complaints_Subjects}}"></th>
                     <th>
                        <button value="{{$Complaints_Subject->fld_Id}}" style="background-color: #434343;color: white" type="button" class="btn btn-default btn-sm editSubject">
                        <span class="glyphicon glyphicon-edit"></span> تغیر
                        </button>
                        <button value="{{$Complaints_Subject->fld_Id}}" style="background-color: tomato;color: white" type="button" class="btn btn-default btn-sm deleteSubject">
                        <span class="glyphicon glyphicon-trash"></span> حذف
                        </button>
                     </th>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection
@section ('extensions')
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
       url: "{{URL::to('/ChangeLevel')}}",
       data: {
         id: $id,
         level:$level
       },
       success: function(data){
         toastr.success('بارنامه '+": "+$con, 'وضعیت شکایت تغیر پیدا کرد', {timeOut: 7000});
       }
     });
   });
    @if ($errors->any())
    
    toastr.success('{{$errors->first()}}');
   
    @endif
   
    $(".deleteSubject" ).click(function() {
     $id= $(this).attr('value') ;
     $btn=$(this);
     $.ajax({
       method: "GET",
       url: "{{URL::to('/RemoveSubject')}}",
       data: {
         id: $id
       },
       success: function(data){
         $btn.parent().parent().hide('slow', function(){  $btn.parent().parent().remove(); });
         toastr.success('موضوع با موفیقت حذف شد ', {timeOut: 7000});
       }
     });
   });
    $(".editSubject" ).click(function() {
     $id= $(this).attr('value') ;
     $btn=$(this);
     $Thsubject=$(this).parent().prev().find('input:first').val();
     $.ajax({
       method: "GET",
       url: "{{URL::to('/EditSubject')}}",
       data: {
         id: $id,
         sub: $Thsubject
       },
       success: function(data){
   
        toastr.success('موضوع با موفیقت تغیر یافت ', {timeOut: 7000});
      }
    });
   });
    
   });
   
</script>
@endsection