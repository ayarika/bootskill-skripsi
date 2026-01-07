<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
    <title>Sign Up</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
        }

        form {
            background-color: #ffffff;
            padding: 20px 20px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 480px;
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 26px;
            animation: fadeIn 1s ease-in-out;
            transform: translate(0%, 0%);
        }

        h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
        }

        

        label {
            font-weight: bold;
            color: #444;
            font-size: 14px;
        }

        small.error-message {
            color: red;
            font-size: 12px;
            display: none;
        }

        button[type="submit"],
        #loadingBtn {
            width: 100%;
            border: none;
            background-color: #2193b0;
            border-radius: 2px;
            padding: 14px 10px;
            color: white;
        }

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(-45deg, #2193b0, #6dd5ed, #2e3a59, #753a88);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0 50%; }
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 12px 14px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
            box-sizing: border-box;
            outline: none;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        
        .google-login {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            font-size: 14px;
            border-radius: 6px;
            background: #fff;
            color: #444;
            cursor: default;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            justify-content: center;
        }

        .google-login img {
            width: 20px;
            height: 20px;
        }

        .wave-container {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: -1;
        }

        .wave-bg {
            width: 100%;
            height: 200px;
            animation: floatWave 8s ease-in-out infinite;
        }

        @keyframes floatWave {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(10px); }
        }

        input:focus {
            border-color: #4fc3f7;
            box-shadow: 0 0 5px rgba(79, 195, 247, 0.5);
            outline: none;
        }

        button {
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #4fc3f7;
            transform: translateY(-1px);
        }

        @media (max-width: 600px) {
            input, button {
                width: 100%;
                font-size: 16px;
            }
        }

        @keyframes loadingBar {
            0% { width: 0%; }
            100% { width: 100%; }
        }

    </style>
</head>

