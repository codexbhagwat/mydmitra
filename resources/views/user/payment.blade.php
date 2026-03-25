@extends('layouts.user')
@section('title', 'Payment')
@section('page-title', 'Payment')

@section('content')
<div style="max-width:560px;margin:0 auto;">
    <div class="payment-card">
        <div style="text-align:center;margin-bottom:26px;">
            <div class="payment-icon" style="margin:0 auto 14px;">
                <i class="bi {{ $application->service->icon ?? 'bi-gear' }}"></i>
            </div>
            <h4 style="font-size:20px;font-weight:800;">Complete Payment</h4>
            <p style="color:var(--grey);font-size:13.5px;">Review your order and proceed to pay</p>
        </div>

        {{-- Order Summary --}}
        <div style="background:var(--grey-bg);border-radius:12px;padding:20px;margin-bottom:24px;">
            <div style="font-size:12px;font-weight:700;letter-spacing:0.8px;text-transform:uppercase;color:var(--grey);margin-bottom:14px;">Order Summary</div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--grey-light);">
                <span style="font-size:13.5px;color:var(--grey-dark);">Service</span>
                <span style="font-weight:600;font-size:13.5px;">{{ $application->service->name }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--grey-light);">
                <span style="font-size:13.5px;color:var(--grey-dark);">Application ID</span>
                <span style="font-weight:600;font-size:13.5px;">#{{ str_pad($application->id, 6, '0', STR_PAD_LEFT) }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--grey-light);">
                <span style="font-size:13.5px;color:var(--grey-dark);">Service Fee</span>
                <span style="font-weight:600;font-size:13.5px;">₹{{ number_format($application->service->price, 0) }}</span>
            </div>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 0 0;">
                <span style="font-family:'Syne',sans-serif;font-weight:700;font-size:15px;">Total</span>
                <span style="font-weight:700;font-size:22px;color:var(--orange);">
                    ₹{{ number_format($application->service->price, 0) }}
                </span>
            </div>
        </div>

        {{-- Dummy Payment Methods --}}
        <div style="margin-bottom:22px;">
            <div style="font-size:12px;font-weight:700;letter-spacing:0.8px;text-transform:uppercase;color:var(--grey);margin-bottom:12px;">Select Payment Method</div>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <label style="display:flex;align-items:center;gap:12px;padding:14px;border:1.5px solid var(--orange);border-radius:10px;cursor:pointer;background:var(--orange-soft);">
                    <input type="radio" name="payment_method" checked style="accent-color:var(--orange);">
                    <i class="bi bi-credit-card" style="font-size:20px;color:var(--orange);"></i>
                    <div>
                        <div style="font-weight:600;font-size:13.5px;">UPI / Net Banking</div>
                        <div style="font-size:12px;color:var(--grey);">Pay via PhonePe, GPay, BHIM UPI</div>
                    </div>
                </label>
                <label style="display:flex;align-items:center;gap:12px;padding:14px;border:1.5px solid var(--grey-light);border-radius:10px;cursor:pointer;">
                    <input type="radio" name="payment_method" style="accent-color:var(--orange);">
                    <i class="bi bi-bank" style="font-size:20px;color:var(--grey);"></i>
                    <div>
                        <div style="font-weight:600;font-size:13.5px;">Debit / Credit Card</div>
                        <div style="font-size:12px;color:var(--grey);">Visa, Mastercard, RuPay</div>
                    </div>
                </label>
            </div>
        </div>

        <form method="POST" action="{{ route('payment.process', $application) }}">
            @csrf
            <button type="submit" class="btn-orange w-100" style="justify-content:center;padding:14px;font-size:15px;">
                <i class="bi bi-lock-fill"></i> Proceed to Pay ₹{{ number_format($application->service->price, 0) }}
            </button>
        </form>

        <p style="text-align:center;font-size:11.5px;color:var(--grey);margin-top:14px;">
            <i class="bi bi-shield-lock"></i> This is a secure, encrypted transaction.
        </p>
    </div>
</div>
@endsection
