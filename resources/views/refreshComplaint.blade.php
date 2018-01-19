<table id="DataTable" style="font-size: 14px" class="table direction table-hover dataTable" role="grid" >
        <thead>
          <tr  role="row" >
            <th>شماره</th>
            @foreach ($Table->head as $head)
            <th>{{$head}}</th>
            @endforeach
            <th>اقدامات</th>
          </tr>
        </thead>
        <tbody >
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
            <span style="display: none;">{{$complaints->fld_Level}}</span>
            <select style="background-color:#3c8dbc;color: white" class="form-control level" name="{{$complaints->fld_Id}}" >
            <option @if ($complaints->fld_Level==1) selected="true" @endif value="1"> ثبت شده است</option>
            <option @if ($complaints->fld_Level==2) selected="true" @endif value="2">در حال انجام</option>
            <option @if ($complaints->fld_Level==3) selected="true" @endif value="3"> به اتمام رسیده</option>
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
            <button  value="{{$complaints->fld_Id}}" style="display: none;background-color: tomato;color: white" type="button" class="btn btn-default btn-sm deleteComplainBtn">
            <span class="glyphicon glyphicon-trash"></span> حذف
            </button>
            <button class="btn btn-default btn-sm history" value="{{$complaints->fld_Consignment}}" style="background-color: 545454;color: white" type="button" class="btn btn-default btn-sm deleteComplainBtn">
            <span class="glyphicon glyphicon-repeat"></span> تاریخچه
            &nbsp;
            <span class="countOfRecords">{{$complaints->count}}</span>
            </button>
            <button  value="{{$complaints->fld_Consignment}}" class="btn btn-default btn-sm newComplaintSpc" style="     background-color: #239D60;font-size: 13px;height: 32px;margin-top: 5px;color: white;" type="button">
            <span style="vertical-align: -2px;" class="glyphicon glyphicon-plus"></span> شکایت جدید
            </button>
            </th>
            </tr> 
            @endforeach
            </tbody>
            </table>