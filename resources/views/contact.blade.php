@extends('layouts.app')

@section('title', 'Contact Us - D-Mitra Service Center')

@section('content')

{{-- Contact Section --}}
<section style="background: #dcd7c957; padding: 64px 0;">
    <div class="container">
        <h2 style="font-weight:700;font-size:clamp(24px,4vw,34px);text-align:center;color:#111827;letter-spacing:-0.5px;">Contact Us</h2>
        <p style="text-align:center;color:#6b7280;font-size:15px;margin-top:8px;margin-bottom:44px;">Get in touch with us for any queries or service requirements</p>

        <!-- {{-- Success / Error Alerts --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-auto mb-4" style="max-width:860px;" role="alert">
                <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mx-auto mb-4" style="max-width:860px;" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i> Please fix the errors below.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            {{-- Visit Info Card --}}
            <div class="col-12 col-lg-5">
                <div class="contact-info-card">
                    <h5>Visit Our Center</h5>
                    <p class="cinfo-sub">We are here to help you with all services</p>

                    <div class="cinfo-row">
                        <div class="cinfo-icon"><i class="bi bi-geo-alt"></i></div>
                        <div class="cinfo-text">
                            <strong>Address</strong>
                            <span>Bhilwara<br>Rajasthan, India</span>
                        </div>
                    </div>

                    <div class="cinfo-row">
                        <div class="cinfo-icon"><i class="bi bi-telephone"></i></div>
                        <div class="cinfo-text">
                            <strong>Phone</strong>
                            <span><a href="tel:+917568359165" style="color:#6b7280;text-decoration:none;">+91 7568359165</a></span>
                        </div>
                    </div>

                    <div class="cinfo-row">
                        <div class="cinfo-icon"><i class="bi bi-envelope"></i></div>
                        <div class="cinfo-text">
                            <strong>Email</strong>
                            <span style="word-break:break-all;"><a href="mailto:superamitt3107@gmail.com" style="color:#6b7280;text-decoration:none;">superamitt3107@gmail.com</a></span>
                        </div>
                    </div>

                    <div class="cinfo-row">
                        <div class="cinfo-icon"><i class="bi bi-clock"></i></div>
                        <div class="cinfo-text">
                            <strong>Working Hours</strong>
                            <span>Monday - Saturday: 9:00 AM - 7:00 PM<br><span style="color:#e53935;">Sunday: Closed</span></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Enquiry Form Card --}}
            <div class="col-12 col-lg-7">
                <div class="enquiry-card">
                    <h5>Send Enquiry</h5>
                    <p class="enq-sub">Fill the form below and we will get back to you</p>

                      <form action="{{ route('contact.submit') }}" method="POST" id="enquiryForm">
                        @csrf
                        <div class="col-12">
                        <label class="form-label-e">Please Choose Type</label>
                        <select name="type" class="form-inp @error('type') is-invalid @enderror" required>
                            <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select type</option>
                            <option value="enquiry"   {{ old('type') == 'enquiry'   ? 'selected' : '' }}>Enquiry</option>
                            <option value="complaint" {{ old('type') == 'complaint' ? 'selected' : '' }}>Complaint</option>
                            <option value="feedback"  {{ old('type') == 'feedback'  ? 'selected' : '' }}>Feedback</option>
                        </select>
                        @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <label class="form-label-e">Full Name</label>
                                <input type="text" name="name"
                                    class="form-inp @error('name') is-invalid @enderror"
                                    placeholder="Enter your name"
                                    value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="form-label-e">Phone Number</label>
                                <input type="tel" name="phone"
                                    class="form-inp @error('phone') is-invalid @enderror"
                                    placeholder="Enter phone number"
                                    value="{{ old('phone') }}" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label-e">Email Address</label>
                                <input type="email" name="email"
                                    class="form-inp @error('email') is-invalid @enderror"
                                    placeholder="Enter your email"
                                    value="{{ old('email') }}">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label-e">Service Required</label>
                                <input type="text" name="service"
                                    class="form-inp @error('service') is-invalid @enderror"
                                    placeholder="e.g., Birth Certificate, Bank Account"
                                    value="{{ old('service') }}">
                                @error('service')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label-e">Message</label>
                                <textarea name="message" rows="4"
                                    class="form-inp @error('message') is-invalid @enderror"
                                    placeholder="Describe your requirements...">{{ old('message') }}</textarea>
                                @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn-send">
                                    <i class="bi bi-send"></i> Send Enquiry
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
    /* ── CONTACT INFO CARD ── */
    .contact-info-card {
        background: #fff;
        border-radius: 19px;
        padding: 23px 30px;
        border: 1px solid #a5a12a99;
        /* height: 100%; */
    }
    .contact-info-card h5 {
        font-weight: 700;
        font-size: 17px;
        margin-bottom: 4px;
        color: #111827;
    }
    .cinfo-sub {
        font-size: 13px;
        color: #9ca3af;
        margin-bottom: 24px;
    }
    .cinfo-row {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 20px;
    }
    .cinfo-icon {
        width: 40px; height: 40px;
        flex-shrink: 0;
        background: #e8eef8;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #1a3a6b;
        font-size: 17px;
    }
    .cinfo-text strong {
        font-size: 14px;
        display: block;
        font-weight: 700;
        color: #111827;
    }
    .cinfo-text span {
        font-size: 13px;
        color: #6b7280;
        line-height: 1.5;
    }

    /* ── ENQUIRY CARD ── */
    .enquiry-card {
        background: #fff;
        border-radius: 14px;
        padding: 28px 24px;
        border: 1px solid #a5a12a99;
    }
    .enquiry-card h5 {
        font-weight: 700;
        font-size: 19px;
        margin-bottom: 4px;
        color: #111827;
    }
    .enq-sub {
        font-size: 13px;
        color: #9ca3af;
        margin-bottom: 22px;
    }

    /* ── FORM ── */
    .form-label-e {
        font-size: 13.5px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
        display: block;
    }
    .form-inp {
        width: 100%;
        border: 1.5px solid #e5e7eb;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 14px;
        color: #111827;
        background: #fff;
        transition: border-color .18s, box-shadow .18s;
        outline: none;
    }
    .form-inp::placeholder { color: #c0c7d0; }
    .form-inp:focus {
        border-color: #1a3a6b;
        box-shadow: 0 0 0 3px rgba(26,58,107,0.08);
    }
    textarea.form-inp {
        resize: vertical;
        min-height: 110px;
    }

    /* ── SEND BUTTON ── */
    .btn-send {
        width: 100%;
        padding: 13px;
        background: #1a3a6b;
        color: #fff;
        border: none;
        border-radius: 9px;
        font-size: 15px;
        font-weight: 700;
        display: flex; align-items: center; justify-content: center; gap: 8px;
        cursor: pointer;
        transition: background .2s;
    }
    .btn-send:hover { background: #122d56; }

    /* ── RESPONSIVE ── */
    @media (max-width: 991px) {
        .contact-info-card { height: auto; padding: 20px; }
        .enquiry-card { padding: 22px 18px; }
    }
    @media (max-width: 575px) {
        .contact-info-card { padding: 18px 16px; border-radius: 14px; }
        .contact-info-card h5 { font-size: 15px; }
        .cinfo-sub { font-size: 12px; margin-bottom: 18px; }
        .cinfo-row { gap: 10px; margin-bottom: 14px; }
        .cinfo-icon { width: 34px; height: 34px; font-size: 14px; border-radius: 8px; }
        .cinfo-text strong { font-size: 13px; }
        .cinfo-text span { font-size: 12px; }
        .enquiry-card { padding: 18px 14px; border-radius: 12px; }
        .enquiry-card h5 { font-size: 16px; }
        .enq-sub { font-size: 12px; margin-bottom: 16px; }
        .form-label-e { font-size: 13px; }
        .form-inp { font-size: 13px; padding: 8px 12px; }
        textarea.form-inp { min-height: 90px; }
        .btn-send { font-size: 14px; padding: 10px; }
    }
    @media (max-width: 360px) {
        .contact-info-card,
        .enquiry-card { padding: 14px 12px; }
        .cinfo-icon { width: 30px; height: 30px; font-size: 13px; }
    }
</style>
@endpush
