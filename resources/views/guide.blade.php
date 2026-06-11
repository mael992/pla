@extends('layouts.app')

@section('title', __('messages.guide_title') . ' — PlanEx')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.31.0/dist/tabler-icons.min.css">
<style>
#guidePage {
    --color-text-primary:#1e293b; --color-text-secondary:#64748b; --color-text-info:#2563eb;
    --color-border-tertiary:#e2e8f0; --color-border-secondary:#cbd5e1; --color-border-info:#93c5fd;
    --color-background-primary:#fff; --color-background-secondary:#f1f5f9; --color-background-tertiary:#e2e8f0;
    --color-background-info:#eff6ff; --border-radius-lg:12px; --border-radius-md:8px;
    --font-mono:ui-monospace,SFMono-Regular,Menlo,monospace;
    max-width: 880px; margin: 0 auto; padding: 1.5rem 1rem 3rem;
}
#guidePage .guide-header { display:flex; align-items:center; gap:10px; margin-bottom:1.25rem; padding-bottom:1rem; border-bottom:1px solid var(--color-border-tertiary); }
#guidePage .guide-header h1 { font-size:24px; font-weight:700; color:var(--color-text-primary); }
#guidePage .guide-header p { font-size:13px; color:var(--color-text-secondary); margin-top:2px; }
#guidePage .toc { background:var(--color-background-secondary); border-radius:var(--border-radius-lg); padding:1rem 1.25rem; margin-bottom:1.5rem; position:sticky; top:8px; z-index:5; }
#guidePage .toc-title { font-size:12px; font-weight:600; color:var(--color-text-secondary); text-transform:uppercase; letter-spacing:0.05em; margin-bottom:10px; }
#guidePage .toc-list { display:flex; flex-wrap:wrap; gap:6px; }
#guidePage .toc-btn { background:var(--color-background-primary); border:1px solid var(--color-border-tertiary); border-radius:var(--border-radius-md); padding:5px 12px; font-size:13px; color:var(--color-text-secondary); cursor:pointer; transition:border-color .15s,color .15s; }
#guidePage .toc-btn:hover { border-color:var(--color-border-info); color:var(--color-text-info); }
#guidePage .toc-btn.active { border-color:var(--color-border-info); color:var(--color-text-info); background:var(--color-background-info); }
#guidePage .section { margin-bottom:2rem; scroll-margin-top:90px; }
#guidePage .section-title { font-size:17px; font-weight:600; color:var(--color-text-primary); margin-bottom:1rem; display:flex; align-items:center; gap:8px; }
#guidePage .section-title i { font-size:20px; color:var(--color-text-info); }
#guidePage .step-list { display:flex; flex-direction:column; gap:10px; }
#guidePage .step { display:flex; gap:12px; align-items:flex-start; background:var(--color-background-primary); border:1px solid var(--color-border-tertiary); border-radius:var(--border-radius-lg); padding:12px 14px; }
#guidePage .step-num { width:24px; height:24px; border-radius:50%; background:var(--color-background-info); color:var(--color-text-info); font-size:12px; font-weight:600; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:1px; }
#guidePage .step-body { flex:1; }
#guidePage .step-label { font-size:14px; font-weight:600; color:var(--color-text-primary); margin-bottom:3px; }
#guidePage .step-desc { font-size:13px; color:var(--color-text-secondary); line-height:1.55; }
#guidePage .step-desc code, #guidePage .field-desc code { background:var(--color-background-tertiary); border-radius:4px; padding:1px 5px; font-family:var(--font-mono); font-size:12px; color:var(--color-text-primary); }
#guidePage .field-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(240px,1fr)); gap:8px; }
#guidePage .field-card { background:var(--color-background-primary); border:1px solid var(--color-border-tertiary); border-radius:var(--border-radius-md); padding:10px 14px; }
#guidePage .field-name { font-size:13px; font-weight:600; color:var(--color-text-primary); margin-bottom:2px; display:flex; align-items:center; gap:6px; flex-wrap:wrap; }
#guidePage .field-desc { font-size:12px; color:var(--color-text-secondary); line-height:1.5; }
#guidePage .badge { font-size:10px; padding:2px 7px; border-radius:10px; font-weight:600; }
#guidePage .badge-req { background:#FAECE7; color:#993C1D; }
#guidePage .badge-opt { background:var(--color-background-secondary); color:var(--color-text-secondary); }
#guidePage .badge-auto { background:#EAF3DE; color:#3B6D11; }
#guidePage .status-list { display:flex; flex-direction:column; gap:8px; }
#guidePage .status-row { display:flex; align-items:flex-start; gap:12px; padding:10px 14px; border:1px solid var(--color-border-tertiary); border-radius:var(--border-radius-md); background:var(--color-background-primary); }
#guidePage .status-dot { width:10px; height:10px; border-radius:50%; flex-shrink:0; margin-top:4px; }
#guidePage .status-name { font-size:13px; font-weight:600; color:var(--color-text-primary); }
#guidePage .status-desc { font-size:12px; color:var(--color-text-secondary); margin-top:2px; line-height:1.45; }
#guidePage .tip-box { background:var(--color-background-info); border:1px solid var(--color-border-info); border-radius:var(--border-radius-md); padding:10px 14px; display:flex; gap:10px; align-items:flex-start; margin-top:10px; }
#guidePage .tip-box i { font-size:16px; color:var(--color-text-info); flex-shrink:0; margin-top:1px; }
#guidePage .tip-box p { font-size:13px; color:var(--color-text-info); line-height:1.5; }
#guidePage .warn-box { background:#FAEEDA; border:1px solid #EF9F27; border-radius:var(--border-radius-md); padding:10px 14px; display:flex; gap:10px; align-items:flex-start; margin-top:10px; }
#guidePage .warn-box i { font-size:16px; color:#854F0B; flex-shrink:0; margin-top:1px; }
#guidePage .warn-box p { font-size:13px; color:#854F0B; line-height:1.5; }
#guidePage .divider { height:1px; background:var(--color-border-tertiary); margin:1.5rem 0; }
#guidePage .photo-flow { display:flex; flex-direction:column; gap:8px; }
#guidePage .photo-row { display:flex; gap:10px; align-items:center; padding:10px 14px; border:1px solid var(--color-border-tertiary); border-radius:var(--border-radius-md); background:var(--color-background-primary); }
#guidePage .photo-icon { width:36px; height:36px; border-radius:var(--border-radius-md); display:flex; align-items:center; justify-content:center; flex-shrink:0; }
#guidePage .photo-icon.open { background:#E6F1FB; } #guidePage .photo-icon.close { background:#EAF3DE; }
#guidePage .photo-icon i { font-size:18px; } #guidePage .photo-icon.open i { color:#185FA5; } #guidePage .photo-icon.close i { color:#3B6D11; }
#guidePage .photo-info { flex:1; }
#guidePage .photo-label { font-size:13px; font-weight:600; color:var(--color-text-primary); }
#guidePage .photo-sub { font-size:12px; color:var(--color-text-secondary); margin-top:2px; }
#guidePage .photo-auto { font-size:12px; font-weight:600; } #guidePage .photo-auto.blue { color:#185FA5; } #guidePage .photo-auto.green { color:#3B6D11; }
#guidePage .ask-btn { display:inline-flex; align-items:center; gap:8px; margin-top:1.25rem; padding:11px 20px; border:1px solid #2563eb; border-radius:var(--border-radius-md); background:#2563eb; font-size:14px; font-weight:600; color:#fff !important; text-decoration:none !important; transition:background .15s; }
#guidePage .ask-btn:hover { background:#1d4ed8; color:#fff !important; }
#guidePage .ask-btn span { color:#fff !important; }
</style>
@endsection

