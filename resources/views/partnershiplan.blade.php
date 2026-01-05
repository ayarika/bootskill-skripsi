<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Partnership</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
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
            flex-wrap: wrap;
        }

        nav h1 {
            font-size: 24px;
            margin: 0;
        }

        nav a {
            margin-left: 15px;
            text-decoration: none;
            color: white;
        }

        nav a:hover {
            text-decoration: underline;
        }

        #listpartner {
            text-align: center;
            padding: 80px 20px;
            min-height: 60vh;
        }

        #listpartner h1 {
            font-size: 32px;
            color: #2e3a59;
            margin-bottom: 15px;
        }

        #listpartner p {
            font-size: 18px;
            color: #444;
        }

        footer {
            margin-top: 60px;
            padding: 30px 20px;
            background: linear-gradient(to bottom, #66aef6ff, #79beedff);
            color: white;
            text-align: center;
        }

        footer h4, footer h3 {
            margin: 10px 0;
        }

        footer a {
            color: white;
            text-decoration: none;
            display: inline-block;
            margin: 3px 10px;
        }

        footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <header>
    <nav>
        <h1>Boot Skill</h1>
        <div style="margin-left: auto; display: flex; gap: 10px;">
            <a href="/landinghome"><p>Home</p></a>
            <a href="/aboutlan"><p>About</p></a>
            <a href="/partnershiplan"><p>Partnership</p></a>
            <a href="/signinlan"><p>Sign in</p></a>
        </div>
    </nav>
    </header>

    <main>
        <section id="listpartner">
            <h1>Our Partnership</h1>
            <p>Coming Soon</p>

        </section>

        <footer>
            <h4><b>About</b></h4>
            <a href="/aboutlan"><p>About Us</p></a>
            <a href="/contactuslan"><p>Contact Us</p></a>
            <a href="/helpandsupport"><p>Help and Support</p></a>
            <h3>Boot Skill</h3>
            <p>&copy; 2025 Boot Skill. All rights reserved.</p>
        </footer>
    </main>
</body>
</html>