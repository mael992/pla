<?php $__env->startSection('content'); ?>

<div class="container">

    <div class="card">

        <div class="card-header">
            <h2><?php echo e(__('messages.user_edit_title')); ?></h2>
        </div>

        <div class="card-body">

            <form method="POST" action="<?php echo e(route('users.update', $user->id)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <label><?php echo e(__('messages.col_username')); ?></label>
                <input type="text" name="username" value="<?php echo e($user->username); ?>" required>
                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color:red"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <br><br>

                <label><?php echo e(__('messages.user_email_hint')); ?></label>
                <input type="email" name="email" value="<?php echo e($user->email); ?>">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color:red"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <br><br>

                <label><?php echo e(__('messages.user_password_optional')); ?></label>
                <input type="password" name="password" minlength="8">
                <small style="color:gray"><?php echo e(__('Minimum 8 caractères')); ?></small>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span style="color:red"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <br><br>

                <label><?php echo e(__('messages.user_role')); ?></label>
                <select name="role" required>
                    <option value="user" <?php echo e($user->role == 'user' ? 'selected' : ''); ?>>User</option>
                    <option value="incident" <?php echo e($user->role == 'incident' ? 'selected' : ''); ?>>Incident</option>
                    <option value="admin" <?php echo e($user->role == 'admin' ? 'selected' : ''); ?>>Admin</option>
                </select>

                <br><br>

                <div class="card-footer">
                    <a href="<?php echo e(route('users.index')); ?>" class="btn btn-secondary">
                        <?php echo e(__('messages.btn_back')); ?>

                    </a>
                    <button type="submit" class="btn btn-warning">
                        <?php echo e(__('messages.user_save')); ?>

                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/users/edit.blade.php ENDPATH**/ ?>