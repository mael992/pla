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
    'footer_rights'    => '© :year PlanEx — Todos los derechos reservados',
    'pdf_download'     => '📄 Descargar PDF',

];
