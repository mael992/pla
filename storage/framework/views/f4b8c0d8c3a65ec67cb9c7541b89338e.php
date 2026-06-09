<?php $__env->startSection('content'); ?>
<div class="container py-5">

    
    <?php if(session('upgrade')): ?>
        <div class="alert alert-warning d-flex align-items-center gap-3 mb-4">
            <span style="font-size:1.5rem">🔒</span>
            <div>
                <strong><?php echo e(__('messages.pricing_not_access')); ?></strong>
            </div>
        </div>
    <?php endif; ?>

    
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-2"><?php echo e(__('messages.pricing_title')); ?></h1>
        <p class="text-muted fs-5"><?php echo e(__('messages.pricing_subtitle')); ?></p>
    </div>

    
    <div class="row g-4 justify-content-center">

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card">
                <div class="pricing-badge" style="background:#cd7f32">BRONZE</div>
                <div class="pricing-icon">🥉</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span><?php echo e(__('messages.pricing_persons')); ?> : <strong>1–5</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📋</span>
                        <span><?php echo e(__('messages.pricing_access')); ?></span>
                    </div>
                    <div class="pricing-feature pf-no">
                        <span class="pf-icon">🛠️</span>
                        <span><?php echo e(__('messages.pricing_support')); ?></span>
                    </div>
                </div>
                <a href="<?php echo e(route('contact')); ?>" class="pricing-btn">
                    <?php echo e(__('messages.pricing_contact_btn')); ?>

                </a>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card">
                <div class="pricing-badge" style="background:#aaa">SILVER</div>
                <div class="pricing-icon">🥈</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span><?php echo e(__('messages.pricing_persons')); ?> : <strong>6–15</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📋</span>
                        <span><?php echo e(__('messages.pricing_access')); ?></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">🛠️</span>
                        <span><?php echo e(__('messages.pricing_support')); ?></span>
                    </div>
                </div>
                <a href="<?php echo e(route('contact')); ?>" class="pricing-btn">
                    <?php echo e(__('messages.pricing_contact_btn')); ?>

                </a>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card pricing-card--featured">
                <div class="pricing-badge" style="background:#f59e0b">GOLD ⭐</div>
                <div class="pricing-icon">🥇</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span><?php echo e(__('messages.pricing_persons')); ?> : <strong>16–30</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📋</span>
                        <span><?php echo e(__('messages.pricing_access')); ?></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">🛠️</span>
                        <span><?php echo e(__('messages.pricing_support')); ?></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📊</span>
                        <span><?php echo e(__('messages.pricing_monthly')); ?> / <?php echo e(__('messages.pricing_annual')); ?></span>
                    </div>
                </div>
                <a href="<?php echo e(route('contact')); ?>" class="pricing-btn pricing-btn--gold">
                    <?php echo e(__('messages.pricing_contact_btn')); ?>

                </a>
            </div>
        </div>

        
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="pricing-card">
                <div class="pricing-badge" style="background:#7c3aed">PLATINUM 💎</div>
                <div class="pricing-icon">💎</div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <span class="pf-icon">👥</span>
                        <span><?php echo e(__('messages.pricing_persons')); ?> : <strong>30+</strong></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📋</span>
                        <span><?php echo e(__('messages.pricing_access')); ?></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">🛠️</span>
                        <span><?php echo e(__('messages.pricing_support')); ?></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">📊</span>
                        <span><?php echo e(__('messages.pricing_monthly')); ?> / <?php echo e(__('messages.pricing_annual')); ?></span>
                    </div>
                    <div class="pricing-feature">
                        <span class="pf-icon">✨</span>
                        <span><?php echo e(__('messages.pricing_save')); ?></span>
                    </div>
                </div>
                <a href="<?php echo e(route('contact')); ?>" class="pricing-btn">
                    <?php echo e(__('messages.pricing_contact_btn')); ?>

                </a>
            </div>
        </div>

    </div>

    
    <p class="text-center text-muted small mt-4">
        <?php echo e(__('messages.pricing_monthly')); ?> &amp; <?php echo e(__('messages.pricing_annual')); ?> —
        <?php echo e(__('messages.pricing_save')); ?>

    </p>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\planex\resources\views/tarifs.blade.php ENDPATH**/ ?>