<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Home</title>
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

        #beranda {
            text-align: center;
            padding: 60px 20px;
            background-color: #e6f0fb;
        }

        #beranda h1 {
            font-size: 36px;
            color: #2e3a59;
            margin-bottom: 10px;
        }

        #beranda p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
        }

        .btn-signuplan,
        .btn-moredetails {
            padding: 10px 20px;
            margin: 10px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .btn-signuplan {
            background-color: #1e90ff;
            color: white;
        }

        .btn-moredetails {
            background-color: white;
            color: #1e90ff;
            border: 2px solid #1e90ff;
        }

        #detail-wrapper {
            display: flex;
            justify-content: center;
            gap: 40px;
            text-align: center;
            margin: 30px 0;
        }

        .detail-item h4 {
            color: #555;
            font-size: 24px;
            margin-bottom: 5px;
        }

        .detail-item p {
            color: #555;
            font-weight: bold;
        }
        
        #benefitberanda {
            background-color: #f0f8ff;
            padding: 50px 20px;
        }

        #benefitberanda h1 {
            text-align: center;
            font-size: 30px;
            margin-bottom: 40px;
            color: #2e3a59;
        }

        #benefitberanda h4 {
            margin-top: 25px;
            font-size: 22px;
            color: #2e3a59;
        }

        #benefitberanda p1 {
            display: block;
            font-weight: bold;
            margin: 15px 0 5px;
            color: #333;
        }

        #benefitberanda p {
            margin-bottom: 15px;
            color: #555;
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
            color: #333;
        }

        #myschedulepreview,
        #evaluationtestpreview,
        #studenttestimonypreview {
            background-color: #fff;
            padding: 30px 20px;
            text-align: center;
        }

        .testimonial-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            margin-top: 30px;
            text-align: left;
            flex-wrap: wrap;
        }

        #myschedulepreview h4,
        #evaluationtestpreview h4,
        #studenttestimonypreview h4 {
            font-size: 24px;
            color: #2e3a59;
        }

        #myschedulepreview p,
        #evaluationtestpreview p {
            color: #555;
        }

        .studenttestimony,
        .eventcreatortestimony {
            background-color: #fff;
            padding: 20px;
            flex: 1;
            min-width: 300px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3 ease;
        }

        .studenttestimony:hover,
        .eventcreatortestimony:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0, 0.2);
        }

        .studenttestimony p,
        .eventcreatortestimony p {
            font-style: italic;
            color: #333;
            margin-bottom: 5px;
        }

        .studenttestimony h4,
        .eventcreatortestimony h4 {
            margin-top: 10px;
            color: #2e3a59;
            margin-bottom: 2px;
        }

        .studenttestimony h7,
        .eventcreatortestimony h7 {
            display: block;
            font-size: 14px;
            color: #888;
            margin-top: 2px;
            margin-bottom: 25px;
        }

        #startexplor {
            text-align: center;
            padding: 50px 20px;
            background-color: #e6f0fb;
        }

        #startexplor h1 {
            font-size: 28px;
            color: #2e3a59;
        }

        #startexplor p {
            font-size: 16px;
            color: #444;
            margin-bottom: 20px;
        }

        .btn-startexplan {
            background-color: #1e90ff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
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
        <section id="beranda">
            <h1>Challenge and Develop Yourself Through Bootcamp</h1>
            <p>Discover diverse training programs from all of our providers to boost your skills and career</p>
            
            <button onclick= "location.href='/signuplan'" class="btn-signuplan">Register Now</button>
            <button onclick= "location.href='/aboutlan'" class="btn-moredetails">More Details</button>
        </section>

        <section id="detail-wrapper">
            <div class="detail-item">
                <h4>0</h4>
                <p>Alumni</p>
            </div>
            <div class="detail-item">
                <h4>0</h4>
                <p>Organizer Bootcamp</p>
            </div>
            <div class="detail-item">
                <h4>0/5</h4>
                <p>Bootcamp Web App</p>
            </div>
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

        <section id= myschedulepreview>
            <h4>Plan Your Day Effectively</h4>
            <p> Customize your daily reminders by creating, editing, or deleting them</p>
        </section>
        <section id= evaluationtestpreview>
            <h4>Evaluate Your Abilities and Understanding</h4>
            <p> Move ahead to the next level by completing a few questions</p>
        </section>
        <section id= studenttestimonypreview>
            <h4>Let's Listen To Their Testimony</h4>
            <div class="testimonial-container">
                <div class= studenttestimony>
                    <p>This program completely transformed the way I approach my studies. The practical knowledge and evaluation tests really helped boost my confidence. Highly recommend!</p>
                    <h4>Nabila M</h4>
                    <h7>Participant of "Gen Z: The Future of  Work" Bootcamp by Nusantara Group</h7>

                    <p>I loved how flexible the scheduling system was. It allowed me to balance my activities and learning seamlessly. The support from mentors was also fantastic.</p>
                    <h4>Emily R</h4>
                    <h7>Participant of "Level Up: Leadership" Bootcamp by Calif Group</h7>

                    <p>The tools for scheduling activities and the regular quizzes really kept me motivated. I feel more prepared and confident for my exams than ever before!</p>
                    <h4>David M</h4>
                    <h7>Participant of "1001 UI/UX" Bootcamp by IT Group</h7>

                </div>
                <div class= eventcreatortestimony>
                    <p>Using the intuitive event maker made organizing our community workshops at Bright Minds Academy effortless. Adding the group link helped us keep participants connected, and the evaluation test links allowed us to measure their progress effectively.</p>
                    <h4>Lisa B</h4>
                    <h7>Event Coordinator, Bright Minds Academy</h7>

                    <p>As an individual event creator, the ability to insert evaluation test links directly into my events has been a game changer. The intuitive event maker simplifies the entire process, and sharing group links keeps my attendees engaged even after the event.</p>
                    <h4>Mark J</h4>
                    <h7>Independent Event Creator</h7>

                    <p>At Future Leaders Network, the combination of the intuitive event maker and the option to add group and evaluation test links has transformed how we run our training sessions. It's efficient and keeps our students motivated.</p>
                    <h4>Amanda M</h4>
                    <h7>Program Manager, Future Leaders Network</h7>
                </div>
            </div>
        </section>

        <section id= startexplor>
            <h1>Looking for Complete Information About Boot Skill?</h1>
            <p>Get to Know Our Features, Providers, and How to Get Started</p>
            <button onclick= "location.href='/aboutlan'" class="btn-startexplan">Start Exploring</button>
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

    <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>

