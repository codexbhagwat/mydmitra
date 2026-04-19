<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $updateTitle }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            background-color: #f4f6f8;
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #333;
        }
        .wrapper {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            padding: 32px 40px;
            text-align: center;
        }
        .header .logo {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.5px;
        }
        .header .logo span {
            color: #f97316;
        }
        .header .tagline {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 4px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* BADGE */
        .badge-wrap {
            text-align: center;
            margin-top: -18px;
            margin-bottom: 10px;
        }
        .badge {
            display: inline-block;
            background: #f97316;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 16px;
            border-radius: 20px;
        }

        /* BODY */
        .body {
            padding: 30px 40px 20px;
        }
        .greeting {
            font-size: 22px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }
        .greeting span {
            color: #f97316;
        }
        .subtitle {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 24px;
        }

        /* CONTENT CARD */
        .content-card {
            background: #f8fafc;
            border-left: 4px solid #f97316;
            border-radius: 0 8px 8px 0;
            padding: 20px 24px;
            margin-bottom: 24px;
        }
        .content-card h2 {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            line-height: 1.4;
        }
        .content-card .description {
            font-size: 14px;
            line-height: 1.8;
            color: #475569;
        }
        .content-card .description p { margin-bottom: 10px; }
        .content-card .description ul { padding-left: 18px; }
        .content-card .description li { margin-bottom: 6px; }

        /* CTA BUTTON */
        .cta-wrap {
            text-align: center;
            margin: 28px 0;
        }
        .cta-btn {
            display: inline-block;
            background: #f97316;
            color: #ffffff !important;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
            padding: 13px 32px;
            border-radius: 8px;
            letter-spacing: 0.3px;
        }

        /* DIVIDER */
        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 20px 0;
        }

        /* FOOTER */
        .footer {
            background: #f8fafc;
            padding: 20px 40px;
            text-align: center;
        }
        .footer p {
            font-size: 12px;
            color: #94a3b8;
            line-height: 1.7;
        }
        .footer a {
            color: #f97316;
            text-decoration: none;
        }
        .footer .social {
            margin-top: 12px;
            font-size: 11px;
            color: #cbd5e1;
        }
    </style>
</head>
<body>
    <div class="wrapper">

        <!-- HEADER -->
        <div class="header">
            <div class="logo">My<span>d</span>mitra</div>
            <div class="tagline">Your Trusted Service Partner</div>
        </div>

        <!-- BADGE -->
        <div class="badge-wrap">
            <span class="badge">📢 New Update</span>
        </div>

        <!-- BODY -->
        <div class="body">
            <div class="greeting">Hello, <span>{{ $userName }}!</span> 👋</div>
            <p class="subtitle">We have a new update for you. Here's what's new on Mydmitra:</p>

            <!-- CONTENT CARD -->
            <div class="content-card">
                <h2>{{ $updateTitle }}</h2>
                <div class="description">
                    {!! $updateDescription !!}
                </div>
            </div>

            <!-- CTA -->
            <div class="cta-wrap">
                <a href="{{ url('/') }}" class="cta-btn">
                    Visit Mydmitra →
                </a>
            </div>

            <hr class="divider">

            <p style="font-size:13px;color:#64748b;text-align:center;">
                Thank you for being a part of the <strong>Mydmitra</strong> family. 🙏<br>
                We're always working to bring you better services.
            </p>
        </div>

        <!-- FOOTER -->
        <div class="footer">
            <p>
                You are receiving this email because you are registered on
                <a href="{{ url('/') }}">mydmitra.com</a>.<br>
                © {{ date('Y') }} Mydmitra. All rights reserved.
            </p>
            <p class="social">
                Questions? Contact us at
                <a href="mailto:admin@mydmitra.com">admin@mydmitra.com</a>
            </p>
        </div>

    </div>
</body>
</html>