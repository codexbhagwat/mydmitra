{{--
    resources/views/admin/services/create.blade.php
--}}
@extends('layouts.admin')
@section('title', 'Add Service')
@section('page-title', 'Add Service')

@section('content')
<style>
*{box-sizing:border-box;}
.svc-wrap{max-width:720px;font-family:inherit;}

.svc-back{display:inline-flex;align-items:center;gap:6px;font-size:13px;color:#6b7280;text-decoration:none;font-weight:500;margin-bottom:20px;}
.svc-back:hover{color:#e07820;}

.svc-hero{display:flex;align-items:center;gap:14px;margin-bottom:26px;}
.svc-hero-icon{width:46px;height:46px;border-radius:12px;background:#fff3e8;border:1px solid #f0c89a;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.svc-hero-icon i{font-size:20px;color:#e07820;}
.svc-hero h2{font-size:20px;font-weight:700;margin:0 0 3px;color:#111827;}
.svc-hero p{font-size:13px;color:#6b7280;margin:0;}

.svc-card{background:#ffffff;border:1px solid #e5e7eb;border-radius:14px;padding:24px 26px;margin-bottom:16px;box-shadow:0 1px 4px rgba(0,0,0,0.04);}

.svc-sec-head{display:flex;align-items:center;gap:10px;padding-bottom:16px;border-bottom:1px solid #f3f4f6;margin-bottom:22px;}
.svc-sec-icon{width:32px;height:32px;border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.svc-sec-icon i{font-size:15px;}
.svc-card.s1 .svc-sec-icon{background:#eff6ff;border:1px solid #bfdbfe;}
.svc-card.s1 .svc-sec-icon i{color:#2563eb;}
.svc-card.s2 .svc-sec-icon{background:#f0fdf4;border:1px solid #bbf7d0;}
.svc-card.s2 .svc-sec-icon i{color:#16a34a;}
.svc-card.s3 .svc-sec-icon{background:#fff7ed;border:1px solid #fed7aa;}
.svc-card.s3 .svc-sec-icon i{color:#ea580c;}
.svc-sec-head h3{font-size:14px;font-weight:700;color:#111827;margin:0 0 2px;}
.svc-sec-head span{font-size:12px;color:#9ca3af;}

.fg{margin-bottom:18px;}
.fg:last-child{margin-bottom:0;}
.fg>label{display:block;font-size:12.5px;font-weight:600;color:#374151;margin-bottom:7px;}
.fg>label .req{color:#ef4444;margin-left:2px;}
.fg>label .hint{font-weight:400;color:#9ca3af;font-size:11.5px;margin-left:5px;}
.fg input[type=text],.fg input[type=number],.fg textarea,.fg select{
  width:100%;padding:10px 13px;border:1px solid #d1d5db;border-radius:10px;
  font-size:13.5px;font-family:inherit;color:#111827;background:#fff;outline:none;
  transition:border-color .15s,box-shadow .15s;}
.fg input:focus,.fg textarea:focus,.fg select:focus{border-color:#e07820;box-shadow:0 0 0 3px rgba(224,120,32,0.12);}
.fg input.is-invalid,.fg textarea.is-invalid{border-color:#ef4444;}
.fg input::placeholder,.fg textarea::placeholder{color:#c4c9d4;}
.fg textarea{resize:vertical;min-height:90px;line-height:1.6;}
.invalid-feedback{font-size:12px;color:#ef4444;margin-top:5px;display:block;}

.fg-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
@media(max-width:540px){.fg-row{grid-template-columns:1fr;}}

.price-box{display:flex;align-items:center;border:1px solid #d1d5db;border-radius:10px;overflow:hidden;transition:border-color .15s,box-shadow .15s;}
.price-box:focus-within{border-color:#e07820;box-shadow:0 0 0 3px rgba(224,120,32,0.12);}
.price-pfx{padding:10px 13px;background:#f9fafb;border-right:1px solid #e5e7eb;font-size:14px;font-weight:700;color:#6b7280;}
.price-box input{border:none!important;box-shadow:none!important;border-radius:0!important;outline:none;flex:1;padding:10px 13px;font-size:13.5px;font-family:inherit;color:#111827;background:transparent;}

/* ── Icon picker trigger ── */
.icon-pick-btn{
  display:flex;align-items:center;gap:10px;
  width:100%;padding:10px 13px;
  border:1px solid #d1d5db;border-radius:10px;
  background:#fff;cursor:pointer;transition:border-color .15s,box-shadow .15s;
  font-family:inherit;
}
.icon-pick-btn:hover{border-color:#e07820;}
.icon-pick-btn:focus{outline:none;border-color:#e07820;box-shadow:0 0 0 3px rgba(224,120,32,0.12);}
.icon-pick-preview{
  width:34px;height:34px;border-radius:8px;
  background:#fff7ed;border:1px solid #fed7aa;
  display:flex;align-items:center;justify-content:center;
  flex-shrink:0;
}
.icon-pick-preview i{font-size:17px;color:#e07820;}
.icon-pick-label{flex:1;text-align:left;}
.icon-pick-label span{display:block;font-size:13px;color:#111827;font-weight:500;}
.icon-pick-label small{font-size:11.5px;color:#9ca3af;}
.icon-pick-caret{color:#9ca3af;font-size:12px;}

/* ── Icon picker modal ── */
.ipk-overlay{display:none;position:fixed;inset:0;background:rgba(17,24,39,.5);backdrop-filter:blur(4px);z-index:10000;align-items:center;justify-content:center;padding:16px;}
.ipk-overlay.open{display:flex;}
.ipk-box{background:#fff;border-radius:18px;width:620px;max-width:100%;max-height:88vh;display:flex;flex-direction:column;box-shadow:0 24px 60px rgba(0,0,0,.22);animation:ipkpop .2s cubic-bezier(.34,1.56,.64,1);}
@keyframes ipkpop{from{transform:scale(.9) translateY(10px);opacity:0;}to{transform:scale(1) translateY(0);opacity:1;}}

.ipk-head{display:flex;align-items:center;justify-content:space-between;padding:20px 22px 16px;border-bottom:1px solid #f3f4f6;flex-shrink:0;}
.ipk-head h6{font-size:15px;font-weight:700;color:#111827;margin:0;}
.ipk-close{width:30px;height:30px;border-radius:8px;border:1px solid #e5e7eb;background:#f9fafb;color:#6b7280;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:14px;transition:all .15s;}
.ipk-close:hover{border-color:#fca5a5;color:#ef4444;background:#fff5f5;}

.ipk-search-wrap{padding:14px 22px 10px;flex-shrink:0;}
.ipk-search{display:flex;align-items:center;gap:9px;padding:9px 13px;border:1px solid #d1d5db;border-radius:10px;background:#f9fafb;transition:border-color .15s,box-shadow .15s;}
.ipk-search:focus-within{border-color:#e07820;box-shadow:0 0 0 3px rgba(224,120,32,0.12);background:#fff;}
.ipk-search i{font-size:14px;color:#9ca3af;flex-shrink:0;}
.ipk-search input{border:none;outline:none;background:transparent;font-size:13.5px;font-family:inherit;color:#111827;flex:1;}
.ipk-search input::placeholder{color:#c4c9d4;}

.ipk-cats{display:flex;gap:6px;padding:0 22px 10px;flex-shrink:0;flex-wrap:wrap;}
.ipk-cat{padding:5px 12px;border-radius:20px;border:1px solid #e5e7eb;background:#f9fafb;font-size:12px;font-weight:600;color:#6b7280;cursor:pointer;transition:all .15s;white-space:nowrap;}
.ipk-cat:hover{border-color:#e07820;color:#e07820;background:#fff7ed;}
.ipk-cat.active{border-color:#e07820;background:#e07820;color:#fff;}

.ipk-grid-wrap{flex:1;overflow-y:auto;padding:4px 22px 18px;}
.ipk-count{font-size:11.5px;color:#9ca3af;margin-bottom:10px;margin-top:6px;}
.ipk-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(70px,1fr));gap:6px;}
.ipk-item{display:flex;flex-direction:column;align-items:center;gap:5px;padding:10px 6px;border-radius:10px;border:1px solid transparent;cursor:pointer;transition:all .15s;}
.ipk-item:hover{background:#fff7ed;border-color:#fed7aa;}
.ipk-item.selected{background:#fff3e0;border-color:#e07820;}
.ipk-item i{font-size:22px;color:#374151;}
.ipk-item.selected i{color:#e07820;}
.ipk-item span{font-size:9.5px;color:#9ca3af;text-align:center;line-height:1.3;word-break:break-all;}
.ipk-item.selected span{color:#c96a18;}
.ipk-none{text-align:center;padding:32px 16px;color:#c4c9d4;font-size:13px;}
.ipk-none i{font-size:28px;display:block;margin-bottom:8px;}

.ipk-foot{padding:14px 22px;border-top:1px solid #f3f4f6;display:flex;align-items:center;gap:10px;flex-shrink:0;}
.ipk-selected-preview{display:flex;align-items:center;gap:10px;flex:1;}
.ipk-sel-ico{width:36px;height:36px;border-radius:9px;background:#fff7ed;border:1px solid #fed7aa;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.ipk-sel-ico i{font-size:18px;color:#e07820;}
.ipk-sel-name{font-size:13px;color:#374151;font-weight:500;}
.ipk-sel-hint{font-size:11.5px;color:#9ca3af;}
.m-btn-yes{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:9px;background:#e07820;color:#fff;font-size:13.5px;font-weight:600;font-family:inherit;border:none;cursor:pointer;transition:background .15s;}
.m-btn-yes:hover{background:#c96a18;}
.m-btn-back{display:inline-flex;align-items:center;gap:7px;padding:10px 16px;border-radius:9px;background:#f3f4f6;color:#374151;font-size:13.5px;font-weight:500;font-family:inherit;border:1px solid #e5e7eb;cursor:pointer;transition:background .15s;}
.m-btn-back:hover{background:#e5e7eb;}

/* Status toggle */
.status-row{display:flex;align-items:center;gap:12px;padding:12px 15px;background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;cursor:pointer;transition:border-color .15s;}
.status-row:hover{border-color:#d1d5db;}
.tog-wrap{position:relative;width:40px;height:22px;flex-shrink:0;}
.tog-wrap input{opacity:0;width:0;height:0;}
.tog-track{position:absolute;inset:0;background:#d1d5db;border-radius:22px;cursor:pointer;transition:background .2s;}
.tog-track::before{content:'';position:absolute;width:16px;height:16px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:transform .2s;box-shadow:0 1px 3px rgba(0,0,0,.2);}
.tog-wrap input:checked ~ .tog-track{background:#e07820;}
.tog-wrap input:checked ~ .tog-track::before{transform:translateX(18px);}
.tog-txt strong{display:block;font-size:13.5px;font-weight:600;color:#111827;}
.tog-txt span{font-size:12px;color:#9ca3af;}

/* Empty state */
.svc-empty{text-align:center;padding:22px 16px;border:1px dashed #e5e7eb;border-radius:10px;margin-bottom:10px;}
.svc-empty i{font-size:24px;color:#e5e7eb;display:block;margin-bottom:8px;}
.svc-empty p{font-size:13px;color:#c4c9d4;margin:0;}

/* Field row */
.field-row{background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;margin-bottom:10px;display:grid;grid-template-columns:1fr 150px 32px;gap:10px;align-items:start;transition:border-color .15s;}
.field-row:hover{border-color:#d1d5db;}
.fi-lbl{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;color:#9ca3af;margin-bottom:5px;}
.fi-inp{width:100%;padding:8px 11px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:inherit;color:#111827;background:#fff;outline:none;transition:border-color .15s;}
.fi-inp:focus{border-color:#e07820;}
.fi-inp::placeholder{color:#c4c9d4;}
.fi-inp.sm{font-size:12px;margin-top:6px;padding:7px 10px;}
.fi-sel{width:100%;padding:8px 11px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:inherit;color:#111827;background:#fff;outline:none;cursor:pointer;transition:border-color .15s;}
.fi-sel:focus{border-color:#e07820;}
.req-chk{display:flex;align-items:center;gap:6px;margin-top:8px;}
.req-chk input[type=checkbox]{width:14px;height:14px;accent-color:#e07820;cursor:pointer;flex-shrink:0;}
.req-chk label{font-size:12px;color:#6b7280;cursor:pointer;}

/* Doc row */
.doc-row{background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;margin-bottom:10px;transition:border-color .15s;}
.doc-row:hover{border-color:#d1d5db;}
.doc-row-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;}
.doc-num{font-size:12px;font-weight:700;color:#6b7280;display:flex;align-items:center;gap:7px;}
.doc-num i{font-size:14px;color:#ea580c;}
.doc-body{display:grid;grid-template-columns:1fr 1fr;gap:14px;}
@media(max-width:480px){.doc-body{grid-template-columns:1fr;}}
.upload-area{display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px;padding:16px 12px;border:1px dashed #d1d5db;border-radius:8px;background:#fff;cursor:pointer;transition:border-color .15s;text-align:center;}
.upload-area:hover{border-color:#e07820;background:#fff9f5;}
.upload-area i{font-size:20px;color:#9ca3af;}
.upload-area span{font-size:12px;color:#9ca3af;}
.upload-area input[type=file]{display:none;}
.enc-note{display:flex;align-items:center;gap:5px;font-size:11px;color:#16a34a;margin-top:7px;}
.enc-note i{font-size:11px;}

.rm-btn{width:30px;height:30px;border-radius:8px;border:1px solid #e5e7eb;background:#fff;color:#9ca3af;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px;transition:all .15s;flex-shrink:0;}
.rm-btn:hover{border-color:#fca5a5;color:#ef4444;background:#fff5f5;}

.add-btn{width:100%;display:flex;align-items:center;justify-content:center;gap:8px;padding:11px 16px;border:1px dashed #d1d5db;border-radius:10px;background:none;font-size:13px;font-weight:600;color:#6b7280;cursor:pointer;font-family:inherit;transition:all .15s;margin-top:6px;}
.add-btn:hover{border-color:#e07820;color:#e07820;background:#fff7ed;}
.add-btn i{font-size:14px;}

.svc-footer{display:flex;gap:10px;align-items:center;margin-top:4px;}
.btn-svc-primary{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;border-radius:10px;background:#e07820;color:#fff;font-size:14px;font-weight:600;border:none;cursor:pointer;font-family:inherit;transition:background .15s;}
.btn-svc-primary:hover{background:#c96a18;}
.btn-svc-cancel{display:inline-flex;align-items:center;gap:6px;padding:12px 20px;border-radius:10px;background:#f3f4f6;color:#374151;font-size:14px;font-weight:500;text-decoration:none;border:1px solid #e5e7eb;transition:background .15s;}
.btn-svc-cancel:hover{background:#e5e7eb;}

/* Confirm modal */
.svc-modal-bg{display:none;position:fixed;inset:0;background:rgba(17,24,39,.55);backdrop-filter:blur(4px);z-index:9999;align-items:center;justify-content:center;padding:20px;}
.svc-modal-bg.open{display:flex;}
.svc-modal{background:#fff;border-radius:18px;width:500px;max-width:100%;max-height:88vh;overflow-y:auto;box-shadow:0 24px 60px rgba(0,0,0,.2);animation:mpop .22s cubic-bezier(.34,1.56,.64,1);}
@keyframes mpop{from{transform:scale(.9) translateY(8px);opacity:0;}to{transform:scale(1) translateY(0);opacity:1;}}
.svc-modal-head{display:flex;align-items:flex-start;gap:14px;padding:24px 26px 18px;border-bottom:1px solid #f3f4f6;}
.svc-modal-ico{width:42px;height:42px;border-radius:11px;flex-shrink:0;background:#fff7ed;border:1px solid #fed7aa;display:flex;align-items:center;justify-content:center;}
.svc-modal-ico i{font-size:18px;color:#e07820;}
.svc-modal-head h5{font-size:16px;font-weight:700;color:#111827;margin:0 0 4px;}
.svc-modal-head p{font-size:13px;color:#6b7280;margin:0;}
.svc-modal-body{padding:20px 26px;}
.svc-modal-summary{background:#f9fafb;border:1px solid #e5e7eb;border-radius:11px;padding:16px 18px;font-size:13px;line-height:1.9;color:#374151;}
.svc-modal-summary strong{color:#111827;}
.svc-modal-foot{display:flex;gap:10px;padding:0 26px 22px;}
.cf-yes{flex:1;display:flex;align-items:center;justify-content:center;gap:8px;padding:12px 18px;border-radius:10px;background:#e07820;color:#fff;font-size:14px;font-weight:600;font-family:inherit;border:none;cursor:pointer;transition:background .15s;}
.cf-yes:hover{background:#c96a18;}
.cf-back{flex:1;display:flex;align-items:center;justify-content:center;gap:7px;padding:12px 18px;border-radius:10px;background:#f3f4f6;color:#374151;font-size:14px;font-weight:500;font-family:inherit;border:1px solid #e5e7eb;cursor:pointer;transition:background .15s;}
.cf-back:hover{background:#e5e7eb;}
</style>

<div class="svc-wrap">

    <a href="{{ route('admin.services.index') }}" class="svc-back">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>

    <div class="svc-hero">
        <div class="svc-hero-icon"><i class="bi bi-plus-lg"></i></div>
        <div>
            <h2>Create new service</h2>
            <p>Fill in the details, add form fields and required documents</p>
        </div>
    </div>

    <form id="serviceForm" method="POST" action="{{ route('admin.services.store') }}">
        @csrf

        {{-- ── Card 1: Basic Info ── --}}
        <div class="svc-card s1">
            <div class="svc-sec-head">
                <div class="svc-sec-icon"><i class="bi bi-info-circle-fill"></i></div>
                <div><h3>Basic information</h3><span>Name, description, pricing and icon</span></div>
            </div>

            <div class="fg">
                <label>Service name <span class="req">*</span></label>
                <input type="text" name="name" id="svcName" value="{{ old('name') }}"
                       class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                       placeholder="e.g. PAN Card Application" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <!-- <div class="fg">
                <label>Application form title <span class="hint">— heading shown on user's form</span></label>
                <input type="text" name="form_title" id="formTitle" value="{{ old('form_title') }}"
                       placeholder="e.g. Apply for PAN Card">
                @error('form_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div> -->

            <div class="fg">
                <label>Description</label>
                <textarea name="description" id="svcDesc"
                          placeholder="Brief description of what this service covers...">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="fg-row" style="margin-bottom:18px;">
                {{-- Price --}}
                <div class="fg" style="margin-bottom:0;">
                    <label>Price</label>
                    <div class="price-box">
                        <span class="price-pfx">₹</span>
                        <input type="number" name="price" id="svcPrice"
                               value="{{ old('price', 0) }}" min="0" step="0.01" placeholder="0.00">
                    </div>
                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                {{-- Status --}}
                <div class="fg" style="margin-bottom:0;">
                    <label>Status</label>
                    <label class="status-row" for="isActive">
                        <div class="tog-wrap">
                            <input type="checkbox" name="is_active" id="isActive" checked>
                            <div class="tog-track"></div>
                        </div>
                        <div class="tog-txt">
                            <strong id="statusLabel">Active</strong>
                            <span>Visible to users</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Icon Picker --}}
            <div class="fg" style="margin-bottom:0;">
                <label>Service icon</label>
                <input type="hidden" name="icon" id="iconValue" value="{{ old('icon', 'bi-gear') }}">
                <button type="button" class="icon-pick-btn" onclick="openIconPicker()">
                    <div class="icon-pick-preview">
                        <i class="bi bi-gear" id="iconBtnPreview"></i>
                    </div>
                    <div class="icon-pick-label">
                        <span id="iconBtnName">bi-gear</span>
                        <small>Click to choose an icon</small>
                    </div>
                    <i class="bi bi-chevron-right icon-pick-caret"></i>
                </button>
            </div>
        </div>

        {{-- ── Card 2: Form Fields ── --}}
        <div class="svc-card s2">
            <div class="svc-sec-head">
                <div class="svc-sec-icon"><i class="bi bi-ui-checks-grid"></i></div>
                <div><h3>Application form fields</h3><span>Fields that appear in the user's application form</span></div>
            </div>
            <div id="fieldsContainer">
                <div class="svc-empty" id="fieldsEmpty">
                    <i class="bi bi-card-list"></i>
                    <p>No fields yet — click below to add one</p>
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addField()">
                <i class="bi bi-plus-circle"></i> Add form field
            </button>
        </div>

        {{-- ── Card 3: Required Documents ── --}}
        <div class="svc-card s3">
            <div class="svc-sec-head">
                <div class="svc-sec-icon"><i class="bi bi-file-earmark-lock2-fill"></i></div>
                <div><h3>Required documents</h3><span>Documents users must upload · AES-256 encrypted</span></div>
            </div>
            <div id="docsContainer">
                <div class="svc-empty" id="docsEmpty">
                    <i class="bi bi-file-earmark"></i>
                    <p>No documents yet — click below to add one</p>
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addDoc()">
                <i class="bi bi-plus-circle"></i> Add required document
            </button>
        </div>

        <input type="hidden" name="fields"             id="fieldsJson">
        <input type="hidden" name="required_documents" id="documentsJson">

        <div class="svc-footer">
            <button type="button" class="btn-svc-primary" onclick="openModal()">
                <i class="bi bi-eye"></i> Review &amp; Create
            </button>
            <a href="{{ route('admin.services.index') }}" class="btn-svc-cancel">
                <i class="bi bi-x"></i> Cancel
            </a>
        </div>
    </form>
</div>

{{-- ══ ICON PICKER MODAL ════════════════════════════════════════ --}}
<div class="ipk-overlay" id="iconPickerModal">
    <div class="ipk-box">
        <div class="ipk-head">
            <h6><i class="bi bi-grid-3x3-gap" style="color:#e07820;margin-right:7px;"></i>Choose an icon</h6>
            <button type="button" class="ipk-close" onclick="closeIconPicker()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <div class="ipk-search-wrap">
            <div class="ipk-search">
                <i class="bi bi-search"></i>
                <input type="text" id="iconSearch" placeholder="Search icons e.g. file, user, home..." oninput="filterIcons()">
            </div>
        </div>

        <div class="ipk-cats">
            <button class="ipk-cat active" onclick="filterCat('all',this)">All</button>
            <button class="ipk-cat" onclick="filterCat('common',this)">Common</button>
            <button class="ipk-cat" onclick="filterCat('document',this)">Documents</button>
            <button class="ipk-cat" onclick="filterCat('person',this)">People</button>
            <button class="ipk-cat" onclick="filterCat('finance',this)">Finance</button>
            <button class="ipk-cat" onclick="filterCat('building',this)">Places</button>
            <button class="ipk-cat" onclick="filterCat('device',this)">Devices</button>
            <button class="ipk-cat" onclick="filterCat('arrow',this)">Arrows</button>
        </div>

        <div class="ipk-grid-wrap">
            <div class="ipk-count" id="iconCount"></div>
            <div class="ipk-grid" id="iconGrid"></div>
        </div>

        <div class="ipk-foot">
            <div class="ipk-selected-preview">
                <div class="ipk-sel-ico"><i class="bi bi-gear" id="ipkSelIco"></i></div>
                <div>
                    <div class="ipk-sel-name" id="ipkSelName">bi-gear</div>
                    <div class="ipk-sel-hint">Selected icon</div>
                </div>
            </div>
            <button type="button" class="m-btn-back" onclick="closeIconPicker()">Cancel</button>
            <button type="button" class="m-btn-yes" onclick="applyIcon()">
                <i class="bi bi-check-lg"></i> Use this icon
            </button>
        </div>
    </div>
</div>

{{-- ══ CONFIRM MODAL ════════════════════════════════════════════ --}}
<div class="svc-modal-bg" id="confirmModal">
    <div class="svc-modal">
        <div class="svc-modal-head">
            <div class="svc-modal-ico"><i class="bi bi-check2-circle"></i></div>
            <div>
                <h5>Confirm service creation</h5>
                <p>Review carefully, then click <strong>Yes, Create</strong> to save.</p>
            </div>
        </div>
        <div class="svc-modal-body">
            <div class="svc-modal-summary" id="modalSummary"></div>
        </div>
        <div class="svc-modal-foot">
            <button class="cf-yes" onclick="submitForm()">
                <i class="bi bi-check-lg"></i> Yes, Create Service
            </button>
            <button class="cf-back" onclick="closeModal()">
                <i class="bi bi-pencil"></i> Go Back &amp; Edit
            </button>
        </div>
    </div>
</div>

<script>
/* ══════════════════════════════════════════════════════════
   ICON DATA — Bootstrap Icons with categories
══════════════════════════════════════════════════════════ */
const ALL_ICONS = [
  /* common */
  {n:'bi-house-fill',c:'common building'},{n:'bi-house-door-fill',c:'common building'},{n:'bi-person-fill',c:'common person'},{n:'bi-people-fill',c:'common person'},
  {n:'bi-gear-fill',c:'common device'},{n:'bi-gear',c:'common device'},{n:'bi-star-fill',c:'common'},{n:'bi-heart-fill',c:'common'},
  {n:'bi-check-circle-fill',c:'common'},{n:'bi-x-circle-fill',c:'common'},{n:'bi-info-circle-fill',c:'common'},{n:'bi-exclamation-triangle-fill',c:'common'},
  {n:'bi-bell-fill',c:'common'},{n:'bi-search',c:'common'},{n:'bi-eye-fill',c:'common'},{n:'bi-lock-fill',c:'common'},
  {n:'bi-unlock-fill',c:'common'},{n:'bi-shield-fill',c:'common'},{n:'bi-shield-check',c:'common'},{n:'bi-plus-circle-fill',c:'common'},
  /* documents */
  {n:'bi-file-earmark-fill',c:'document'},{n:'bi-file-earmark-text-fill',c:'document'},{n:'bi-file-earmark-pdf-fill',c:'document'},
  {n:'bi-file-earmark-image-fill',c:'document'},{n:'bi-file-earmark-lock2-fill',c:'document'},{n:'bi-file-earmark-check-fill',c:'document'},
  {n:'bi-folder-fill',c:'document'},{n:'bi-folder2-open',c:'document'},{n:'bi-journal-text',c:'document'},{n:'bi-journal-check',c:'document'},
  {n:'bi-clipboard-fill',c:'document'},{n:'bi-clipboard-check-fill',c:'document'},{n:'bi-newspaper',c:'document'},{n:'bi-book-fill',c:'document'},
  {n:'bi-card-text',c:'document'},{n:'bi-card-checklist',c:'document'},{n:'bi-receipt',c:'document'},{n:'bi-receipt-cutoff',c:'document'},
  {n:'bi-file-earmark-person-fill',c:'document person'},{n:'bi-file-earmark-medical-fill',c:'document'},
  /* person */
  {n:'bi-person-circle',c:'person'},{n:'bi-person-badge-fill',c:'person document'},{n:'bi-person-check-fill',c:'person'},
  {n:'bi-person-x-fill',c:'person'},{n:'bi-person-lines-fill',c:'person document'},{n:'bi-person-workspace',c:'person device'},
  {n:'bi-person-vcard-fill',c:'person document'},{n:'bi-people-fill',c:'person'},{n:'bi-gender-male',c:'person'},{n:'bi-gender-female',c:'person'},
  /* finance */
  {n:'bi-currency-rupee',c:'finance'},{n:'bi-currency-dollar',c:'finance'},{n:'bi-currency-exchange',c:'finance'},
  {n:'bi-cash-coin',c:'finance'},{n:'bi-cash-stack',c:'finance'},{n:'bi-wallet-fill',c:'finance'},{n:'bi-wallet2',c:'finance'},
  {n:'bi-credit-card-fill',c:'finance'},{n:'bi-credit-card-2-front-fill',c:'finance'},{n:'bi-bank',c:'finance building'},
  {n:'bi-bank2',c:'finance building'},{n:'bi-piggy-bank-fill',c:'finance'},{n:'bi-graph-up-arrow',c:'finance'},{n:'bi-graph-down-arrow',c:'finance'},
  {n:'bi-bar-chart-fill',c:'finance'},{n:'bi-coin',c:'finance'},{n:'bi-safe-fill',c:'finance'},{n:'bi-percent',c:'finance'},
  /* building/place */
  {n:'bi-building-fill',c:'building'},{n:'bi-buildings-fill',c:'building'},{n:'bi-hospital-fill',c:'building'},
  {n:'bi-shop-window',c:'building'},{n:'bi-shop',c:'building'},{n:'bi-house-heart-fill',c:'building'},
  {n:'bi-geo-alt-fill',c:'building'},{n:'bi-map-fill',c:'building'},{n:'bi-signpost-fill',c:'building'},
  {n:'bi-mailbox-flag',c:'building'},{n:'bi-flag-fill',c:'building'},{n:'bi-globe',c:'building'},
  {n:'bi-globe2',c:'building'},{n:'bi-pin-map-fill',c:'building'},
  /* device */
  {n:'bi-pc-display',c:'device'},{n:'bi-laptop-fill',c:'device'},{n:'bi-phone-fill',c:'device'},
  {n:'bi-tablet-fill',c:'device'},{n:'bi-printer-fill',c:'device'},{n:'bi-camera-fill',c:'device'},
  {n:'bi-wifi',c:'device'},{n:'bi-bluetooth',c:'device'},{n:'bi-usb-drive-fill',c:'device'},
  {n:'bi-hdd-fill',c:'device'},{n:'bi-cpu-fill',c:'device'},{n:'bi-router-fill',c:'device'},
  {n:'bi-keyboard-fill',c:'device'},{n:'bi-mouse-fill',c:'device'},{n:'bi-headphones',c:'device'},
  /* arrows */
  {n:'bi-arrow-right-circle-fill',c:'arrow'},{n:'bi-arrow-left-circle-fill',c:'arrow'},
  {n:'bi-arrow-up-circle-fill',c:'arrow'},{n:'bi-arrow-down-circle-fill',c:'arrow'},
  {n:'bi-arrow-repeat',c:'arrow'},{n:'bi-arrow-clockwise',c:'arrow'},{n:'bi-arrow-counterclockwise',c:'arrow'},
  {n:'bi-box-arrow-right',c:'arrow'},{n:'bi-box-arrow-in-right',c:'arrow'},{n:'bi-send-fill',c:'arrow'},
  {n:'bi-upload',c:'arrow'},{n:'bi-download',c:'arrow'},{n:'bi-cloud-upload-fill',c:'arrow'},{n:'bi-cloud-download-fill',c:'arrow'},
  /* extra common */
  {n:'bi-award-fill',c:'common'},{n:'bi-trophy-fill',c:'common'},{n:'bi-gift-fill',c:'common'},{n:'bi-tag-fill',c:'common'},
  {n:'bi-tags-fill',c:'common'},{n:'bi-bookmark-fill',c:'common'},{n:'bi-bookmarks-fill',c:'common'},
  {n:'bi-chat-dots-fill',c:'common'},{n:'bi-chat-left-text-fill',c:'common'},{n:'bi-envelope-fill',c:'common'},
  {n:'bi-telephone-fill',c:'common'},{n:'bi-whatsapp',c:'common'},{n:'bi-share-fill',c:'common'},
  {n:'bi-qr-code-scan',c:'common document'},{n:'bi-upc-scan',c:'common'},{n:'bi-fingerprint',c:'common person'},
  {n:'bi-activity',c:'common'},{n:'bi-lightning-fill',c:'common'},{n:'bi-hammer',c:'common'},
  {n:'bi-tools',c:'common device'},{n:'bi-wrench-adjustable-fill',c:'common device'},
  {n:'bi-puzzle-fill',c:'common'},{n:'bi-grid-fill',c:'common'},{n:'bi-list-ul',c:'common'},
  {n:'bi-ui-checks',c:'common'},{n:'bi-sliders',c:'common'},{n:'bi-toggle-on',c:'common'},
  {n:'bi-power',c:'common device'},{n:'bi-translate',c:'common'},{n:'bi-magic',c:'common'},
  {n:'bi-palette-fill',c:'common'},{n:'bi-image-fill',c:'common'},{n:'bi-music-note-beamed',c:'common'},
  {n:'bi-play-circle-fill',c:'common'},{n:'bi-calendar-fill',c:'common document'},{n:'bi-calendar-check-fill',c:'common document'},
  {n:'bi-clock-fill',c:'common'},{n:'bi-alarm-fill',c:'common'},{n:'bi-stopwatch-fill',c:'common'},
];

let currentCat = 'all';
let tempIcon   = 'bi-gear';

function buildGrid(icons) {
    const grid = document.getElementById('iconGrid');
    const count = document.getElementById('iconCount');
    count.textContent = icons.length + ' icons';
    if (!icons.length) {
        grid.innerHTML = `<div class="ipk-none" style="grid-column:1/-1"><i class="bi bi-search"></i>No icons found</div>`;
        return;
    }
    grid.innerHTML = icons.map(ic => {
        const sel = ic.n === tempIcon ? 'selected' : '';
        const label = ic.n.replace('bi-','');
        return `<div class="ipk-item ${sel}" onclick="selectIcon('${ic.n}',this)" title="${ic.n}">
            <i class="bi ${ic.n}"></i>
            <span>${label}</span>
        </div>`;
    }).join('');
}

function filterIcons() {
    const q   = document.getElementById('iconSearch').value.toLowerCase().trim();
    let list  = currentCat === 'all' ? ALL_ICONS : ALL_ICONS.filter(i => i.c.includes(currentCat));
    if (q) list = list.filter(i => i.n.includes(q));
    buildGrid(list);
}

function filterCat(cat, btn) {
    currentCat = cat;
    document.querySelectorAll('.ipk-cat').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('iconSearch').value = '';
    filterIcons();
}

function selectIcon(name, el) {
    document.querySelectorAll('.ipk-item').forEach(i => i.classList.remove('selected'));
    el.classList.add('selected');
    tempIcon = name;
    document.getElementById('ipkSelIco').className  = 'bi ' + name;
    document.getElementById('ipkSelName').textContent = name;
}

function openIconPicker() {
    tempIcon = document.getElementById('iconValue').value || 'bi-gear';
    document.getElementById('iconSearch').value = '';
    currentCat = 'all';
    document.querySelectorAll('.ipk-cat').forEach((b,i) => b.classList.toggle('active', i===0));
    document.getElementById('ipkSelIco').className   = 'bi ' + tempIcon;
    document.getElementById('ipkSelName').textContent = tempIcon;
    filterIcons();
    document.getElementById('iconPickerModal').classList.add('open');
}

function closeIconPicker() {
    document.getElementById('iconPickerModal').classList.remove('open');
}

function applyIcon() {
    const val = tempIcon;
    document.getElementById('iconValue').value      = val;
    document.getElementById('iconBtnPreview').className = 'bi ' + val;
    document.getElementById('iconBtnName').textContent  = val;
    closeIconPicker();
}

document.getElementById('iconPickerModal').addEventListener('click', function(e) {
    if (e.target === this) closeIconPicker();
});

/* ══════════════════════════════════════════════════════════
   FORM FIELDS & DOCS
══════════════════════════════════════════════════════════ */
let fieldCount = 0, docCount = 0;

const FIELD_TYPES = [
    {v:'text',l:'Short Text'},{v:'textarea',l:'Long Text'},{v:'number',l:'Number'},
    {v:'email',l:'Email'},{v:'phone',l:'Phone'},{v:'date',l:'Date'},
    {v:'select',l:'Dropdown'},{v:'radio',l:'Radio Buttons'},{v:'checkbox',l:'Checkbox'},{v:'file',l:'File Upload'}
];
const DOC_TYPES = ['PDF','Image (JPG/PNG)','PDF or Image','Any File'];

function esc(s){return String(s).replace(/[&<>"']/g,m=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));}
function typeOpts(sel='text'){return FIELD_TYPES.map(t=>`<option value="${t.v}"${t.v===sel?' selected':''}>${t.l}</option>`).join('');}
function docOpts(sel='PDF'){return DOC_TYPES.map(t=>`<option${t===sel?' selected':''}>${t}</option>`).join('');}

function hideEmpty(id){const e=document.getElementById(id);if(e)e.style.display='none';}
function checkEmpty(cid,eid,cls){const e=document.getElementById(eid);if(!e)return;e.style.display=document.querySelectorAll('#'+cid+' .'+cls).length?'none':'';}

function addField(data={}){
    hideEmpty('fieldsEmpty');
    fieldCount++;
    const n=fieldCount;
    const div=document.createElement('div');
    div.className='field-row';div.id='f'+n;
    div.innerHTML=`
        <div>
            <div class="fi-lbl">Field label</div>
            <input type="text" class="fi-inp field-label" placeholder="e.g. Full Name" value="${esc(data.label||'')}" required>
            <input type="text" class="fi-inp sm field-placeholder" placeholder="Placeholder text (optional)" value="${esc(data.placeholder||'')}">
        </div>
        <div>
            <div class="fi-lbl">Field type</div>
            <select class="fi-sel field-type">${typeOpts(data.type||'text')}</select>
            <div class="req-chk">
                <input type="checkbox" id="req${n}" class="field-required" ${data.required!==false?'checked':''}>
                <label for="req${n}">Required field</label>
            </div>
        </div>
        <button type="button" class="rm-btn" onclick="removeEl('f${n}','fieldsContainer','fieldsEmpty','field-row')" title="Remove">
            <i class="bi bi-x-lg"></i>
        </button>`;
    document.getElementById('fieldsContainer').appendChild(div);
}

function addDoc(data={}){
    hideEmpty('docsEmpty');
    docCount++;
    const n=docCount;
    const div=document.createElement('div');
    div.className='doc-row';div.id='d'+n;
    div.innerHTML=`
        <div class="doc-row-head">
            <span class="doc-num"><i class="bi bi-file-earmark-text"></i> Document ${n}</span>
            <button type="button" class="rm-btn" onclick="removeEl('d${n}','docsContainer','docsEmpty','doc-row')" title="Remove">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="doc-body">
            <div>
                <div class="fi-lbl">Document title</div>
                <input type="text" class="fi-inp doc-name" placeholder="e.g. Aadhaar Card" value="${esc(data.name||'')}" required>
                <div style="margin-top:10px;">
                    <div class="fi-lbl">Accepted format</div>
                    <select class="fi-sel doc-type">${docOpts(data.doctype||'PDF')}</select>
                </div>
            </div>
            <div>
                <div class="fi-lbl">Upload slot</div>
                <label class="upload-area">
                    <i class="bi bi-cloud-upload"></i>
                    <span id="ul${n}">Click to choose file</span>
                    <input type="file" onchange="setUlLabel(this,'ul${n}')">
                </label>
                <div class="enc-note">
                    <i class="bi bi-shield-lock-fill"></i> AES-256 encrypted on upload
                </div>
            </div>
        </div>`;
    document.getElementById('docsContainer').appendChild(div);
}

function setUlLabel(inp,id){const e=document.getElementById(id);if(e&&inp.files[0])e.textContent=inp.files[0].name;}
function removeEl(id,cid,eid,cls){const el=document.getElementById(id);if(el)el.remove();checkEmpty(cid,eid,cls);}

document.getElementById('isActive').addEventListener('change',function(){
    document.getElementById('statusLabel').textContent=this.checked?'Active':'Inactive';
});

function collectFields(){
    return[...document.querySelectorAll('#fieldsContainer .field-row')].map(r=>({
        label:r.querySelector('.field-label').value.trim(),
        placeholder:r.querySelector('.field-placeholder').value.trim(),
        type:r.querySelector('.field-type').value,
        required:r.querySelector('.field-required').checked
    }));
}
function collectDocs(){
    return[...document.querySelectorAll('#docsContainer .doc-row')].map(r=>({
        name:r.querySelector('.doc-name').value.trim(),
        doctype:r.querySelector('.doc-type').value
    }));
}

function openModal(){
    const form=document.getElementById('serviceForm');
    if(!form.checkValidity()){form.reportValidity();return;}
    const fields=collectFields(),docs=collectDocs();
    for(const f of fields)if(!f.label){alert('Please fill in all field labels.');return;}
    for(const d of docs)if(!d.name){alert('Please fill in all document names.');return;}

    const name=document.getElementById('svcName').value;
    const formTitle = name;
    const price=document.getElementById('svcPrice').value;
    const active=document.getElementById('isActive').checked;
    const icon=document.getElementById('iconValue').value;

    let html=`<div style="display:grid;gap:6px;">
        <div><strong>Service name:</strong> ${esc(name)}</div>
        <div><strong>Form title:</strong> ${esc(formTitle)}</div>
        <div><strong>Price:</strong> ₹${parseFloat(price||0).toLocaleString('en-IN')}</div>
        <div><strong>Icon:</strong> <i class="bi ${icon}" style="margin-right:4px;color:#e07820;"></i>${icon}</div>
        <div><strong>Status:</strong> ${active?'<span style="color:#16a34a;font-weight:600;">● Active</span>':'<span style="color:#ef4444;font-weight:600;">● Inactive</span>'}</div>
    </div>`;

    if(fields.length){
        html+=`<div style="margin-top:12px;font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:.05em;">Form Fields (${fields.length})</div><ul style="margin:6px 0 0 16px;padding:0;font-size:12.5px;">`;
        fields.forEach(f=>{html+=`<li>${esc(f.label)} <span style="color:#9ca3af;">(${f.type} · ${f.required?'required':'optional'})</span></li>`;});
        html+=`</ul>`;
    }else{html+=`<div style="margin-top:10px;font-size:12.5px;color:#c4c9d4;">⚠ No form fields added.</div>`;}

    if(docs.length){
        html+=`<div style="margin-top:12px;font-size:11px;font-weight:700;color:#6b7280;text-transform:uppercase;letter-spacing:.05em;">Required Documents (${docs.length})</div><ul style="margin:6px 0 0 16px;padding:0;font-size:12.5px;">`;
        docs.forEach(d=>{html+=`<li>${esc(d.name)} <span style="color:#9ca3af;">(${d.doctype})</span></li>`;});
        html+=`</ul>`;
    }else{html+=`<div style="margin-top:10px;font-size:12.5px;color:#c4c9d4;">No documents required.</div>`;}

    document.getElementById('modalSummary').innerHTML=html;
    document.getElementById('confirmModal').classList.add('open');
}

function closeModal(){document.getElementById('confirmModal').classList.remove('open');}

function submitForm(){
    document.getElementById('fieldsJson').value=JSON.stringify(collectFields());
    document.getElementById('documentsJson').value=JSON.stringify(collectDocs());
    document.getElementById('serviceForm').submit();
}

document.getElementById('confirmModal').addEventListener('click',function(e){if(e.target===this)closeModal();});

addField();
addDoc();
</script>
@endsection