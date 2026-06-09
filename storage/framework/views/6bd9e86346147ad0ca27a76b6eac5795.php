<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>PlanEx — Connexion</title>

    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Styles PlanEx -->
    <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">

    <style>
        body.guest-body {
            min-height: 100vh;
            background: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .guest-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: var(--radius-lg);
            box-shadow: 0 4px 24px rgba(0,0,0,.10);
            overflow: hidden;
        }

        .guest-card-header {
            background: var(--dark);
            padding: 28px 32px 20px;
            text-align: center;
        }

        .guest-card-header img {
            height: 48px;
            object-fit: contain;
        }

        .guest-card-header .guest-subtitle {
            color: rgba(255,255,255,.55);
            font-size: 12px;
            letter-spacing: .08em;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .guest-card-body {
            padding: 28px 32px 32px;
        }

        @media (max-width: 480px) {
            .guest-card { border-radius: 0; min-height: 100vh; }
            body.guest-body { align-items: flex-start; }
        }
    </style>
</head>
<body class="guest-body">

    <div class="guest-card">
        <div class="guest-card-header">
            <a href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('images/Planex.jpg')); ?>" alt="PlanEx">
            </a>
            <p class="guest-subtitle">Gestion des anomalies chantier</p>
        </div>
        <div class="guest-card-body">
            <?php echo e($slot); ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\planex\resources\views/layouts/guest.blade.php ENDPATH**/ ?>