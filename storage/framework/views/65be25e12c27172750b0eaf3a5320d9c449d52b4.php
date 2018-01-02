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
        <tbody >
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
            <button class="btn btn-default btn-sm history" value="<?php echo e($complaints->fld_Consignment); ?>" style="background-color: 545454;color: white" type="button" class="btn btn-default btn-sm deleteComplainBtn">
            <span class="glyphicon glyphicon-repeat"></span> تاریخچه
            &nbsp;
            <span class="countOfRecords"><?php echo e($complaints->count); ?></span>
            </button>
            </th>
            </tr> 
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            </table>