<body class="theme-{{ session('theme', 'default') }}">
    @if(Auth::check() && Auth::user()->role === 'Organizer')
        <h2>Welcome back, Organizer!</h2>
    @endif

    <div id="flashMessage" class="flash-message success" style="display: none;">
        Signed in successfully!
    </div>

    @if(session('error'))
        <div class="flash-message error">
            {{ session('error')}}
        </div>
    @endif

    <div id="flashMessageError" class="flash-message error" style="display: none;">
        Something went wrong.
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2>Sign Up</h2>

        <label>Name</label>
        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        @error('name')
            <small class="error-message" style="display:block;">{{ $message }}</small>
        @enderror

        <label>Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>

        <small id="email-status" class="error-message"></small>
        @error ('email')
            <small class="error-message" style="display:block;">{{ $message }}</small>
        @enderror
        
        <label>Password</label>
        <div style="position: relative;">
            <input type="password" name="password" id="password" required>
                <button type="button" id="toggle-pass-main" aria-label="Toggle Password Visibility" style="position:absolute; top: 50%; right: 10px; transform: translateY(-50%); background:transparent; border:none; cursor:pointer; color: #00000;">
                    <svg id="eye-open" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a0a0a0ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg id="eye-closed" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a0a0a0ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.27 21.27 0 0 1 5.17-5.9"/>
                        <path d="M1 1l22 22"/>
                    </svg>
                </button>
        </div>

        <label>Confirm Password</label>
        <div style="position: relative; margin-bottom: 30px;">
            <input type="password" id="confirm-password" name="password_confirmation" required>
            <button type="button" id="toggle-pass-confirm" aria-label="Toggle Password Visibility" style="position:absolute; top: 50%; right: 10px; transform: translateY(-50%); background:transparent; border:none; cursor:pointer; color: #00000;" aria-label="Show or hide password">
                    <svg id="eye-open-confirm" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a0a0a0ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg id="eye-closed-confirm" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a0a0a0ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;" aria-label="Show or hide confirm password">
                        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.27 21.27 0 0 1 5.17-5.9"/>
                        <path d="M1 1l22 22"/>
                    </svg>
            </button>

            @if(session('password_mismatch'))
                <small class="error-message" style="display:block; color: #e74c3c; margin-top:4px; text-align:center;">
                    {{ session('password_mismatch') }}
                </small>
            @endif
        </div>

        <button type="submit" id="signUpBtn">Sign Up</button>
        <button disabled id="loadingBtn" style="display:none;">Signing up</button>

        <div style="text-align:center;">
            @php 
                $locale = session('locale', 'en');
            @endphp

            @if ($locale === 'id')
                <p style="margin: 0; margin-top: 4px; font-size: 14px; margin-bottom: 8px; margin-top: 8px;">Sudah punya akun? <a href="{{ route('switchaccount.form') }}" style="color: #1184a0ff; text-decoration: none; font-weight: bold;">Sign In</a></p>
            @else
                <p style="margin: 0; margin-top: 4px; font-size: 14px; margin-bottom: 8px; margin-top: 8px;">Already have an account? <a href="{{ route('switchaccount.form') }}" style="color: #1184a0ff; text-decoration: none; font-weight: bold;">Sign In</a></p>
            @endif
        </div>
    </form>

    <div id="sessionWarning" style="display: none; position:fixed; top:0; left: 0; right:0; bottom: 0; background:rgba(0, 0, 0, 0.5); z-index:9999; justify-content:center; align-items:center;">
        <div style="background:white; padding: 30px; border-radius: 8px; text-align:center;">
            <p style="font-size: 1.1rem;">You’ve been inactive for a while. Continue?</p>
            <button onclick="resetTimer()" style="border-radius: 4px; background-color: #2193b0; color: white; border: 2px; padding: 6px 12px;">Yes, keep me signed in</button>
        </div>
    </div>

    <div class="wave-container">
        <svg viewBox="0 0 1440 320" preserveAspectRatio="none" class="wave-bg">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,288L40,266.7C80,245,160,203,240,197.3C320,192,400,224,480,229.3C560,235,640,213,720,192C800,171,880,149,960,138.7C1040,128,1120,128,1200,138.7C1280,149,1360,171,1400,181.3L1440,192L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z">
            </path>
        </svg>
    </div>

    <div id="refreshPrompt" style="display:none; position:fixed; top: 0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
        <div style="background:#fff; padding:30px; border-radius:8px; text-align:center;">
            <p> You’ve been inactive. Click below to refresh your session.</p>
            <button onclick="refreshSession()">Refresh Session</button>
        </div>
    </div>

    <script>
        document.querySelector("form").addEventListener("submit", function(e) {
            const pass = document.getElementById("password").value;
            const confirm = document.getElementById("confirm-password").value;

            if (pass !== confirm) {
                e.preventDefault();

                let existingError = document.getElementById("confirm-error");
                if(existingError) existingError.remove();

                const error = document.createElement("small");
                error.id = "confirm-error";
                error.textContent = "Password do not match.";
                error.className = "error-message";
                error.style.color = "red";
                error.style.display = "block";
                error.style.marginTop = "4px";

                document.getElementById("confirm-password").parentNode.appendChild(error);

                document.getElementById("signUpBtn").style.display = 'inline-block';
                document.getElementById("loadingBtn").style.display = 'none';

                return;
            }

            document.getElementById('signUpBtn').style.display = 'none';
            document.getElementById('loadingBtn').style.display = 'inline-block';
        });

        function togglePassword() {
            const pass = document.getElementById("password");
            pass.type = pass.type === "password" ? "text" : "password";
        }

        function showFlashMessage(type) {
            const success = document.getElementById("flashMessage");
            const error = document.getElementById("flashMessageError");

            success.style.display = "none";
            error.style.display = "none";

            const element = type === "success" ? success : error;
            element.style.display = "block";
            element.style.opacity = 1;

            setTimeout(() => {
                element.style.transition = "opacity 1s ease";
                element.style.opacity = 0;
                setTimeout(() => {
                    element.style.display = "none";
                }, 1000);
            }, 4000);
        }

        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if(alert) {
                setTimeout(() => alert.remove(), 500);
            }
        })

        document.getElementById('email').addEventListener('input', () => {
            document.getElementById('extra-options').style.display = 'block';
        });

        let timeoutWarning;
        let logoutTimer;
        const warningTime = 4 * 60 * 1000;
        const logoutTime = 5 * 60 * 1000;

        function startSessionTimers() {
            clearTimeout(timeoutWarning);
            clearTimeout(logoutTimer);

            timeoutWarning = setTimeout(() => {
                document.getElementById('sessionWarning').style.display = 'flex';
            }, warningTime);

            logoutTimer = setTimeout(() => {
                alert("You have been logged out due to inactivity.");
                window.location.href = "/logout";
            }, logoutTime);
        }

        function resetTimer() {
            document.getElementById('sessionWarning').style.display = 'none';
            startSessionTimers();
        }

        ['mousemove', 'keydown', 'click'].forEach(event => {
            document.addEventListener(event,resetTimer);
        });

        window.onload = startSessionTimers;

        document.getElementById("email").addEventListener("blur", function() {
            const email = this.value;
            const isValid = /\S+@\S+\.\S+/.test(email);
            const status = document.getElementById("email-status");
            status.textContent = isValid ? "Valid email" : "Invalid format";
        });

        const hour = new Date().getHours();
        document.body.classList.toggle('dark-mode', hour >= 18 || hour < 6);

        setTimeout(() => {
            const email = document.querySelector('input[name="email"]');
            if (email && email.value !== '') {
                console.log("Autofill detected");
            }
        }, 500);

        const pass = document.getElementById("password");
        const toggle = document.getElementById("toggle-pass");

        function refreshSession() {
            fetch('/refresh-session', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}'}})
                .then(() => {
                    document.getElementById('refreshPrompt').style.display = 'none';
                    startSessionTimers();
                });
        }

        function setupTogglePassword(toggleId, inputId, eyeOpenId, eyeClosedId) {
            const toggleBtn = document.getElementById(toggleId);
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(eyeOpenId);
            const eyeClosed = document.getElementById(eyeClosedId);

            toggleBtn.addEventListener("click", () => {
                const isPassword = input.type === "password";
                input.type = isPassword ? "text" : "password";
                eyeOpen.style.display = isPassword ? "none" : "block";
                eyeClosed.style.display = isPassword ? "block" : "none";
            });
        }

        setupTogglePassword("toggle-pass-main", "password", "eye-open", "eye-closed");
        setupTogglePassword("toggle-pass-confirm", "confirm-password", "eye-open-confirm", "eye-closed-confirm");

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        fetch('/refresh-session', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': token }
        });
    </script>
    
</body>
</html>
