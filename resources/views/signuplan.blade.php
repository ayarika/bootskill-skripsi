<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        main {
            padding: 20px;
            background-color: #fff;
        }

        nav {
            background: linear-gradient(to bottom, #66aef6ff, #79beedff);
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            height: 58px;
            flex-wrap: wrap;
        }

        nav h1 {
            font-size: 24px;
            margin: 0;
            line-height: 1;
        }

        nav a {
            margin-left: 15px;
            text-decoration: none;
            color: white;
            line-height: 1;
            padding: 8px 0;
        }

        .auth-wrapper {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 40px;
            padding: 60px 80px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            max-width: 900px;
            margin: 60px auto;
        }

        .auth-left {
            flex: 1;
            max-width: 580px;
            color: #2e3a59;
        }

        .auth-left h2 {
            font-size: 32px;
            font-weight: bold;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        .auth-left p {
            font-size: 15px;
            color: #333;
        }

        .auth-right {
            flex: 1;
            max-width: 450px;
            margin-top: 10px;
        }

        .auth-right h3 {
            margin-bottom: 20px;
            color: #2e3a59;
            text-align: center;
            font-size: 22px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form input {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        form input:focus {
            outline: none;
            border-color: #0c6ad8;
            box-shadow: 0 0 5px rgba(31, 111, 186, 0.4);
        }

        .btn-home {
            background-color: #1e90ff;
            color: white;
            padding: 10px 0;
            width: 100%;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-home:hover {
            background-color: #0c6ad8;
        }

        .auth-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .auth-footer a {
            color: #2e3a59;
            font-weight: bold;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .auth-wrapper {
                flex-direction: column;
                align-items: center;
                padding: 20px 10px;
                gap: 30px;
            }


            .auth-left, .auth-right {
                max-width: 100%;
                width: 100%;
                text-align: center;
            }

            .auth-left h2 {
                font-size: 26px;
            }

            .auth-left p {
                font-size: 14px;
                color: #444;
                margin-bottom: 2px;
            }

            .auth-right {
                margin-top: 0;
                width: 100%;
                align-items: center;
            }

            .auth-right h3 {
                font-size: 20px;
                margin-top: 10px;
                margin-bottom: 16px;
            }

            form {
                width: 100%;
                max-width: 1000px;
                display: flex;
                justify-content: center;
                flex-direction: column;
                gap: 15px;
            }

            form input {
                font-size: 14px;
                padding: 10px;
            }

            .btn-home {
                font-size: 15px;
                padding: 10px;
            }

            .auth-footer {
                margin-left: 10px;
                gap: 4px;
                font-size: 14px;
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <header>
    <nav>
        <h1>Boot Skill</h1>
        <div style="margin-left: auto; display: flex; gap: 10px;">
            <a href="/landinghome">Home</a>
            <a href="/aboutlan">About</a>
            <a href="/partnershiplan">Partnership</a>
            <a href="/signinlan">Sign in</a>
        </div>
    </nav>
    </header>

    <main>
        <div class="auth-wrapper">
            <section class="auth-left">
                @php
                    $sentence1= "Challenge and Develop Yourself Through Bootcamp";
                    $words = explode(" ", $sentence1);
                    $cuts = 3;
                    $firsts = implode(" ", array_slice($words, 0, $cuts));
                    $lasts = implode(" ", array_slice($words, $cuts));
                @endphp
                <h2 style="text-align: center; margin-top: 60px; font-size: 30px;">{!! $firsts !!}<br>{!! $lasts !!}</h2>
                @php
                    $sentence = "Discover diverse training programs from all our providers to boots your skills and career.";
                    $word = explode(" ", $sentence);
                    $cut = 9;
                    $first = implode(" ", array_slice($word, 0, $cut));
                    $second = implode(" ", array_slice($word, $cut));
                @endphp
                <p>{!! $first !!}<br>{!! $second !!}</p>
            </section>

            <section class="auth-right">
                <h3>Sign Up</h3>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                    <p id="js-error" style="color: red; font-size: 14px; margin-top: 5px; display: none;"></p>
                    <button type="submit" class="btn-home">Submit</button>
                </form>

                @if ($errors->any())
                    <div style="color:red; font-size:14px; margin-bottom:10px;">
                        {{ $errors->first() }}
                    </div>
                @endif
                
                <p style="margin-top: 15px; text-align: center">
                    Already have an account?
                    <a href="/signinlan" style="color: #1f6fba; text-decoration: none; font-weight: bold;">Sign in</a>
                </p>
            </section>
        </div>
    </main>


    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.querySelector("form");
            const jsError = document.getElementById("js-error");

            form.addEventListener("submit", (e) => {
                const password = document.getElementById("password").value;
                let message = "";
                if (password.length < 6) {
                    message = "Password must be at least 6 characters long.";
                }

                if (message) {
                    e.preventDefault();
                    jsError.textContent = message;
                    jsError.style.display = "block";
                } else {
                    jsError.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>