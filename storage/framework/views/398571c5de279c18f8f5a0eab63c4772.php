<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    
    <?php if(session('status')): ?>
        <div class="alert alert-success py-2 px-3 mb-3" style="font-size:13px;">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>

    
    <?php if(session('error') === 'temp_password_expired'): ?>
        <div class="alert alert-danger py-2 px-3 mb-3" style="font-size:13px;">
            ⚠️ Votre mot de passe temporaire a expiré (48h). Contactez un administrateur.
        </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="alert alert-danger py-2 px-3 mb-3" style="font-size:13px;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div><?php echo e($error); ?></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>" novalidate>
        <?php echo csrf_field(); ?>

        
        <div class="mb-3">
            <label for="username" class="form-label fw-semibold" style="font-size:13px;">
                <?php echo e(__('messages.auth_username')); ?>

            </label>
            <input
                type="text"
                id="username"
                name="username"
                class="form-control <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                value="<?php echo e(old('username')); ?>"
                required
                autofocus
                autocomplete="username"
                placeholder="Votre identifiant"
            >
        </div>

        
        <div class="mb-3">
            <label for="password" class="form-label fw-semibold" style="font-size:13px;">
                <?php echo e(__('messages.auth_password')); ?>

            </label>
            <div class="input-group">
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                >
                <button type="button" class="btn btn-outline-secondary" tabindex="-1"
                        onclick="togglePwd()" title="Afficher/Masquer">
                    <span id="eyeIcon">👁</span>
                </button>
            </div>
        </div>

        
        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me" style="font-size:13px;color:#555;">
                    <?php echo e(__('messages.auth_remember')); ?>

                </label>
            </div>
        </div>

        
        <button type="submit" class="btn w-100 fw-semibold py-2"
                style="background:var(--brand);color:#fff;border:none;border-radius:var(--radius);font-size:15px;letter-spacing:.01em;transition:background .2s;"
                onmouseover="this.style.background='var(--brand-dark)'"
                onmouseout="this.style.background='var(--brand)'">
            <?php echo e(__('messages.auth_sign_in')); ?>

        </button>

        
        <?php if(Route::has('password.request')): ?>
        <div class="text-center mt-3">
            <a href="<?php echo e(route('password.request')); ?>"
               style="font-size:12px;color:#888;text-decoration:none;">
                <?php echo e(__('messages.auth_forgot_password')); ?>

            </a>
        </div>
        <?php endif; ?>

    </form>

    <script>
    function togglePwd() {
        const p = document.getElementById('password');
        const e = document.getElementById('eyeIcon');
        if (p.type === 'password') { p.type = 'text'; e.textContent = '🙈'; }
        else { p.type = 'password'; e.textContent = '👁'; }
    }
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\planex\resources\views/auth/login.blade.php ENDPATH**/ ?>