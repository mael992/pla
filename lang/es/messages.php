<?php

return [

    // ════════════════════════════════════════════════════════
    // NAVBAR
    // ════════════════════════════════════════════════════════
    'nav_home'          => 'Inicio',
    'nav_infos'         => 'Info',
    'nav_news'          => 'Novedades',
    'nav_contact'       => 'Contacto',
    'nav_dashboard'     => 'Registro de anomalías',
    'nav_manage_users'  => 'Gestión de usuarios',
    'nav_logout'        => 'Cerrar sesión',
    'nav_login'         => 'Iniciar sesión',
    'nav_chantiers'     => 'Obras',

    // Dropdown "Panel de anomalías"
    'nav_tableau_label'   => 'Panel de anomalías',
    'nav_tab_engineering' => 'Ingeniería',
    'nav_tab_development' => 'Desarrollo',
    'nav_tab_precom'      => 'Pre-puesta en marcha / Puesta en marcha',
    'nav_tab_operations'  => 'Explotación / Operaciones',
    'nav_tab_support'     => 'Servicios de soporte & servicios adicionales',

    // ════════════════════════════════════════════════════════
    // AUTENTICACIÓN
    // ════════════════════════════════════════════════════════
    'auth_username'        => 'Nombre de usuario',
    'auth_password'        => 'Contraseña',
    'auth_remember'        => 'Recuérdame',
    'auth_sign_in'         => 'Iniciar sesión',
    'auth_forgot_password' => '¿Olvidó su contraseña?',
    'auth_forgot_desc'     => '¿Olvidó su contraseña? Sin problema. Ingrese su dirección de correo electrónico y le enviaremos un enlace de restablecimiento.',
    'auth_send_reset_link' => 'Enviar enlace',

    // ════════════════════════════════════════════════════════
    // BOTONES & COMUNES
    // ════════════════════════════════════════════════════════
    'btn_back'           => '← Volver',
    'btn_save'           => 'Guardar',
    'btn_cancel'         => 'Cancelar',
    'btn_create'         => 'Crear',
    'btn_edit'           => 'Editar',
    'btn_delete'         => 'Eliminar',
    'btn_view'           => 'Ver',
    'btn_add'            => '➕ Agregar',
    'select_placeholder' => '— Seleccionar —',

    // ════════════════════════════════════════════════════════
    // HOME
    // ════════════════════════════════════════════════════════
    'home_welcome' => 'Bienvenido a PlanEx — siempre un paso adelante',

    // ════════════════════════════════════════════════════════
    // ANOMALÍAS
    // ════════════════════════════════════════════════════════
    'incidents_title'         => 'Anomalías',
    'incident_new'            => 'Nueva anomalía',
    'incident_add'            => '+ Agregar anomalía',
    'incident_edit_title'     => 'Editar anomalía #:id',
    'incident_confirm_delete' => '¿Eliminar esta anomalía?',
    'incident_none'           => 'No hay anomalías registradas.',
    'incident_create_btn'     => 'Crear anomalía',
    'incident_save_btn'       => 'Guardar',
    'incident_closed_warning' => 'Esta anomalía está <strong>cerrada</strong> y ya no puede modificarse.',
    'incident_issued_by'      => 'Emitido por',

    // Columnas tabla
    'col_id'           => 'Ref.',
    'col_issued_on'    => 'Emitido el',
    'col_photo_open'   => 'Foto ab.',
    'col_photo_closed' => 'Foto cer.',
    'col_closed_on'    => 'Cerrado el',
    'col_discipline'   => 'Disciplina',
    'col_status'       => 'Estado',
    'col_actions'      => 'Acciones',

    // Estados
    'status_na'          => '⬛ N/A',
    'status_open'        => '🟥 Abierto',
    'status_in_progress' => '🟧 En curso',
    'status_closed'      => '🟩 Cerrado',

    // Secciones ficha detalle
    'section_general_info' => 'Información general',
    'section_tracking'     => 'Seguimiento',
    'section_description'  => 'Descripción y observaciones',
    'section_qfc'          => 'QFC',
    'section_photos'       => 'Fotos',

    // Campos formulario
    'field_discipline'      => 'Disciplina',
    'field_system'          => 'Sistema',
    'field_work_lot'        => 'Lote de trabajo',
    'field_zone'            => 'Zona',
    'field_chantier'        => 'Obra',
    'field_label'           => 'Etiqueta',
    'field_category'        => 'Categoría',
    'field_internal'        => 'Interno',
    'field_responsibility'  => 'Responsabilidad',
    'field_status'          => 'Estado',
    'field_issued_on'       => 'Emitido el',
    'field_updated_on'      => 'Actualizado el',
    'field_closed_on'       => 'Cerrado el',
    'field_planned_closure' => 'Cierre previsto',
    'field_closure_date'    => 'Fecha de cierre',
    'field_qfc_open'        => 'Abierto n°',
    'field_qfc_closed'      => 'Cerrado n°',
    'field_qfc_open_form'   => 'QFC abierto n°',
    'field_qfc_closed_form' => 'QFC cerrado n°',
    'field_description'     => 'Descripción y observaciones',
    'field_photo_open'      => 'Foto abierta',
    'field_photo_closed'    => 'Foto cerrada',

    'photo_sets_issue_date'  => '(establece automáticamente la fecha de emisión)',
    'photo_sets_update_date' => '(establece automáticamente la fecha de actualización)',
    'photo_delete'           => '🗑 Eliminar foto',
    'photo_take'             => 'Tomar una foto',
    'photo_gallery'          => 'Elegir de la galería',

    'form_incident_closed' => 'Anomalía <strong>cerrada</strong> — solo el estado puede modificarse.',
    'form_manage_zones'    => 'Gestionar zonas',

    // ════════════════════════════════════════════════════════
    // SIDEBAR
    // ════════════════════════════════════════════════════════
    'sidebar_incidents'    => 'Anomalías',
    'sidebar_new_incident' => 'Nueva anomalía',
    'sidebar_manage_zones' => 'Gestionar zonas',
    'sidebar_add_incident' => 'Agregar anomalía',

    // ════════════════════════════════════════════════════════
    // BÚSQUEDA
    // ════════════════════════════════════════════════════════
    'search_placeholder' => 'Buscar por obra o localidad...',
    'search_label'       => 'Búsqueda',
    'search_active'      => 'Filtro activo:',
    'search_clear'       => 'Borrar',

    // ════════════════════════════════════════════════════════
    // ZONAS
    // ════════════════════════════════════════════════════════
    'zones_title' => 'Gestión de zonas',
    'zone_new'    => 'Nueva zona',
    'zone_name'   => 'Nombre de zona',
    'zone_none'   => 'No hay zonas registradas.',

    // ════════════════════════════════════════════════════════
    // USUARIOS
    // ════════════════════════════════════════════════════════
    'users_title'            => 'Gestión de usuarios',
    'user_add'               => '➕ Agregar',
    'user_add_title'         => '➕ Agregar usuario',
    'user_edit_title'        => '✏️ Editar usuario',
    'col_username'           => 'Usuario',
    'col_email'              => 'Correo electrónico',
    'col_role'               => 'Rol',
    'user_email_hint'        => 'Correo electrónico (para restablecer contraseña)',
    'user_password'          => 'Contraseña',
    'user_password_optional' => 'Contraseña (dejar vacío para no cambiar)',
    'user_role'              => 'Rol',
    'user_save'              => '💾 Guardar',
    'user_create'            => '💾 Crear',

    // ════════════════════════════════════════════════════════
    // OBRAS (chantiers)
    // ════════════════════════════════════════════════════════
    'chantiers_title'      => 'Gestión de obras',
    'chantier_new'         => '➕ Nueva obra',
    'chantier_add_title'   => '➕ Agregar obra',
    'chantier_edit_title'  => '✏️ Editar obra',
    'chantier_created'     => 'Obra creada con éxito.',
    'chantier_updated'     => 'Obra modificada con éxito.',
    'chantier_deleted'     => 'Obra eliminada.',
    'chantier_none'        => 'No hay obras registradas.',
    'col_chantier'         => 'Obra',
    'col_localite'         => 'Localidad',
    'col_incidents_count'  => 'Anomalías',
    'field_nom'            => 'Nombre',
    'field_localite'       => 'Localidad',

    // ════════════════════════════════════════════════════════
    // PÁGINAS PÚBLICAS & VARIOS
    // ════════════════════════════════════════════════════════
    'home_title'       => 'Bienvenido a PlanEx — siempre un paso adelante',
    'infos_title'      => 'Información',
    'infos_p1'         => 'PlanEx llega pronto 🚀',
    'infos_p2'         => 'Nuestra plataforma está actualmente en proceso de finalización para ofrecerle la mejor experiencia posible.',
    'infos_p3'         => 'Gracias por su paciencia — el lanzamiento oficial se acerca. La fecha de lanzamiento se anunciará muy pronto.',
    'infos_p4'         => 'El equipo de PlanEx les agradece su paciencia y comprensión.',
    'contact_title'    => 'Contacto',
    'contact_coming'   => 'Página de contacto próximamente.',
    'news_title'       => 'Novedades',
    'news_coming_p1'   => 'Esta página estará disponible pronto.',
    'news_coming_p2'   => 'El equipo de PlanEx les agradece su paciencia y comprensión.',
    'footer_rights'    => '© :year PlanEx — Todos los derechos reservados',

    // Cambio de contraseña obligatorio
    'force_change_title'       => 'Cambio de contraseña requerido',
    'force_change_subtitle'    => 'Por razones de seguridad, debe establecer una nueva contraseña antes de continuar.',
    'force_change_new_password'=> 'Nueva contraseña',
    'force_change_confirm'     => 'Confirmar contraseña',
    'force_change_btn'         => 'Guardar y continuar',
    'password_changed_success' => '¡Contraseña actualizada con éxito. ¡Bienvenido!',

    // PDF de credenciales
    'btn_courrier'             => 'Descargar carta de credenciales (PDF)',
    'pdf_download'     => '📄 Descargar PDF',

    // ── Zones & Chantier show
    'zone_add_section' => 'Agregar una zona',
    'zone_existing' => 'Zonas existentes',
    'zone_confirm_delete' => '¿Eliminar la zona \":name\"?',
    'kpi_total' => 'Total anomalías',
    'kpi_open' => 'En curso / abiertas',
    'kpi_closed' => 'Cerradas',
    'kpi_closure_rate' => 'Tasa de cierre',
    'chart_by_status' => 'Distribución por estado',
    'chantier_anomalies' => 'Anomalías de la obra',
    // ── Tarifs & Achat
    'nav_buy' => 'Comprar',
    'pricing_title' => 'Nuestros planes',
    'pricing_subtitle' => 'Elija el plan adecuado para su proyecto',
    'pricing_monthly' => 'Mensual',
    'pricing_annual' => 'Anual',
    'pricing_save' => 'Ahorre un 20%',
    'pricing_persons' => 'Número de usuarios',
    'pricing_support' => 'Soporte técnico 24/7',
    'pricing_access' => 'Acceso Panel de Anomalías',
    'pricing_contact_btn' => 'Contáctenos',
    'pricing_choose' => 'Elegir este plan',
    'pricing_included' => 'Incluido',
    'pricing_not_access' => 'No tiene acceso a esta función. Actualice a un plan superior.',
    'pricing_upgrade' => 'Ver planes',
    // ── Membres chantier
    'chantier_name_taken' => 'Este nombre de obra ya está asignado, por favor elija uno nuevo.',
    'chantier_members' => 'Miembros de la obra',
    'chantier_add_member' => 'Agregar usuario',
    'chantier_user_added' => 'Usuario agregado con éxito.',
    'chantier_user_updated' => 'Rol actualizado.',
    'chantier_user_removed' => 'Usuario eliminado.',
    'chantier_user_already' => 'Este usuario ya es miembro de esta obra.',
    'chantier_creator_no_remove' => 'El creador no puede ser retirado de la obra.',
    'chantier_role' => 'Rol en la obra',
    'chantier_member_search' => 'Buscar usuario...',
    'col_member' => 'Miembro',
    'col_role_chantier' => 'Rol en la obra',
    'col_creator' => 'Creador',
    // ── Suppression utilisateur
    'user_deleted'=>'Usuario eliminado y retirado de todas las obras.',
    'user_cannot_delete_self'=>'No puede eliminar su propia cuenta.',
    'user_search_placeholder'=>'Buscar por usuario, correo o rol...',
    'user_none'=>'Ningún usuario encontrado.',

    // ── Empresas vinculadas a las disciplinas
    'chantier_disciplines_title'=>'Empresas vinculadas a las disciplinas',
    'chantier_discipline_add'=>'Añadir una empresa',
    'chantier_discipline_name'=>'Nombre de la empresa',
    'chantier_discipline_added'=>'Empresa añadida.',
    'chantier_discipline_removed'=>'Empresa eliminada.',
    'chantier_discipline_exists'=>'Esta empresa ya está vinculada a esta disciplina.',
    'chantier_discipline_none'=>'Ninguna empresa vinculada por ahora.',
    'chantier_discipline_required_member'=>'Añada primero una empresa para poder asignar un miembro.',
    'modal_add_chantier'=>'Añadir una obra',
    'modal_add_zone'=>'Añadir una zona',
    'form_pick_chantier_first'=>'Elija primero una obra',

    // ── Contact
    'contact_title'=>'Bienvenido a la página de contacto de PlanEx',
    'contact_intro'=>'¿Tiene una pregunta, un problema o una sugerencia? Rellene el formulario a continuación. Nuestro equipo le responderá por correo electrónico lo antes posible.',
    'contact_card_header'=>'Nuevo ticket de soporte',
    'contact_q1_label'=>'Su solicitud se refiere a',
    'contact_select_cat'=>'-- Seleccione una categoría --',
    'contact_opt_connexion'=>'Problema de conexión',
    'contact_opt_anomalies'=>'Anomalías / Incidentes',
    'contact_opt_suggestion'=>'Sugerencia',
    'contact_opt_abonnement'=>'Suscripción',
    'contact_opt_autre'=>'Otro',
    'contact_q2_label'=>'Especifique su solicitud',
    'contact_select'=>'-- Seleccione --',
    'contact_message_label'=>'Describa su problema',
    'contact_message_ph'=>'Explique su solicitud en detalle...',
    'contact_chars'=>'/ 2500 caracteres',
    'contact_email_label'=>'Su dirección de correo electrónico',
    'contact_pdf_label'=>'Documentos PDF',
    'contact_optional2'=>'(opcional, máx. 2 archivos)',
    'contact_pdf_formats'=>'Formatos aceptados: PDF — 10 MB máx. por archivo',
    'contact_img_label'=>'Fotos / Imágenes',
    'contact_optional10'=>'(opcional, máx. 10 archivos)',
    'contact_img_formats'=>'Formatos aceptados: JPG, PNG, GIF, WEBP — 10 MB máx. por archivo',
    'contact_submit'=>'Enviar mi solicitud',
    'contact_modal_title'=>'Solicitud enviada',
    'contact_modal_body'=>'Hemos recibido su solicitud. Nos pondremos en contacto con usted por correo electrónico lo antes posible.',
    'contact_modal_close'=>'Cerrar',
    'contact_browse'=>'Elegir archivos',
    'contact_no_file'=>'Ningún archivo seleccionado',
    'contact_files_count'=>'archivo(s) seleccionado(s)',

    // ── SEO (meta descriptions)
    'meta_default'=>'PlanEx — plataforma para gestionar y supervisar las anomalías de obra: ingeniería, desarrollo, puesta en marcha, explotación y soporte.',
    'seo_home_desc'=>'PlanEx, la plataforma para supervisar y gestionar las anomalías de sus obras: ingeniería, desarrollo, puesta en marcha, explotación y soporte.',
    'seo_infos_desc'=>'Acerca de PlanEx: descubra la plataforma de seguimiento de anomalías de obra.',
    'seo_news_desc'=>'Novedades y actualizaciones de la plataforma PlanEx.',
    'seo_pricing_desc'=>'Precios de PlanEx: packs Bronze, Silver, Gold y Platinum para la gestión de anomalías de obra.',
    'seo_contact_desc'=>'Contacte con el equipo de PlanEx: preguntas, problemas técnicos, sugerencias y suscripciones.',
    'contact_sq_conn_username'=>'¿Problema con el nombre de usuario?',
    'contact_sq_conn_password'=>'¿Problema al restablecer la contraseña?',
    'contact_sq_ano_add'=>'Problema al añadir una anomalía',
    'contact_sq_ano_zone'=>'Problema al añadir una zona',
    'contact_sq_ano_pdf'=>'Problema al crear un PDF',
    'contact_sq_ano_tab'=>'Problema al mostrar la pestaña "Tabla de Anomalías"',
    'contact_sq_sug_translation'=>'Añadir una nueva traducción',
    'contact_sq_sug_info'=>'Añadir cierta información',
    'contact_sq_abo_regulate'=>'Me gustaría que me contactaran para ajustar mi suscripción',
    'contact_sq_abo_newoption'=>'Me gustaría tener una nueva opción de suscripción',
    'contact_sq_abo_details'=>'Me gustaría ponerme en contacto con ustedes para más detalles sobre la suscripción',
    'contact_sq_autre_tabs'=>'No puedo acceder a mis pestañas',
    'contact_sq_autre_other'=>'Mi problema no figura en ninguna de estas respuestas y me gustaría otra ayuda',
];
