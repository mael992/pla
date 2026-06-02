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
    'footer_rights'    => '© :year PlanEx — Tous droits réservés',
    'pdf_download'     => '📄 Télécharger PDF',

];
