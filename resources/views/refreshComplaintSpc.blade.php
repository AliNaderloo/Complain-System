  <table id="DataTable" style="font-size: 14px" class="table direction table-hover dataTable" role="grid" >
    <thead>
      <tr  role="row" >
        <th>شماره</th>
        @foreach ($Table->head as $head)
        <th>{{$head}}</th>
        @endforeach
    </tr>
</thead>
<tbody>
  @php $i=0 @endphp
  @foreach ($Table->data as $complaints)
  <tr role="row" >
    <th style="text-align: center;">@php echo ++$i @endphp</th>
    <th class="consignment">{{$complaints->fld_Consignment}}</th>
    <th>{{$complaints->fld_Complaints_Subjects}}</th>
    <th><p style="width: 210px;word-break: break-all;">{{$complaints->fld_Description}}</p></th>
    <th style="min-width: 60px">
    @if($complaints->fld_Registrar==1)
    نماینده
    @else
    مشتری
    @endif
    </th>
    <th>{{$complaints->fld_User_Name}}</th>
    <th><span style="display: none;">{{$complaints->created_at}}</span>
    <p style="min-width: 115px">{{jDate::forge($complaints->created_at)->format('%y/%m/%d %H:%M')}}</p>
    </th>
    <th>

    @if ($complaints->fld_Level==1) ثبت شده است @endif 
    @if ($complaints->fld_Level==2) در حال انجام @endif 
    @if ($complaints->fld_Level==3)  به اتمام رسیده @endif 

    </th>
    <th>
    <button  value="{{$complaints->fld_Id}}" style="background-color: tomato;color: white" type="button" class="btn btn-default btn-sm deleteComplainBtn">
    <span class="glyphicon glyphicon-trash"></span> حذف
    </button>
    </th>
    </tr> 
    @endforeach
    </tbody>
    </table>
            <div id="conId" style="display:none;">@if($createSpcCom!=false) {{$createSpcCom}} @endif</div>
