<?php

return [

    // ════════════════════════════════════════════════════════
    // NAVBAR
    // ════════════════════════════════════════════════════════
    'nav_home'          => 'Accueil',
    'nav_infos'         => 'Infos',
    'nav_news'          => 'Nouveautés',
    'nav_contact'       => 'Contact',
    'nav_dashboard'     => 'Tableau des anomalies',
    'nav_manage_users'  => 'Gestion des utilisateurs',
    'nav_logout'        => 'Déconnexion',
    'nav_login'         => 'Connexion',
    'nav_chantiers'     => 'Chantiers',

    // Dropdown "Tableau anomalie"
    'nav_tableau_label'   => 'Tableau anomalie',
    'nav_tab_engineering' => 'Ingénierie',
    'nav_tab_development' => 'Développement',
    'nav_tab_precom'      => 'Mise en route precom / com',
    'nav_tab_operations'  => 'Exploitation / Opération',
    'nav_tab_support'     => 'Services supports & prestations additionnelles',

    // ════════════════════════════════════════════════════════
    // AUTHENTIFICATION
    // ════════════════════════════════════════════════════════
    'auth_username'        => "Nom d'utilisateur",
    'auth_password'        => 'Mot de passe',
    'auth_remember'        => 'Se souvenir de moi',
    'auth_sign_in'         => 'Connexion',
    'auth_forgot_password' => 'Mot de passe oublié ?',
    'auth_forgot_desc'     => 'Mot de passe oublié ? Pas de problème. Renseignez votre adresse e-mail et nous vous enverrons un lien de réinitialisation.',
    'auth_send_reset_link' => 'Envoyer le lien',

    // ════════════════════════════════════════════════════════
    // BOUTONS & COMMUNS
    // ════════════════════════════════════════════════════════
    'btn_back'           => '← Retour',
    'btn_save'           => 'Enregistrer',
    'btn_cancel'         => 'Annuler',
    'btn_create'         => 'Créer',
    'btn_edit'           => 'Modifier',
    'btn_delete'         => 'Supprimer',
    'btn_view'           => 'Voir',
    'btn_add'            => '➕ Ajouter',
    'select_placeholder' => '— Sélectionner —',

    // ════════════════════════════════════════════════════════
    // PAGE D'ACCUEIL
    // ════════════════════════════════════════════════════════
    'home_welcome' => 'Bienvenue sur PlanEx — toujours une idée d\'avance',

    // ════════════════════════════════════════════════════════
    // ANOMALIES (incidents)
    // ════════════════════════════════════════════════════════
    'incidents_title'         => 'Anomalies',
    'incident_new'            => 'Nouvelle anomalie',
    'incident_add'            => 'Ajouter une anomalie',
    'incident_edit_title'     => 'Modifier l\'anomalie #:id',
    'incident_confirm_delete' => 'Supprimer cette anomalie ?',
    'incident_none'           => 'Aucune anomalie enregistrée.',
    'incident_create_btn'     => 'Créer l\'anomalie',
    'incident_save_btn'       => 'Enregistrer',
    'incident_closed_warning' => 'Cette anomalie est <strong>fermée</strong> et ne peut plus être modifiée.',
    'incident_issued_by'      => 'Émis par',

    // Colonnes tableau
    'col_id'           => 'Réf.',
    'col_issued_on'    => 'Émis le',
    'col_photo_open'   => 'Photo ouv.',
    'col_photo_closed' => 'Photo ferm.',
    'col_closed_on'    => 'Clôture le',
    'col_discipline'   => 'Discipline',
    'col_status'       => 'Statut',
    'col_actions'      => 'Actions',

    // Statuts
    'status_na'          => '⬛ N/A',
    'status_open'        => '🟥 Ouvert',
    'status_in_progress' => '🟧 En cours',
    'status_closed'      => '🟩 Fermé',

    // Sections fiche détail
    'section_general_info' => 'Informations générales',
    'section_tracking'     => 'Suivi',
    'section_description'  => 'Description & remarques',
    'section_qfc'          => 'QFC',
    'section_photos'       => 'Photos',

    // Champs formulaire
    'field_discipline'      => 'Discipline',
    'field_system'          => 'Système',
    'field_work_lot'        => 'Lot de travail',
    'field_zone'            => 'Zone',
    'field_chantier'        => 'Chantier',
    'field_label'           => 'Étiquette',
    'field_category'        => 'Catégorie',
    'field_internal'        => 'Interne',
    'field_responsibility'  => 'Responsabilité',
    'field_status'          => 'Statut',
    'field_issued_on'       => 'Émis le',
    'field_updated_on'      => 'Mise à jour',
    'field_closed_on'       => 'Clôture',
    'field_planned_closure' => 'Clôture prévue',
    'field_closure_date'    => 'Date de clôture',
    'field_qfc_open'        => 'Ouvert n°',
    'field_qfc_closed'      => 'Fermé n°',
    'field_qfc_open_form'   => 'QFC ouvert n°',
    'field_qfc_closed_form' => 'QFC fermé n°',
    'field_description'     => 'Description & remarques',
    'field_photo_open'      => 'Photo ouverte',
    'field_photo_closed'    => 'Photo fermée',

    'photo_sets_issue_date'  => '(définit automatiquement la date d\'émission)',
    'photo_sets_update_date' => '(définit automatiquement la date de mise à jour)',
    'photo_delete'           => '🗑 Supprimer la photo',
    'photo_take'             => 'Prendre une photo',
    'photo_gallery'          => 'Choisir depuis la galerie',

    'form_incident_closed' => 'Anomalie <strong>fermée</strong> — seul le statut peut être modifié.',
    'form_manage_zones'    => 'Gérer les zones',

    // ════════════════════════════════════════════════════════
    // SIDEBAR TABLEAU
    // ════════════════════════════════════════════════════════
    'sidebar_incidents'    => 'Anomalies',
    'sidebar_new_incident' => 'Nouvelle anomalie',
    'sidebar_manage_zones' => 'Gérer les zones',
    'sidebar_add_incident' => 'Ajouter une anomalie',

    // ════════════════════════════════════════════════════════
    // RECHERCHE
    // ════════════════════════════════════════════════════════
    'search_placeholder' => 'Rechercher par chantier ou localité...',
    'search_label'       => 'Recherche',
    'search_active'      => 'Filtre actif :',
    'search_clear'       => 'Effacer',

    // ════════════════════════════════════════════════════════
    // ZONES
    // ════════════════════════════════════════════════════════
    'zones_title' => 'Gestion des zones',
    'zone_new'    => 'Nouvelle zone',
    'zone_name'   => 'Nom de la zone',
    'zone_none'   => 'Aucune zone enregistrée.',

    // ════════════════════════════════════════════════════════
    // UTILISATEURS
    // ════════════════════════════════════════════════════════
    'users_title'            => 'Gestion des utilisateurs',
    'user_add'               => '➕ Ajouter',
    'user_add_title'         => '➕ Ajouter un utilisateur',
    'user_edit_title'        => '✏️ Modifier l\'utilisateur',
    'col_username'           => 'Identifiant',
    'col_email'              => 'E-mail',
    'col_role'               => 'Rôle',
    'user_email_hint'        => 'E-mail (pour la réinitialisation du mot de passe)',
    'user_password'          => 'Mot de passe',
    'user_password_optional' => 'Mot de passe (laisser vide pour ne pas modifier)',
    'user_role'              => 'Rôle',
    'user_save'              => '💾 Enregistrer',
    'user_create'            => '💾 Créer',

    // ════════════════════════════════════════════════════════
    // CHANTIERS
    // ════════════════════════════════════════════════════════
    'chantiers_title'      => 'Gestion des chantiers',
    'chantier_new'         => '➕ Nouveau chantier',
    'chantier_add_title'   => '➕ Ajouter un chantier',
    'chantier_edit_title'  => '✏️ Modifier le chantier',
    'chantier_created'     => 'Chantier créé avec succès.',
    'chantier_updated'     => 'Chantier modifié avec succès.',
    'chantier_deleted'     => 'Chantier supprimé.',
    'chantier_none'        => 'Aucun chantier enregistré.',
    'col_chantier'         => 'Chantier',
    'col_localite'         => 'Localité',
    'col_incidents_count'  => 'Anomalies',
    'field_nom'            => 'Nom',
    'field_localite'       => 'Localité',

    // ════════════════════════════════════════════════════════
    // PAGES PUBLIQUES & DIVERS
    // ════════════════════════════════════════════════════════
    'home_title'       => "Bienvenue sur PlanEx — toujours une idée d'avance",
    'infos_title'      => 'Informations',
    'infos_p1'         => 'PlanEx arrive bientôt 🚀',
    'infos_p2'         => 'Notre plateforme est actuellement en cours de finalisation afin de vous offrir la meilleure expérience possible.',
    'infos_p3'         => "Merci pour votre patience — l'ouverture officielle approche à grands pas. La date de lancement sera annoncée très prochainement.",
    'infos_p4'         => "L'équipe PlanEx vous remercie pour votre patience et votre compréhension.",
    'contact_title'    => 'Contact',
    'contact_coming'   => 'Page de contact à venir.',
    'news_title'       => 'Nouveauté',
    'news_coming_p1'   => 'Cette page sera bientôt disponible.',
    'news_coming_p2'   => "L'équipe PlanEx vous remercie de votre patience et de votre compréhension.",
    'footer_rights'    => '© :year PlanEx — Tous droits réservés',

    // Changement de mot de passe forcé
    'force_change_title'       => 'Changement de mot de passe requis',
    'force_change_subtitle'    => 'Pour des raisons de sécurité, vous devez définir un nouveau mot de passe avant de continuer.',
    'force_change_new_password'=> 'Nouveau mot de passe',
    'force_change_confirm'     => 'Confirmer le mot de passe',
    'force_change_btn'         => 'Valider et continuer',
    'password_changed_success' => 'Mot de passe mis à jour avec succès. Bienvenue !',
    'temp_password_expired'    => 'Votre mot de passe provisoire a expiré (48h dépassées). Veuillez contacter l\'administrateur pour en obtenir un nouveau.',

    // Courrier PDF
    'btn_courrier'             => 'Télécharger le courrier d\'identifiants (PDF)',
    'pdf_download'     => '📄 Télécharger PDF',

    // ── Zones & Chantier show
    'zone_add_section' => 'Ajouter une zone',
    'zone_existing' => 'Zones existantes',
    'zone_confirm_delete' => 'Supprimer la zone « :name » ?',
    'kpi_total' => 'Total anomalies',
    'kpi_open' => 'En cours / ouvertes',
    'kpi_closed' => 'Fermées',
    'kpi_closure_rate' => 'Taux de clôture',
    'chart_by_status' => 'Répartition par statut',
    'chantier_anomalies' => 'Anomalies du chantier',
    // ── Tarifs & Achat
    'nav_buy' => 'Acheter',
    'pricing_title' => 'Nos offres',
    'pricing_subtitle' => 'Choisissez le pack adapté à votre projet',
    'pricing_monthly' => 'Mensuel',
    'pricing_annual' => 'Annuel',
    'pricing_save' => 'Économisez 20%',
    'pricing_persons' => 'Nombre d\'utilisateurs',
    'pricing_support' => 'Support technique 24/7',
    'pricing_access' => 'Accès Tableau Anomalies',
    'pricing_contact_btn' => 'Nous contacter',
    'pricing_choose' => 'Choisir ce pack',
    'pricing_included' => 'Inclus',
    'pricing_not_access' => 'Vous n\'avez pas accès à cette fonctionnalité. Passez à un pack supérieur.',
    'pricing_upgrade' => 'Voir les offres',
    // ── Membres chantier
    'chantier_name_taken' => 'Ce nom de chantier est déjà attribué, veuillez en saisir un nouveau.',
    'chantier_members' => 'Membres du chantier',
    'chantier_add_member' => 'Ajouter un utilisateur',
    'chantier_user_added' => 'Utilisateur ajouté avec succès.',
    'chantier_user_updated' => 'Rôle modifié.',
    'chantier_user_removed' => 'Utilisateur retiré.',
    'chantier_user_already' => 'Cet utilisateur est déjà membre de ce chantier.',
    'chantier_creator_no_remove' => 'Le créateur ne peut pas être retiré du chantier.',
    'chantier_not_chef'          => 'Seul le chef de chantier peut effectuer cette action.',
    'chantier_role' => 'Rôle sur le chantier',
    'chantier_member_search' => 'Rechercher un utilisateur...',
    'col_member' => 'Membre',
    'col_role_chantier' => 'Rôle sur le chantier',
    'col_creator' => 'Créateur',
    // ── Suppression utilisateur
    'user_deleted'=>'Utilisateur supprimé et retiré de tous les chantiers.',
    'user_cannot_delete_self'=>'Vous ne pouvez pas supprimer votre propre compte.',
    'user_search_placeholder'=>'Rechercher par identifiant, e-mail ou rôle...',
    'user_none'=>'Aucun utilisateur trouvé.',

    // ── Entreprises liées aux disciplines
    'chantier_disciplines_title'=>'Entreprises liées aux disciplines',
    'chantier_discipline_add'=>'Ajouter une entreprise',
    'chantier_discipline_name'=>"Nom de l'entreprise",
    'chantier_discipline_added'=>'Entreprise ajoutée.',
    'chantier_discipline_removed'=>'Entreprise retirée.',
    'chantier_discipline_exists'=>'Cette entreprise est déjà liée à cette discipline.',
    'chantier_discipline_none'=>'Aucune entreprise liée pour le moment.',
    'chantier_discipline_required_member'=>"Ajoutez d'abord une entreprise pour pouvoir attribuer un membre.",
    'modal_add_chantier'=>'Ajouter un chantier',
    'modal_add_zone'=>'Ajouter une zone',
    'form_pick_chantier_first'=>"Choisissez d'abord un chantier",

    // ── Contact
    'contact_title'=>'Bienvenue sur la page de contact de PlanEx',
    'contact_intro'=>'Vous avez une question, un problème ou une suggestion ? Remplissez le formulaire ci-dessous. Notre équipe vous répondra par e-mail dans les plus brefs délais.',
    'contact_card_header'=>'Nouveau ticket de support',
    'contact_q1_label'=>'Votre demande concerne',
    'contact_select_cat'=>'-- Sélectionnez une catégorie --',
    'contact_opt_connexion'=>'Problème de connexion',
    'contact_opt_anomalies'=>'Anomalies / Incidents',
    'contact_opt_suggestion'=>'Suggestion',
    'contact_opt_abonnement'=>'Abonnement',
    'contact_opt_autre'=>'Autre',
    'contact_q2_label'=>'Précisez votre demande',
    'contact_select'=>'-- Sélectionnez --',
    'contact_message_label'=>'Décrivez votre problème',
    'contact_message_ph'=>'Expliquez votre demande en détail...',
    'contact_chars'=>'/ 2500 caractères',
    'contact_email_label'=>'Votre adresse e-mail',
    'contact_pdf_label'=>'Documents PDF',
    'contact_optional2'=>'(optionnel, max 2 fichiers)',
    'contact_pdf_formats'=>'Formats acceptés : PDF — 10 Mo max par fichier',
    'contact_img_label'=>'Photos / Images',
    'contact_optional10'=>'(optionnel, max 10 fichiers)',
    'contact_img_formats'=>'Formats acceptés : JPG, PNG, GIF, WEBP — 10 Mo max par fichier',
    'contact_submit'=>'Envoyer ma demande',
    'contact_modal_title'=>'Demande envoyée',
    'contact_modal_body'=>'Nous avons bien pris en compte votre demande. Nous vous recontacterons par e-mail dans les plus brefs délais.',
    'contact_modal_close'=>'Fermer',
    'contact_browse'=>'Choisir des fichiers',
    'contact_no_file'=>'Aucun fichier sélectionné',
    'contact_files_count'=>'fichier(s) sélectionné(s)',

    // ── SEO (meta descriptions)
    'meta_default'=>"PlanEx — plateforme de gestion et de suivi des anomalies de chantier : ingénierie, développement, mise en route, exploitation et support.",
    'seo_home_desc'=>"PlanEx, la plateforme pour suivre et gérer les anomalies de vos chantiers : ingénierie, développement, mise en route, exploitation et support.",
    'seo_infos_desc'=>"Informations sur PlanEx : découvrez la plateforme de suivi des anomalies de chantier.",
    'seo_news_desc'=>"Les nouveautés et mises à jour de la plateforme PlanEx.",
    'seo_pricing_desc'=>"Tarifs PlanEx : packs Bronze, Silver, Gold et Platinum pour la gestion des anomalies de chantier.",
    'seo_contact_desc'=>"Contactez l'équipe PlanEx : questions, problèmes techniques, suggestions et abonnements.",
    'contact_sq_conn_username'=>"Problème de nom d'utilisateur ?",
    'contact_sq_conn_password'=>'Problème de réinitialisation de mot de passe ?',
    'contact_sq_ano_add'=>"Problème lorsqu'on ajoute une anomalie",
    'contact_sq_ano_zone'=>"Problème lorsqu'on ajoute une zone",
    'contact_sq_ano_pdf'=>"Problème lorsqu'on veut créer un PDF",
    'contact_sq_ano_tab'=>"Problème lors de l'affichage de l'onglet « Tableau des Anomalies »",
    'contact_sq_sug_translation'=>'Ajouter une nouvelle traduction',
    'contact_sq_sug_info'=>'Ajouter certaines informations',
    'contact_sq_abo_regulate'=>'Je souhaiterais être contacté pour réguler mon abonnement',
    'contact_sq_abo_newoption'=>"Je souhaiterais avoir une nouvelle option d'abonnement",
    'contact_sq_abo_details'=>"Je souhaiterais prendre contact avec vous pour plus de détails sur l'abonnement",
    'contact_sq_autre_tabs'=>"Je n'arrive pas à accéder à mes onglets",
    'contact_sq_autre_other'=>'Mon problème ne figure dans aucune de ces réponses et je souhaiterais une autre aide',
];
