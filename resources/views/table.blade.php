  <table  id="history" style="margin: 10px auto;font-size: 14px" class="table direction table-bordered table-hover dataTable" >
    <thead>
      <tr>
       <th>شماره بارنامه</th>
       <th>موضوع</th>
       <th>توضیحات</th>
       <th>از طرف</th>
       <th> توسط</th>
       <th>تاریخ ثبت</th>
       <th>مرحله</th>
       <th>دسته</th>
       <th>اقدامات</th>
     </tr>
   </thead>
   <tbody>
 @foreach ($Complaints as $complaints)
          <tr role="row" >
            <th class="consignment">{{$complaints->fld_Consignment}}</th>
            <th>{{$complaints->getComplaint->fld_Complaints_Subjects}}</th>
            <th><p style="width: 230px;word-break: break-all;">{{$complaints->fld_Description}}</p></th>
            <th>
              @if($complaints->fld_Registrar==1)
              نماینده
              @else
              مشتری
              @endif
            </th>
            <th>{{$complaints->fld_User_Name}}</th>
            <th><span style="display: none;">{{$complaints->created_at}}</span>
              <span>{{jDate::forge($complaints->created_at)->format('%B %d %Y %H:%M')}}</</span>
            </th>
            <th>
              <span style="display: none;">{{$complaints->fld_Level}}</span>
              <select style="background-color:#3c8dbc;color: white" class="form-control level" name="{{$complaints->fld_Id}}" >
               <option @if ($complaints->fld_Level==1) selected="true" @endif value="1"> ثبت شده است</option>
               <option @if ($complaints->fld_Level==2) selected="true" @endif value="2">در حال انجام</option>
               <option @if ($complaints->fld_Level==3) selected="true" @endif value="3"> به اتمام رسیده</option>
             </select>
           </th>
           <th>
            <span style="display: none;">{{$complaints->fld_Level}}</span>
            <select style="background-color:#3c8dbc;color: white" class="form-control cat" name="{{$complaints->fld_Id}}" >
             <option @if ($complaints->fld_Cat==1) selected="true" @endif value="1">پیگیری</option>
             <option @if ($complaints->fld_Cat==2) selected="true" @endif value="2">حقوقی</option>
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
         <!-- Btn Place  -->
        </th>
      </tr> 
      @endforeach
    </tbody>
 </table>
