<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><style>
body { font-family: Arial, sans-serif; color: #111; background:#f4f6f9; margin:0; padding:20px; }
.card { background:white; max-width:520px; margin:0 auto; border-radius:10px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.1); }
.header { background:#111; border-bottom:3px solid #e30613; padding:20px 24px; }
.header img { height:36px; }
.body { padding:28px 24px; }
.body h2 { margin:0 0 12px; font-size:18px; }
.credentials { background:#f8fafc; border-left:4px solid #e30613; padding:14px 18px; border-radius:4px; margin:16px 0; font-size:14px; line-height:2; }
.cred-label { font-weight:bold; display:inline-block; width:180px; }
.footer { border-top:1px solid #eee; padding:14px 24px; font-size:12px; color:#888; }
.note { background:#fff8e1; border:1px solid #f0c040; padding:12px 16px; border-radius:4px; font-size:13px; color:#555; margin-top:16px; }
</style></head>
<body>
<div class="card">
    <div class="header">
        <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx">
    </div>
    <div class="body">
        <h2>Bonjour <?php echo e($user->username); ?>,</h2>
        <p>Bienvenue sur <strong>PlanEx</strong> ! Veuillez trouver ci-dessous vos identifiants de connexion ainsi que le courrier officiel en pièce jointe.</p>

        <div class="credentials">
            <div><span class="cred-label">Lien d'accès :</span> <a href="https://planex26.com">https://planex26.com</a></div>
            <div><span class="cred-label">Identifiant :</span> <?php echo e($user->username); ?></div>
            <div><span class="cred-label">Mot de passe provisoire :</span> <?php echo e($user->temp_password); ?></div>
        </div>

        <div class="note">
            ⚠️ Pour des raisons de sécurité, vous serez invité(e) à modifier ce mot de passe lors de votre première connexion. Conservez ces informations de manière strictement confidentielle.
        </div>

        <a href="https://planex26.com/login" style="display:inline-block;margin-top:20px;padding:10px 22px;background:#e30613;color:white;text-decoration:none;border-radius:6px;font-size:14px;font-weight:600;">
            Se connecter à PlanEx →
        </a>
    </div>
    <div class="footer">
        © <?php echo e(date('Y')); ?> PlanEx — Ce message a été envoyé automatiquement, merci de ne pas y répondre.
    </div>
</div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\planex\resources\views/emails/courrier-identifiants.blade.php ENDPATH**/ ?>