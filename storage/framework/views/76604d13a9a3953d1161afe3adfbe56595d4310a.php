<div class="remodal" data-remodal-id="<?php echo e($Modal->modalName); ?>"
   data-remodal-options="hashTracking: false, closeOnOutsideClick: false">
   <button data-remodal-action="close" class="remodal-close"></button>
   <div class="remodal-form">
      <p><?php echo e($Modal->modalHeader); ?></p>
      <?php $__currentLoopData = $Modal->modalFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
      <?php if(!isset($field['visible']) || $field['visible']==true): ?>
      <?php if($field['type']=="select"): ?>
      <select  name="<?php echo e($field['name']); ?>">
         <?php $__currentLoopData = $field['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
         <option value="<?php echo e($option['value']); ?>"><?php echo e($option['text']); ?></option>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
      <?php elseif($field['type']=="checkbox" || $field['type']=="radio"): ?>
            <div> <input type="<?php echo e($field['type']); ?>" <?php if(isset($field['placeholder'])): ?> placeholder="<?php echo e($field['placeholder']); ?>" <?php endif; ?> name="<?php echo e($field['name']); ?>" <?php if(isset($field['value'])): ?> value="<?php echo e($field['value']); ?>" <?php endif; ?> ><?php if(isset($field['text'])): ?> <?php echo e($field['text']); ?> <?php endif; ?> </div>
      <?php else: ?>
      <input type="<?php echo e($field['type']); ?>" <?php if(isset($field['placeholder'])): ?> placeholder="<?php echo e($field['placeholder']); ?>" <?php endif; ?> name="<?php echo e($field['name']); ?>" <?php if(isset($field['value'])): ?> value="<?php echo e($field['value']); ?>" <?php endif; ?> > 
      <?php endif; ?>
      <?php else: ?>
      <input type="<?php echo e($field['type']); ?>" style="display: none;" <?php if(isset($field['placeholder'])): ?> placeholder="<?php echo e($field['placeholder']); ?>" <?php endif; ?> name="<?php echo e($field['name']); ?>" <?php if(isset($field['value'])): ?> value="<?php echo e($field['value']); ?>" <?php endif; ?> > 
      <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </div>
   <button data-remodal-action="confirm" class="remodal-confirm" id="<?php echo e($Modal->btnId); ?>">تأیید</button>
   <button data-remodal-action="cancel" class="remodal-cancel">انصراف</button>
</div>