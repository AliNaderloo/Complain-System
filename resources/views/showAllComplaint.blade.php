@extends('struct')
@section ('title')
<title>پنل مدیریت | شکایات</title>
@endsection
@section('sidebar')
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
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-body">
       <table id="DataTable" class="table direction table-bordered table-hover dataTable" role="grid" >
        <thead>
          <tr  role="row" >
            @foreach ($Table->head as $head)
            <th>{{$head}}</th>
            @endforeach
          </tr>
        </thead>
        <tfoot>
          <tr  role="row" >
            @foreach ($Table->head as $head)
            <th>{{$head}}</th>
            @endforeach
         
          </tr>
        </tfoot>
        <tbody >
          @foreach ($Table->data as $complaints)
            <tr role="row" >
            <th class="consignment">{{$complaints->fld_Consignment}}</th>
            <th>{{$complaints->getComplaint->fld_Complaints_Subjects}}</th>
            <th>{{$complaints->fld_Description}}</th>
            <th>
              <select style="background-color:#3c8dbc;color: white" class="form-control level" name="{{$complaints->fld_Id}}" >
               <option @if ($complaints->fld_Level==1) selected="true" @endif value="1"> ثبت شده است</option>
               <option @if ($complaints->fld_Level==2) selected="true" @endif value="2">در حال انجام</option>
               <option @if ($complaints->fld_Level==3) selected="true" @endif value="3"> به اتمام رسیده</option>
             </select>
           </th>
     <!--      <th>
            <a  href="/Complain/{{$complaints->fld_Id}}" target="_blank">
              <div >
               <button style="background-color: #3c8dbc;color: white;font-size: 14px" type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-edit"></span> تغیر
              </button>
            </div>
          </a>
        </th> -->
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
       $('[data-remodal-id=modal]').remodal();

 });
</script>

@endsection