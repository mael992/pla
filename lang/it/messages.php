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
    'photo_take'             => 'Scatta una foto',
    'photo_gallery'          => 'Scegli dalla galleria',

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
    'news_title'       => 'Novità',
    'news_coming_p1'   => 'Questa pagina sarà presto disponibile.',
    'news_coming_p2'   => 'Il team PlanEx vi ringrazia per la vostra pazienza e comprensione.',
    'footer_rights'    => '© :year PlanEx — Tutti i diritti riservati',

    // Cambio password obbligatorio
    'force_change_title'       => 'Cambio password richiesto',
    'force_change_subtitle'    => 'Per motivi di sicurezza, devi impostare una nuova password prima di continuare.',
    'force_change_new_password'=> 'Nuova password',
    'force_change_confirm'     => 'Conferma password',
    'force_change_btn'         => 'Salva e continua',
    'password_changed_success' => 'Password aggiornata con successo. Benvenuto!',

    // PDF credenziali
    'btn_courrier'             => 'Scarica lettera credenziali (PDF)',
    'pdf_download'     => '📄 Scarica PDF',

    // ── Zones & Chantier show
    'zone_add_section' => 'Aggiungi una zona',
    'zone_existing' => 'Zone esistenti',
    'zone_confirm_delete' => 'Eliminare la zona \":name\"?',
    'kpi_total' => 'Totale anomalie',
    'kpi_open' => 'In corso / aperte',
    'kpi_closed' => 'Chiuse',
    'kpi_closure_rate' => 'Tasso di chiusura',
    'chart_by_status' => 'Ripartizione per stato',
    'chantier_anomalies' => 'Anomalie del cantiere',
    // ── Tarifs & Achat
    'nav_buy' => 'Acquista',
    'pricing_title' => 'I nostri piani',
    'pricing_subtitle' => 'Scegli il piano adatto al tuo progetto',
    'pricing_monthly' => 'Mensile',
    'pricing_annual' => 'Annuale',
    'pricing_save' => 'Risparmia il 20%',
    'pricing_persons' => 'Numero di utenti',
    'pricing_support' => 'Supporto tecnico 24/7',
    'pricing_access' => 'Accesso Pannello Anomalie',
    'pricing_contact_btn' => 'Contattaci',
    'pricing_choose' => 'Scegli questo piano',
    'pricing_included' => 'Incluso',
    'pricing_not_access' => 'Non hai accesso a questa funzionalità. Passa a un piano superiore.',
    'pricing_upgrade' => 'Vedi piani',
    // ── Membres chantier
    'chantier_name_taken' => 'Questo nome cantiere è già utilizzato, sceglierne uno nuovo.',
    'chantier_members' => 'Membri del cantiere',
    'chantier_add_member' => 'Aggiungi utente',
    'chantier_user_added' => 'Utente aggiunto con successo.',
    'chantier_user_updated' => 'Ruolo aggiornato.',
    'chantier_user_removed' => 'Utente rimosso.',
    'chantier_user_already' => 'Questo utente è già membro del cantiere.',
    'chantier_creator_no_remove' => 'Il creatore non può essere rimosso dal cantiere.',
    'chantier_role' => 'Ruolo nel cantiere',
    'chantier_member_search' => 'Cerca utente...',
    'col_member' => 'Membro',
    'col_role_chantier' => 'Ruolo nel cantiere',
    'col_creator' => 'Creatore',
    // ── Suppression utilisateur
    'user_deleted'=>'Utente eliminato e rimosso da tutti i cantieri.',
    'user_cannot_delete_self'=>'Non puoi eliminare il tuo account.',
    'user_search_placeholder'=>'Cerca per nome utente, email o ruolo...',
    'user_none'=>'Nessun utente trovato.',

    // ── Aziende collegate alle discipline
    'chantier_disciplines_title'=>'Aziende collegate alle discipline',
    'chantier_discipline_add'=>"Aggiungi un'azienda",
    'chantier_discipline_name'=>"Nome dell'azienda",
    'chantier_discipline_added'=>'Azienda aggiunta.',
    'chantier_discipline_removed'=>'Azienda rimossa.',
    'chantier_discipline_exists'=>'Questa azienda è già collegata a questa disciplina.',
    'chantier_discipline_none'=>'Nessuna azienda collegata per ora.',
    'chantier_discipline_required_member'=>"Aggiungi prima un'azienda per poter assegnare un membro.",
    'modal_add_chantier'=>'Aggiungi un cantiere',
    'modal_add_zone'=>'Aggiungi una zona',
    'form_pick_chantier_first'=>'Scegli prima un cantiere',

    // ── Contact
    'contact_title'=>'Benvenuto nella pagina dei contatti di PlanEx',
    'contact_intro'=>'Hai una domanda, un problema o un suggerimento? Compila il modulo qui sotto. Il nostro team ti risponderà via e-mail il prima possibile.',
    'contact_card_header'=>'Nuovo ticket di assistenza',
    'contact_q1_label'=>'La tua richiesta riguarda',
    'contact_select_cat'=>'-- Seleziona una categoria --',
    'contact_opt_connexion'=>'Problema di accesso',
    'contact_opt_anomalies'=>'Anomalie / Incidenti',
    'contact_opt_suggestion'=>'Suggerimento',
    'contact_opt_abonnement'=>'Abbonamento',
    'contact_opt_autre'=>'Altro',
    'contact_q2_label'=>'Specifica la tua richiesta',
    'contact_select'=>'-- Seleziona --',
    'contact_message_label'=>'Descrivi il tuo problema',
    'contact_message_ph'=>'Spiega la tua richiesta in dettaglio...',
    'contact_chars'=>'/ 2500 caratteri',
    'contact_email_label'=>'Il tuo indirizzo e-mail',
    'contact_pdf_label'=>'Documenti PDF',
    'contact_optional2'=>'(opzionale, max 2 file)',
    'contact_pdf_formats'=>'Formati accettati: PDF — 10 MB max per file',
    'contact_img_label'=>'Foto / Immagini',
    'contact_optional10'=>'(opzionale, max 10 file)',
    'contact_img_formats'=>'Formati accettati: JPG, PNG, GIF, WEBP — 10 MB max per file',
    'contact_submit'=>'Invia la mia richiesta',
    'contact_modal_title'=>'Richiesta inviata',
    'contact_modal_body'=>'Abbiamo ricevuto la tua richiesta. Ti ricontatteremo via e-mail il prima possibile.',
    'contact_modal_close'=>'Chiudi',
    'contact_browse'=>'Scegli file',
    'contact_no_file'=>'Nessun file selezionato',
    'contact_files_count'=>'file selezionati',

    // ── SEO (meta descriptions)
    'meta_default'=>'PlanEx — piattaforma per gestire e monitorare le anomalie di cantiere: ingegneria, sviluppo, messa in servizio, esercizio e supporto.',
    'seo_home_desc'=>'PlanEx, la piattaforma per monitorare e gestire le anomalie dei tuoi cantieri: ingegneria, sviluppo, messa in servizio, esercizio e supporto.',
    'seo_infos_desc'=>'Informazioni su PlanEx: scopri la piattaforma di monitoraggio delle anomalie di cantiere.',
    'seo_news_desc'=>'Novità e aggiornamenti della piattaforma PlanEx.',
    'seo_pricing_desc'=>'Prezzi PlanEx: pacchetti Bronze, Silver, Gold e Platinum per la gestione delle anomalie di cantiere.',
    'seo_contact_desc'=>'Contatta il team PlanEx: domande, problemi tecnici, suggerimenti e abbonamenti.',
    'contact_sq_conn_username'=>'Problema con il nome utente?',
    'contact_sq_conn_password'=>'Problema di reimpostazione della password?',
    'contact_sq_ano_add'=>"Problema durante l'aggiunta di un'anomalia",
    'contact_sq_ano_zone'=>"Problema durante l'aggiunta di una zona",
    'contact_sq_ano_pdf'=>'Problema durante la creazione di un PDF',
    'contact_sq_ano_tab'=>'Problema nella visualizzazione della scheda "Tabella delle Anomalie"',
    'contact_sq_sug_translation'=>'Aggiungere una nuova traduzione',
    'contact_sq_sug_info'=>'Aggiungere alcune informazioni',
    'contact_sq_abo_regulate'=>'Vorrei essere contattato per regolare il mio abbonamento',
    'contact_sq_abo_newoption'=>'Vorrei una nuova opzione di abbonamento',
    'contact_sq_abo_details'=>"Vorrei contattarvi per maggiori dettagli sull'abbonamento",
    'contact_sq_autre_tabs'=>'Non riesco ad accedere alle mie schede',
    'contact_sq_autre_other'=>'Il mio problema non è elencato in nessuna di queste risposte e vorrei un altro tipo di aiuto',
];
