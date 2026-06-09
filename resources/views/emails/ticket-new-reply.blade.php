<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><style>
body { font-family: Arial, sans-serif; color: #111; background:#f4f6f9; margin:0; padding:20px; }
.card { background:white; max-width:520px; margin:0 auto; border-radius:10px; overflow:hidden; box-shadow:0 4px 16px rgba(0,0,0,0.1); }
.header { background:#111; border-bottom:3px solid #e30613; padding:20px 24px; }
.header img { height:36px; }
.body { padding:28px 24px; }
.body h2 { margin:0 0 12px; font-size:18px; }
.ticket-num { display:inline-block; background:#fde8ea; color:#c0020c; font-weight:700; padding:5px 14px; border-radius:20px; font-size:14px; margin:12px 0; }
.footer { border-top:1px solid #eee; padding:14px 24px; font-size:12px; color:#888; }
</style></head>
<body>
<div class="card">
    <div class="header">
        <img src="{{ asset('images/Planex.jpg') }}" alt="PlanEx">
    </div>
    <div class="body">
        <h2>Bonjour,</h2>
        <p>Nous vous informons qu'un nouveau message vous attend sur le site internet de PlanEx.</p>

        <div class="ticket-num">Ticket {{ $ticket->numero }}</div>

        <p style="font-size:14px;color:#555;">
            Pour le consulter, veuillez accéder au site en suivant le lien ci-dessous :
        </p>
        <a href="{{ url('/message/' . $ticket->token) }}"
           style="display:inline-block;margin-top:4px;padding:10px 22px;background:#e30613;color:white;text-decoration:none;border-radius:6px;font-size:14px;font-weight:600;">
            Voir le message &rarr;
        </a>

        <p style="margin-top:24px;font-size:14px;color:#555;">Cordialement,<br><strong>L'équipe PlanEx</strong></p>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} PlanEx &mdash; Ce message a été envoyé automatiquement, merci de ne pas y répondre.
    </div>
</div>
</body>
</html>
