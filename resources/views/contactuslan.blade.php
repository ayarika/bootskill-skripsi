<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Contact Us</title>
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

        #contactlan {
            background-color: #fff;
            padding: 50px 20px;
            text-align: center;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0, 0.1);
            max-width: 600px;
        }

        #contactlan p {
            font-size: 18px;
            margin: 10px 0;
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
        <section id="contactlan">
            <h1 style="color:#2e3a59;">Get in Touch with Us at</h1>
            <p style="color:#2e3a59;">Email: bootskill@gmail.com</p>
            <p style="color:#2e3a59;">Instagram: @bootskill</p>
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