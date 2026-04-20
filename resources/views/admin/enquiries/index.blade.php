@extends('layouts.admin')
@section('title', 'Contact Enquiries')
@section('page-title', 'Contact Enquiries')

@section('content')
<div class="card">
    <div class="card-header-custom">
        <div>
            <h5>All Contact Enquiries</h5>
            <p>All messages sent by users.</p>
        </div>
    </div>
    <div class="card-body-custom">
        @forelse($enquiries as $enquiry)
            <div class="app-row">
                <div class="app-icon">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <div class="app-row-info">
                    <div class="title" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        {{ $enquiry->name }}
                        @if($enquiry->service)
                            <span style="
                                display: inline-flex;
                                align-items: center;
                                gap: 5px;
                                font-size: 11.5px;
                                font-weight: 500;
                                padding: 3px 10px;
                                border-radius: 20px;
                                background: #E6F1FB;
                                color: #0C447C;
                                border: 0.5px solid #B5D4F4;
                                white-space: nowrap;
                            ">
                                <span style="width:6px;height:6px;border-radius:50%;background:#378ADD;display:inline-block;flex-shrink:0;"></span>
                                {{ $enquiry->service }}
                            </span>
                        @endif
                    </div>
                    <div class="meta">
                        {{ $enquiry->phone }} &middot; {{ $enquiry->email }} &middot; {{ $enquiry->created_at->format('Y-m-d') }}
                    </div>
                    <div style="font-size:13px;color:#444;margin-top:3px;">
                        {{ $enquiry->message }}
                    </div>
                </div>
                <span style="
                    font-size:11px;padding:3px 10px;border-radius:20px;
                    background:#e8f5e9;color:#2e7d32;white-space:nowrap;
                ">{{ ucfirst($enquiry->type ?? 'enquiry') }}</span>
            </div>
        @empty
            <p style="color:var(--grey);text-align:center;padding:30px 0;font-size:13.5px;">No inquiries were received.</p>
        @endforelse

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $enquiries->links() }}
        </div>
    </div>
</div>
@endsection