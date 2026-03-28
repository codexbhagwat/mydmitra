@extends('layouts.app')

@section('title', 'Document Services - D-Mitra Service Center')

@section('content')

{{-- Page Header --}}
<section style="background: #f0ede8; padding: 50px 0 30px;">
    <div class="container">
        <div class="text-center mb-4">
            <span style="background: #fff3e0; color: #e65100; border: 1px solid #ffcc80; border-radius: 20px; padding: 6px 16px; font-size: 14px; font-weight: 500;">
                📄 Certified Document Services
            </span>
        </div>
        <h1 class="text-center fw-bold" style="color: #1a2340; font-size: 2.5rem;">Document Services</h1>
        <p class="text-center text-muted mt-2">Professional document preparation, printing, scanning, notarization and more — all under one roof.</p>
    </div>
</section>

{{-- Filter Tabs --}}
<section style="background: #f0ede8; padding: 30px 0 20px;">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-2">
            <button class="filter-btn active" data-filter="all">All Services</button>
            <button class="filter-btn" data-filter="print">Printing & Scan</button>
            <button class="filter-btn" data-filter="typing">Typing & Forms</button>
            <button class="filter-btn" data-filter="legal">Legal & Notary</button>
            <button class="filter-btn" data-filter="online">Online Forms</button>
        </div>
    </div>
</section>

