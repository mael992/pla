<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><style>
body { font-family: Arial, sans-serif; color: #111; background:#f4f6f9; margin:0; padding:20px; }
.card { background:white; max-width:520px; margin:0 auto; border-radius:10px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.1); }
.header { background:#111; border-bottom:3px solid #e30613; padding:20px 24px; }
.header img { height:36px; }
.body { padding:28px 24px; }
.body h2 { margin:0 0 12px; font-size:18px; }
.role-badge { display:inline-block; background:#fde8ea; color:#c0020c; font-weight:700; padding:5px 14px; border-radius:20px; font-size:14px; margin:12px 0; }
.info-row { display:flex; gap:8px; margin:8px 0; font-size:14px; }
.footer { border-top:1px solid #eee; padding:14px 24px; font-size:12px; color:#888; }
</style></head>
<body>
<div class="card">
    <div class="header">
        <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx">
    </div>
    <div class="body">
        <h2>Bonjour <?php echo e($user->username); ?>,</h2>
        <p>Vous avez été <strong>ajouté à un chantier</strong> sur PlanEx.</p>

        <div style="background:#f8fafc;border-left:4px solid #e30613;padding:14px 18px;border-radius:4px;margin:16px 0;">
            <div class="info-row"><span>🏗️</span><strong>Chantier :</strong> <?php echo e($chantier->nom); ?></div>
            <div class="info-row"><span>📍</span><span><?php echo e($chantier->localite); ?></span></div>
            <div class="info-row"><span>🎯</span><span>Votre rôle :</span></div>
            <div><span class="role-badge"><?php echo e($roleLabel); ?></span></div>
        </div>

        <p style="font-size:14px;color:#555;">
            Connectez-vous à PlanEx pour accéder au tableau des anomalies de ce chantier.
        </p>
        <a href="<?php echo e(url('/')); ?>" style="display:inline-block;margin-top:8px;padding:10px 22px;background:#e30613;color:white;text-decoration:none;border-radius:6px;font-size:14px;font-weight:600;">
            Accéder à PlanEx →
        </a>
    </div>
    <div class="footer">
        © <?php echo e(date('Y')); ?> PlanEx — Ce message a été envoyé automatiquement, merci de ne pas y répondre.
    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\planex\resources\views/emails/chantier-user-added.blade.php ENDPATH**/ ?>