@php $i=0 @endphp
@extends('struct')
@section ('title')
<title>پنل مدیریت | مدیران</title>
@endsection
@section('sidebar')
<li>
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
  <li><a href="/Subjects"><i class="fa  fa-quote-left "></i> <span>موضوعات شکایات</span></a></li>
  <li  class="active"><a href="/Admins"><i class="fa  fa-users"></i> <span>مدیران</span></a></li>
</ul>
</li>
@endsection
@section('content')
@php 
$flds=array(
array(
"name" => "name",
"placeholder" => "نام و نام خانوادگی",
"type" => "text"
),
array(
"name" => "username",
"placeholder" => "نام کاربری",
"type" => "text"
),
array(
"name" => "password",
"placeholder" => "گذرواژه",
"type" => "password",

),
array(
"name" => "id",
"placeholder" => "آیدی",
"type" => "text",
"visible" => false 
)

);
$obj=new Modal($flds,"ثبت کاربر جدید","modal","addAdmin");
$obj->Deploy();
$flds=array(
array(
"name" => "name",
"placeholder" => "نام و نام خانوادگی",
"type" => "text"
),
array(
"name" => "username",
"placeholder" => "نام کاربری",
"type" => "text"
),
array(
"name" => "id",
"placeholder" => "آیدی",
"type" => "text",
"visible" => false 
)
);
$obj=new Modal($flds,"تغیر مشخصات","modal2","chgAdminBt");
$obj->Deploy();
@endphp
<!-- <div class="remodal" data-remodal-id="modal2"
   data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
   <button data-remodal-action="close" class="remodal-close"></button>
   <div class="remodal-form">
     <p>تغیر مشخصات</p>
     <input type="text" placeholder="نام و نام خانوادگی" value="" name="name">
     <input type="text" placeholder="نام کاربری" value="" name="username">
     <input type="password" placeholder="گذرواژه" name="password">
     <input style="display: none" type="text"  name="id">
   </div>
   <button data-remodal-action="confirm" class="remodal-confirm chgAdminBt">تغیر</button>
   <button data-remodal-action="cancel" class="remodal-cancel">انصراف</button>
 </div> -->
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
   <tbody>
                  <!--     <tr role="row" >
                     <form method="post" action="addAdmin">
                       csrf
                       <th>+</th>
                       <th><input class="lsInput" placeholder="نان و نام خانوادگی" type="text" name="name"></th>
                       <th><input class="lsInput" placeholder="نام کاربری" type="text" name="username"></th>
                       <th><input class="lsInput" placeholder="گذرواژه" type="password" name="password"></th>
                       <th></th>
                       <th>
                        <button style="background-color: steelblue;color :white" type="submit" class="btn btn-default btn-sm ">
                          <span class="glyphicon glyphicon-save-file  Try it
                          "></span> اضافه کردن
                        </button>
                      </th>
                     </form> 
                   </tr> -->
                   @foreach ($Table->data as $Admin)
                   @php $i++ @endphp
                   <tr role="row" >
                     <th>{{$i}}</th>
                     <th>{{$Admin->fld_Name}}</th>
                     <th>{{$Admin->fld_Username}}</th>
                     <th style="text-align: center;"><img src="img/ProfilePics/{{$Admin->fld_Picture}}" style="height: 50px;width: 50px;border-radius: 100px"></th>
                    <th>
                      @if (!is_null($Admin->fld_Last_Login))
                      {{jDate::forge($Admin->fld_Last_Login)->format('%B %d ، %Y')}}
                      @else
                      ثبت نشده است
                      @endif
                    </th>
                    <th>{{jDate::forge($Admin->created_at)->format('%B %d ، %Y')}}</th>
                    <th>
                      <a data-remodal-target="modal2" value="{{$Admin->fld_Id}}" href="#"> 
                        <button  style="background-color: #434343;color: white" type="button" class="btn btn-default btn-sm ">
                          <span class="glyphicon glyphicon-edit"></span> تغیر
                        </button>
                      </a>
                      <button value="{{$Admin->fld_Id}}" style="background-color: tomato;color: white" type="button" class="btn btn-default btn-sm deleteAdminBtn">
                        <span class="glyphicon glyphicon-trash"></span> حذف
                      </button>
                    </th>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <a data-remodal-target="modal" href="#">    <button style="background-color: steelblue;color :white" type="submit" class="btn btn-default btn-sm ">
                <span class="glyphicon glyphicon-save-file  Try it
                "></span> اضافه کردن
              </button> </a>
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

        $('#addAdmin').click(function(){
         $btn=$(this);
         $name= $btn.prev().find("input[name='name']").val();
         $username= $btn.prev().find("input[name='username']").val();
         $password= $btn.prev().find("input[name='password']").val();
         $.ajax({
           method: "GET",
           url: "{{URL::to('/AddAdmin')}}",
           data: {
             name:$name,
             username:$username,
             password:$password
           },
           success: function(data){
             toastr.success('اکانت با موفقیت اضافه شد ', {timeOut: 7000});
             $('tbody').append("<tr role="+"row"+" ><th>*</th><th>"+$name+"</th><th>"+$username+"</th><th>ثبت نشده است</th><th>امروز</th></tr>");
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
        $(".deleteAdminBtn" ).click(function() {
         $id= $(this).attr('value') ;
         $btn=$(this);
         $.ajax({
           method: "GET",
           url: "{{URL::to('/DeleteAdmin')}}",
           data: {
             id: $id
           },
           success: function(data){
             $btn.parent().parent().hide('slow', function(){  $btn.parent().parent().remove(); });
             toastr.success('اکانت با موفقیت حذف شد ', {timeOut: 7000});
             window.location.href = "/";
           }
         });
       });
        $("#chgAdminBt" ).click(function() {
         $id=$("div[data-remodal-id='modal2']").find("input[name='id']").val();
         $name=$("div[data-remodal-id='modal2']").find("input[name='name']").val();
         $username=$("div[data-remodal-id='modal2']").find("input[name='username']").val();
         $.ajax({
           method: "GET",
           url: "{{URL::to('/ChangeAdmin')}}",
           data: {
             id: $id,
             name:$name,
             username:$username
           },
           success: function(data){
             toastr.success('تغیرات با موفقیت تغیر یافت', {timeOut: 7000});
             $chgBtn.parent().parent().find('th:nth-child(2)').text($name);
             $chgBtn.parent().parent().find('th:nth-child(3)').text($username);

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
        $("a[data-remodal-target='modal2']").click(function(){
         $id=$(this).attr('value') ;
         $chgBtn=$(this);
         $name=$(this).parent().parent().find('th:nth-child(2)').text();
         $username=$(this).parent().parent().find('th:nth-child(3)').text();
         $("div[data-remodal-id='modal2']").find("input[name='id']").val($id);
         $("div[data-remodal-id='modal2']").find("input[name='name']").val($name);
         $("div[data-remodal-id='modal2']").find("input[name='username']").val($username);
       });
      });

    </script>
    @endsection