<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Verify Email</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background: #fff;
    padding: 40px;
    width: 420px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    text-align: center;
}

h1 { font-size: 22px; margin-bottom: 10px; }

p {
    color: #555;
    font-size: 14px;
    line-height: 1.6;
}

.btn {
    display: inline-block;
    margin-top: 15px;
    padding: 12px 18px;
    background: #2d89ff;
    color: #fff;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

.btn:disabled {
    background: #9bbcf5;
    cursor: not-allowed;
}

.success {
    color: green;
    margin-top: 10px;
    font-size: 13px;
}

.timer {
    margin-top: 10px;
    font-size: 13px;
    color: #333;
}

.logout {
    margin-top: 20px;
    font-size: 13px;
}

.logout button {
    color: #ff4d4d;
    background: none;
    border: none;
    cursor: pointer;
}
</style>
</head>

<body>

<div class="card">

    <h1>Verify Your Email 📩</h1>

    <p>
        We sent a verification link to your email.<br>
        Please check your inbox and click the link to activate your account.
    </p>

    @if (session('message'))
        <div class="success">{{ session('message') }}</div>
    @endif

    {{-- RESEND FORM --}}
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" id="resendBtn" class="btn">
            Resend Email
        </button>

        <div class="timer" id="timerText"></div>
    </form>

    {{-- LOGOUT --}}
    <div class="logout">
        <form method="POST" action="{{ route('user.logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>

</div>

<script>
let btn = document.getElementById('resendBtn');
let timerText = document.getElementById('timerText');

let timeLeft = 60;

btn.disabled = true;

let countdown = setInterval(() => {
    timeLeft--;

    timerText.innerHTML = "You can resend email in " + timeLeft + " seconds";

    if (timeLeft <= 0) {
        clearInterval(countdown);
        btn.disabled = false;
        timerText.innerHTML = "You can now resend verification email.";
    }

}, 1000);
</script>

</body>
</html>