@section('content')
<div id="guidePage">

  <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm mb-3">← {{ __('messages.sidebar_incidents') }}</a>

  <div class="guide-header">
    <div>
      <h1>{{ __('messages.guide_title') }}</h1>
      <p>{{ __('messages.guide_subtitle') }}</p>
    </div>
  </div>

  <div class="toc">
    <div class="toc-title">{{ __('messages.guide_goto') }}</div>
    <div class="toc-list">
      <button class="toc-btn active" onclick="guideScrollTo('gs1',this)"><i class="ti ti-plus"></i> {{ __('messages.guide_s1') }}</button>
      <button class="toc-btn" onclick="guideScrollTo('gs2',this)"><i class="ti ti-forms"></i> {{ __('messages.guide_s2') }}</button>
      <button class="toc-btn" onclick="guideScrollTo('gs3',this)"><i class="ti ti-camera"></i> {{ __('messages.guide_s3') }}</button>
      <button class="toc-btn" onclick="guideScrollTo('gs4',this)"><i class="ti ti-tag"></i> {{ __('messages.guide_s4') }}</button>
      <button class="toc-btn" onclick="guideScrollTo('gs5',this)"><i class="ti ti-pencil"></i> {{ __('messages.guide_s5') }}</button>
      <button class="toc-btn" onclick="guideScrollTo('gs6',this)"><i class="ti ti-table"></i> {{ __('messages.guide_s6') }}</button>
      <button class="toc-btn" onclick="guideScrollTo('gs7',this)"><i class="ti ti-map-pin"></i> {{ __('messages.guide_s7') }}</button>
      <button class="toc-btn" onclick="guideScrollTo('gs8',this)"><i class="ti ti-building"></i> {{ __('messages.guide_s8') }}</button>
    </div>
  </div>

  <div class="section" id="gs1">
    <div class="section-title"><i class="ti ti-circle-plus"></i> {{ __('messages.guide_create_title') }}</div>
    <div class="step-list">
      <div class="step"><div class="step-num">1</div><div class="step-body"><div class="step-label">{{ __('messages.guide_create_1_l') }}</div><div class="step-desc">{{ __('messages.guide_create_1_d') }}</div></div></div>
      <div class="step"><div class="step-num">2</div><div class="step-body"><div class="step-label">{{ __('messages.guide_create_2_l') }}</div><div class="step-desc">{!! __('messages.guide_create_2_d') !!}</div></div></div>
      <div class="step"><div class="step-num">3</div><div class="step-body"><div class="step-label">{{ __('messages.guide_create_3_l') }}</div><div class="step-desc">{!! __('messages.guide_create_3_d') !!}</div></div></div>
      <div class="step"><div class="step-num">4</div><div class="step-body"><div class="step-label">{{ __('messages.guide_create_4_l') }}</div><div class="step-desc">{{ __('messages.guide_create_4_d') }}</div></div></div>
    </div>
    <div class="tip-box"><i class="ti ti-info-circle"></i><p>{{ __('messages.guide_create_tip') }}</p></div>
  </div>

  <div class="divider"></div>

  <div class="section" id="gs2">
    <div class="section-title"><i class="ti ti-forms"></i> {{ __('messages.guide_fields_title') }}</div>
    <div class="field-grid">
      <div class="field-card"><div class="field-name"><i class="ti ti-building"></i> {{ __('messages.field_chantier') }} <span class="badge badge-req">{{ __('messages.guide_req') }}</span></div><div class="field-desc">{{ __('messages.guide_f_chantier') }}</div></div>
      <div class="field-card"><div class="field-name"><i class="ti ti-tools"></i> {{ __('messages.field_discipline') }} <span class="badge badge-req">{{ __('messages.guide_req') }}</span></div><div class="field-desc">{{ __('messages.guide_f_discipline') }}</div></div>
      <div class="field-card"><div class="field-name"><i class="ti ti-shield"></i> {{ __('messages.field_responsibility') }} <span class="badge badge-auto">{{ __('messages.guide_auto') }}</span></div><div class="field-desc">{{ __('messages.guide_f_resp') }}</div></div>
      <div class="field-card"><div class="field-name"><i class="ti ti-settings"></i> {{ __('messages.field_system') }} <span class="badge badge-opt">{{ __('messages.guide_opt') }}</span></div><div class="field-desc">{{ __('messages.guide_f_system') }}</div></div>
      <div class="field-card"><div class="field-name"><i class="ti ti-map-pin"></i> {{ __('messages.field_zone') }} <span class="badge badge-opt">{{ __('messages.guide_opt') }}</span></div><div class="field-desc">{{ __('messages.guide_f_zone') }}</div></div>
      <div class="field-card"><div class="field-name"><i class="ti ti-align-left"></i> {{ __('messages.field_description') }} <span class="badge badge-opt">{{ __('messages.guide_opt') }}</span></div><div class="field-desc">{{ __('messages.guide_f_desc') }}</div></div>
      <div class="field-card"><div class="field-name"><i class="ti ti-tag"></i> {{ __('messages.field_category') }} <span class="badge badge-opt">{{ __('messages.guide_opt') }}</span></div><div class="field-desc">{{ __('messages.guide_f_cat') }}</div></div>
      <div class="field-card"><div class="field-name"><i class="ti ti-hash"></i> {{ __('messages.col_id') }} <span class="badge badge-auto">{{ __('messages.guide_auto') }}</span></div><div class="field-desc">{{ __('messages.guide_f_ref') }}</div></div>
      <div class="field-card"><div class="field-name"><i class="ti ti-calendar"></i> {{ __('messages.col_issued_on') }} <span class="badge badge-auto">{{ __('messages.guide_auto') }}</span></div><div class="field-desc">{{ __('messages.guide_f_date') }}</div></div>
    </div>
  </div>

  <div class="divider"></div>

  <div class="section" id="gs3">
    <div class="section-title"><i class="ti ti-camera"></i> {{ __('messages.guide_photos_title') }}</div>
    <div class="photo-flow">
      <div class="photo-row">
        <div class="photo-icon open"><i class="ti ti-camera"></i></div>
        <div class="photo-info"><div class="photo-label">{{ __('messages.guide_photo_open') }}</div><div class="photo-sub">{{ __('messages.guide_photo_open_sub') }}</div></div>
        <div style="text-align:right"><div class="photo-auto blue">→ {{ __('messages.col_issued_on') }}</div><div style="font-size:11px;color:var(--color-text-secondary)">{{ __('messages.guide_auto_ts') }}</div></div>
      </div>
      <div class="photo-row">
        <div class="photo-icon close"><i class="ti ti-camera-check"></i></div>
        <div class="photo-info"><div class="photo-label">{{ __('messages.guide_photo_close') }}</div><div class="photo-sub">{{ __('messages.guide_photo_close_sub') }}</div></div>
        <div style="text-align:right"><div class="photo-auto green">→ {{ __('messages.guide_update_date') }}</div><div style="font-size:11px;color:var(--color-text-secondary)">{{ __('messages.guide_auto_ts') }}</div></div>
      </div>
    </div>
    <div class="warn-box"><i class="ti ti-alert-triangle"></i><p>{!! __('messages.guide_photo_warn') !!}</p></div>
    <div class="tip-box"><i class="ti ti-info-circle"></i><p>{{ __('messages.guide_photo_tip') }}</p></div>
  </div>

  <div class="divider"></div>

  <div class="section" id="gs4">
    <div class="section-title"><i class="ti ti-tag"></i> {{ __('messages.guide_status_title') }}</div>
    <div class="status-list">
      <div class="status-row"><div class="status-dot" style="background:#E24B4A"></div><div class="status-info"><div class="status-name">{{ __('messages.status_open') }}</div><div class="status-desc">{{ __('messages.guide_status_open') }}</div></div></div>
      <div class="status-row"><div class="status-dot" style="background:#EF9F27"></div><div class="status-info"><div class="status-name">{{ __('messages.status_in_progress') }}</div><div class="status-desc">{{ __('messages.guide_status_progress') }}</div></div></div>
      <div class="status-row"><div class="status-dot" style="background:#1D9E75"></div><div class="status-info"><div class="status-name">{{ __('messages.status_closed') }}</div><div class="status-desc">{!! __('messages.guide_status_closed') !!}</div></div></div>
    </div>
    <div class="tip-box"><i class="ti ti-info-circle"></i><p>{{ __('messages.guide_status_tip') }}</p></div>
  </div>

  <div class="divider"></div>

  <div class="section" id="gs5">
    <div class="section-title"><i class="ti ti-pencil"></i> {{ __('messages.guide_edit_title') }}</div>
    <div class="step-list">
      <div class="step"><div class="step-num">1</div><div class="step-body"><div class="step-label">{{ __('messages.guide_edit_1_l') }}</div><div class="step-desc">{{ __('messages.guide_edit_1_d') }}</div></div></div>
      <div class="step"><div class="step-num">2</div><div class="step-body"><div class="step-label">{{ __('messages.guide_edit_2_l') }}</div><div class="step-desc">{{ __('messages.guide_edit_2_d') }}</div></div></div>
      <div class="step"><div class="step-num">3</div><div class="step-body"><div class="step-label">{{ __('messages.guide_edit_3_l') }}</div><div class="step-desc">{{ __('messages.guide_edit_3_d') }}</div></div></div>
    </div>
  </div>

  <div class="divider"></div>

  <div class="section" id="gs6">
    <div class="section-title"><i class="ti ti-table"></i> {{ __('messages.guide_table_title') }}</div>
    <div class="step-list">
      <div class="step"><div class="step-num">🔄</div><div class="step-body"><div class="step-label">{{ __('messages.guide_table_1_l') }}</div><div class="step-desc">{!! __('messages.guide_table_1_d') !!}</div></div></div>
      <div class="step"><div class="step-num">📸</div><div class="step-body"><div class="step-label">{{ __('messages.guide_table_2_l') }}</div><div class="step-desc">{{ __('messages.guide_table_2_d') }}</div></div></div>
      <div class="step"><div class="step-num">🔍</div><div class="step-body"><div class="step-label">{{ __('messages.guide_table_3_l') }}</div><div class="step-desc">{{ __('messages.guide_table_3_d') }}</div></div></div>
      <div class="step"><div class="step-num">📄</div><div class="step-body"><div class="step-label">{{ __('messages.guide_table_4_l') }}</div><div class="step-desc">{{ __('messages.guide_table_4_d') }}</div></div></div>
    </div>
  </div>

  <div class="divider"></div>

  <div class="section" id="gs7">
    <div class="section-title"><i class="ti ti-map-pin"></i> {{ __('messages.guide_zones_title') }}</div>
    <div class="step-list">
      <div class="step"><div class="step-num">1</div><div class="step-body"><div class="step-label">{{ __('messages.guide_zones_1_l') }}</div><div class="step-desc">{!! __('messages.guide_zones_1_d') !!}</div></div></div>
      <div class="step"><div class="step-num">2</div><div class="step-body"><div class="step-label">{{ __('messages.guide_zones_2_l') }}</div><div class="step-desc">{{ __('messages.guide_zones_2_d') }}</div></div></div>
      <div class="step"><div class="step-num">3</div><div class="step-body"><div class="step-label">{{ __('messages.guide_zones_3_l') }}</div><div class="step-desc">{{ __('messages.guide_zones_3_d') }}</div></div></div>
    </div>
    <div class="warn-box"><i class="ti ti-alert-triangle"></i><p>{{ __('messages.guide_zones_warn') }}</p></div>
  </div>

  <div class="divider"></div>

  <div class="section" id="gs8">
    <div class="section-title"><i class="ti ti-building"></i> {{ __('messages.guide_chantiers_title') }}</div>
    <div class="step-list">
      <div class="step"><div class="step-num">1</div><div class="step-body"><div class="step-label">{{ __('messages.guide_ch_1_l') }}</div><div class="step-desc">{!! __('messages.guide_ch_1_d') !!}</div></div></div>
      <div class="step"><div class="step-num">2</div><div class="step-body"><div class="step-label">{{ __('messages.guide_ch_2_l') }}</div><div class="step-desc">{!! __('messages.guide_ch_2_d') !!}</div></div></div>
      <div class="step"><div class="step-num">3</div><div class="step-body"><div class="step-label">{{ __('messages.guide_ch_3_l') }}</div><div class="step-desc">{!! __('messages.guide_ch_3_d') !!}</div></div></div>
      <div class="step"><div class="step-num">4</div><div class="step-body"><div class="step-label">{{ __('messages.guide_ch_4_l') }}</div><div class="step-desc">{{ __('messages.guide_ch_4_d') }}</div></div></div>
    </div>
    <div class="tip-box"><i class="ti ti-info-circle"></i><p>{{ __('messages.guide_ch_tip') }}</p></div>
  </div>

  <a class="ask-btn" href="{{ route('contact') }}" target="_blank"><i class="ti ti-message-question"></i> {{ __('messages.guide_ask') }}</a>

</div>

<script>
function guideScrollTo(id, btn) {
    document.querySelectorAll('#guidePage .toc-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection
