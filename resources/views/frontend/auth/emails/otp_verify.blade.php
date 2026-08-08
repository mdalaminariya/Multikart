<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>OTP Verification</title>

<style>

body{
    margin:0;
    padding:0;
    background:#f4f6f9;
    font-family:Arial;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card{
    width:400px;
    background:#fff;
    padding:40px;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
    text-align:center;
}

h2{ margin-bottom:10px; }

p{
    color:#666;
    font-size:14px;
}

input{
    width:100%;
    padding:14px;
    margin-top:20px;
    border:1px solid #ddd;
    border-radius:6px;
    font-size:18px;
    text-align:center;
    letter-spacing:5px;
}

button{
    width:100%;
    padding:14px;
    margin-top:15px;
    border:none;
    background:#2d89ff;
    color:#fff;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}

button:hover{ background:#1b6fe0; }

.resend-btn{
    background:#28a745;
}

.resend-btn:hover{
    background:#1f8a38;
}

.error{
    color:red;
    margin-top:10px;
    font-size:14px;
}

.success{
    color:green;
    margin-top:10px;
    font-size:14px;
}

.timer{
    margin-top:10px;
    font-size:14px;
    color:#333;
}

.disabled{
    opacity:0.6;
    pointer-events:none;
}

</style>

</head>
<body>

@php
    $user = \App\Models\User::find(session('verify_user_id'));
@endphp

<div class="card">

    <h2>OTP Verification</h2>

    <p>Enter the OTP sent to your email</p>

    {{-- Success --}}
    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    {{-- Error --}}
    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    {{-- OTP FORM --}}
    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf

        <input type="text" name="otp" placeholder="Enter OTP" maxlength="6" required>

        @error('otp')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Verify OTP</button>
    </form>

    {{-- TIMER --}}
    <div class="timer">
        OTP expires in: <span id="countdown">--:--</span>
    </div>

    {{-- RESEND --}}
    <form action="{{ route('otp.resend') }}" method="POST">
        @csrf
        <button type="submit" id="resendBtn" class="resend-btn disabled">
            Resend OTP
        </button>
    </form>

</div>

<script>

let expiryTime = {{ $user && $user->otp_expires_at ? \Carbon\Carbon::parse($user->otp_expires_at)->timestamp * 1000 : 'null' }};

let resendBtn = document.getElementById("resendBtn");

function updateTimer() {

    if (!expiryTime) {
        document.getElementById("countdown").innerHTML = "NO OTP";
        return;
    }

    let now = new Date().getTime();
    let distance = expiryTime - now;

    if (distance <= 0) {
        document.getElementById("countdown").innerHTML = "EXPIRED";
        resendBtn.classList.remove("disabled");
        resendBtn.disabled = false;
        return;
    }

    let minutes = Math.floor(distance / 60000);
    let seconds = Math.floor((distance % 60000) / 1000);

    document.getElementById("countdown").innerHTML =
        minutes + "m " + seconds + "s";
}

updateTimer();
setInterval(updateTimer, 1000);

</script>

</body>
</html>
