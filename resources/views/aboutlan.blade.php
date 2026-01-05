<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>About</title>
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

        section {
            margin: 40px auto;
            max-width: 900px;
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        section h1 {
            color: #2e3a59;
            font-size: 28px;
            margin-bottom: 15px;
        }

        section h4 {
            margin: 10px 0;
            font-size: 20px;
            color: #555;
        }

        section p, section p1 {
            font-size: 16px;
            color: #555;
            margin: 8px 0;
            line-height: 1.6;
        }

        p1 {
            display: block;
            font-weight: bold;
            color: #2e3a59;
            margin-top: 15px;
        }

        #benefitberanda {
            padding: 40px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .benefit-container{
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-top: 30px;
            text-align: left;
            flex-wrap: wrap;
        }

        .benefit-column {
            flex: 1;
            min-width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0, 0.2);
            transition: transform 0.3 ease, box-shadow 0.3s ease;
        }

        .benefit-column:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0, 0.15);
        }

        .benefit-column h4 {
            font-size: 20px;
            color: #2e3a59;
            margin-bottom: 10px;
        }

        .benefit-column .title {
            font-weight: bold;
            margin-top: 20px;
            color: #555;
        }

        #aboutachieve {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
            text-align: center;
        }

        #aboutachieve h4 {
            margin: 0;
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
        <section id="aboutdesc">
            <h1>Boot Skill</h1>
            <p>Boot Skill is an innovative web platform established in 2025, created to connect bootcamp organizers with participants eager to enhance their skills. Featuring powerful tools focused on boosting soft skills—especially time management—Boot Skill empowers learners to stay organized and make the most of their training. At the same time, it offers organizers an efficient attendance management system, ensuring smooth and professional event execution.</p>
        </section>

        <section id="aboutachieve">
            <h1>Our Achievements</h1>
            <h4>0</h4>
            <h4>Alumni</h4>
            <h4>0</h4>
            <h4>Providers of Bootcamp</h4>
            <h4>0/5</h4>
            <h4>Bootcamp Web App</h4>
            <h4>0</h4>
            <h4>Partnership</h4>
        </section>

        <section id = benefitberanda>
            <h1>Experience These Amazing Benefits</h1>
            <div class="benefit-container">
                <div class="benefit-column">
                    <h4>Student</h4>
                    <p class="title">Effortless Activity Scheduling</p>
                    <p>Organize your study session, assignments, and extracurricular activities with our easy-to-use scheduling tools</p>
                    <p class="title">Practical Knowledge</p>
                    <p>Gain hands-on experience and real-world insights that go beyind textbooks, preparing you for future challenges tools</p>
                    <p class="title">Confidence Boost Through Evaluation</p>
                    <p>Track your progress and build confidence with regular evaluation tests that help you identity strengths and areas to improve</p>
                </div>
                <div class="benefit-column">
                    <h4>Event Creator</h4>
                    <p class="title">Student Attendance Tracking</p>
                    <p>Easily monitor and manage student attendance in real time, ensuring smooth event event flow and accurate records</p>
                    <p class="title">Intuitive Event Maker</p>
                    <p>Design, organize, and launch your events effortlessly with our user-friendly event creation tools</p>
                    <p class="title">Insert Evaluation Test Links</p>
                    <p>Seamlessly add evaluation test links to your events, allowing you to assess student understanding and progress directly</p>
                    <p class="title">Connect via Group Links</p>
                    <p>Share group chat or community links to foster communication and collaboration between you and your students</p>
                </div>
            </div>            
        </section>

        <section id ="deschowtouseland">
            <h1>How to Use Boot Skill</h1>
            <p><b>Getting started with Boot Skill is simple and designed to make your bootcamp experience smooth and productive</b>. Here's how you can make the most of our platform:</p>
            <p>1. <b>Sign Up and Explore:</b> Create your account quickly and browse available bootcamp programs tailored to your interests and goals.</p>
            <p>2. <b>Schedule Your Activities:</b> Use our intuitive calendar tools to organize your study sessions, workshops, and deadlines, helping you manage your time effectively.</p>
            <p>3. <b>Join Events Seamlessly:</b> Register for bootcamp sessions with just a few clicks and access all event details in one place.</p>
            <p>4. <b>Stay Connected:</b> Engage with instructors and fellow participants through integrated group links, fostering collaboration and community.</p>
            <p>5. <b>Track Your Progress:</b> Complete evaluation tests linked directly within events to assess your understanding and boost your confidence.</p>
            <p>6. <b>Efficient Attendance:</b> For organizers, manage participant attendance effortlessly, ensuring smooth event flow and accurate records.</p>
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

