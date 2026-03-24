{{--
    resources/views/admin/services/edit.blade.php
--}}
@extends('layouts.admin')
@section('title', 'Edit Service')
@section('page-title', 'Edit Service')

@push('styles')
<style>
    .field-row {
        display: grid;
        grid-template-columns: 1fr 140px 120px auto;
        gap: 10px; align-items: start;
        background: var(--bg-soft, #f9f9f9);
        border: 1px solid var(--grey-light, #e5e7eb);
        border-radius: 10px; padding: 12px 14px; margin-bottom: 10px;
        transition: box-shadow .2s;
    }
    .field-row:hover { box-shadow: 0 2px 8px rgba(0,0,0,.07); }
    .field-row .form-control { font-size: 13px; }
    .field-required-toggle {
        display: flex; flex-direction: column;
        align-items: center; gap: 4px; padding-top: 6px;
    }
    .field-required-toggle span { font-size: 10.5px; color: var(--grey); }
    .toggle-switch { position: relative; width: 36px; height: 20px; }
    .toggle-switch input { opacity: 0; width: 0; height: 0; }
    .toggle-slider {
        position: absolute; inset: 0; background: #ccc;
        border-radius: 20px; cursor: pointer; transition: .2s;
    }
    .toggle-slider::before {
        content: ''; position: absolute;
        width: 14px; height: 14px; left: 3px; bottom: 3px;
        background: white; border-radius: 50%; transition: .2s;
    }
    .toggle-switch input:checked + .toggle-slider { background: var(--orange, #f97316); }
    .toggle-switch input:checked + .toggle-slider::before { transform: translateX(16px); }
    .remove-field-btn {
        background: none; border: none; color: #e53e3e;
        font-size: 17px; cursor: pointer; padding: 6px 4px;
        border-radius: 6px; transition: background .15s; line-height: 1;
    }
    .remove-field-btn:hover { background: #fef2f2; }
    .doc-row {
        display: grid; grid-template-columns: 1fr 160px auto;
        gap: 10px; align-items: center;
        background: var(--bg-soft, #f9f9f9);
        border: 1px solid var(--grey-light, #e5e7eb);
        border-radius: 10px; padding: 11px 14px; margin-bottom: 10px;
        transition: box-shadow .2s;
    }
    .doc-row:hover { box-shadow: 0 2px 8px rgba(0,0,0,.07); }
    .badge-enc {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 11px; background: #ecfdf5; color: #059669;
        border: 1px solid #a7f3d0; border-radius: 6px;
        padding: 3px 8px; white-space: nowrap;
    }
    .add-row-btn {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        background: none; border: 2px dashed var(--orange, #f97316);
        color: var(--orange, #f97316); padding: 8px 16px;
        border-radius: 9px; transition: background .15s;
        width: 100%; justify-content: center; margin-top: 4px;
    }
    .add-row-btn:hover { background: var(--orange-soft, #fff7ed); }
    .section-label {
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .08em; color: var(--grey);
        margin: 20px 0 10px; display: flex; align-items: center; gap: 8px;
    }
    .section-label::after { content: ''; flex: 1; height: 1px; background: var(--grey-light, #e5e7eb); }
    .confirm-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,.5); backdrop-filter: blur(4px);
        z-index: 9999; align-items: center; justify-content: center;
    }
    .confirm-overlay.active { display: flex; }
    .confirm-box {
        background: #fff; border-radius: 18px;
        padding: 36px 32px; width: 460px; max-width: 95vw;
        box-shadow: 0 24px 64px rgba(0,0,0,.2);
        animation: popIn .22s cubic-bezier(.34,1.56,.64,1);
        max-height: 90vh; overflow-y: auto;
    }
    @keyframes popIn {
        from { transform: scale(.88); opacity: 0; }
        to   { transform: scale(1);   opacity: 1; }
    }
    .confirm-box h5 { font-size: 18px; font-weight: 800; margin-bottom: 6px; }
    .confirm-box p  { font-size: 13.5px; color: var(--grey); margin-bottom: 20px; }
    .confirm-summary {
        background: var(--bg-soft, #f9f9f9);
        border: 1px solid var(--grey-light, #e5e7eb);
        border-radius: 10px; padding: 16px 18px; margin-bottom: 22px;
        font-size: 13px; line-height: 1.8;
    }
    .confirm-actions { display: flex; gap: 10px; }
    .confirm-actions .btn-orange { flex: 1; justify-content: center; }
    .confirm-actions .btn-dark   { flex: 1; justify-content: center; text-align: center; }
    #icon-preview {
        width: 38px; height: 38px; border-radius: 10px;
        background: var(--orange-soft, #fff7ed); color: var(--orange, #f97316);
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 19px; vertical-align: middle; margin-left: 8px;
        border: 1px solid var(--grey-light, #e5e7eb);
    }
    .field-row.dragging { opacity: .4; }
    @media (max-width: 600px) {
        .field-row { grid-template-columns: 1fr 110px auto; }
        .field-row .field-type { grid-column: 1 / -1; }
    }
</style>
@endpush

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" style="color:var(--grey);font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
</div>

<div class="card" style="max-width:740px;">
    <div class="card-header-custom">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;">
            <div>
                <h5>Edit Service</h5>
                <p>Update fields, documents, pricing and visibility</p>
            </div>
            <a href="{{ route('admin.services.show', $service) }}"
               class="btn-dark" style="font-size:12.5px;padding:7px 14px;">
                <i class="bi bi-eye"></i> Preview Form
            </a>
        </div>
    </div>
    <div class="card-body-custom">

        <form id="serviceForm" method="POST" action="{{ route('admin.services.update', $service) }}">
            @csrf @method('PUT')

            <div class="section-label"><i class="bi bi-info-circle"></i> Basic Information</div>

            <div class="form-group">
                <label class="form-label">Service Name <span style="color:#e53e3e;">*</span></label>
                <input type="text" name="name" id="svcName"
                       value="{{ old('name', $service->name) }}"
                       class="form-control @error('name') is-invalid @enderror" required>
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">
                    Application Form Title
                    <span style="font-size:11.5px;color:var(--grey);font-weight:400;margin-left:6px;">
                        — heading users see on the form
                    </span>
                </label>
                <input type="text" name="form_title" id="formTitle"
                       value="{{ old('form_title', $service->form_title) }}"
                       class="form-control @error('form_title') is-invalid @enderror"
                       placeholder="e.g. Apply for PAN Card">
                @error('form_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" name="price" id="svcPrice"
                               value="{{ old('price', $service->price) }}" min="0" step="0.01"
                               class="form-control @error('price') is-invalid @enderror">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Bootstrap Icon Class</label>
                        <div style="display:flex;align-items:center;">
                            <input type="text" name="icon" id="iconInput"
                                   value="{{ old('icon', $service->icon) }}"
                                   class="form-control @error('icon') is-invalid @enderror"
                                   placeholder="e.g. bi-credit-card" style="flex:1;">
                            <span id="icon-preview">
                                <i class="bi {{ old('icon', $service->icon) }}" id="iconPreviewIcon"></i>
                            </span>
                        </div>
                        <div style="font-size:11.5px;color:var(--grey);margin-top:4px;">
                            Browse at <a href="https://icons.getbootstrap.com" target="_blank"
                                         style="color:var(--orange);">icons.getbootstrap.com</a>
                        </div>
                        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="is_active" id="isActive"
                           {{ $service->is_active ? 'checked' : '' }}
                           style="width:16px;height:16px;accent-color:var(--orange);">
                    <span class="form-label" style="margin:0;">Active (visible to users on frontend)</span>
                </label>
            </div>

            {{-- ── 2. Form Fields ─────────────────────────────── --}}
            <div class="section-label" style="margin-top:28px;">
                <i class="bi bi-ui-checks"></i> Application Form Fields
            </div>
            <p style="font-size:12.5px;color:var(--grey);margin:-4px 0 14px;">
                Drag rows to reorder. Changes take effect after saving.
            </p>
            <div id="fieldsContainer"></div>
            <button type="button" class="add-row-btn" onclick="addField()">
                <i class="bi bi-plus-lg"></i> Add Form Field
            </button>

            {{-- ── 3. Required Documents ──────────────────────── --}}
            <div class="section-label" style="margin-top:30px;">
                <i class="bi bi-file-earmark-lock2"></i> Required Documents
            </div>
            <p style="font-size:12.5px;color:var(--grey);margin:-4px 0 14px;">
                All uploads are <strong>AES-256 encrypted</strong>.
            </p>
            <div id="docsContainer"></div>
            <button type="button" class="add-row-btn" onclick="addDocument()">
                <i class="bi bi-plus-lg"></i> Add Required Document
            </button>

            <input type="hidden" name="fields_json"    id="fieldsJson">
            <input type="hidden" name="documents_json" id="documentsJson">

            <div class="d-flex gap-2 mt-4">
                <button type="button" class="btn-orange" onclick="openConfirm()">
                    <i class="bi bi-eye"></i> Review & Save
                </button>
                <a href="{{ route('admin.services.show', $service) }}" class="btn-dark">
                    <i class="bi bi-eye"></i> Preview
                </a>
                <a href="{{ route('admin.services.index') }}" class="btn-dark">Cancel</a>
            </div>
        </form>

    </div>
</div>

{{-- Confirmation Modal --}}
<div class="confirm-overlay" id="confirmOverlay">
    <div class="confirm-box">
        <h5>
            <i class="bi bi-pencil-square" style="color:var(--orange);margin-right:8px;"></i>
            Confirm Changes
        </h5>
        <p>Review the updated service before saving.</p>
        <div class="confirm-summary" id="confirmSummary"></div>
        <div class="confirm-actions">
            <button class="btn-orange" onclick="submitForm()">
                <i class="bi bi-check-lg"></i> Yes, Save Changes
            </button>
            <button class="btn-dark" onclick="closeConfirm()">
                <i class="bi bi-x"></i> Go Back & Edit
            </button>
        </div>
    </div>
</div>

{{-- Pass existing service data to JS --}}
<script>
    const existingFields = @json($service->fields ?? []);
    const existingDocs   = @json($service->required_documents ?? []);
</script>
@endsection

@push('scripts')
<script>
let fieldIndex = 0;
let docIndex   = 0;

const FIELD_TYPES = [
    { v: 'text',     l: 'Short Text'    },
    { v: 'textarea', l: 'Long Text'     },
    { v: 'number',   l: 'Number'        },
    { v: 'email',    l: 'Email'         },
    { v: 'phone',    l: 'Phone'         },
    { v: 'date',     l: 'Date'          },
    { v: 'select',   l: 'Dropdown'      },
    { v: 'radio',    l: 'Radio Buttons' },
    { v: 'checkbox', l: 'Checkbox'      },
    { v: 'file',     l: 'File Upload'   },
];
const DOC_TYPES = ['PDF', 'Image (JPG/PNG)', 'PDF or Image', 'Any File'];

function typeOptions(selected = 'text') {
    return FIELD_TYPES.map(t =>
        `<option value="${t.v}" ${t.v === selected ? 'selected' : ''}>${t.l}</option>`
    ).join('');
}
function docTypeOptions(selected = 'PDF') {
    return DOC_TYPES.map(t =>
        `<option value="${t}" ${t === selected ? 'selected' : ''}>${t}</option>`
    ).join('');
}

function addField(data = {}) {
    const label       = data.label       || '';
    const type        = data.type        || 'text';
    const required    = data.required    !== false;
    const placeholder = data.placeholder || '';

    const row = document.createElement('div');
    row.className = 'field-row';
    row.draggable = true;
    row.innerHTML = `
        <div style="display:flex;flex-direction:column;gap:6px;">
            <input type="text" class="form-control field-label"
                   placeholder="Field label e.g. Full Name"
                   value="${escHtml(label)}" required>
            <input type="text" class="form-control field-placeholder"
                   placeholder="Placeholder text (optional)"
                   value="${escHtml(placeholder)}" style="font-size:12px;">
        </div>
        <select class="form-control field-type">${typeOptions(type)}</select>
        <div class="field-required-toggle">
            <label class="toggle-switch">
                <input type="checkbox" class="field-required" ${required ? 'checked' : ''}>
                <span class="toggle-slider"></span>
            </label>
            <span>Required</span>
        </div>
        <button type="button" class="remove-field-btn" onclick="removeRow(this, 'field-row')">
            <i class="bi bi-x-lg"></i>
        </button>
    `;
    setupDrag(row);
    document.getElementById('fieldsContainer').appendChild(row);
    fieldIndex++;
}

function addDocument(data = {}) {
    const name    = data.name    || '';
    const doctype = data.doctype || 'PDF';

    const row = document.createElement('div');
    row.className = 'doc-row';
    row.innerHTML = `
        <input type="text" class="form-control doc-name"
               placeholder="Document name e.g. Aadhaar Card"
               value="${escHtml(name)}" required>
        <select class="form-control doc-type">${docTypeOptions(doctype)}</select>
        <div style="display:flex;align-items:center;gap:8px;">
            <span class="badge-enc"><i class="bi bi-shield-lock-fill"></i> AES-256</span>
            <button type="button" class="remove-field-btn" onclick="removeRow(this, 'doc-row')">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    `;
    document.getElementById('docsContainer').appendChild(row);
    docIndex++;
}

function removeRow(btn, cls) { btn.closest('.' + cls).remove(); }

let dragSrc = null;
function setupDrag(el) {
    el.addEventListener('dragstart', e => {
        dragSrc = el; el.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
    });
    el.addEventListener('dragend', () => {
        el.classList.remove('dragging'); dragSrc = null;
    });
    el.addEventListener('dragover', e => {
        e.preventDefault();
        if (dragSrc && dragSrc !== el) {
            const rows = [...document.querySelectorAll('#fieldsContainer .field-row')];
            if (rows.indexOf(dragSrc) < rows.indexOf(el)) el.after(dragSrc);
            else el.before(dragSrc);
        }
    });
}

function escHtml(s) {
    return String(s).replace(/[&<>"']/g, m =>
        ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[m])
    );
}

function collectFields() {
    return [...document.querySelectorAll('#fieldsContainer .field-row')].map(row => ({
        label:       row.querySelector('.field-label').value.trim(),
        placeholder: row.querySelector('.field-placeholder').value.trim(),
        type:        row.querySelector('.field-type').value,
        required:    row.querySelector('.field-required').checked,
    }));
}
function collectDocs() {
    return [...document.querySelectorAll('#docsContainer .doc-row')].map(row => ({
        name:    row.querySelector('.doc-name').value.trim(),
        doctype: row.querySelector('.doc-type').value,
    }));
}

document.getElementById('iconInput').addEventListener('input', function () {
    document.getElementById('iconPreviewIcon').className = 'bi ' + this.value.trim();
});

function openConfirm() {
    const form = document.getElementById('serviceForm');
    if (!form.checkValidity()) { form.reportValidity(); return; }

    const fields = collectFields();
    const docs   = collectDocs();
    for (const f of fields) if (!f.label) { alert('Please fill in all field labels.'); return; }
    for (const d of docs)   if (!d.name)  { alert('Please fill in all document names.'); return; }

    const name      = document.getElementById('svcName').value;
    const formTitle = document.getElementById('formTitle').value || name;
    const price     = document.getElementById('svcPrice').value;
    const active    = document.getElementById('isActive').checked;

    let html = `
        <div><strong>Service Name:</strong> ${escHtml(name)}</div>
        <div><strong>Form Title:</strong> ${escHtml(formTitle)}</div>
        <div><strong>Price:</strong> ₹${parseFloat(price || 0).toLocaleString('en-IN')}</div>
        <div><strong>Status:</strong> ${active ? '🟢 Active' : '🔴 Inactive'}</div>
    `;
    if (fields.length) {
        html += `<div style="margin-top:10px;"><strong>Fields (${fields.length}):</strong></div>
                 <ul style="margin:4px 0 0 18px;padding:0;font-size:12.5px;">`;
        fields.forEach(f => {
            html += `<li>${escHtml(f.label)} <span style="color:#6b7280;">(${f.type}${f.required ? ' · required' : ''})</span></li>`;
        });
        html += `</ul>`;
    }
    if (docs.length) {
        html += `<div style="margin-top:10px;"><strong>Documents (${docs.length}):</strong></div>
                 <ul style="margin:4px 0 0 18px;padding:0;font-size:12.5px;">`;
        docs.forEach(d => {
            html += `<li>${escHtml(d.name)} <span style="color:#6b7280;">(${d.doctype})</span></li>`;
        });
        html += `</ul>`;
    }

    document.getElementById('confirmSummary').innerHTML = html;
    document.getElementById('confirmOverlay').classList.add('active');
}

function closeConfirm() {
    document.getElementById('confirmOverlay').classList.remove('active');
}
function submitForm() {
    document.getElementById('fieldsJson').value    = JSON.stringify(collectFields());
    document.getElementById('documentsJson').value = JSON.stringify(collectDocs());
    document.getElementById('serviceForm').submit();
}

document.getElementById('confirmOverlay').addEventListener('click', function (e) {
    if (e.target === this) closeConfirm();
});

// Pre-populate from existing service data
if (existingFields && existingFields.length) {
    existingFields.forEach(f => addField(f));
} else {
    addField();
}
if (existingDocs && existingDocs.length) {
    existingDocs.forEach(d => addDocument(d));
} else {
    addDocument();
}
</script>
@endpush
