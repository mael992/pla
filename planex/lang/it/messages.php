<?php

return [

    // ════════════════════════════════════════════════════════
    // NAVBAR
    // ════════════════════════════════════════════════════════
    'nav_home'          => 'Home',
    'nav_infos'         => 'Info',
    'nav_news'          => 'Novità',
    'nav_contact'       => 'Contatti',
    'nav_dashboard'     => 'Registro anomalie',
    'nav_manage_users'  => 'Gestione utenti',
    'nav_logout'        => 'Disconnetti',
    'nav_login'         => 'Accedi',
    'nav_chantiers'     => 'Cantieri',

    // Dropdown "Pannello anomalie"
    'nav_tableau_label'   => 'Pannello anomalie',
    'nav_tab_engineering' => 'Ingegneria',
    'nav_tab_development' => 'Sviluppo',
    'nav_tab_precom'      => 'Pre-commissioning / Commissioning',
    'nav_tab_operations'  => 'Sfruttamento / Operazioni',
    'nav_tab_support'     => 'Servizi di supporto & servizi aggiuntivi',

    // ════════════════════════════════════════════════════════
    // AUTENTICAZIONE
    // ════════════════════════════════════════════════════════
    'auth_username'        => 'Nome utente',
    'auth_password'        => 'Password',
    'auth_remember'        => 'Ricordami',
    'auth_sign_in'         => 'Accedi',
    'auth_forgot_password' => 'Password dimenticata?',
    'auth_forgot_desc'     => 'Password dimenticata? Nessun problema. Inserisci il tuo indirizzo e-mail e ti invieremo un link di reimpostazione.',
    'auth_send_reset_link' => 'Invia link di reset',

    // ════════════════════════════════════════════════════════
    // PULSANTI & COMUNI
    // ════════════════════════════════════════════════════════
    'btn_back'           => '← Indietro',
    'btn_save'           => 'Salva',
    'btn_cancel'         => 'Annulla',
    'btn_create'         => 'Crea',
    'btn_edit'           => 'Modifica',
    'btn_delete'         => 'Elimina',
    'btn_view'           => 'Visualizza',
    'btn_add'            => '➕ Aggiungi',
    'select_placeholder' => '— Selezionare —',

    // ════════════════════════════════════════════════════════
    // HOME
    // ════════════════════════════════════════════════════════
    'home_welcome' => 'Benvenuto su PlanEx — sempre un passo avanti',

    // ════════════════════════════════════════════════════════
    // ANOMALIE
    // ════════════════════════════════════════════════════════
    'incidents_title'         => 'Anomalie',
    'incident_new'            => 'Nuova anomalia',
    'incident_add'            => '+ Aggiungi anomalia',
    'incident_edit_title'     => 'Modifica anomalia #:id',
    'incident_confirm_delete' => 'Eliminare questa anomalia?',
    'incident_none'           => 'Nessuna anomalia registrata.',
    'incident_create_btn'     => 'Crea anomalia',
    'incident_save_btn'       => 'Salva',
    'incident_closed_warning' => 'Questa anomalia è <strong>chiusa</strong> e non può più essere modificata.',
    'incident_issued_by'      => 'Emesso da',

    // Colonne tabella
    'col_id'           => 'Rif.',
    'col_issued_on'    => 'Emesso il',
    'col_photo_open'   => 'Foto aperta',
    'col_photo_closed' => 'Foto chiusa',
    'col_closed_on'    => 'Chiuso il',
    'col_discipline'   => 'Disciplina',
    'col_status'       => 'Stato',
    'col_actions'      => 'Azioni',

    // Stati
    'status_na'          => '⬛ N/A',
    'status_open'        => '🟥 Aperto',
    'status_in_progress' => '🟧 In corso',
    'status_closed'      => '🟩 Chiuso',

    // Sezioni scheda
    'section_general_info' => 'Informazioni generali',
    'section_tracking'     => 'Monitoraggio',
    'section_description'  => 'Descrizione e note',
    'section_qfc'          => 'QFC',
    'section_photos'       => 'Foto',

    // Campi modulo
    'field_discipline'      => 'Disciplina',
    'field_system'          => 'Sistema',
    'field_work_lot'        => 'Lotto di lavoro',
    'field_zone'            => 'Zona',
    'field_chantier'        => 'Cantiere',
    'field_label'           => 'Etichetta',
    'field_category'        => 'Categoria',
    'field_internal'        => 'Interno',
    'field_responsibility'  => 'Responsabilità',
    'field_status'          => 'Stato',
    'field_issued_on'       => 'Emesso il',
    'field_updated_on'      => 'Aggiornato il',
    'field_closed_on'       => 'Chiuso il',
    'field_planned_closure' => 'Chiusura prevista',
    'field_closure_date'    => 'Data di chiusura',
    'field_qfc_open'        => 'Aperto n°',
    'field_qfc_closed'      => 'Chiuso n°',
    'field_qfc_open_form'   => 'QFC aperto n°',
    'field_qfc_closed_form' => 'QFC chiuso n°',
    'field_description'     => 'Descrizione e note',
    'field_photo_open'      => 'Foto aperta',
    'field_photo_closed'    => 'Foto chiusa',

    'photo_sets_issue_date'  => '(imposta automaticamente la data di emissione)',
    'photo_sets_update_date' => '(imposta automaticamente la data di aggiornamento)',
    'photo_delete'           => '🗑 Rimuovi foto',

    'form_incident_closed' => 'Anomalia <strong>chiusa</strong> — solo lo stato può essere modificato.',
    'form_manage_zones'    => 'Gestisci zone',

    // ════════════════════════════════════════════════════════
    // SIDEBAR
    // ════════════════════════════════════════════════════════
    'sidebar_incidents'    => 'Anomalie',
    'sidebar_new_incident' => 'Nuova anomalia',
    'sidebar_manage_zones' => 'Gestisci zone',
    'sidebar_add_incident' => 'Aggiungi anomalia',

    // ════════════════════════════════════════════════════════
    // RICERCA
    // ════════════════════════════════════════════════════════
    'search_placeholder' => 'Cerca per cantiere o località...',
    'search_label'       => 'Ricerca',
    'search_active'      => 'Filtro attivo:',
    'search_clear'       => 'Cancella',

    // ════════════════════════════════════════════════════════
    // ZONE
    // ════════════════════════════════════════════════════════
    'zones_title' => 'Gestione zone',
    'zone_new'    => 'Nuova zona',
    'zone_name'   => 'Nome zona',
    'zone_none'   => 'Nessuna zona registrata.',

    // ════════════════════════════════════════════════════════
    // UTENTI
    // ════════════════════════════════════════════════════════
    'users_title'            => 'Gestione utenti',
    'user_add'               => '➕ Aggiungi',
    'user_add_title'         => '➕ Aggiungi utente',
    'user_edit_title'        => '✏️ Modifica utente',
    'col_username'           => 'Nome utente',
    'col_email'              => 'E-mail',
    'col_role'               => 'Ruolo',
    'user_email_hint'        => 'E-mail (per il reset della password)',
    'user_password'          => 'Password',
    'user_password_optional' => 'Password (lasciare vuoto per non modificare)',
    'user_role'              => 'Ruolo',
    'user_save'              => '💾 Salva',
    'user_create'            => '💾 Crea',

    // ════════════════════════════════════════════════════════
    // CANTIERI
    // ════════════════════════════════════════════════════════
    'chantiers_title'      => 'Gestione cantieri',
    'chantier_new'         => '➕ Nuovo cantiere',
    'chantier_add_title'   => '➕ Aggiungi cantiere',
    'chantier_edit_title'  => '✏️ Modifica cantiere',
    'chantier_created'     => 'Cantiere creato con successo.',
    'chantier_updated'     => 'Cantiere modificato con successo.',
    'chantier_deleted'     => 'Cantiere eliminato.',
    'chantier_none'        => 'Nessun cantiere registrato.',
    'col_chantier'         => 'Cantiere',
    'col_localite'         => 'Località',
    'col_incidents_count'  => 'Anomalie',
    'field_nom'            => 'Nome',
    'field_localite'       => 'Località',

    // ════════════════════════════════════════════════════════
    // PAGINE PUBBLICHE & VARIE
    // ════════════════════════════════════════════════════════
    'home_title'       => 'Benvenuto su PlanEx — sempre un passo avanti',
    'infos_title'      => 'Informazioni',
    'infos_p1'         => 'PlanEx arriverà presto 🚀',
    'infos_p2'         => 'La nostra piattaforma è attualmente in fase di finalizzazione per offrirvi la migliore esperienza possibile.',
    'infos_p3'         => 'Grazie per la vostra pazienza — il lancio ufficiale si avvicina. La data di lancio sarà annunciata molto presto.',
    'infos_p4'         => 'Il team PlanEx vi ringrazia per la pazienza e la comprensione.',
    'contact_title'    => 'Contatti',
    'contact_coming'   => 'Pagina contatti in arrivo.',
    'footer_rights'    => '© :year PlanEx — Tutti i diritti riservati',
    'pdf_download'     => '📄 Scarica PDF',

];
