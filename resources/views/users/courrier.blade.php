<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12pt;
            color: #222;
            background: #fff;
        }

        .page {
            padding: 40px 50px;
        }

        /* ── Logo ── */
        .logo-block {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #c00;
            padding-bottom: 18px;
        }
        .logo-block img {
            max-height: 70px;
        }

        /* ── Destinataire ── */
        .destinataire {
            margin-bottom: 28px;
        }
        .destinataire p {
            line-height: 1.7;
        }
        .label-bold {
            font-weight: bold;
        }

        /* ── Date ── */
        .date-line {
            margin-bottom: 30px;
            color: #444;
        }

        /* ── Séparateur ── */
        hr {
            border: none;
            border-top: 1px solid #ccc;
            margin: 22px 0;
        }

        /* ── Corps lettre ── */
        .body-text {
            line-height: 1.8;
            margin-bottom: 20px;
        }

        /* ── Bloc identifiants ── */
        .credentials {
            background: #f5f5f5;
            border-left: 4px solid #c00;
            padding: 16px 20px;
            margin: 22px 0;
            border-radius: 2px;
        }
        .credentials p {
            line-height: 2;
        }
        .cred-label {
            font-weight: bold;
            display: inline-block;
            width: 180px;
        }
        .cred-value {
            font-family: DejaVu Sans Mono, Courier New, monospace;
            color: #c00;
            font-size: 12pt;
        }

        /* ── Note sécurité ── */
        .note-securite {
            background: #fff8e1;
            border: 1px solid #f0c040;
            padding: 12px 16px;
            border-radius: 3px;
            margin-bottom: 22px;
            font-size: 10.5pt;
            color: #555;
        }

        /* ── Signature ── */
        .signature {
            margin-top: 40px;
            border-top: 1px solid #ccc;
            padding-top: 16px;
        }
        .signature p {
            line-height: 1.8;
        }
        .signature .equipe {
            font-weight: bold;
            font-size: 13pt;
        }
    </style>
</head>
<body>
<div class="page">

    {{-- Logo --}}
    <div class="logo-block">
        <img src="{{ public_path('images/Planex.jpg') }}" alt="PlanEx">
    </div>

    {{-- Destinataire --}}
    <div class="destinataire">
        <p class="label-bold">À l'attention de :</p>
        <p>{{ $user->username }}</p>
        @if($user->email)
        <p>{{ $user->email }}</p>
        @endif
    </div>

    {{-- Date --}}
    <p class="date-line">Date : {{ now()->format('d/m/Y') }}</p>

    <hr>

    {{-- Corps --}}
    <p class="body-text">Madame, Monsieur,</p>

    <p class="body-text">
        Dans le cadre de la mise en place de votre accès à la plateforme <strong>PlanEx</strong>,
        nous avons le plaisir de vous transmettre ci-dessous vos identifiants personnels de connexion :
    </p>

    {{-- Bloc identifiants --}}
    <div class="credentials">
        <p>
            <span class="cred-label">Lien d'accès au site :</span>
            <span class="cred-value">https://planex26.com</span>
        </p>
        <p>
            <span class="cred-label">Identifiant (User) :</span>
            <span class="cred-value">{{ $user->username }}</span>
        </p>
        <p>
            <span class="cred-label">Mot de passe provisoire :</span>
            <span class="cred-value">
                {{ $user->temp_password ?? '(voir l\'administrateur)' }}
            </span>
        </p>
        @if($user->temp_password_expires_at)
        <p style="margin-top:6px;">
            <span class="cred-label">Valable jusqu'au :</span>
            <span style="color:#c00;font-weight:bold;">
                {{ $user->temp_password_expires_at->format('d/m/Y à H:i') }}
            </span>
        </p>
        @endif
    </div>

    {{-- Note sécurité --}}
    <div class="note-securite">
        &#x26A0; Pour des raisons de sécurité, vous serez invité(e) à modifier ce mot de passe
        lors de votre première connexion. Conservez l'ensemble de ces informations de manière
        strictement confidentielle.
    </div>

    <p class="body-text">
        Notre équipe reste bien entendu à votre disposition pour toute question ou assistance
        complémentaire concernant l'utilisation de la plateforme.
    </p>

    <p class="body-text">
        Nous vous remercions pour votre confiance et vous souhaitons une excellente utilisation de PlanEx.
    </p>

    <hr>

    {{-- Signature --}}
    <div class="signature">
        <p class="equipe">L'équipe PlanEx</p>
        <p>Service Client</p>
    </div>

</div>
</body>
</html>
