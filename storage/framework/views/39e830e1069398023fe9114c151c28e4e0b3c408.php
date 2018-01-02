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
       <th>اقدامات</th>
     </tr>
   </thead>
   <tbody>
 <?php $__currentLoopData = $Complaints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $complaints): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr role="row" >
            <th class="consignment"><?php echo e($complaints->fld_Consignment); ?></th>
            <th><?php echo e($complaints->getComplaint->fld_Complaints_Subjects); ?></th>
            <th><p style="width: 230px;word-break: break-all;"><?php echo e($complaints->fld_Description); ?></p></th>
            <th>
              <?php if($complaints->fld_Registrar==1): ?>
              نماینده
              <?php else: ?>
              مشتری
              <?php endif; ?>
            </th>
            <th><?php echo e($complaints->getUser->fld_Name); ?></th>
            <th><span style="display: none;"><?php echo e($complaints->created_at); ?></span>
              <span><?php echo e(jDate::forge($complaints->created_at)->format('%B %d %Y %H:%M')); ?></</span>
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
          <button value="<?php echo e($complaints->fld_Id); ?>" style="background-color: tomato;color: white" type="button" class="btn btn-default btn-sm deleteComplainBtn">
            <span class="glyphicon glyphicon-trash"></span> حذف
          </button>
        </th>
      </tr> 
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
 </table>