{{-- Services Grid --}}
<section style="background: #f0ede8; padding: 20px 0 60px;">
    <div class="container">
        <div class="row g-4">

            {{-- Photocopy & Scan --}}
            <div class="col-md-4 service-card-wrap" data-category="print">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-printer"></i>
                    </div>
                    <h5 class="service-title">Photocopy & Scanning</h5>
                    <p class="service-desc">High-quality black & white and colour photocopies. Document scanning to PDF/JPG for digital storage and sharing.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Instant</span>
                        <span class="service-price">₹2/page</span>
                    </div>
                    <a href="{{ route('services.apply', 'photocopy') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Lamination --}}
            <div class="col-md-4 service-card-wrap" data-category="print">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-layers"></i>
                    </div>
                    <h5 class="service-title">Lamination</h5>
                    <p class="service-desc">Protect your important documents and certificates with A4 or A3 sized lamination for long-term preservation.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Instant</span>
                        <span class="service-price">₹15/page</span>
                    </div>
                    <a href="{{ route('services.apply', 'lamination') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Photo Print --}}
            <div class="col-md-4 service-card-wrap" data-category="print">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-camera"></i>
                    </div>
                    <h5 class="service-title">Passport Photo Print</h5>
                    <p class="service-desc">Instant passport-size and stamp-size photo prints with white/light blue background as per government specifications.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Instant</span>
                        <span class="service-price">₹30/sheet</span>
                    </div>
                    <a href="{{ route('services.apply', 'photo-print') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Form Typing --}}
            <div class="col-md-4 service-card-wrap" data-category="typing">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-keyboard"></i>
                    </div>
                    <h5 class="service-title">Form Typing & Filling</h5>
                    <p class="service-desc">Professional typing assistance for all government forms in Hindi or English. Accurate and fast turnaround.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹50/form</span>
                    </div>
                    <a href="{{ route('services.apply', 'form-typing') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Affidavit --}}
            <div class="col-md-4 service-card-wrap" data-category="legal">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-file-earmark-check"></i>
                    </div>
                    <h5 class="service-title">Affidavit Preparation</h5>
                    <p class="service-desc">Drafting and notarization of affidavits for name change, address proof, income declaration, and more on stamp paper.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹199</span>
                    </div>
                    <a href="{{ route('services.apply', 'affidavit') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Notary --}}
            <div class="col-md-4 service-card-wrap" data-category="legal">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-patch-check"></i>
                    </div>
                    <h5 class="service-title">Notarization</h5>
                    <p class="service-desc">Get your documents notarized by a registered notary. Required for property transactions, legal matters, and visa applications.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹299</span>
                    </div>
                    <a href="{{ route('services.apply', 'notarization') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Power of Attorney --}}
            <div class="col-md-4 service-card-wrap" data-category="legal">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-pen"></i>
                    </div>
                    <h5 class="service-title">Power of Attorney</h5>
                    <p class="service-desc">Drafting of General or Special Power of Attorney documents for property, legal, and financial representation.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 1-2 Days</span>
                        <span class="service-price">₹499</span>
                    </div>
                    <a href="{{ route('services.apply', 'power-of-attorney') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Online Form Fill --}}
            <div class="col-md-4 service-card-wrap" data-category="online">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <h5 class="service-title">Online Form Submission</h5>
                    <p class="service-desc">Assistance in filling and submitting online forms for scholarships, job applications, admissions, and government portals.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹99</span>
                    </div>
                    <a href="{{ route('services.apply', 'online-form') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- e-Stamp Paper --}}
            <div class="col-md-4 service-card-wrap" data-category="legal">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-file-earmark-ruled"></i>
                    </div>
                    <h5 class="service-title">e-Stamp Paper</h5>
                    <p class="service-desc">Procurement of e-Stamp papers of various denominations for rent agreements, affidavits, bonds, and legal deeds.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹99 + duty</span>
                    </div>
                    <a href="{{ route('services.apply', 'e-stamp') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Rent Agreement --}}
            <div class="col-md-4 service-card-wrap" data-category="legal">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-house-check"></i>
                    </div>
                    <h5 class="service-title">Rent Agreement Drafting</h5>
                    <p class="service-desc">Professionally drafted and notarized rental agreements for residential and commercial properties on e-Stamp paper.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹399</span>
                    </div>
                    <a href="{{ route('services.apply', 'rent-agreement') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Email/Print Outs --}}
            <div class="col-md-4 service-card-wrap" data-category="print">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-envelope-arrow-down"></i>
                    </div>
                    <h5 class="service-title">Email & Printout</h5>
                    <p class="service-desc">Send or receive emails, download and print documents from government portals, DigiLocker, UMANG, and more.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Instant</span>
                        <span class="service-price">₹10</span>
                    </div>
                    <a href="{{ route('services.apply', 'email-print') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- ITR Filing --}}
            <div class="col-md-4 service-card-wrap" data-category="online">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <h5 class="service-title">ITR / Tax Filing</h5>
                    <p class="service-desc">Income Tax Return filing assistance for salaried employees, small businesses, and farmers under ITR-1 to ITR-4.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 1-2 Days</span>
                        <span class="service-price">₹399</span>
                    </div>
                    <a href="{{ route('services.apply', 'itr-filing') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-outline-secondary px-5 py-3" style="border-color: #1a2340; color: #1a2340; border-radius: 8px; font-weight: 500;">
                Need a custom document service? Contact Us →
            </a>
        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    .filter-btn {
        background: white;
        border: 1.5px solid #d0cdc8;
        color: #555;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 14px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }
    .filter-btn:hover, .filter-btn.active {
        background: #1a2340;
        color: white;
        border-color: #1a2340;
    }
    .service-card {
        background: white;
        border-radius: 14px;
        padding: 28px;
        height: 100%;
        box-shadow: 0 1px 4px rgba(0,0,0,0.07);
        display: flex;
        flex-direction: column;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.10);
    }
    .service-icon-wrap {
        width: 48px;
        height: 48px;
        background: #eef0f8;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #1a2340;
        margin-bottom: 16px;
    }
    .service-title {
        font-weight: 700;
        color: #1a2340;
        font-size: 1.05rem;
        margin-bottom: 8px;
    }
    .service-desc {
        color: #6b7280;
        font-size: 0.88rem;
        flex-grow: 1;
        line-height: 1.6;
        margin-bottom: 16px;
    }
    .service-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }
    .badge-time {
        font-size: 0.8rem;
        color: #6b7280;
        background: #f3f4f6;
        padding: 4px 10px;
        border-radius: 12px;
    }
    .service-price {
        font-weight: 700;
        font-size: 1.15rem;
        color: #1a2340;
    }
    .btn-apply {
        display: block;
        background: #1a2340;
        color: white;
        text-align: center;
        padding: 12px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: background 0.2s;
    }
    .btn-apply:hover {
        background: #2d3a5e;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            const filter = this.dataset.filter;
            document.querySelectorAll('.service-card-wrap').forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
