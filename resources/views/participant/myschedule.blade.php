<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Schedule</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
        }

        .hamburger-btn {
            position: fixed;
            top: 20px;
            left: 10px;
            background: transparent;
            border: none;
            color: #2e3a59;
            z-index: 2001;
            cursor: pointer;
        }

        .hamburger-btn.active {
            color: white;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 170px;
            background: linear-gradient(to bottom, #66aef6ff, #79beedff);
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .sidebar a{
            display: block;
            padding: 10px 0 20px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }

        .sidebar a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            padding-left: 8px;
            transition: all 0.2s ease;
        }

        .footer-nav a:hover, .footer-nav a[href="/aahowtousebootskill"]:hover {
            background: none;
            border-radius: 0;
        }

        .sidebar h3 {
            margin-bottom: 20px;
            margin-top: 60px;
        }

        .main-content {
            margin-left: 170px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .main-content.pushed {
            margin-left: 0px;
        }


        .main-content.full {
            margin-left: 0;
        }

        .sidebar.hidden {
            transform: translateX(-100%);
        }

        .footer-nav{
            margin-top: 180px;
            font-size: 0.85em;
            color: #666;
        }

        .footer-nav .link-row{
            display: flex;
            justify-content: flex-start;
            gap: 8px;
            margin-bottom: 4px;
        }

        .footer-nav a {
            text-decoration: none;
            color: #555;
            font-weight: normal;
            font-size: 0.85em;
            line-height: 1.2;
            display: inline-block;
            padding: 2px 0;
        }

        .footer-nav a[href="/aahowtousebootskill"]{
            display: block;
            margin-top: 2px;
            font-size: 0.9em;
            color: #555;
        }

        .footer-nav .block link {
            display: block;
            margin-bottom: 8px;
        }

        .footer-nav .copyright {
            font-size: 0.8em;
            color: #999;
            margin-top: 4px;
            display: block;
        }

        #mainpage {
            transition: margin-left 0.3s ease;
        }

        #mainpage.pushed{
            margin-left: 170px;
        }

        .schedule-page {
            margin-left: 40px;
            height: 70px;
            margin-top: 35px;
        }

        .schedule-card {
            position: relative;
            border-radius: 12px;
            padding: 16px 20px;
            background: #fff;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            overflow: visible !important;
            animation: fadeInCard 0.35s ease forwards;
        }

        .schedule-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.12);
        }

        .schedule-card:hover .priority-label {
            opacity: 1;
            transform: translateY(0) scale(1.05);
        }

        .schedule-card[data-priority="high"] .priority-strip {
            border-left-color: #e74c3c;
        }

        .schedule-card[data-priority="medium"] .priority-strip {
            border-left-color: #e67e22;
        }

        .schedule-card[data-priority="low"] .priority-strip {
            border-left-color: #f1c40f;
        }

        .schedule-card[data-priority="not_urgent_not_important"] {
            border-left-color: #2ecc71;
        }

        .schedule-card.hide {
            opacity: 0;
            transform: translateY(6px) scale(.99);
            pointer-events: none;
            height: auto;
        }

        .priority-strip {
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            bottom: 0;
            width: 6px;
            background: linear-gradient(to bottom, #4cafef, #1976d2);
            border-radius: 2px;
            margin-bottom: 30px;
            height: 100%;
            transition: background-color 0.3s ease;
        }

        .status-badge {
           font-size: 12px;
           font-weight: bold;
           padding: 4px 8px;
           border-radius: 6px;
           margin-top: 10px;
           text-transform: uppercase;
           color: #fff;
           transition: background 0.3s ease;
        }

        .status-badge.show {
            opacity: 1;
            transform: translateY(0);
        }

        .status-badge-upcoming {
            background: #3498db;
            color: white;
        }

        .status-badge.ongoing {
            background: #27ae60;
            color: white;
        }

        .status-badge.ended {
            background: #7f8c8d;
            color: white;
        }

        .status-upcoming {
            background: #457b9d;
        }

        .status-ongoing {
            background: #2a9d8f;
        }

        .status-completed {
            background: #6c757d;
        }

        .empty-state {
            text-align: center;
            padding: 30px;
            color: #777;
            background: #fafafa;
            border: 1px dashed #ddd;
            border-radius: 8px;
            grid-column: 1 / -1;
        }

        .empty-state p {
            margin-bottom: 12px;
            color: #888;
        }

        .empty-state .add-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 14px;
            background: #2a9d8f;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }

        .empty-state .add-btn:hover {
            background: #23867a;
        }

        .highlight-match {
            background-color: #fff3a7;
            padding: 0 2px;
            border-radius: 2px;
        }

        .highlight-today {
            outline: 3px solid #ff9800;
            background-color: rgba(255, 244, 229, 0.9);
            transition: background-color 0.2s ease;
        }

        .schedule-card h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #2e3a59;
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .schedule-desc {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 8px;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: anywhere;
        }

        .schedule-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            border-bottom: 1px solid #f1f1f1;
        }

        .priority-icon {
            font-size: 1.2rem;
        }

        .schedule-card h3,
        .schedule-title {
            font-size: 18px;
            font-weight: 600;
            color: #2e3a59;
            margin-bottom: 6px;
            word-wrap: break-word;
            white-space: normal;
            overflow: hidden;
        }

        .schedule-link {
            background: linear-gradient(45deg, #4cafef, #1976d2, #4cafef);
            background-size: 400% 400%;
            animation: gradientAnim 6s ease infinite;
            color: white;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            border-radius: 6px;
            padding: 0 16px;
            font-size: 13px;
            height: 20px;
            min-width: 40px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            position: relative;
        }

        .schedule-link:hover {
            background: #176392ff;
        }

        @keyframes gradientAnim {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        @media (max-width: 400px) {
            .schedule-link {
                font-size: 13px;
                padding: 10px;
            }
        }

        .badge-bootcamp {
            display: inline-block;
            margin-top: 8px;
            background: #3b82f6;
            color: white;
            position: absolute;
            font-size: 0.7rem;
            padding: 4px 8px;
            border-radius: 8px;
        }

        .edit-schedule-btn {
            background: linear-gradient(135deg, #66aef6ff, #79beedff);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            margin-right: 10px;
            margin-top: 15px;
        }

        .edit-schedule-btn:hover {
            background: linear-gradient(135deg, #5fa9f3ff, #60b4ecff);
        }

        .schedule-description {
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            color: #555;
        }

        .priority-legend {
            margin-bottom: 1.5rem;
        }

        .priority-legend ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .priority-legend li {
            display: flex;
            align-items: center;
            font-size: 0.9rem;
            color: #333;
        }

        .priority-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
        }

        .red {background-color: red;}
        .orange {background-color: orange;}
        .yellow {background-color: #3498db;}
        .green {background-color: #7f8c8d;}

        .calender-container {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-size: 0.95rem;
            color: #333;
            margin-bottom: 1.5rem;
        }

        .calender-container label{
            font-weight: 600;
            color: #2e3a59;
        }

        .calender-container input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border 0.2s ease, box-shadow 0.2s ease;
            box-sizing: border-box;
        }

        .schedule-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            padding: 1rem; 
        }

        .urgent-important { background-color: #ffe5e5; }
        .urgent-not-important { background-color: #fff4e5; }
        .important-not-urgent { background-color: #fffde5; }
        .not-urgent-not-important { background-color: #e5ffe5; }
        
        .schedule-time-row {
            padding: 6px 6px;
            display: flex;
            justify-content: space-between;
            font-weight: 500;
            gap: 4px;
            background: linear-gradient(270deg, #4cafef, #1976d2, #4cafef);
            background-size: 400% 400%;
            animation: gradientMove 6s ease infinite;
            color: #e7dfdfff;
            border-radius: 7px;
            max-width: 200px;
            margin-top: 4px;
            flex: 1 1 100%;
            font-size: 13px;
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .schedule-dates {
            margin-top: 10px;
            min-width: 80px;
            color: #838383ff;
            display: flex;
            font-size: 14px;
        }

        .schedule-title {
            font-size: 18px;
            font-weight: 600;
            color: #2e3a59;
            margin-bottom: 4px;
        }

        .schedule-controls input,
        .schedule-controls select {
            padding: 8px;
            font-size: 14px;
        }

        @media screen and (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar:not(.hidden) {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.full {
                margin-left: 0;
            }

        }

        @media (min-width: 769px) {
            .sidebar {
                width: 170px;
                transform: translateX(0);
            }

            .sidebar.hidden {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 170px;
                transition: margin-left 0.3s ease;
            }

            .sidebar.hidden + .main-content {
                margin-left: 0;
            }
        }

        .schedule-controls {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            align-items: center;
        }

        .schedule-controls button {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 2px 5px rgba (0, 0, 0, 0.08);
        }

        #jumpToday {
            background: linear-gradient(135deg, #66aef6ff, #79beedff);
            color: white;
        }

        #jumpToday:hover {
            background: linear-gradient(135deg, #5fa9f3ff, #60b4ecff);
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(25, 118, 210, 0.3);
        }

        #jumpToday:active {
            transform: scale(0.97);
        }

        #resetFilters {
            background: linear-gradient(135deg, #f8997dff, #f8764eff);
            color: white;
        }

        #resetFilters:hover {
            background: linear-gradient(135deg, #fa9576ff, #f5663aff);
            transform: transformY(-1px);
            box-shadow: 0 4px 8px rgba(229, 57, 53, 0.3);
        }

        #resetFilters:active {
            transform: scale(0.97);
        }
        
        .schedule-controls input[type="text"],
        .schedule-controls select {
            padding: 10px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #fff;
            outline: none;
            transition: all 0.2s ease-in-out;
            flex: 1;
            min-width: 200px;
        }

        .schedule-controls input[type="text"]:hover {
            border-color: #007bff;
        }

        .schedule-controls input[type="text"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        @media (max-width: 600px) {
            .schedule-controls {
                flex-direction: column;
            }

            .schedule-controls input[type="text"],
            .schedule-controls select {
                width: 100%;
            }
        }

        .schedule-time-row span:first-child {
            margin-right: 2px;
        }

        .btn-share-main {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #2ecc71, #0fd70bff, #2ecc71);
            background-size: 400% 400%;
            animation: gradientAnim 6s ease infinite;
            border: none;
            color: white;
            padding: 6px 8px;
            cursor: pointer;
            display: flex;
            flex-shrink: 0;
            margin: 0;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease, color 0.3s ease;
        }

        .btn-share-main:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(66, 165, 245, 0.7);
                        0 0 15px rgba(25, 118, 210, 0.5);
            animation: gradientAnim 6s ease infinite;
        }

        .btn-share-main svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
            display: inline-block;
        }

        @keyframes gradientAnim {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .share-icon {
            width: 16px;
            height: 16px;
        }

        .share-options-compact {
            display: none;
            flex-direction: column;
            gap: 5px;
            position: absolute;
            top: 100%;
            right: 0;
            transform: translateY(6px) scale(0.95);
            background: #fff;
            border: 1px solid #ccc;
            padding: 6px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            opacity: 0;
            pointer-events: none;
            visibility: hidden;
            transition: opacity 0.25s ease, transform 0.25s ease, visibility 0.25s;
            width: 200px;
            min-width: 150px;
            max-width: 250px;
            z-index: 999999;
        }

        .share-options-compact a,
        .share-options-compact button {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            text-decoration: none;
            color: #333;
            margin-bottom: 3px;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .share-options-compact.show {
            display: flex;
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 8px 12px;
            gap: 6px;
            border-radius: 6px;
            font-size: 12px;
            text-decoration: none;
            color: #fff;
            background: #2980b9;
            transition: background 0.2s ease, transform 0.2s ease;
            width: 100%;
            box-sizing: border-box;
            flex: none;
        }

        .social-btn svg {
            fill: currentColor;
            transition: color 0.2s ease;
            display: inline-block;
        }

        .social-btn span {
            display: inline-block;
        }

        .social-btn:hover {
            background: #1c5980;
        }

        .social-btn.whatsapp:hover {
            color: #000;
        }

        .social-btn.telegram:hover {
            color: #000;
        }

        .social-btn.twitter:hover {
            color: #000;
        }
        
        .social-btn img {
            width: 18px;
            height: 18px;
            color: white;
        }

        .social-btn:hover {
            transform: scale(1.2);
        }

        .social-btn.whatsapp {
            background: linear-gradient(45deg, #23f279ff, #25D366, #14d062ff);
            color: #fff;
        }

        .share-options-compact a:hover svg {
            fill: black;
        }

        .social-btn.telegram {
            background: linear-gradient(45deg, #1baff9ff, #0088cc, #137db3ff);
            color: #fff;
        }

        .social-btn.twitter {
            background: linear-gradient(45deg, #39b2fdff, #1DA1F2, #0f87d2ff);
            color: #fff;
        }

        .social-btn.whatsapp img,
        .social-btn.telegram img,
        .social-btn.twitter img {
            filter: invert(1);
        }

        .share-options-compact a {
           display: flex;
           align-items: center;
           gap: 6px;
           opacity: 1;
           transform: translateY(0);
           transition: transform 0.25s ease, opacity 0.25s ease;
        }

        .share-options-compact a span {
            margin-right: 8px;
        }

        .share-options-compact a:hover {
            background: #f0faff;
            color: #000;
            transform: translateX(4px);
            filter: brightness(1.1);
        }

        .whatsapp span {
            color: #fff;
        }

        .telegram span {
            color: #fff;
        }

        .twitter span {
            color: #fff;
        }

        .social-btn.whatsapp:hover span,
        .social-btn.telegram:hover span,
        .social-btn.twitter:hover span {
            color: #000;
        }

        .share-options-compact .social-btn img,
        .share-options-compact .social-btn svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }
     
        .badge-ongoing {
            background: #e6f7ff;
            color: #036;
            padding: 3px 6px;
            border-radius: 6px;
            font-size: 0.8rem;
        }

        .badge-upcoming {
            background: #fff4e6;
            color: #a14;
            padding: 3px 6px;
            border-radius: 6px;
            font-size: 0.8rem;
        }

        .badge-completed {
            background: #f0f0f0;
            color: #666;
            padding: 3px 6px;
            border-radius: 6px;
            font-size: 0.8rem;
        }

        .schedule-actions {
            margin-top: 20px;
            position: relative;
            display: flex;
            justify-content: flex-start;
            gap: 12px;
            align-items: center;
            overflow: visible !important;
            z-index: 9999;
        }

        .schedule-link,
        .btn-share-main {
            flex: 1;
            min-height: 24px;
            padding: 8px 12px;
            border-radius: 6px;
            text-align: center;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s ease;
        }

        .toast {
            position: absolute;
            bottom: 110%;
            left: 50%;
            transform: translateX(-50%) translateY(-10px);
            background: #333;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease, transform 0.3s ease;
            white-space: nowrap;
            z-index: 9999;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .copy-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 8px 14px;
            gap: 6px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            background: #4cafef;
            color: #fff;
            border: none;
            transition: background 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .copy-link:hover {
            background: #b9babdff;
            color: white;
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(25, 118, 210, 0.3);
        }

        .copy-link:active {
            transform: scale(0.97);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 10000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            position: relative;
            animation: fadeIn 0.3s ease;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
        }

        .modal-body h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: left;
            margin-top: 20px;
            border-left: 4px solid #4cafef;
            padding-left: 10px;
        }

        .modal-body .info-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 8px 12px;
            margin-top: 10px;
        }

        .modal-body .info-grid span {
            font-weight: 600;
        }

        .modal-body .modal-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .modal-body .modal-buttons a,
        .modal-body .modal-buttons button {
            flex: 1 1 45%;
            padding: 8px 12px;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            border: none;
            outline: none;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .modal-body .join-btn {
            background-color: #4cafef;
            color: #fff;
            box-sizing: border-box;
            width: 100% !important;
        }

        .modal-body h3,
        .modal-body p {
            word-wrap: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .modal-body .join-btn:hover {
            background: linear-gradient(45deg, #4cafef, #2b90f5ff, #4cafef);
            transform: scale(1.05);
        }

        .join-btn.disabled {
            pointer-events: none;
            background-color: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        .modal-body .social-btn {
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 0.85rem;
        }

        .modal-body .social-btn.whatsapp {
            background-color: #25D366;
        }

        .modal-body .social-btn.telegram {
            background-color: #0088cc;
        }

        .modal-body .social-btn.twitter {
            background-color: #1DA1F2;
        }

        .modal-body .social-btn:hover {
            transform: scale(1.1);
            color: white;
        }

        .modal-body .social-btn svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .modal-body .copy-btn {
            background: linear-gradient(45deg, #2ecc71, #0fd70bff, #2ecc71);
            color: #fff;
        }
        
        .modal-body .copy-btn:hover {
            background: linear-gradient(45deg, #2bbc67ff, #0dc20aff, #2bbc67ff);
        }

        #progress-container {
            width: 100%;
            background: #eee;
            height: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }

        #progress-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #4cafef, #00c6ff);
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .modal-toast {
            position: absolute;
            bottom: 16px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: #333;
            color: #fff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 1001;
        }

        .modal-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        @keyframes fadeInCard {
            from {
                opacity: 0;
                transform: translateY(12px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .schedule-card {
            animation: fadeInCard 0.35 ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .priority-label {
            position: absolute;
            top: 12px;
            left: 12px;
            padding: 5px 10px;
            border-radius: 14px;
            font-size: 0.70rem;
            font-weight: 600;
            color: #fff;
            text-transform: uppercase;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(2px);
            z-index: 10;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .priority-label.show {
            opacity: 1;
            transform: translateY(0);
        }

        .priority-urgent_important {
            background-color: #e74c3c;
        }

        .priority-urgent_not_important {
            background-color: #f39c12;
        }

        .priority-important_not_urgent {
            background-color: #3498db;
        }

        .priority-not_urgent_not_important {
            background-color: #7f8c8d;
        }

        .schedule-card,
        .schedule-actions,
        .schedule-list,
        .main-content {
            overflow: visible !important;
            position: relative;
            z-index: auto;
        }

        .schedule-card {
            position: relative;
            z-index: 1;
        }

        .schedule-actions {
            position: relative;
            z-index: 2;
        }

        .share-options-compact {
            position: absolute;
            top: 110%;
            right: 0;
            z-index: 99999 !important;
        }

        .schedule-list {
            overflow: visible !important;
            z-index: auto !important;
        }

        .quick-add-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 10px 20px;
            border-radius: 10px;
            background: #42a5f5;
            color: white;
            border: none;
            font-size: 16px;
            font-weight: 540;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: all 0.2s ease;
            z-index: 9999;
        }

        .quick-add-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
        }

        .schedule-card.from-event {
            border-left: 4px solid #4a6cf7;
        }

        .event-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #4a6cf7;
            color: white;
            font-size: 0.7rem;
            padding: 3px 6px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <button id="hamburgerbtn" class="hamburger-btn" aria-label="Toggle menu">
        <svg width="30" height="30" viewBox="0 0 100 80" fill="currentColor" aria-hidden="true">
            <rect width="100" height="10"></rect>
            <rect y="30" width="100" height="10"></rect>
            <rect y="60" width="100" height="10"></rect>
        </svg>
    </button>

    <nav id="mainmenu" class="sidebar">
        
        <h3 style="color: white;">Boot Skill</h3>
        <a href="/aamainhome" style="color: white;">Home</a>
        <a href="/aayourcourse" style="color: white;">Your Course</a>
        <a href="/aamyschedule" style="color: white;">My Schedule</a>
        <a href="{{ route('favorite.list') }}" style="color: white;">Favorite</a>
        <a href="/settings" style="color: white;">Settings</a>

        <div class="footer-nav">
            <div class="link-row">
                <a href="/aaabout" style="color: white;">About</a>
                <a href="/contactus" style="color: white;">Contact Us</a>
            </div>
            <a href="/aahowtousebootskill" style="color: white;">How To Use Boot Skill</a>
            <a class="copyright" style="color: white;">&copy; 2025 Boot Skill</a>
        </div>
    </nav>

    <main id="mainpage" class="main-content">

        <section class="schedule-page">

            <div class="schedule-header">
                <h1>My Schedule</h1>
                <a href="{{ route('schedule.edit') }}" class="edit-schedule-btn">Edit Schedule</a>
            </div>

            <p class="schedule-description" style="color: #989fb5ff">
                Organize and manage all your activities here. Enrolled bootcamp schedules will appear automatically and cannot be modified.
            </p>

            <div>
                <div class="priority-legend">
                    <h3>Priority</h3>
                    <ul>
                        <li><span class="priority-dot red"></span> Urgent and Important</li>
                        <li><span class="priority-dot orange"></span> Urgent but Not Important</li>
                        <li><span class="priority-dot yellow"></span> Important but Not Urgent</li>
                        <li><span class="priority-dot green"></span> Not Important and Not Urgent</li>
                    </ul>
                </div>
                <div class="calender-container">
                    <label for="calendarSelector">Select a date:</label>
                    <input type="date" id="calendarSelector" name="calendarSelector"/>
                </div>
            </div>

            <div class="schedule-controls">
                <input type="text" id="searchSchedule" placeholder="Search schedule...">
                <button id="jumpToday" title="Go to today">Today</button>

                <select id="filterPriority">
                    <option value="">All Priorities</option>
                    <option value="urgent_important">Urgent & Important</option>
                    <option value="urgent_not_important">Urgent but Not Important</option>
                    <option value="important_not_urgent">Important but Not Urgent</option>
                    <option value="not_urgent_not_important"> Not Important & Not Urgent</option>
                </select>

                <select id="filterStatus">
                    <option value="all">All Status</option>
                    <option value="upcoming">Upcoming</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="completed">Completed</option>
                </select>

                <select id="sortBy">
                    <option value="">Sort By...</option>
                    <option value="date">Sort by Date</option>
                    <option value="priority">Sort by Priority</option>
                </select>

                <button id="resetFilters">Reset Filters</button>
            </div>
            
            <div class="schedule-list">
                @forelse ($schedules as $schedule)

                    @php                        
                        $startDT = \Carbon\Carbon::parse($schedule->start_datetime);
                        $endDT = \Carbon\Carbon::parse($schedule->end_datetime);

                        $now = \Carbon\Carbon::now();

                        if($now->lt($startDT)) {
                            $status = 'Upcoming';
                        } elseif($now->between($startDT, $endDT)) {
                            $status = 'Ongoing';
                        } else {
                            $status = 'Ended';
                        }
                    @endphp

                    <div class="schedule-card" 
                        data-title="{{ $schedule->title }}"
                        data-link="{{ $schedule->meeting_link }}"
                        data-description="{{ $schedule->description }}"
                        data-priority="{{ $schedule->priority }}"
                        data-start="{{ $startDT->format('Y-m-d') }}"
                        data-end="{{ $endDT->format('Y-m-d') }}"
                        data-timestart="{{ $startDT->format('H:i:s') }}"
                        data-timeend="{{ $endDT->format('H:i:s') }}"
                        data-is_event="{{ $schedule->is_from_event ? '1' : '0' }}"
                        data-enroll-id="{{ $schedule->enrollment_id ?? '' }}" >

                        <div class="priority-strip"></div>

                        <div class="schedule-header">
                                <h3>{{ Str::limit(strtoupper($schedule->title), 10) }}</h3>

                                <span class="status-badge {{ strtolower($status) }}">{{ $status }}</span>
                        </div>

                        @if($schedule->description)
                            <p class="schedule-desc">{{ Str::limit($schedule->description, 20) }}</p>
                        @endif

                        <div class="schedule-dates">
                           {{ $startDT->translatedFormat('l, d F Y') }} -
                           {{ $endDT->translatedFormat('l, d F Y') }}
                        </div>

                        <div class="schedule-time-row">
                            <span>{{ $startDT->translatedFormat('H:i') }}</span>
                            <span>-</span>
                            <span>{{ $endDT->translatedFormat('H:i') }}</span>
                        </div>

                        <div class="schedule-actions">
                            <a href="{{ $schedule->meeting_link }}"
                                class="schedule-link join-meeting"
                                data-enroll-id="{{ $schedule->enrollment_id }}"
                                target="_blank">
                                Join
                            </a>
                            <button class="btn-share-main" data-link="{{ $schedule->meeting_link ?? '' }}">
                                Share
                            </button>

                            <div class="share-options-compact">
                                <button class="copy-link" data-link="{{ $schedule->meeting_link ?? ''}}">Copy Link</button>
                            </div>
                            <div class="toast"> Link copied!</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <p>No schedules available yet.</p>
                        <a href="/add-schedule" class="add-btn">Add a new schedule</a>
                    </div>
                @endforelse
            </div>
            
            <button id="quickAdd" class="quick-add-btn">+ Add Schedule</button>

        </section>
        <div id="scheduleModal" class="modal">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <div class="modal-body">
                    
                </div>
                <div class="modal-toast">Link copied!</div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const hamburgerBtn = document.getElementById("hamburgerbtn");
            const sidebar = document.getElementById("mainmenu");
            const mainContent = document.getElementById("mainpage");

            if (hamburgerBtn && sidebar && mainContent) {
                let isVisible = localStorage.getItem("sidebarVisible") !== "false";
                const applySidebar = (v) => {
                    sidebar.classList.toggle("hidden", !v);
                    mainContent.classList.toggle("pushed", v);
                    hamburgerBtn.classList.toggle("active", v);
                };
                applySidebar(isVisible);

                hamburgerBtn.addEventListener("click", () => {
                    isVisible = !isVisible;
                    applySidebar(isVisible);
                    localStorage.setItem("sidebarVisible", isVisible);
                });
            }

            const priorityMap = {
                "urgent_important": "Urgent & Important",
                "urgent_not_important": "Urgent but Not Important",
                "important_not_urgent": "Important but Not Urgent",
                "not_urgent_not_important": "Not Urgent & Not Important"
            };

            const parseYMD = (date, time = '00:00:00') => {
                if (!date) return null;
                const parts = date.split('-').map(Number);
                const t = time.split(':').map(Number);
                return new Date(
                    parts[0],
                    parts[1] - 1,
                    parts[2],
                    t[0] || 0,
                    t[1] || 0,
                    t[2] || 0
                );
            };

            const getStatus = (start, end) => {
                if (!start) return "";
                const now = new Date();
                if (!end) end = start;
                if (now < start) return "upcoming";
                if (now >= start && now <= end) return "ongoing";
                return "completed";
            };

            const showToast = (msg, color = "green") => {
                const t = document.createElement("div");
                t.textContent = msg;
                t.style = `
                    position: fixed;
                    bottom: 50px;
                    left: 50%;
                    transform: translateX(-50%);
                    background: ${color === "red" ? "#e74c3c" : "#2e3a5c"};
                    color: #fff;
                    border-radius: 4px;
                    padding: 6px 12px;
                    font-size: 0.85rem;
                    opacity: 0;
                    transition: opacity 0.3s, transform 0.3s;
                    z-index: 10000;
                `;
                document.body.appendChild(t);
                requestAnimationFrame(() => {
                    t.style.opacity = "1";
                    t.style.transform = "translateX(-50%) translateY(-8px)";
                });
                setTimeout(() => {
                    t.style.opacity = "0";
                    t.style.transform = "translateX(-50%) translateY(0)";
                    setTimeout(() => t.remove(), 300);
                }, 1500);
            };

            const searchInput = document.getElementById("searchSchedule");
            const filterPriority = document.getElementById("filterPriority");
            const controlDate = document.getElementById("calendarSelector");
            const filterStatus = document.getElementById("filterStatus");
            const sortBy = document.getElementById("sortBy");
            const resetBtn = document.getElementById("resetFilters");
            const jumpTodayBtn = document.getElementById("jumpToday");
            const scheduleList = document.querySelector(".schedule-list");
            let originalCards = scheduleList ? Array.from(scheduleList.querySelectorAll(".schedule-card")) : [];

            function attachCardEvents() {
                if (!scheduleList) return;

                scheduleList.querySelectorAll(".schedule-card").forEach(card => {

                    const isEvent = card.dataset.isEvent === "1";

                    if (isEvent) {
                        card.classList.add("from-event");

                        if (!card.querySelector(".event-badge")) {
                            const badge = document.createElement("div");
                            badge.className = "event-badge";
                            badge.textContent = "From Bootcamp";
                            card.appendChild(badge);
                        }
                    }
                    let pEl = card.querySelector(".priority-label");
                    if (!pEl) {
                        pEl = document.createElement("div");
                        pEl.className = `priority-label priority-${card.dataset.priority}`;
                        pEl.textContent = priorityMap[card.dataset.priority] || card.dataset.priority;
                        card.appendChild(pEl);
                    }

                    pEl.classList.remove("show");
                    setTimeout(() => pEl.classList.add("show"), 50);

                    card.addEventListener("click", e => {
                        if (e.target.closest(".btn-share-main") || e.target.closest(".share-options-compact")) return;
                        openModal(card);
                    });
                });                    
            }

            function filterAndSortSchedules() {
                if (!originalCards.length) return;
                const searchWords = (searchInput?.value || "").toLowerCase().trim().split(/\s+/).filter(Boolean);
                const priorityValue = (filterPriority?.value || "").toLowerCase();
                const selectedDate = controlDate?.value ? new Date(controlDate.value) : null;
                const statusValue = (filterStatus?.value || "all").toLowerCase();
                const sortValue = (sortBy?.value || "").toLowerCase();

                const filtered = originalCards.filter(card => {
                    const title = (card.querySelector("h3")?.textContent || "").toLowerCase();
                    const desc = (card.querySelector(".schedule-desc")?.textContent || "").toLowerCase();
                    const priority = (card.dataset.priority || "").toLowerCase();
                    const start = parseYMD(card.dataset.start, card.dataset.timestart || "00:00:00");
                    const end = parseYMD(card.dataset.end, card.dataset.timeend || "23:59:59");
                    if (!start || !end) return true;

                    const matchSearch = !searchWords.length || searchWords.every(w => title.includes(w) || desc.includes(w));
                    const matchPriority = !priorityValue || priority === priorityValue;
                    const status = getStatus(start, end).toLowerCase();
                    const matchStatus = statusValue === "all" || status === statusValue;

                    let matchDate = true;
                    if (selectedDate && !isNaN(selectedDate.getTime())) {
                        const sel = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), selectedDate.getDate()).getTime();
                        const st = new Date(start.getFullYear(), start.getMonth(), start.getDate()).getTime();
                        const en = new Date(end.getFullYear(), end.getMonth(), end.getDate()).getTime();
                        matchDate = sel >= st && sel <= en;
                    }

                    return matchSearch && matchPriority && matchStatus && matchDate;
                });

                if (sortValue === "date") filtered.sort((a, b) => new Date(a.dataset.start) - new Date(b.dataset.start));
                else if (sortValue === "priority") {
                    const order = ["urgent_important", "urgent_not_important", "important_not_urgent", "not_urgent_not_important"];
                    filtered.sort((a, b) => order.indexOf(a.dataset.priority) - order.indexOf(b.dataset.priority));
                }

                renderSchedule(filtered);
            }

            [searchInput, filterPriority, controlDate, filterStatus, sortBy].forEach(el => {
                el?.addEventListener("input", filterAndSortSchedules);
                el?.addEventListener("change", filterAndSortSchedules);
            });

            resetBtn?.addEventListener("click", () => {
                if (searchInput) searchInput.value = "";
                if (filterPriority) filterPriority.value = "";
                if (controlDate) controlDate.value = "";
                if (filterStatus) filterStatus.value = "all";
                if (sortBy) sortBy.value = "";
                filterAndSortSchedules();
            });

            jumpTodayBtn?.addEventListener("click", () => {
                const today = new Date();
                const yyyy = today.getFullYear();
                const mm = String(today.getMonth() + 1).padStart(2, "0");
                const dd = String(today.getDate()).padStart(2, "0");

                if (controlDate) controlDate.value = `${yyyy}-${mm}-${dd}`;
                filterAndSortSchedules();
            });

            renderSchedule(originalCards);

            function updateCardBadges() {
                const now = new Date();
                document.querySelectorAll(".schedule-card").forEach(card => {
                    const start = parseYMD(card.dataset.start, card.dataset.timestart || "00:00:00");
                    const end = parseYMD(card.dataset.end, card.dataset.timeend || "23:59:59");
                    let badge = card.querySelector(".status-badge");
                    if (!badge) {
                        badge = document.createElement("div");
                        badge.className = "status-badge";
                        card.appendChild(badge);
                    }

                    if (!start || !end) {
                        badge.textContent = "";
                        badge.className = "status-badge";
                        return;
                    }

                    if (now < start) {
                        badge.textContent = "Upcoming";
                        badge.className = "status-badge upcoming";
                    } else if ( now >= start && now <= end) {
                        badge.textContent = "Ongoing";
                        badge.className = "status-badge ongoing";
                    } else {
                        badge.textContent = "Ended";
                        badge.className = "status-badge ended";
                    }
                });
            }

            setInterval(updateCardBadges, 1000);
            updateCardBadges();

            document.querySelectorAll(".btn-share-main").forEach(btn => {
                const card = btn.closest(".schedule-card");
                const menu = card.querySelector(".share-options-compact");

                if (menu) {
                    document.body.appendChild(menu);

                    btn.addEventListener("click", e => {
                        e.stopPropagation();
                        
                        document.querySelectorAll(".share-options-compact.show").forEach(m => m.classList.remove("show"));

                        const rect = btn.getBoundingClientRect();
                        menu.style.position = "absolute";
                        menu.style.top = (rect.bottom + window.scrollY + 5) + "px";
                        menu.style.left = (rect.left + window.scrollX) + "px";

                        menu.classList.add("show");
                    });
                }
            });

            function formatDuration(ms) {
                const totalSec = Math.floor(ms / 1000);
                const hours = Math.floor(totalSec / 3600);
                const minutes = Math.floor((totalSec % 3600) / 60);
                const seconds = totalSec % 60;
                return `${hours}h ${minutes}m ${seconds}s`;
            }

            const modal = document.getElementById("scheduleModal");
            let modalInterval;

            function openModal(card) {
                if (!modal) return;
                clearInterval(modalInterval);

                const modalBody = modal.querySelector(".modal-body");
                const closeBtn = modal.querySelector(".close-btn");

                const title = card.dataset.title || "No title";
                const description = card.dataset.description || "No description";
                const link = card.dataset.link || "#";
                const priority = card.dataset.priority || "N/A";
                const priorityDisplay = priorityMap[priority] || priority;
                const start = card.dataset.start || "N/A";
                const end = card.dataset.end || "N/A";
                const timestart = card.dataset.timestart || "00:00:00";
                const timeend = card.dataset.timeend || "23:59:59";
                const isEvent = card.dataset.isEvent === "1";
                const enrollId = card.dataset.enrollId || "";

                modalBody.innerHTML = `
                    <h3>${title}</h3>
                    <p>${description}</p>
                    <div class="info-grid">
                        <p><strong>Priority: </strong>${priorityDisplay}</p>
                        <p><strong>Date: </strong>${start} - ${end}</p>
                        <p><strong>Time: </strong>${timestart} - ${timeend}</p>
                        <p><strong>Meeting Link: </strong><a href="${link}" target="_blank">${link}</a></p>
                    </div>
                    <div class="modal-buttons">
                        <a href="${link}"
                            target="_blank"
                            class="join-meeting join-btn"
                            data-enroll-id="${enrollId}">
                            Join Meeting
                        </a>
                        <button class="copy-btn" data-link="${link}">Copy Link</button>
                    </div>
                `;

                modal.style.display = "flex";

                if (closeBtn) closeBtn.onclick = () => {
                    modal.style.display = "none";
                    clearInterval(modalInterval);
                };

                window.onclick = e => {
                    if (e.target === modal) {
                        modal.style.display = "none";
                        clearInterval(modalInterval);
                    }
                };
            }

            document.addEventListener("click", e => {
                const btn = e.target.closest('.copy-btn, .copy-link');
                if (btn) {
                    e.stopPropagation();
                    const link = btn.dataset.link || '';
                    if (!link) return showToast("No link available", "red");
                    navigator.clipboard.writeText(link)
                        .then(() => showToast("Link copied!", "green"))
                        .catch(() => showToast("Failed to copy", "red"));
                }

                if (!e.target.closest(".share-options-compact") && !e.target.closest(".btn-share-main")) {
                    document.querySelectorAll(".share-options-compact.show").forEach(d => d.classList.remove("show"));
                }
            });

            function renderSchedule(cards) {
                if (!scheduleList) return;

                if (!cards.length) {
                    scheduleList.innerHTML = `
                        <div class="empty-state">
                            <p>No schedules available.</p>
                        </div>
                    `;
                    return;
                }

                scheduleList.innerHTML = "";
                cards.forEach(c => scheduleList.appendChild(c));
                attachCardEvents();
            }

            document.getElementById("quickAdd").addEventListener("click", () => {
                window.scrollTo({top: 0, behavior: 'smooth'});
                document.getElementById("schedule_id").value = "";
                document.getElementById("title").value = "";
                document.getElementById("description").value = "";
                document.getElementById("start_datetime").value = "";
                document.getElementById("end_datetime").value = "";
                document.getElementById("link").value = "";
            });

            document.addEventListener("click", function (e) {
                const btn = e.target.closest(".join-meeting");
                if (!btn) return;

                const enrollId = btn.dataset.enrollId;
                if (!enrollId) {
                    console.warn("Enroll ID not found");
                    return;
                }

                fetch(`/attendance/${enrollId}`, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Attendance response:", data);
                })
                .catch(err => console.error("Attendance error:", err));
            });
        });
    </script>

</body>   
<html>