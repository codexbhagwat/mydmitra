@extends('layouts.app')

@section('title', 'Banking Services - D-Mitra Service Center')

@section('content')

{{-- Page Header --}}
<section style="background: #f0ede8; padding: 50px 0 30px;">
    <div class="container">
        <div class="text-center mb-4">
            <span style="background: #e3f2fd; color: #1565c0; border: 1px solid #90caf9; border-radius: 20px; padding: 6px 16px; font-size: 14px; font-weight: 500;">
                🏦 Authorized Banking Correspondent Center
            </span>
        </div>
        <h1 class="text-center fw-bold" style="color: #1a2340; font-size: 2.5rem;">Banking Services</h1>
        <p class="text-center text-muted mt-2">Complete banking solutions — account opening, insurance, loans, and more at your doorstep.</p>
    </div>
</section>

{{-- Info Banner --}}
<section style="background: #1a2340; padding: 18px 0;">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center gap-4 text-white text-center">
            <div><i class="bi bi-bank me-2"></i><strong>SBI</strong> &nbsp;|&nbsp;</div>
            <div><i class="bi bi-bank me-2"></i><strong>Bank of Baroda</strong> &nbsp;|&nbsp;</div>
            <div><i class="bi bi-bank me-2"></i><strong>PNB</strong> &nbsp;|&nbsp;</div>
            <div><i class="bi bi-bank me-2"></i><strong>HDFC</strong> &nbsp;|&nbsp;</div>
            <div><i class="bi bi-bank me-2"></i><strong>Post Office Savings</strong></div>
        </div>
    </div>
</section>

{{-- Filter Tabs --}}
<section style="background: #f0ede8; padding: 30px 0 20px;">
    <div class="container">
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-2">
            <button class="filter-btn active" data-filter="all">All Services</button>
            <button class="filter-btn" data-filter="account">Account</button>
            <button class="filter-btn" data-filter="insurance">Insurance</button>
            <button class="filter-btn" data-filter="loan">Loans</button>
            <button class="filter-btn" data-filter="payment">Payments</button>
        </div>
    </div>
</section>

