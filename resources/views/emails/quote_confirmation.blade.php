<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quote Confirmation</title>
    <style>
        body{font-family: Arial, Helvetica, sans-serif;background:#f3fafb;margin:0;padding:20px}
        .card{max-width:720px;margin:20px auto;background:#fff;border-radius:8px;overflow:hidden;box-shadow:0 10px 30px rgba(0,0,0,0.08)}
    .hero{background:linear-gradient(90deg,#16a34a,#2563eb);color:#fff;padding:36px 24px;text-align:center}
        .hero h1{margin:0;font-size:28px}
        .container{padding:24px}
        .panel{border:1px solid #e6f3ef;background:#f8fffb;padding:16px;border-radius:6px}
        .panel h3{margin:0 0 8px}
        .field{display:flex;gap:8px;padding:8px 0;border-bottom:1px dashed #eef}
        .field:last-child{border-bottom:0}
        .label{min-width:160px;color:#2b3440;font-weight:600}
        .value{color:#3b4a57}
        .cta{display:block;margin:18px auto 0;text-align:center}
        .btn{display:inline-block;padding:10px 18px;border-radius:6px;background:#fff;color:#1e90ff;text-decoration:none;border:1px solid rgba(30,144,255,0.12)}
        .note{font-size:13px;color:#52707a;padding:12px 0;text-align:center}
        @media (max-width:520px){.label{min-width:120px}}
    </style>
</head>
<body>
<div class="card">
    <div class="hero">
        <div style="font-size:40px;line-height:1">✔</div>
        <h1>Thank You!</h1>
        <p style="margin:8px 0 0;opacity:0.95">Your request has been received and our partners are preparing your quotes.</p>
    </div>

    <div class="container">
        <div class="panel">
            <h3>Your Quotes Are On The Way</h3>
            <p style="margin:8px 0 12px;color:#44606a">You'll receive a confirmation. Below is the information you submitted.</p>

            <div class="field"><div class="label">Full name</div><div class="value">{{ $quote->full_name }}</div></div>
            <div class="field"><div class="label">Email</div><div class="value">{{ $quote->email }}</div></div>
            <div class="field"><div class="label">Mobile</div><div class="value">{{ $quote->mobile_number }}</div></div>
            @if($quote->additional_info)
                <div class="field"><div class="label">Additional info</div><div class="value">{{ $quote->additional_info }}</div></div>
            @endif

        </div>

        <div class="note">⚡ Quotes Guaranteed Within 2 Hours — We'll notify you as quotes arrive.</div>

        <div class="cta"><a href="{{ url('/') }}" class="btn">Back to Home</a></div>
    </div>
</div>
</body>
</html>
