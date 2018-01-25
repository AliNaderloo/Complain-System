  <table id="DataTable" style="font-size: 14px" class="table direction table-hover dataTable" role="grid" >
    <thead>
      <tr  role="row" >
        <th>شماره</th>
        <?php $__currentLoopData = $Table->head; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <th><?php echo e($head); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    <th><?php echo e($complaints->fld_User_Name); ?></th>
    <th><span style="display: none;"><?php echo e($complaints->created_at); ?></span>
    <p style="min-width: 115px"><?php echo e(jDate::forge($complaints->created_at)->format('%y/%m/%d %H:%M')); ?></p>
    </th>
    <th>

    <?php if($complaints->fld_Level==1): ?> ثبت شده است <?php endif; ?> 
    <?php if($complaints->fld_Level==2): ?> در حال انجام <?php endif; ?> 
    <?php if($complaints->fld_Level==3): ?>  به اتمام رسیده <?php endif; ?> 

    </th>
    <th>
    <button  value="<?php echo e($complaints->fld_Id); ?>" style="background-color: tomato;color: white" type="button" class="btn btn-default btn-sm deleteComplainBtn">
    <span class="glyphicon glyphicon-trash"></span> حذف
    </button>
    </th>
    </tr> 
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
    </table>
            <div id="conId" style="display:none;"><?php if($createSpcCom!=false): ?> <?php echo e($createSpcCom); ?> <?php endif; ?></div>
