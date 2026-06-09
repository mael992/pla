<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><style>
body { font-family: Arial, sans-serif; color: #111; background:#f4f6f9; margin:0; padding:20px; }
.card { background:white; max-width:520px; margin:0 auto; border-radius:10px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.1); }
.header { background:#111; border-bottom:3px solid #e30613; padding:20px 24px; }
.header img { height:36px; }
.body { padding:28px 24px; }
.alert-box { background:#fef2f2; border-left:4px solid #e30613; padding:14px 18px; border-radius:4px; margin:16px 0; }
.footer { border-top:1px solid #eee; padding:14px 24px; font-size:12px; color:#888; }
</style></head>
<body>
<div class="card">
    <div class="header">
        <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx">
    </div>
    <div class="body">
        <h2 style="margin:0 0 12px;font-size:18px">Bonjour {{ $chef->username }},</h2>
        <p>Un membre de votre chantier <strong>n'est plus disponible</strong> sur PlanEx.</p>

        <div class="alert-box">
            <div style="display:flex;gap:8px;margin-bottom:8px">
                <span>🏗️</span>
                <strong>Chantier :</strong> {{ $chantier->nom }} — {{ $chantier->localite }}
            </div>
            <div style="display:flex;gap:8px;margin-bottom:8px">
                <span>👤</span>
                <span>Utilisateur retiré : <strong>{{ $removedUsername }}</strong></span>
            </div>
            <div style="display:flex;gap:8px">
                <span>🎯</span>
                <span>Rôle occupé : <strong>{{ $removedRole }}</strong></span>
            </div>
        </div>

        <p style="font-size:14px;color:#555;">
            En tant que <strong>Chef Chantier</strong>, vous pouvez réattribuer ce rôle à un autre membre
            depuis la fiche de votre chantier sur PlanEx.
        </p>

        <a href="{{ url('/chantiers/'.$chantier->id) }}"
           style="display:inline-block;margin-top:8px;padding:10px 22px;background:#e30613;color:white;text-decoration:none;border-radius:6px;font-size:14px;font-weight:600;">
            Gérer le chantier →
        </a>
    </div>
    <div class="footer">
        © {{ date('Y') }} PlanEx — Ce message a été envoyé automatiquement, merci de ne pas y répondre.
    </div>
</div>
</body>
</html>
