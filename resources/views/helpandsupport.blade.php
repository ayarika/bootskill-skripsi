<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Help</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            line-height: 1.6;
        }

        main {
            padding: 30px 20px;
            background-color: white;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to bottom, #66aef6ff, #79beedff);
            padding: 15px 25px;
            color: white;
            flex-wrap: wrap;
        }

        nav h1 {
            margin: 0;
            font-size: 24px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        section {
            background-color: #e6f0fb;
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            border-radius: 10px;
            transition: background-color 0.3s;
            cursor: pointer;
        }

        section:hover {
            background-color: #d4e5fb;
        }

        section p {
            font-size: 18px;
            margin: 0;
            color: #1f6fba;
        }

        #popup {
            display: none;
            position: absolute;
            background-color: #333;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            max-width: 300px;
            font-size: 14px;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
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
        <section 
            onmouseover="showPopup(event, 'You can easily sign up by creating an account on our platform, browsing available bootcamps, and selecting the program that fits your goals. Then, follow the registration prompts to secure your spot.')"
            onmouseout="hidePopup()"
        >
            <p>How do I register for a bootcamp program?</p>
        </section>

        <section 
            onmouseover="showPopup(event, 'Yes! Our platform includes a scheduling feature that helps you organize your study sessions, assignments, and events to manage your time effectively.')"
            onmouseout="hidePopup()"
        >
            <p>Can I schedule and manage my learning activities within the app?</p>
        </section>

        <section 
            onmouseover="showPopup(event, 'Organizers can monitor participant attendance in real time through our efficient attendance management system, ensuring smooth event execution.')"
            onmouseout="hidePopup()"
        >
            <p>How does attendance tracking work for bootcamp organizers?</p>
        </section>

        <section 
            onmouseover="showPopup(event, 'Absolutely. You can join group chats and communities via integrated group links provided within each bootcamp event to foster collaboration and communication.')"
            onmouseout="hidePopup()"
        >
            <p>Is there a way to connect with other participants and instructors?</p>
        </section>

        <section 
            onmouseover="showPopup(event, 'Yes, evaluation test links can be embedded directly into events, allowing you to assess your progress and reinforce your learning effectively.')"
            onmouseout="hidePopup()"
        >
            <p>Can I take evaluation tests through the platform?</p>
        </section>

        <div id="popup" style="display: none; position: absolute; background: #101010; border: 1px solid #ccc; padding: 5px; max-width: 300px;"></div>
        
        <script>
            const popup = document.getElementById('popup');

            function showPopup(event, text){
                popup.style.display= 'block';
                popup.textContent= text;
                popup.style.top = (event.clientY + 10) + 'px';
                popup.style.left = (event.clickX + 10) + 'px';
            }

            function hidePopup(){
                popup.style.display = 'none';
                popup.textContent = ''
            }

        </script>

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