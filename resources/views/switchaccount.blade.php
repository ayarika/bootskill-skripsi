<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" >
    <title>Switch Account</title>
    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
        }

        form {
            background-color: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 20px;
            animation: fadeIn 1s ease-in-out;
            transform: translate(0%, 0%);
        }

        h2 {
            text-align: center;
            font-weight: 600;
            margin-bottom: 20px;
            font-size: 1.8rem;
            animation: textColorShift 15s ease infinite;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
        }

        @keyframes textColorShift {
            0% { color: #fff; }
            25% { color: #e0e0e0; }
            50% { color: #2e3a59; }
            75% { color: #304374ff; }
            100% { color: #fff; }
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
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

        input[type="text"],
        input[type="password"] {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
            outline: none;
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

        @media (min-width: 601px) and (max-width: 1024px) {
            body {
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding: 30px;
            }

            h2 {
                text-align: center;
                font-size: 1.6rem;
                margin-bottom: 30px;
            }

            form {
                width: 90%;
                max-width: 450px;
                margin-top: 0;
            }
            
            .social-login {
                width: 100%;
                max-width: 450px;
            }
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 20px;
        }

        @media (min-width: 1025px) {
            body {
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            h2 {
                margin-bottom: 10px;
                font-size: 1.8rem;
                text-align: center;
            }

            form {
                margin-top: 0;
                max-width: 420px;
            }
        }

        @media (min-width: 1025px) {
            form {
                text-align: left !important;
            }

            form label:nth-of-type(1),
            form label:nth-of-type(2) {
                text-align: left !important;
                width: 100%;
                display: block;
            }

            form input[type="email"],
            form input[type="password"] {
                text-align: left !important;
                padding-left: 14px;
            }
        }

        .dont-have-account {
            white-space: nowrap;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px 25px;
            border-radius: 10px;
            width: 90%;
            max-width: 380px;
            text-align: center;
            box-shadow: 0 5px 25px rgba(0,0,0,0.2);
            animation: slideUp 0.4s ease;
        }

        .modal-content h3 {
            margin-bottom: 10px;
            color: #2e3a59;
        }

        .modal-content p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .modal-content input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .modal-content button {
            background-color: #2193b0;
            color: #fff;
            border: none;
            padding: 10px 14px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }

        .modal-content button:hover {
            background-color: #4fc3f7;
        }

        #forgotPassModal form {
            display: flex;
            flex-direction: column;
            gap: 14px;
            width: 100%;
            align-items: stretch;
        }

        #forgotPassModal input[type="email"] {
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
        }

        #forgotPassModal button {
            width: 100%;
            padding: 12px 14px;
            border-radius: 6px;
            background: linear-gradient(90deg, #2193b0, #6dd5ed);
            color: #fff;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        #forgotPassModal button:hover {
            background: linear-gradient(90deg, #4fc3f7, #2193b0);
            transform: translateY(-2px);
        }

        .modal-content p {
            margin-bottom: 15px;
        }

        .close-btn {
            position: absolute;
            top: 12px;
            right: 20px;
            font-size: 24px;
            color: #888;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-btn:hover {
            color: #333;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translate(0);
                opacity: 1;
            }
        }

        .forgot-password {
            width: 100%;
            text-align: right;
            margin-top: 4px;
            margin-bottom: -4px;
        }

        .forgot-password a {
            font-size: 13px;
            color: #2193b0;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease, text-decoration 0.3s ease;
        }

        .forgot-password a:hover {
            color: #176a80;
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .forgot-password {
                text-align: right;
                margin-top: 6px;
            }

            .forgot-password a {
                font-size: 14px;
            }
        }

        body > form {
            background-color: #fff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-top: 20px;
            animation: fadeIn 1s ease-in-out;
            transform: translate(0%, 0%);
        }

        #forgotPassModal form {
            all: unset;
            display: flex;
            flex-direction: column;
            gap: 12px;
            width: 100%;
            text-align: left;
        }

        #forgotPassModal input[type="email"] {
            all: unset;
            box-sizing: border-box;
            width: 100%;
            padding: 12px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            color: #333;
        }

        #forgotPassModal button {
            all: unset;
            text-align: center;
            background: linear-gradient(90deg, #2193b0, #6dd5ed);
            color: #fff;
            border-radius: 6px;
            padding: 12px 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        #forgotPassModal button:hover {
            background: linear-gradient(90deg, #4fc3f7, #2193b0);
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="container">
    @if(Auth::check() && Auth::user()->role === 'Organizer')
        <h2>Welcome Back!</h2>
    @endif

    <form method="POST" action="{{ route('switchaccount.login') }}">
        @csrf

        <h2 style="color: #2e3a59 !important;">Sign In</h2>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <small class="error-message">Email not valid</small>
        
        <label for="password">Password</label>
        <div style="position: relative;">
            <input type="password" name="password" id="password" required>
                <button type="button" id="toggle-pass" aria-label="Toggle Password Visibility" style="position:absolute; top: 50%; right: 10px; transform: translateY(-50%); background:transparent; border:none; cursor:pointer; color: #00000;">
                    <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a0a0a0ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#a0a0a0ff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;">
                        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.27 21.27 0 0 1 5.17-5.9"/>
                        <path d="M1 1l22 22"/>
                    </svg>
                </button>
        </div>

        
        @if(session('error'))
            <div class="flash-message error" style="text-align:center; color: #e74c3c;">
                {{ session('error')}}
            </div>
        @endif

        <div class="forgot-password">
            <a href="#" id="forgotPassBtn">Forgot Password?</a>
        </div>
           

        <button type="submit" id="signInBtn" onclick="handleLogin()">Sign In</button>
        <button disabled id="loadingBtn" style="display:none;">Signing in</button>

        <div style="text-align:center;">
            @php 
                $locale = session('locale', 'en');
            @endphp

            @if ($locale === 'id')
                <p class="dont-have-account" style="margin: 0; margin-tip: 4px; font-size: 14px; align-items:center;">
                    Belum punya akun?
                    <a href="/signupacc" style="color: #11840ff; text-decoration: none; font-weight: bold;">Sign Up</a>
                </p>
            @else
                <p class="dont-have-account" style="margin: 0; margin-top: 4px; font-size: 14px; align-items:center;">                    Don't have an account?
                <a href="/signupacc" style="color: #1184a0ff; text-decoration: none; font-weight: bold;">Sign Up</a>
                </p>
            @endif
        </div>
        
        
    </form>

    <div id="sessionWarning" style="display: none; position:fixed; top:0; left: 0; right:0; bottom: 0; background:rgba(0, 0, 0, 0.5); z-index:9999; justify-content:center; align-items:center;">
        <div style="background:white; padding: 30px; border-radius: 8px; text-align:center;">
            <p style="font-size: 1.1rem;">You’ve been inactive for a while. Continue?</p>
            <button onclick="resetTimer()">Yes, keep me signed in</button>
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
            <p>You’ve been inactive. Click below to refresh your session.</p>
            <button onclick="refreshSession()">Refresh Session</button>
        </div>
    </div>

    <div id="forgotPassModal" class="modal">
        <div class="modal-content">
            <span class="close-btn">&times;</span>
            <h3>Reset Password</h3>
            <p>Enter your new password below.</p>
            <form id="resetForm" method="POST" action="{{ route('newpass') }}">
                @csrf 
                <label>Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>

                <label>New Password</label>
                <input type="password" name="password" placeholder="New Password" required>

                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

                <button type="submit">Reset Password</button>

                <small id="resetSuccess" style="display:none; color:green;"></small>
                <small id="resetError" style="display:none; color:red;"></small>
            </form>
        </div>
    </div>
        

    <script>
        function handleLogin() {
            document.getElementById('signInBtn').style.display = 'none';
            document.getElementById('loadingBtn').style.display = 'inline-block';
        }

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
                    startIdleTimer();
                });
        }

        const toggleBtn = document.getElementById("toggle-pass");
        const passwordInput = document.getElementById("password");
        const eyeOpen = document.getElementById("eye-open");
        const eyeClosed = document.getElementById("eye-closed");

        toggleBtn.addEventListener("click", () => {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                eyeOpen.style.display = "none";
                eyeClosed.style.display = "block";
            } else {
                passwordInput.type = "password";
                eyeOpen.style.display = "block";
                eyeClosed.style.display = "none";
            }
        });

        const modal = document.getElementById("forgotPassModal");
        const btn = document.getElementById("forgotPassBtn");
        const closeBtn = document.querySelector(".close-btn");

        btn.addEventListener("click", (e) => {
            e.preventDefault();
            modal.style.display = "flex";
        });

        closeBtn.addEventListener("click", () => {
            modal.style.display = "none";
        });

        window.addEventListener("click", (e) => {
            if (e.target === modal) {
                modal.style.display = "none";
            }
        });

        document.getElementById("resetForm").addEventListener("submit", function(e) {
            e.preventDefault();

            const form = this;
            const password = form.querySelector("input[name='password']").value;
            const confirm = form.querySelector("input[name='password_confirmation']").value;

            let existingError = document.getElementById("modal-confirm-error");
            if (existingError) existingError.remove();

            if (password !== confirm) {
                const error = document.createElement("small");
                error.id = "modal-confirm-error";
                error.style.color = "red";
                error.textContent = "Passwords do not match";

                form.querySelector("input[name='password_confirmation']")
                    .parentNode.appendChild(error);
                return;
            }

            const formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: formData
            })
            .then(async res => {
                const data = await res.json();
                if (!res.ok) throw data;

                document.getElementById("resetSuccess").textContent = 
                    "Password successfully reset. Please login.";
                document.getElementById("resetSuccess").style.display = "block";

                setTimeout(() => {
                    document.getElementById("forgotPassModal").style.display = "none";
                    form.reset();
                }, 1500);
            })
            .catch(err => {
                document.getElementById("resetError").textContent = 
                    err.message || "Failed to reset password";
                document.getElementById("resetError").style.display = "block";
            });
        });
        
    </script>
    
</body>
</html>
