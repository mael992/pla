@extends('layouts.app')

@section('title', 'Conditions Générales d\'Utilisation — PlanEx')
@section('meta_description', 'Conditions Générales d\'Utilisation de l\'application PlanEx.')

@section('styles')
<style>
.cgu-wrap { max-width: 820px; }
.cgu-wrap h1 { font-size: clamp(1.5rem, 3.5vw, 2.1rem); font-weight: 800; margin-bottom: 4px; }
.cgu-sub { color: #6b7280; font-style: italic; margin-bottom: 28px; }
.cgu-wrap h2 { font-size: 1.15rem; font-weight: 700; color: #b91c1c; margin: 30px 0 10px; padding-bottom: 6px; border-bottom: 1px solid #eee; }
.cgu-wrap p { text-align: justify; margin-bottom: 12px; }
.cgu-wrap ul { margin: 6px 0 14px; padding-left: 22px; }
.cgu-wrap li { margin-bottom: 5px; }
.cgu-label { font-weight: 700; }
</style>
@endsection

@section('content')
<div class="container py-5 cgu-wrap">

    <h1>Conditions Générales d'Utilisation (CGU)</h1>
    <p class="cgu-sub">Application PlanEx — Version 1, en vigueur au 27 juin 2026</p>

    <h2>1. Objet et Accès au Service</h2>
    <p>Les présentes Conditions Générales d'Utilisation ont pour objet de définir les modalités d'utilisation de l'application PlanEx. L'utilisation du service est ouverte à toute personne physique ou morale disposant d'un compte utilisateur valide et à jour de son abonnement. En souscrivant et en utilisant PlanEx, l'utilisateur accepte sans réserve les présentes conditions.</p>
    <p>Le service en ligne PlanEx est accessible 24h/24 et 7j/7, sous réserve des opérations de maintenance. Des opérations de maintenance peuvent intervenir à tout moment, en principe pendant les heures de faible affluence. Dans la mesure du possible, les utilisateurs en seront informés via le site. Durant une opération de maintenance, l'accès au service peut être temporairement suspendu.</p>

    <h2>2. Fonctionnalités et Droits d'Utilisation</h2>
    <p>L'utilisateur dispose d'un droit d'usage de l'application lui permettant de :</p>
    <ul>
        <li>Créer et gérer des chantiers, des zones et des incidents (anomalies) ;</li>
        <li>Éditer des suivis et rapports au format PDF ;</li>
        <li>Ajouter des collaborateurs sur leurs chantiers en autonomie.</li>
    </ul>
    <p>Pour qu'un collaborateur puisse être ajouté à un chantier, il est impératif qu'il dispose également d'un compte préalablement créé et actif.</p>

    <h2>3. Modalités d'Abonnement, Rétractation et Résiliation</h2>
    <p><span class="cgu-label">Durée et renouvellement :</span> L'abonnement à PlanEx est proposé selon deux formules : soit mensuel, soit annuel.</p>
    <p><span class="cgu-label">Droit de rétractation :</span> Conformément aux dispositions légales, l'utilisateur dispose d'un délai de 14 jours à compter de son inscription pour faire une demande d'annulation. Passé ce délai, aucune annulation ou remboursement ne sera possible. Si l'annulation intervient dans le délai des 14 jours, l'utilisateur sera débité au prorata du temps utilisé. (Exemple : si l'application a été utilisée pendant 12 jours, 12 jours d'utilisation seront facturés, et le reste de la somme versée sera remboursé.)</p>
    <p><span class="cgu-label">Résiliation :</span> Pour toute demande de résiliation, l'utilisateur doit se rendre sur la page de contact du site, sélectionner la catégorie de demande concernant l'abonnement, et formuler sa volonté de résilier. La Direction PlanEx se réserve un délai maximum de 48h à 72h pour recontacter le client suite à une demande d'abonnement ou de résiliation, le temps de vérifier les e-mails automatisés de création de compte et de trouver la solution adaptée.</p>

    <h2>4. Propriété Intellectuelle</h2>
    <p>La conservation des droits de l'application PlanEx appartient exclusivement à son créateur/direction et en aucun cas à une autre entité. Il est strictement interdit de copier, modifier, revendre ou procéder à de la rétro-ingénierie sur le site ou l'application. Tout manquement à cette règle entraînera la fermeture immédiate du compte, sans remboursement du contrat.</p>

    <h2>5. Charte de Bonne Conduite et Comportements Prohibés</h2>
    <p>L'utilisateur s'engage à utiliser PlanEx dans le strict respect des lois en vigueur. Il est formellement interdit de publier, saisir ou diffuser tout contenu (texte, mot, photo ou image) relevant des comportements suivants :</p>
    <p class="cgu-label">Contenus et comportements strictement interdits :</p>
    <ul>
        <li>Discrimination, racisme, xénophobie, sexisme, homophobie ;</li>
        <li>Propos injurieux, insultes, harcèlement sous toutes ses formes ;</li>
        <li>Nudité, pornographie ou tout contenu à caractère sexuel ;</li>
        <li>Menaces de mort, menaces verbales ou visuelles envers quiconque.</li>
    </ul>
    <p class="cgu-label">Sanctions applicables en cas d'infraction :</p>
    <p>En cas de non-respect de cette charte de bonne conduite, la Direction PlanEx procédera à la fermeture immédiate et définitive du compte, sans aucun remboursement du contrat et sans possibilité d'appliquer le droit de rétractation des 14 jours.</p>
    <p>Conformément à nos obligations légales, les journaux de connexion et d'activité sont conservés pendant une durée de six (6) mois. En cas de manquement grave ou de litige, les données et preuves nécessaires (journaux, tickets, contenus incriminés) pourront être conservées au-delà de cette durée, pendant tout le temps nécessaire à la constatation, à l'exercice ou à la défense de droits en justice, dans la limite des durées de prescription légales applicables. La Direction PlanEx se réserve le droit de saisir la justice appropriée.</p>

    <h2>6. Données Personnelles, Sauvegardes et Purge Serveur</h2>
    <p><span class="cgu-label">Données collectées :</span> La Direction PlanEx collecte les données suivantes : authentification (heure et date de connexion), noms d'utilisateur, noms des chantiers créés, tickets et incidents, ainsi que le temps de traitement des demandes.</p>
    <p><span class="cgu-label">Sauvegardes :</span> La base de données fait l'objet d'une sauvegarde automatique quotidienne, conservée pendant trente (30) jours. Les journaux d'activité font l'objet d'une sauvegarde automatique tous les deux (2) jours, conservée pendant six (6) mois. Les sauvegardes sont stockées de manière sécurisée sur le serveur. Bien que PlanEx mette en œuvre toutes les mesures nécessaires pour assurer les sauvegardes et le bon fonctionnement, l'utilisateur ne peut en aucun cas se retourner contre la Direction PlanEx en cas de perte de données imputable à une mauvaise manipulation (par exemple : un utilisateur du chantier qui supprime tout lui-même, ou une perte due à l'action de l'utilisateur).</p>
    <p><span class="cgu-label">Clôture, fin d'abonnement et accès technique :</span> En cas de clôture de compte, de fin d'abonnement ou de terme du contrat, les données (comptes, chantiers, logs) sont retirées de l'interface utilisateur et purgées du système serveur dans un délai maximum de 6 mois. Cette période d'archivage technique de 6 mois maximum après la fin du contrat donne expressément le droit à l'équipe PlanEx de consulter les e-mails automatisés de création de compte, les transactions et les logs associés, afin de vérifier les informations, de traiter le délai de 48h à 72h pour trouver une solution amiable en cas de litige ou d'erreur d'abonnement, et de justifier d'éléments en cas de saisine de la justice.</p>
    <p><span class="cgu-label">Conservation des tickets :</span> Les tickets de contact clôturés sont automatiquement supprimés quinze (15) jours après leur clôture, sauf lorsqu'ils sont nécessaires à la gestion d'un litige en cours, auquel cas ils sont conservés pour les besoins de celui-ci.</p>

    <h2>7. Acceptation et Modification des Conditions</h2>
    <p>Les présentes Conditions Générales d'Utilisation sont accessibles à tout moment sur le site. Toute modification sera publiée sur cette même page, avec mention de sa date d'entrée en vigueur. Les utilisateurs disposent d'un délai de trente (30) jours à compter de la publication pour formuler un refus via la page de contact. À défaut, ou dès lors que l'utilisateur continue à utiliser le service après l'entrée en vigueur, les Conditions Générales d'Utilisation sont réputées acceptées.</p>

</div>
@endsection
