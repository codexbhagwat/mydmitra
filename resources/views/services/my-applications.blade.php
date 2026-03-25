{{--
    resources/views/services/my-applications.blade.php
    Shows the logged-in user's submitted service applications with status tracking.
--}}
@extends('layouts.app')
@section('title', 'My Applications')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&display=swap');

.ma-wrap { background:#f4f6fb; min-height:100vh; padding-bottom:70px; }

/* ── HERO ── */
.ma-hero {
    background: linear-gradient(135deg, #1a3a6b 0%, #122d56 100%);
    padding: 42px 0 62px;
    position: relative;
    overflow: hidden;
}
.ma-hero::before {
    content:'';
    position:absolute; inset:0;
    background: radial-gradient(ellipse at 85% 40%, rgba(234,88,12,.14) 0%, transparent 55%),
                radial-gradient(ellipse at 5% 90%, rgba(255,255,255,.05) 0%, transparent 45%);
    pointer-events:none;
}
.ma-hero-circle {
    position:absolute; right:-70px; top:-70px;
    width:280px; height:280px;
    border-radius:50%;
    border:55px solid rgba(255,255,255,.04);
    pointer-events:none;
}
.ma-hero-circle2 {
    position:absolute; left:-40px; bottom:-60px;
    width:190px; height:190px;
    border-radius:50%;
    border:35px solid rgba(234,88,12,.08);
    pointer-events:none;
}
.ma-hero-inner { max-width:900px; margin:0 auto; padding:0 28px; position:relative; z-index:1; }

.ma-back {
    display:inline-flex; align-items:center; gap:6px;
    color:rgba(255,255,255,.4); font-size:12.5px; font-weight:500;
    text-decoration:none; margin-bottom:22px; transition:color .15s;
    letter-spacing:.2px;
}
.ma-back:hover { color:rgba(255,255,255,.75); }

.ma-hero-row { display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:18px; }

.ma-hero h1 {
    /* font-family:'Syne',sans-serif; */
    font-size:38px; font-weight:700;
    color:#fff; letter-spacing:-1px; line-height:1.1; margin:0 0 6px;
}
.ma-hero h1 em { font-style:normal; color:#ea580c; }
.ma-hero-sub { color:rgba(255,255,255,.42); font-size:13.5px; font-weight:400; }

.ma-hero-stats { display:flex; gap:8px; }
.stat-card {
    background:rgba(255,255,255,.07);
    border:1px solid rgba(255,255,255,.11);
    border-radius:12px; padding:12px 18px; text-align:center; min-width:76px;
}
.stat-card-num {  font-size:22px; font-weight:700; color:#fff; line-height:1; }
.stat-card-num span { color:#ea580c; }
.stat-card-lbl { font-size:10px; color:rgba(255,255,255,.3); text-transform:uppercase; letter-spacing:.9px; margin-top:3px; }

/* ── FILTER BAR (floating) ── */
.ma-filter-wrap { max-width:900px; margin:-24px auto 0; padding:0 28px; position:relative; z-index:2; }
.ma-filter-bar {
    background:#fff;
    border-radius:14px;
    box-shadow:0 6px 28px rgba(0,0,0,.10), 0 1px 4px rgba(0,0,0,.05);
    padding:10px 12px;
    display:flex; gap:5px; flex-wrap:wrap; align-items:center;
}
.f-tab {
    display:inline-flex; align-items:center; gap:7px;
    padding:7px 15px; border-radius:9px;
    font-size:13px; font-weight:600; text-decoration:none;
    color:#6b7280; transition:all .18s; white-space:nowrap;
}
.f-tab:hover { background:#f4f6fb; color:#1a3a6b; }
.f-tab.is-active { background:#1a3a6b; color:#fff; }
.f-tab-count {
    background:rgba(255,255,255,.2); border-radius:20px;
    padding:1px 7px; font-size:11px; font-weight:700;
}
.f-tab:not(.is-active) .f-tab-count { background:#f0f2f5; color:#9ca3af; }

/* ── BODY ── */
.ma-body { max-width:900px; margin:30px auto 0; padding:0 28px; }

/* Flash */
.ma-flash {
    background:#ecfdf5; border:1px solid #a7f3d0; border-left:3px solid #10b981;
    border-radius:10px; padding:12px 16px; font-size:13.5px; color:#065f46;
    margin-bottom:20px; display:flex; align-items:center; gap:10px; font-weight:500;
}

/* Empty */
.ma-empty {
    background:#fff; border-radius:18px;
    border:1.5px dashed #e5e7eb;
    padding:72px 20px; text-align:center;
}
.ma-empty-icon {
    width:72px; height:72px;
    background:linear-gradient(135deg,#eef2ff,#dce6ff);
    border-radius:20px; margin:0 auto 20px;
    display:flex; align-items:center; justify-content:center;
    font-size:28px; color:#1a3a6b;
}
.ma-empty h3 { font-family:'Syne',sans-serif; font-size:18px; font-weight:800; color:#111827; margin-bottom:8px; }
.ma-empty p { font-size:14px; color:#6b7280; margin-bottom:24px; max-width:300px; margin-left:auto; margin-right:auto; }
.btn-browse-empty {
    display:inline-flex; align-items:center; gap:8px;
    background:#ea580c; color:#fff; padding:11px 26px;
    border-radius:10px; font-size:14px; font-weight:700; text-decoration:none;
    box-shadow:0 4px 16px rgba(234,88,12,.3); transition:all .2s;
}
.btn-browse-empty:hover { background:#d14e09; transform:translateY(-1px); box-shadow:0 6px 22px rgba(234,88,12,.4); color:#fff; }

/* ── CARD LIST ── */
.ma-list { display:flex; flex-direction:column; gap:14px; }

.app-card {
    background:#fff;
    border-radius:16px;
    border:1.5px solid #e5e7eb;
    overflow:hidden;
    display:flex;
    transition:box-shadow .2s, border-color .2s, transform .18s;
    animation:slideUp .35s ease both;
}
.app-card:nth-child(1){animation-delay:.04s}
.app-card:nth-child(2){animation-delay:.09s}
.app-card:nth-child(3){animation-delay:.14s}
.app-card:nth-child(4){animation-delay:.19s}
.app-card:nth-child(5){animation-delay:.24s}
@keyframes slideUp {
    from{opacity:0;transform:translateY(14px)}
    to{opacity:1;transform:translateY(0)}
}
.app-card:hover {
    box-shadow:0 8px 34px rgba(0,0,0,.09);
    border-color:#d1d5db;
    transform:translateY(-2px);
}

/* Status accent bar */
.app-accent { width:5px; flex-shrink:0; }
.ac-pending    { background:#f59e0b; }
.ac-processing { background:#3b82f6; }
.ac-completed  { background:#10b981; }
.ac-rejected   { background:#ef4444; }

.app-card-body {
    flex:1; padding:20px 22px;
    display:flex; align-items:flex-start; gap:16px; flex-wrap:wrap;
}

/* Service icon */
.app-svc-icon {
    width:48px; height:48px; border-radius:13px;
    background:linear-gradient(135deg,#eef2ff,#dce6ff);
    color:#1a3a6b; display:flex; align-items:center;
    justify-content:center; font-size:20px; flex-shrink:0;
}

.app-main { flex:1; min-width:0; }

.app-title-row { display:flex; align-items:center; gap:10px; flex-wrap:wrap; margin-bottom:5px; }
.app-name { font-family:'Syne',sans-serif; font-size:15.5px; font-weight:800; color:#111827; }

/* Status badge */
.s-badge {
    display:inline-flex; align-items:center; gap:5px;
    border-radius:20px; padding:3px 11px;
    font-size:11.5px; font-weight:700; border:1px solid;
}
.sb-pending    { background:#fffbeb; color:#d97706; border-color:#fde68a; }
.sb-processing { background:#eff6ff; color:#2563eb; border-color:#bfdbfe; }
.sb-completed  { background:#ecfdf5; color:#059669; border-color:#a7f3d0; }
.sb-rejected   { background:#fef2f2; color:#dc2626; border-color:#fecaca; }

.app-meta {
    font-size:12px; color:#6b7280;
    display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-bottom:14px;
}
.meta-sep { width:3px; height:3px; border-radius:50%; background:#d1d5db; display:inline-block; }
.meta-ref {
    font-family:'Courier New',monospace; background:#f4f6fb;
    padding:2px 8px; border-radius:5px; font-size:11.5px;
    color:#6b7280; border:1px solid #e5e7eb;
}
.meta-fee { font-weight:700; color:#ea580c; }

/* Field data */
.app-fields {
    background:#fafbfd; border:1px solid #e5e7eb;
    border-radius:10px; padding:12px 15px; margin-bottom:10px;
}
.app-fields-ttl {
    font-size:10.5px; font-weight:700; text-transform:uppercase;
    letter-spacing:.08em; color:#6b7280; margin-bottom:10px;
}
.fields-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(200px,1fr)); gap:10px; }
.field-lbl { font-size:11px; color:#6b7280; font-weight:600; margin-bottom:2px; }
.field-val { font-size:13px; font-weight:500; color:#111827; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }

/* Docs */
.app-docs { display:flex; flex-wrap:wrap; gap:7px; margin-top:8px; }
.doc-chip {
    display:inline-flex; align-items:center; gap:5px;
    background:#ecfdf5; color:#059669;
    border:1px solid #a7f3d0; border-radius:6px;
    padding:3px 10px; font-size:12px; font-weight:600;
}

/* Right action */
.app-action {
    flex-shrink:0; display:flex;
    align-items:center; justify-content:center;
    padding:20px 20px 20px 0;
}
.btn-view-detail {
    display:inline-flex; align-items:center; gap:7px;
    background:#1a3a6b; color:#fff;
    padding:9px 18px; border-radius:9px;
    font-size:13px; font-weight:600; text-decoration:none;
    transition:background .18s, transform .14s; white-space:nowrap;
}
.btn-view-detail:hover { background:#1e4080; transform:translateX(2px); color:#fff; }

/* Pagination */
.ma-pagination { margin-top:28px; }

@media(max-width:640px){
    .ma-hero h1{font-size:26px;}
    .ma-hero-stats{display:none;}
    .app-card-body{padding:14px;}
    .app-action{padding:0 14px 14px; align-self:flex-end;}
    .ma-hero{padding:30px 0 44px;}
}
</style>

<div class="ma-wrap">

  {{-- ── HERO ── --}}
  <div class="ma-hero">
    <div class="ma-hero-circle"></div>
    <div class="ma-hero-circle2"></div>
    <div class="ma-hero-inner">
      <a href="{{ route('services.index') }}" class="ma-back">
        <i class="bi bi-arrow-left"></i> Back to Services
      </a>
      <div class="ma-hero-row">
        <div>
          <h1>My <em>Applications</em></h1>
          <p class="ma-hero-sub">Track the status of all your submitted service applications.</p>
        </div>
        <div class="ma-hero-stats">
          <div class="stat-card">
            <div class="stat-card-num">{{ $applications->total() }}<span>+</span></div>
            <div class="stat-card-lbl">Total</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-num">{{ $counts['completed'] ?? 0 }}</div>
            <div class="stat-card-lbl">Done</div>
          </div>
          <div class="stat-card">
            <div class="stat-card-num">{{ $counts['pending'] ?? 0 }}</div>
            <div class="stat-card-lbl">Pending</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ── FILTER BAR ── --}}
  @php
    $statuses = ['all' => 'All', 'pending' => 'Pending', 'processing' => 'Processing',
                 'completed' => 'Completed', 'rejected' => 'Rejected'];
    $current  = request('status', 'all');
    $filterIcons = [
      'all'        => 'bi-grid-3x3-gap',
      'pending'    => 'bi-hourglass-split',
      'processing' => 'bi-arrow-repeat',
      'completed'  => 'bi-check2-circle',
      'rejected'   => 'bi-x-circle',
    ];
  @endphp
  <div class="ma-filter-wrap">
    <div class="ma-filter-bar">
      @foreach($statuses as $val => $label)
        <a href="{{ route('services.my-applications', $val === 'all' ? [] : ['status' => $val]) }}"
           class="f-tab {{ $current === $val ? 'is-active' : '' }}">
          <i class="bi {{ $filterIcons[$val] }}"></i>
          {{ $label }}
          <span class="f-tab-count">
            @if($val === 'all')
              {{ $applications->total() }}
            @elseif(isset($counts[$val]))
              {{ $counts[$val] }}
            @else
              0
            @endif
          </span>
        </a>
      @endforeach
    </div>
  </div>

  {{-- ── MAIN BODY ── --}}
  <div class="ma-body">

    @if(session('success'))
      <div class="ma-flash">
        <i class="bi bi-check-circle-fill" style="font-size:16px;"></i>
        {{ session('success') }}
      </div>
    @endif

    @if($applications->isEmpty())
      <div class="ma-empty">
        <div class="ma-empty-icon"><i class="bi bi-folder2-open"></i></div>
        <h3>
          @if($current !== 'all')
            No {{ ucfirst($current) }} Applications
          @else
            No Applications Yet
          @endif
        </h3>
        <p>
          @if($current !== 'all')
            No {{ $current }} applications right now.
          @else
            You haven't submitted any applications yet.
          @endif
        </p>
        <a href="{{ route('services.index') }}" class="btn-browse-empty">
          <i class="bi bi-grid"></i> Browse Services
        </a>
      </div>

    @else
      <div class="ma-list">
        @foreach($applications as $app)
        @php
          $statusStyles = [
            'pending'    => ['bg'=>'#fffbeb','color'=>'#d97706','border'=>'#fde68a','icon'=>'bi-hourglass-split','ac'=>'ac-pending',   'sb'=>'sb-pending'],
            'processing' => ['bg'=>'#eff6ff','color'=>'#2563eb','border'=>'#bfdbfe','icon'=>'bi-arrow-repeat',  'ac'=>'ac-processing','sb'=>'sb-processing'],
            'completed'  => ['bg'=>'#ecfdf5','color'=>'#059669','border'=>'#a7f3d0','icon'=>'bi-check2-circle','ac'=>'ac-completed', 'sb'=>'sb-completed'],
            'rejected'   => ['bg'=>'#fef2f2','color'=>'#dc2626','border'=>'#fecaca','icon'=>'bi-x-circle',     'ac'=>'ac-rejected',  'sb'=>'sb-rejected'],
          ];
          $st = $statusStyles[$app->status] ?? $statusStyles['pending'];
        @endphp

        <div class="app-card">
          <div class="app-accent {{ $st['ac'] }}"></div>
          <div class="app-card-body">

            <div class="app-svc-icon">
              <i class="bi {{ $app->service->icon ?? 'bi-gear' }}"></i>
            </div>

            <div class="app-main">
              <div class="app-title-row">
                <span class="app-name">{{ $app->service->name ?? 'Service Removed' }}</span>
                <span class="s-badge {{ $st['sb'] }}">
                  <i class="bi {{ $st['icon'] }}"></i>
                  {{ ucfirst($app->status) }}
                </span>
              </div>

              <div class="app-meta">
                <span>Submitted {{ $app->created_at->diffForHumans() }}</span>
                <span class="meta-sep"></span>
                <span class="meta-ref">Ref #{{ str_pad($app->id, 6, '0', STR_PAD_LEFT) }}</span>
                @if($app->service && $app->service->price > 0)
                  <span class="meta-sep"></span>
                  <span class="meta-fee">₹{{ number_format($app->service->price, 0) }}</span>
                @endif
              </div>

              {{-- Submitted field values summary --}}
              @if(!empty($app->field_data))
                <div class="app-fields">
                  <div class="app-fields-ttl">Submitted Details</div>
                  <div class="fields-grid">
                    @foreach($app->field_data as $index => $value)
                      @php
                        $fieldDef   = $app->service->fields[$index] ?? null;
                        $fieldLabel = $fieldDef['label'] ?? 'Field ' . ($index + 1);
                        $fieldType  = $fieldDef['type']  ?? 'text';
                      @endphp
                      @if(!empty($value))
                        <div>
                          <div class="field-lbl">{{ $fieldLabel }}</div>
                          <div class="field-val">
                            @if($fieldType === 'file')
                              <i class="bi bi-paperclip"></i> File uploaded
                            @elseif($fieldType === 'checkbox')
                              {{ $value ? 'Yes' : 'No' }}
                            @else
                              {{ $value }}
                            @endif
                          </div>
                        </div>
                      @endif
                    @endforeach
                  </div>
                </div>
              @endif

              {{-- Documents uploaded --}}
              @if(!empty($app->documents))
                <div class="app-docs">
                  @foreach($app->documents as $doc)
                    <span class="doc-chip">
                      <i class="bi bi-shield-lock-fill"></i>
                      {{ $doc['name'] ?? 'Document' }}
                      <span style="font-weight:400;opacity:.75;">({{ $doc['doctype'] ?? '' }})</span>
                    </span>
                  @endforeach
                </div>
              @endif
            </div>

          </div>

          <div class="app-action">
            <a href="{{ route('services.application', $app) }}" class="btn-view-detail">
              View <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        @endforeach
      </div>

      {{-- Pagination --}}
      @if($applications->hasPages())
        <div class="ma-pagination">
          {{ $applications->appends(request()->query())->links() }}
        </div>
      @endif
    @endif

  </div>
</div>

@endsection