{{-- Services Grid --}}
<section style="background: #f0ede8; padding: 20px 0 60px;">
    <div class="container">
        <div class="row g-4">

            {{-- Bank Account Opening --}}
            <div class="col-md-4 service-card-wrap" data-category="account">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-bank"></i>
                    </div>
                    <h5 class="service-title">Bank Account Opening</h5>
                    <p class="service-desc">Assisted service for opening a new savings or current bank account with major public and private banks.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹299</span>
                    </div>
                    <a href="{{ route('services.apply', 'bank-account') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- PM Jan Dhan --}}
            <div class="col-md-4 service-card-wrap" data-category="account">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-people"></i>
                    </div>
                    <h5 class="service-title">Jan Dhan Account</h5>
                    <p class="service-desc">Open a zero-balance PMJDY account under Pradhan Mantri Jan Dhan Yojana with RuPay debit card and insurance benefits.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹Free</span>
                    </div>
                    <a href="{{ route('services.apply', 'jan-dhan') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Fixed Deposit --}}
            <div class="col-md-4 service-card-wrap" data-category="account">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-piggy-bank"></i>
                    </div>
                    <h5 class="service-title">Fixed Deposit (FD)</h5>
                    <p class="service-desc">Assistance in opening Fixed Deposits with SBI, Post Office and other banks for safe and guaranteed returns.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 1-2 Days</span>
                        <span class="service-price">₹199</span>
                    </div>
                    <a href="{{ route('services.apply', 'fixed-deposit') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- PM Jeevan Jyoti --}}
            <div class="col-md-4 service-card-wrap" data-category="insurance">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-shield-heart"></i>
                    </div>
                    <h5 class="service-title">PMJJBY – Life Insurance</h5>
                    <p class="service-desc">Enroll in Pradhan Mantri Jeevan Jyoti Bima Yojana. ₹2 lakh life cover at just ₹436/year for ages 18-50.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹99</span>
                    </div>
                    <a href="{{ route('services.apply', 'pmjjby') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- PM Suraksha Bima --}}
            <div class="col-md-4 service-card-wrap" data-category="insurance">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-shield-plus"></i>
                    </div>
                    <h5 class="service-title">PMSBY – Accident Insurance</h5>
                    <p class="service-desc">Enroll in Pradhan Mantri Suraksha Bima Yojana. ₹2 lakh accident cover at just ₹20/year.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Same Day</span>
                        <span class="service-price">₹99</span>
                    </div>
                    <a href="{{ route('services.apply', 'pmsby') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Atal Pension --}}
            <div class="col-md-4 service-card-wrap" data-category="insurance">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-person-check"></i>
                    </div>
                    <h5 class="service-title">Atal Pension Yojana</h5>
                    <p class="service-desc">Enroll in APY for guaranteed monthly pension of ₹1000-5000 after age 60. Suitable for unorganised sector workers.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 1-2 Days</span>
                        <span class="service-price">₹149</span>
                    </div>
                    <a href="{{ route('services.apply', 'atal-pension') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- KCC Loan --}}
            <div class="col-md-4 service-card-wrap" data-category="loan">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <h5 class="service-title">Kisan Credit Card (KCC)</h5>
                    <p class="service-desc">Assist farmers in applying for KCC loans for crop production, post-harvest expenses, and allied activities.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 7-15 Days</span>
                        <span class="service-price">₹499</span>
                    </div>
                    <a href="{{ route('services.apply', 'kcc') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Mudra Loan --}}
            <div class="col-md-4 service-card-wrap" data-category="loan">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-briefcase"></i>
                    </div>
                    <h5 class="service-title">PM Mudra Loan</h5>
                    <p class="service-desc">Apply for PMMY business loans under Shishu (up to ₹50K), Kishore (₹5L), or Tarun (₹10L) categories.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 10-20 Days</span>
                        <span class="service-price">₹499</span>
                    </div>
                    <a href="{{ route('services.apply', 'mudra-loan') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Cash Withdrawal/Deposit --}}
            <div class="col-md-4 service-card-wrap" data-category="payment">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h5 class="service-title">Cash Deposit / Withdrawal</h5>
                    <p class="service-desc">Deposit or withdraw cash from your bank account through our Aadhaar-enabled payment system (AePS).</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Instant</span>
                        <span class="service-price">₹29</span>
                    </div>
                    <a href="{{ route('services.apply', 'cash-service') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Money Transfer --}}
            <div class="col-md-4 service-card-wrap" data-category="payment">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-arrow-left-right"></i>
                    </div>
                    <h5 class="service-title">Money Transfer (NEFT/IMPS)</h5>
                    <p class="service-desc">Safe and instant money transfer to any bank account in India through NEFT, IMPS, or UPI channels.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Instant</span>
                        <span class="service-price">₹19/txn</span>
                    </div>
                    <a href="{{ route('services.apply', 'money-transfer') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- Bill Payment --}}
            <div class="col-md-4 service-card-wrap" data-category="payment">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <h5 class="service-title">Bill Payment</h5>
                    <p class="service-desc">Pay electricity, water, gas, DTH, mobile recharge and all utility bills quickly through our BBPS platform.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> Instant</span>
                        <span class="service-price">₹10/bill</span>
                    </div>
                    <a href="{{ route('services.apply', 'bill-payment') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

            {{-- PAN Card --}}
            <div class="col-md-4 service-card-wrap" data-category="account">
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="bi bi-card-text"></i>
                    </div>
                    <h5 class="service-title">PAN Card Application</h5>
                    <p class="service-desc">Apply for a new PAN card or request corrections/reprint of existing PAN details through NSDL/UTIITSL.</p>
                    <div class="service-meta">
                        <span class="badge-time"><i class="bi bi-clock"></i> 7-10 Days</span>
                        <span class="service-price">₹499</span>
                    </div>
                    <a href="{{ route('services.apply', 'pan-card') }}" class="btn-apply">Apply Now →</a>
                </div>
            </div>

        </div>

        <div class="text-center mt-5">
            <a href="{{ route('contact') }}" class="btn btn-outline-secondary px-5 py-3" style="border-color: #1a2340; color: #1a2340; border-radius: 8px; font-weight: 500;">
                Need help choosing a service? Contact Us →
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
