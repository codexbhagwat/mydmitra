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

        {{-- Pay via QR Button --}}
        <button type="button" onclick="document.getElementById('qrModal').style.display='flex'"
            class="btn-orange w-100"
            style="justify-content:center;padding:14px;font-size:15px;border:none;cursor:pointer;">
            <i class="bi bi-qr-code-scan"></i> &nbsp;Scan QR & Pay ₹{{ number_format($application->service->price, 0) }}
        </button>

        <p style="text-align:center;font-size:11.5px;color:var(--grey);margin-top:14px;">
            <i class="bi bi-shield-lock"></i> This is a secure, encrypted transaction.
        </p>
    </div>
</div>

{{-- QR Modal --}}
<div id="qrModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.55);z-index:9999;align-items:center;justify-content:center;padding:16px;">
    <div style="background:#fff;border-radius:18px;padding:32px 28px;max-width:400px;width:100%;box-shadow:0 8px 40px rgba(0,0,0,0.18);position:relative;">

        {{-- Close Button --}}
        <button onclick="document.getElementById('qrModal').style.display='none'"
            style="position:absolute;top:14px;right:16px;background:none;border:none;font-size:22px;cursor:pointer;color:#888;line-height:1;">
            &times;
        </button>

        <div style="text-align:center;margin-bottom:20px;">
            <div style="font-size:18px;font-weight:800;margin-bottom:4px;">Scan & Pay</div>
            <div style="font-size:13px;color:#888;">Scan the QR code using any UPI app</div>
        </div>

        {{-- Dynamic UPI QR Code --}}
        @php
            $upiId   = '7667077361@axl';
            $name    = 'Mydmitra';
            $amount  = number_format($application->service->price, 2, '.', '');
            $note    = 'App#' . $application->id;
            $upiData = "upi://pay?pa={$upiId}&pn={$name}&am={$amount}&cu=INR&tn={$note}";
            $qrUrl   = 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&margin=10&data=' . urlencode($upiData);
        @endphp

        <div style="text-align:center;margin-bottom:20px;">
            <div style="display:inline-block;padding:12px;border:2px dashed #f97316;border-radius:14px;background:#fff8f3;">
                <img src="{{ $qrUrl }}"
                    alt="UPI Payment QR Code"
                    style="width:220px;height:220px;display:block;border-radius:8px;">
            </div>
            <div style="margin-top:12px;font-size:13px;color:#666;">
                UPI ID: <strong>{{ $upiId }}</strong>
            </div>
            <div style="margin-top:4px;font-size:13px;color:#666;">
                Amount: <strong style="color:#f97316;">₹{{ number_format($application->service->price, 0) }}</strong>
            </div>
        </div>

        {{-- UPI Apps hint --}}
        <div style="text-align:center;font-size:12px;color:#aaa;margin-bottom:20px;">
            <i class="bi bi-phone"></i> PhonePe &nbsp;•&nbsp; GPay &nbsp;•&nbsp; Paytm &nbsp;•&nbsp; BHIM UPI
        </div>

        <hr style="border:none;border-top:1px solid #f0f0f0;margin-bottom:20px;">

        {{-- Transaction ID Form --}}
        <form method="POST" action="{{ route('payment.process', $application) }}">
            @csrf
            <div style="margin-bottom:14px;">
                <label style="font-size:12px;font-weight:700;letter-spacing:0.6px;text-transform:uppercase;color:#888;display:block;margin-bottom:8px;">
                    Enter Transaction ID / UTR Number
                </label>
                <input type="text"
                    name="transaction_id"
                    required
                    placeholder="e.g. 425123456789"
                    style="width:100%;padding:12px 14px;border:1.5px solid #e5e7eb;border-radius:10px;font-size:14px;outline:none;box-sizing:border-box;transition:border 0.2s;"
                    onfocus="this.style.borderColor='#f97316'"
                    onblur="this.style.borderColor='#e5e7eb'">
                <div style="font-size:11.5px;color:#aaa;margin-top:6px;">
                    <i class="bi bi-info-circle"></i> Payment ke baad UPI app se UTR/Transaction ID enter karein.
                </div>
            </div>

            <button type="submit" class="btn-orange w-100"
                style="justify-content:center;padding:13px;font-size:14.5px;border:none;cursor:pointer;">
                <i class="bi bi-check-circle-fill"></i> Confirm Payment
            </button>
        </form>
    </div>
</div>

@endsection