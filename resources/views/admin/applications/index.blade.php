@extends('layouts.admin')
@section('title', 'Applications')
@section('page-title', 'Applications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 style="font-size:18px;font-weight:800;margin:0;">All Applications</h4>
        <p style="color:var(--grey);font-size:13px;margin-top:2px;">Manage and update application statuses</p>
    </div>
</div>

<div class="card">
    <div class="card-body-custom p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Service</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    @php
                        $fieldsData    = is_string($app->fields_data)    ? json_decode($app->fields_data, true)    : ($app->fields_data ?? []);
                        $documentsData = is_string($app->documents_data) ? json_decode($app->documents_data, true) : ($app->documents_data ?? []);
                    @endphp
                    <tr>
                        <td style="color:var(--grey);font-size:12.5px;">{{ $app->id }}</td>
                        <td>
                            <div style="font-weight:600;font-size:13.5px;">{{ $app->user->full_name }}</div>
                            <div style="font-size:12px;color:var(--grey);">{{ $app->user->email }}</div>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div style="width:30px;height:30px;border-radius:8px;background:var(--orange-soft);display:flex;align-items:center;justify-content:center;color:var(--orange);font-size:14px;">
                                    <i class="bi {{ $app->service->icon ?? 'bi-gear' }}"></i>
                                </div>
                                <span style="font-weight:600;font-size:13.5px;">{{ $app->service->name }}</span>
                            </div>
                        </td>
                        <td style="font-size:13px;color:var(--grey);">{{ $app->created_at->format('d M Y') }}</td>
                        <td><span class="{{ $app->status_badge }}">{{ $app->status_label }}</span></td>

                        {{-- View Details Button --}}
                        <td>
                            <button
                                type="button"
                                class="btn-view-details"
                                onclick="openModal({{ $app->id }})"
                                style="background:var(--orange-soft);color:var(--orange);border:none;border-radius:8px;padding:5px 12px;font-size:12.5px;font-weight:600;cursor:pointer;">
                                <i class="bi bi-eye me-1"></i> View
                            </button>
                        </td>

                        <td>
                            <form method="POST" action="{{ route('admin.applications.status', $app) }}" class="d-flex gap-2 align-items-center">
                                @csrf @method('PATCH')
                                <select name="status" class="form-control" style="width:140px;padding:5px 10px;font-size:12.5px;">
                                    <option value="pending"     {{ $app->status === 'pending'     ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ $app->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed"   {{ $app->status === 'completed'   ? 'selected' : '' }}>Completed</option>
                                </select>
                                <button type="submit" class="btn-sm-orange">Update</button>
                            </form>
                        </td>
                    </tr>

                    {{-- Hidden Modal Data (JSON encoded safely) --}}
                    <script>
                        window._appData = window._appData || {};
                        window._appData[{{ $app->id }}] = {
                            id:        {{ $app->id }},
                            user:      "{{ $app->user->full_name }}",
                            email:     "{{ $app->user->email }}",
                            service:   "{{ $app->service->name }}",
                            status:    "{{ $app->status_label }}",
                            notes:     {!! json_encode($app->notes ?? '') !!},
                            fields:    {!! json_encode($fieldsData ?? []) !!},
                            documents: {!! json_encode($documentsData ?? []) !!}
                        };
                    </script>

                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:40px;color:var(--grey);">No applications found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div style="padding:16px 22px;border-top:1px solid var(--grey-light);">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>

{{-- ==================== MODAL ==================== --}}
<div id="appDetailModal" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.45);backdrop-filter:blur(3px);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:680px;max-height:88vh;overflow-y:auto;margin:16px;box-shadow:0 20px 60px rgba(0,0,0,0.2);">

        {{-- Modal Header --}}
        <div style="padding:20px 24px 16px;border-bottom:1px solid #f0f0f0;display:flex;justify-content:space-between;align-items:center;position:sticky;top:0;background:#fff;z-index:1;border-radius:16px 16px 0 0;">
            <div>
                <h5 id="modalTitle" style="margin:0;font-size:16px;font-weight:800;">Application Details</h5>
                <p id="modalSubtitle" style="margin:2px 0 0;font-size:12px;color:var(--grey);"></p>
            </div>
            <button onclick="closeModal()" style="background:none;border:none;font-size:20px;cursor:pointer;color:#999;line-height:1;">&times;</button>
        </div>

        <div style="padding:22px 24px;">

            {{-- User & Service Info --}}
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px;">
                <div style="background:#f8f9fa;border-radius:10px;padding:12px 14px;">
                    <div style="font-size:11px;color:var(--grey);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">User</div>
                    <div id="modalUser" style="font-weight:700;font-size:13.5px;"></div>
                    <div id="modalEmail" style="font-size:12px;color:var(--grey);"></div>
                </div>
                <div style="background:#f8f9fa;border-radius:10px;padding:12px 14px;">
                    <div style="font-size:11px;color:var(--grey);text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">Service</div>
                    <div id="modalService" style="font-weight:700;font-size:13.5px;"></div>
                    <div id="modalStatus" style="font-size:12px;"></div>
                </div>
            </div>

            {{-- Notes --}}
            <div id="modalNotesWrap" style="margin-bottom:20px;display:none;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--grey);margin-bottom:8px;">
                    <i class="bi bi-chat-left-text me-1"></i> User Note
                </div>
                <div id="modalNotes" style="background:#fffbf0;border:1px solid #ffe082;border-radius:10px;padding:12px 14px;font-size:13px;color:#7a6000;"></div>
            </div>

            {{-- Fields Data --}}
            <div id="modalFieldsWrap" style="margin-bottom:20px;">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--grey);margin-bottom:10px;">
                    <i class="bi bi-ui-checks me-1"></i> Submitted Fields
                </div>
                <div id="modalFields"></div>
            </div>

            {{-- Documents --}}
            <div id="modalDocsWrap">
                <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.5px;color:var(--grey);margin-bottom:10px;">
                    <i class="bi bi-paperclip me-1"></i> Uploaded Documents
                </div>
                <div id="modalDocs"></div>
            </div>

        </div>
    </div>
</div>

<script>
function openModal(appId) {
    const data = window._appData[appId];
    if (!data) return;

    document.getElementById('modalTitle').textContent    = 'Application #' + data.id;
    document.getElementById('modalSubtitle').textContent = data.service + ' — ' + data.status;
    document.getElementById('modalUser').textContent     = data.user;
    document.getElementById('modalEmail').textContent    = data.email;
    document.getElementById('modalService').textContent  = data.service;
    document.getElementById('modalStatus').innerHTML     = '<span style="font-size:12px;">' + data.status + '</span>';

    // Notes
    const notesWrap = document.getElementById('modalNotesWrap');
    if (data.notes && data.notes.trim() !== '') {
        document.getElementById('modalNotes').textContent = data.notes;
        notesWrap.style.display = 'block';
    } else {
        notesWrap.style.display = 'none';
    }

    // Fields
    const fieldsEl = document.getElementById('modalFields');
    fieldsEl.innerHTML = '';
    if (data.fields && data.fields.length > 0) {
        data.fields.forEach(function(f) {
            const val = (f.value !== undefined && f.value !== null && f.value !== '') ? f.value : '<span style="color:#bbb;">—</span>';
            fieldsEl.innerHTML += `
                <div style="display:grid;grid-template-columns:160px 1fr;gap:8px;align-items:start;padding:9px 12px;border-radius:8px;background:#f8f9fa;margin-bottom:7px;">
                    <div style="font-size:12px;font-weight:600;color:#555;">${escHtml(f.label ?? '')}</div>
                    <div style="font-size:13px;color:#222;word-break:break-word;">${escHtml(String(f.value ?? '')) || '<span style="color:#bbb;">—</span>'}</div>
                </div>`;
        });
        document.getElementById('modalFieldsWrap').style.display = 'block';
    } else {
        document.getElementById('modalFieldsWrap').style.display = 'none';
    }

    // Documents
    const docsEl = document.getElementById('modalDocs');
    docsEl.innerHTML = '';
    if (data.documents && data.documents.length > 0) {
        data.documents.forEach(function(doc) {
            const isImage = doc.doctype && doc.doctype.toLowerCase().includes('image');
            // Baad mein:
            const fileUrl = '/admin/file/' + (doc.path ?? '').replace(/\\/g, '/');
            const iconHtml = isImage
                ? `<i class="bi bi-file-image" style="font-size:22px;color:var(--orange);"></i>`
                : `<i class="bi bi-file-earmark" style="font-size:22px;color:var(--orange);"></i>`;

            docsEl.innerHTML += `
                <div style="display:flex;align-items:center;gap:12px;padding:10px 14px;border-radius:10px;background:#f8f9fa;margin-bottom:8px;border:1px solid #eee;">
                    <div style="width:40px;height:40px;border-radius:8px;background:var(--orange-soft);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        ${iconHtml}
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:700;font-size:13px;">${escHtml(doc.name ?? '')}</div>
                        <div style="font-size:11.5px;color:var(--grey);white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${escHtml(doc.original_name ?? '')}</div>
                        <div style="font-size:11px;color:#bbb;">${escHtml(doc.doctype ?? '')}</div>
                    </div>
                    <a href="${fileUrl}" target="_blank" style="background:var(--orange-soft);color:var(--orange);border-radius:7px;padding:5px 10px;font-size:12px;font-weight:600;text-decoration:none;white-space:nowrap;">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Open
                    </a>
                </div>`;
        });
        document.getElementById('modalDocsWrap').style.display = 'block';
    } else {
        document.getElementById('modalDocsWrap').style.display = 'none';
    }

    const modal = document.getElementById('appDetailModal');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('appDetailModal').style.display = 'none';
    document.body.style.overflow = '';
}

// Close on backdrop click
document.getElementById('appDetailModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});

// Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeModal();
});

function escHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}
</script>
@endsection