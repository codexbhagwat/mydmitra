@extends('layouts.app')

@section('title', 'Government Services - D-Mitra Service Center')

@section('content')

{{-- Page Header --}}
<section style="background: #f0ede8; padding: 50px 0 30px;">
    <div class="container">
        <div class="text-center mb-4">
            <span style="background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; border-radius: 20px; padding: 6px 16px; font-size: 14px; font-weight: 500;">
                ✓ Authorized Government Service Center
            </span>
        </div>
        <h1 class="text-center fw-bold" style="color: #1a2340; font-size: 2.5rem;">Government Services</h1>
        <p class="text-center text-muted mt-2">All official government document services at one place — fast, reliable, and hassle-free.</p>
    </div>
</section>

{{-- Filter Tabs --}}
<section style="background: #f0ede8; padding: 20px 0 40px;">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
            <button class="filter-btn active" data-filter="all">All Services</button>
            <button class="filter-btn" data-filter="certificate">Certificates</button>
            <button class="filter-btn" data-filter="id">ID & Identity</button>
            <button class="filter-btn" data-filter="property">Property</button>
            <button class="filter-btn" data-filter="income">Income & Social</button>
        </div>
    </div>
</section>

{{-- Services Grid --}}
<section style="background: #f0ede8; padding: 0 0 60px;">
    <div class="container">
        <div class="row g-4">

            {{-- Birth Certificate --}}
            <div class="col-md-4 service-card-wrap" data-category="certificate">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h5 class="service-title">Birth Certificate</h5>
                    <p class="service-desc">Apply for an official birth certificate for newborns or request corrections to existing records.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 2-3 Days</span>
                        <span class="service-price">₹199</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Death Certificate --}}
            <div class="col-md-4 service-card-wrap" data-category="certificate">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-file-earmark-medical"></i>
                    </div>
                    <h5 class="service-title">Death Certificate</h5>
                    <p class="service-desc">Official death certificate issuance for legal, insurance, and inheritance purposes.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 2-3 Days</span>
                        <span class="service-price">₹199</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Caste Certificate --}}
            <div class="col-md-4 service-card-wrap" data-category="certificate">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-award"></i>
                    </div>
                    <h5 class="service-title">Caste Certificate</h5>
                    <p class="service-desc">Get your SC/ST/OBC caste certificate for government schemes, scholarships and reservations.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 5-7 Days</span>
                        <span class="service-price">₹249</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Domicile Certificate --}}
            <div class="col-md-4 service-card-wrap" data-category="certificate">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h5 class="service-title">Domicile Certificate</h5>
                    <p class="service-desc">Proof of residence certificate required for admissions, jobs, and government schemes in Rajasthan.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 5-7 Days</span>
                        <span class="service-price">₹199</span>
                    </div>
                    <a href="#"   class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Income Certificate --}}
            <div class="col-md-4 service-card-wrap" data-category="income">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-currency-rupee"></i>
                    </div>
                    <h5 class="service-title">Income Certificate</h5>
                    <p class="service-desc">Official income certificate issuance for scholarship, reservation, and government scheme eligibility.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 3-5 Days</span>
                        <span class="service-price">₹249</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Voter ID --}}
            <div class="col-md-4 service-card-wrap" data-category="id">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <h5 class="service-title">Voter ID Card</h5>
                    <p class="service-desc">Apply for a new voter ID card, correction of details, or address change for electoral roll updates.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 7-10 Days</span>
                        <span class="service-price">₹149</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Aadhaar --}}
            <div class="col-md-4 service-card-wrap" data-category="id">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="service-title">Aadhaar Card Update</h5>
                    <p class="service-desc">Update your address, phone number, name, or biometrics on your Aadhaar card at our authorized center.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹149</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Driving License --}}
            <div class="col-md-4 service-card-wrap" data-category="id">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h5 class="service-title">Driving License</h5>
                    <p class="service-desc">Apply for a new driving license, learner's license, or renewal. We assist with form filing and slot booking.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 10-15 Days</span>
                        <span class="service-price">₹499</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Property Registration --}}
            <div class="col-md-4 service-card-wrap" data-category="property">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-building"></i>
                    </div>
                    <h5 class="service-title">Property Documents</h5>
                    <p class="service-desc">Assistance with property registration, Jamabandi, khasra-khatoni, and mutation (Nakal) documents.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 5-7 Days</span>
                        <span class="service-price">₹599</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Ration Card --}}
            <div class="col-md-4 service-card-wrap" data-category="income">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-basket3"></i>
                    </div>
                    <h5 class="service-title">Ration Card</h5>
                    <p class="service-desc">Apply for a new ration card or add/remove family members from your existing BPL/APL ration card.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 7-10 Days</span>
                        <span class="service-price">₹299</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Passport --}}
            <div class="col-md-4 service-card-wrap" data-category="id">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-passport"></i>
                    </div>
                    <h5 class="service-title">Passport Application</h5>
                    <p class="service-desc">End-to-end assistance with passport applications, renewals, Tatkal, and document verification.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 15-30 Days</span>
                        <span class="service-price">₹999</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Marriage Certificate --}}
            <div class="col-md-4 service-card-wrap" data-category="certificate">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-heart"></i>
                    </div>
                    <h5 class="service-title">Marriage Certificate</h5>
                    <p class="service-desc">Official marriage certificate registration under the Hindu Marriage Act or Special Marriage Act.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 7-10 Days</span>
                        <span class="service-price">₹399</span>
                    </div>
                    <a href="#"  class="btn-apply">Apply Now →</a>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-outline-secondary px-5 py-3" style="border-color: #1a2340; color: #1a2340; border-radius: 8px; font-weight: 500;">
                Can't find a service? Contact Us →
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
