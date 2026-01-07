<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Home</title>
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
            z-index: 1001;
            color: white;
        }

        .hamburger-btn.active {
            color: #2e3a59;
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

        main {
            transition: margin-left 0.3s ease;
            will-change: margin-left;
        }

        .main.full {
            margin-left: 0;
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

        main {
            margin-left: 170px;
            padding: 20px;
            padding-left: 80px;
            flex-grow: 1;
            transition: margin-left 0.3s ease;
        }

        main.full {
            margin-left: 0;
        }

        .topbarmain {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            height: 70px;
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 999;
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

        .searchbar {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 1400px;
            border: 1px solid #ccc;
            border-radius: 20px;
            padding: 5px 10px;
            background-color: #fff;
        }

        .searchbar input[type="text"] {
            border: none;
            outline: none;
            padding: 8px;
            font-size: 14px;
            flex: 1;
            background: transparent;
        }

        .searchbar button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .searchbar:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .searchbar input [type="text"]:focus {
            width: 100%;
            flex: 1;
        }

        .notification {
            position: relative;
            cursor: pointer;
            padding-left: 13px;
            z-index: 1000;
        }

        .notif-dropdown {
            max-height: 320px;
            overflow-y: auto;
            overscroll-behavior: contain;
        }

        .notif-dropdown {
            scrollbar-width: thin;
        }
        
        .notif-dropdown::-webkit-scrollbar {
            width: 6px;
        }

        .notif-dropdown::-webkit-scrollbar-thumb {
            background-color: rgba(0,0,0,0.2);
            border-radius: 4px;
        }
        .notif-dropdown.show {
            display: block;
        }

        .notif-dropdown p {
            margin: 0;
            font-size: 0.9em;
            color: #333;
        }

        #notifDropdown.show {
            display: block;
        }

        #notifDropdown .notif-item {
            padding: 12px 16px;
            border-bottom: 1px solid #eee;
            cursor: default;
            display: flex;
            flex-direction: column;
        }

        #notifDropdown p {
            margin: 0;
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
            cursor: default;
        }

        #notifDropdown p:last-child {
            border-bottom: none;
        }

        #notifDropdown .notif-item strong {
            font-weight: 600;
            margin-bottom: 4px;
            color: #222;
        }
        
        #notifDropdown p:hover {
            background-color:rgb(226, 226, 226);
        }

        .usersection {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .filterbuttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-left: 22px;
            margin-top: 18px;
            position: sticky;
        }

        .category-buttons {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: flex-start;
            margin-left: 22px;
            margin-top: 18px;
            position: sticky;
        }

        .usersection {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-left: auto;
        }

        #notifDropdown,
        .profile-dropdown {
            position: absolute;
            top: 50px;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 10px;
            width: 240px;
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 999;
        }

        .show-dropdown {
            display: block !important;
            opacity: 1 !important;
            transform: translateY(0) !important;
            pointer-events: auto;
        }

        .profile-dropdown.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        .profile-dropdown.show {
            display: block;
        }

        .profileinfo{
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
        }

        .profileicon img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            display: block;
        }

        .profiledetails {
            max-width: 100%;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .profiledetails strong, .profileinfo p {
            margin: 0;
            display: block;
            line-height: 1.4;
        }

        .profiledetails strong {
            font-size: 1rem;
            font-weight: 600;
        }

        .profiledetails p {
            font-size: 0.9rem;
            color: #555;
        }

        .profileinfo img{
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
        }

        .profiledetails > strong, 
        .profiledetails > p {
            margin-left: 12px;
            line-height: 1.4;
        }

        .profile-dropdown hr {
            border: none;
            border-top: 1px solid #ddd;
            margin: 8px 0;
        }

        .profile-dropdown a {
            display: block;
            color: #333;
            text-decoration: none;
            padding: 6px 0;
            font-size: 0.95em;
            transition: background-color 0.2s ease;
        }

        .profile-dropdown a:hover {
            background-color: #f0f0f0;
            border-radius: 4px;
        }
        
        .hidden {
        }

        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            align-items: center;
            margin-bottom: 20px;
        }

        .filter-container label {
            font-weight: 500;
            margin-right: 8px;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            min-width: 160px;
            background-color: #fff;
            transition: border-color 0.3s ease;
        }

        .filter-select:focus {
            border-color: #2e3a59;
            outline: none;
        }

        .select2-container .select2-selection--single {
            height: 36px;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            background-color: white;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 34px;
        }
  
        
        .bootcamp-content {
            padding: 0 16px;
        }
        .bootcamp-card:hover {
            transform: translateY(-5px);
        }

        .bootcamp-card h4 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: bold;
        }

        .bootcamp-card .bootcamp-description {
            font-size: 0.9rem;
            margin: 8px 0;
            flex-grow: 1;
            color: #555;
        }

        .bootcamp-card .organizer-name {
            font-size: 0.85rem;
            color: #888;
            margin-top: auto;
        }

        .bootcamp-link {
            text-decoration: none !important;
            color: inherit;
        }

        .dropdown-links {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        @media (max-width: 600px) {
            .filter-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .filter-select {
                width: 100%;
            }
        }

        .banner-slider-upgraded {
            position: relative;
            width: 100%;
            max-width: 1000px;
            margin: 20px auto;
            aspect-ratio: 3 / 1;
            overflow: hidden;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .banner-slider-upgraded .slide {
            display: none;
            width: 100%;
            position: relative;
            text-align: center;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .banner-slider-upgraded .slide.active {
            display: block;
            opacity: 1;
        }

        .banner-slider-upgraded img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            background-color: #f5f5f5;
            object-position: center;
            border-radius: 12px;
            display: block;
        }

        .banner-slider-upgraded .prev,
        .banner-slider-upgraded .next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(46, 58, 89, 0.7);
            border: none;
            color: white;
            font-size: 22px;
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 50%;
            z-index: 2;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background 0.3s, transform 0.2s;
        }

        .banner-slider-upgraded .prev {
            left: 15px;
        }

        .banner-slider-upgraded .next {
            right: 15px;
        }

        .banner-slider-upgraded .dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
        }

        .banner-slider-upgraded .prev:hover,
        .banner-slider-upgraded .next:hover {
            background: #2a3a59;
            color: #fff;
            transform: translateY(-50%) scale(1.1);
        }

        .banner-slider-upgraded .dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 10px;
        }

        .banner-slider-upgraded .dot {
            height: 10px;
            width: 10px;
            background-color: #ccc;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .banner-slider-upgraded .dot:hover {
            background-color: #999;
            transform: scale(1.3);
        }

        .active-dot {
            background-color: #2e3a59;
            transform: scale(1.3);
        }

        .bootcamp-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            margin-top: 25px;
        }

        .bootcamp-card:hover {
            transform: translateY(-5px);
        }

        .bootcamp-card-banner {
            position: relative;
            width: 100%;
            height: 150px;
            overflow: hidden;
        }

        .bootcamp-card-banner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .banner-tags {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            z-index: 10;
        }

        .tag {
            padding: 4px 10px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 6px;
            color: #fff;
        }

        .price-tag {
            background: #1e90ff;
        }

        .category-tag {
            background: #28a745;
        }

        .topics-tag {
            background: #722db7;
        }

        .bootcamp-content {
            padding: 16px;
            flex-grow: 1;
            display: flex;
            justify-content: space-between;
            flex-direction: column;
        }

        .bootcamp-title {
            font-size: 1.08rem;
            font-weight: 700;
            color: #222;
            line-height: 1.3;
            height: 2.6em;
            padding: 0 10px;

            max-height: calc(1.3em * 2);
            overflow: hidden;
            margin-bottom: 3px;
        }

        .bootcamp-description {
            font-size: 0.88rem;
            font-weight: 400;
            color: #555;
            margin-top: 6px;
            padding: 0 10px;

            height: 2.8em;
            line-height: 1.4;
            max-height: calc(1.4em * 2);
            overflow: hidden;
        }

        .bootcamp-card {
            display: flex;
            flex-direction: column;
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            transition: transform 0.2s ease;
            height: auto;
        }

        .bootcamp-card .bootcamp-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .bootcamp-card .bootcamp-description {
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .bootcamp-card-footer {
            margin-top: auto;
            padding: 12px 16px;
            background: #fff;
        }

        .view-detail-btn {
            display: block;
            width: 100%;
            text-align: center;
            padding: 10px 0;
            background: #1e90ff;
            color: #fff;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.25s ease;
        }

        .view-detail-btn:hover {
            background: #0c6ad8;
        }

        .organizer-info {
            margin-top: 4px;
            padding: 0 6px;
            height: 48px;
            display: flex;
            margin-left: 0;
            align-items: center;
        }

        .organizer-link {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: 0;
            text-decoration: none;
        }

        .organizer-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        .organizer-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: #333;
            line-height: 1;
            height: 40px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .bootcamp-title {
            margin-bottom: 2px !important;
            padding: 0 6px !important;
        }

        .bootcamp-description {
            margin-top: 2px !important;
            margin-bottom: 2px !important;
            padding: 0 6px !important;
        }

        .organizer-info {
            margin-top: 2px !important;
            padding: 0 6px !important;
        }

        .bootcamp-content {
            padding: 10px !important;
        }

        .role-popup {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .role-popup-content {
            background: #fff;
            width: 380px;
            padding: 26px 28px;
            border-radius: 14px;
            text-align: center;

            box-shadow: 0 18px 50px rgba(0,0,0,0.15);
            animation: popupFade 0.25s ease;
        }

        .role-popup-content p {
            font-size: 14px;
            line-height: 1.5;
            color: #555;
            margin-bottom: 22px;
        }

        .popup-buttons {
            display: flex;
            justify-content : space-between;
            gap: 12px;
        }

        .cancel-btn,
        .confirm-btn {
            flex: 1;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;

            transition: background 0.25s ease, transform 0.1s ease;
        }

        .cancel-btn {
            background: #e5e5e5;
            color: #333;
        }

        .cancel-btn:hover {
            background: #d6d6d6;
        }

        .cancel-btn:active {
            transform: scale(0.97);
        }

        .confirm-btn {
            background: #1e90ff;
            color: #fff;
        }

        .confirm-btn:hover {
            background: #0c6ad8;
        }

        .confirm-btn:active {
            transform: scale(0.97);
        }

        @keyframes popupFade {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 480px) {
            .role-popup-content {
                width: 90%;
                padding: 22px 20px;
            }

            .popup-buttons {
                flex-direction: column;
            }

            .cancel-btn,
            .confirm-btn {
                width: 100%;
                height: 44px;
            }
        }
        .switch-role-btn {
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;

            font-size: 14.5px;
            font-weight: 500;
            line-height: 1.4;
            color: #333;

            text-align: left;
            padding: 0;
            margin: 0;
        }

        .switch-btn {
            font-size: 12px;
            font-weight: 500;
            line-height: 1.4;
            color: #333;
            text-align: left;
            padding: 0;
            margin: 0;
        }

        .switch-role-btn:hover {
            background-color: #f3f4f6;
            opacity: 0.8;
        }

        @keyframes popupFade {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .popup-buttons form {
            flex: 1;
            display: flex;
        }

        .popup-buttons form button {
            width: 100%;
        }

        .popup-buttons {
            display: flex;
            gap: 12px;
        }

        .popup-buttons form {
            flex: 1;
            display: flex;
        }

        .popup-button form button {
            width: 100%;
        }

        .cancel-btn,
        .confirm-btn {
            flex: 1;
            height: 44px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 8px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;

            transition: background 0.25s ease, transform 0.1s ease;
        }

        .countdown-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #fff;
            z-index: 500;
            white-space: nowrap;
        }

        .countdown-badge.today {
            background: #ef4444;
        }

        .countdown-badge.soon {
            background: #f59e0b;
        }

        .countdown-badge.upcoming {
            background: #3b82f6;
        }

        .countdown-badge.started {
            background: #16a34a;
        }

        .notif-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            font-size: 11px;
            font-weight: bold;
            padding: 2px 6px;
            border-radius: 50%;
        }
        
        #notifDropdown .notif-item.unread {
            background-color: #f5f7ff;
        }

        #notifDropdown .notif-item.unread strong {
            color: #1e3a8a;
        }

        #notifDropdown p:hover {
            background-color: rgb(226, 226, 266);
        }

        #notifDropdown .notif-item:hover {
            background-color: rgba(226, 226, 226);
        }

        #notifDropdown .notif-item {
            text-decoration: none;
            color: inherit;
        }

        #notifDropdown .notif-item p {
            font-size: 0.88rem;
            color: #555;
            margin: 4px 0 6px;
            line-height: 1.4;
        }

        #notifDropdown .notif-item small {
            font-size: 0.75rem;
            color: #555;
        }

        #notifDropdown .notif-item strong {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e3a8a;
        }

        #notifDropdown {
            overscroll-behavior: contain;
        }

        .notif-dropdown {
            position: absolute;
            top: 100%;
            right: 0;

            max-height: 320px;
            overflow-y: auto;
            background: white;
            z-index: 9999;

            overscroll-behavior: contain;
        }

        .notification {
            position: relative;
            overflow: visible !important;
        }

        .topbarmain {
            overflow: visible !important;
        }

        .notification-wrapper {
            position: relative;
        }

        .notif-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
        }

        body,
        main,
        .topbarmain,
        .usersection {
            overflow: visible !important;
        }

        .notification-wrapper {
            position: relative;
        }

        .notif-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 340px;
            max-height: 320px;
            overflow-y: auto;
            overflow-x: hidden;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);

            z-index: 99999;

            overscroll-behavior: contain;
        }

        #notifDropdown {
            pointer-events: auto;
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

    <nav id="mainmenu" class="sidebar" aria-label="Main menu">
        
        <h3 style="color: white;">Boot Skill</h3>
        <a href="/aamainhome" style="color: white;">Home</a>
        <a href="/aayourcourse" style="color: white;">Your Course</a>
        <a href="/aamyschedule" style="color: white;">My Schedule</a>
        <a href="/aafavorite" style="color: white;">Favorite</a>
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

    <main id="mainpage">
        <header class ="topbarmain">
            <form action="{{ route('search.bootcamp') }}" method="GET" class="searchbar">
                <input type="text" name="query" id="searchInput" placeholder="Search bootcamp..." aria-label="Search">
                <button type="submit" aria-label="Submit search">
                    <svg width="18" height="18" fill="#333" style="opacity: 80%;" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.397h-.001l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.85-3.85zm-5.242 1.656a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z"/>
                    </svg>
                </button>
            </form>

             <div class="usersection">
                    <div class="notification-wrapper">

                        <div class="notification" id="notificationbtn" tabindex="0" aria-label="Notification">
                            <svg viewBox="0 0 448 512" width="24" height="24" fill="#333">
                                <path d="M224 512c35.3 0 63.9-28.7 63.9-64h-127.8c0 35.3 28.6 64 63.9 64zm215.4-149.7c-19.4-20.9-55.5-52.7-55.5-154.3 0-77.7-54.5-139.4-127.7-155.2V32c0-17.7-14.3-32-31.9-32s-31.9 14.3-31.9 32v20.9c-73.2 15.8-127.7 77.5-127.7 155.2 0 101.6-36.1 133.4-55.5 154.3-6 6.4-8.7 14.5-8.7 22.6 0 26.5 21.5 48 48 48h320c26.5 0 48-21.5 48-48 0-8.1-2.7-16.2-8.7-22.6z"/>
                            </svg>

                            @if ($unreadCount > 0)
                                <span class="notif-badge">{{ $unreadCount }}</span>
                            @endif

                            <div class="notif-dropdown" id="notifDropdown" aria-live="polite">
                                @forelse($notifications as $notif)
                                    <a href="{{ $notif->link ?? '#' }}"
                                        class="notif-item {{ $notif->is_read ? '' : 'unread' }}"
                                        data-id="{{ $notif->id }}">

                                        <strong>{{ $notif->title ?? 'Notification' }}</strong>
                                        <p>{{ $notif->message }}</p>
                                        <small>{{ $notif->created_at->diffForHumans() }}</small>
                                    </a>
                                @empty
                                    <p class="empty-notif">No notifications yet</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="profileicon" id="profilebtn" style="position: relative;" tabindex="0" aria-label="User Profile">
                        @php
                            $profileSrc = $user && $user->profile_picture
                                ? asset($user->profile_picture)
                                : asset('images/default-profile.jpg');

                            $currentRole = $user ? strtolower($user->role) : 'participant';
                            $nextRoleLabel = $currentRole === 'participant' > 'Organizer' : 'Participant';
                        @endphp
                        
                        <img src="{{ $profileSrc }}" alt="Profile Picture" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; cursor: pointer; display: block;">

                        <div class="profile-dropdown" id="profileDropdown" role="menu">
                            <div class="profileinfo">
                                <img src="{{ $profileSrc }}" alt="Profile Picture" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover;">

                                <div class="profiledetails">
                                    <strong>{{ $user?->name ?? 'Guest'}}</strong>
                                    <p>{{ $user->email ?? '-'}}</p>
                                </div>
                            </div>
                            <hr/>

                            <div class="dropdown-links">
                                <a href="{{ route('switchaccount.form') }}" class="switch-btn">Switch Account</a>
                                
                                @if($currentRole === 'participant')
                                    <a href="{{ route('settings') }}" class="settings-btn">Settings</a>
                                @elseif ($currentRole === 'organizer_active')
                                    <a href="{{ route('organizer.editprofile') }}">Settings</a>
                                @endif
                                
                                <button class="switch-role-btn" id="openSwitchRolePopup">
                                    Switch to {{ $nextRoleLabel }}
                                </button>
                            </div>
                        </div>
                    </div>
             </div>
        </header>

        <div class="filter-container" style="margin-top: 20px;">
            <label for="topicFilter">Topic:</label>
            <select id="topicFilter" class="filter-select">
                <option value="">All Topics</option>
                @foreach($topics as $topic)
                    <option value="{{ $topic }}">{{ $topic }}</option>
                @endforeach
            </select>

            <label for="categoryFilter">Category:</label>
            <select id="categoryFilter" class="filter-select">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>

        <div class="banner-slider-upgraded">
                <div class="slide active">
                    <img src="/images/banner1.png" alt="Promo 1">
                </div>
                <div class="slide">
                    <img src="/images/banner2.png" alt="Promo 2">
                </div>
                <div class="slide">
                    <img src="/images/banner3.png" alt="Promo 3">
                </div>

                <button class="prev" aria-label="Previous">&#10094;</button>
                <button class="next" aria-label="Next">&#10095;</button>

                <div class="dots">
                    <span onclick="goToSlide(0)" class="dot active-dot"></span>
                    <span onclick="goToSlide(1)" class="dot"></span>
                    <span onclick="goToSlide(2)" class="dot"></span>
                </div>
        </div>

        <section id="bootcampContainer" class="bootcamp-grid" style="margin-top: 40px;">
            @forelse($events as $event)

                <div class="bootcamp-card" data-start-date="{{ $event->start_date }}">
                    
                    <div class="bootcamp-card-banner">
                        <img 
                            src="{{ $event->image_path ? asset('storage/' . $event->image_path) : asset('images/defaults.png') }}"
                            alt="{{ $event->title }}"
                            onerror="this.onerror=null;this.src='/images/defaults.png';">

                        <div class="banner-tags">
                            <span class="tag price-tag">
                                @if ($event->price == 0)
                                    FREE
                                @else
                                    Rp {{ number_format($event->price, 0, ',', '.' ) }}
                                @endif
                            </span>

                            <span class="tag category-tag">{{ $event-> category }}</span>
                            <span class="tag topics-tag">{{ $event-> topic }}</span>
                        </div>

                        <div class="countdown-badge"></div>

                    </div>

                    <div class="bootcamp-content">
                        <a href="{{ route('bootcamp.detail', $event->id) }}"
                            class="bootcamp-link"
                            data-topic="{{ $event->topic }}"
                            data-category="{{ $event->category }}">

                            <h3 class="bootcamp-title">{{ $event->title }}</h3>
                            <p class="bootcamp-description">{{ Str::limit($event->description, 200) }}</p>
                        </a>

                        <div class="organizer-info" style="margin-top: 10px;">
                            <a href="{{ route('organizer.profile', ['id' => $event->organizer->id]) }}" class="organizer-link">
                                <img
                                    src="{{ $event->organizer->profile_picture_url }}"
                                    alt="Organizer Photo"
                                    class="organizer-avatar"
                                >
                                <span class="organizer-name">{{ $event->organizer->name}}</span>
                            </a>
                        </div>
                        <div style="margin-top: auto;"></div>
                    </div>

                    <div class="bootcamp-card-footer">
                        <a href="{{ route('bootcamp.detail', $event->id) }}"
                            class="view-detail-btn">
                            View Detail
                        </a>
                    </div>
                </div>
            @empty
                <p id="emptyMessage" style="display: block; text-align: center; color: #777;">
                    No bootcamp yet.
                </p>
            @endforelse
        </section>
    </main>

    <div id="switchRolePopup" class="role-popup">
        <div class="role-popup-content">
            <h3>Switch Role</h3>
            <p>>Do you want to switch your role to
                <strong>{{ $nextRoleLabel }}</strong>
            </p>

            <div class="popup-buttons">
                <button id="cancelSwitchRole" class="cancel-btn">Cancel</button>
                
                <form action="{{ route('switch.role') }}" method="POST">
                    @csrf
                    <button type="submit" class="confirm-btn">Yes, Switch</button>
                </form>
            </div>
        </div>
    </div>

    <script>

        document.addEventListener("DOMContentLoaded", function () {

            const hamburgerBtn = document.getElementById("hamburgerbtn");
            const sidebar = document.getElementById("mainmenu");
            const mainContent = document.querySelector("main");

            hamburgerBtn?.addEventListener("click", () => {
                sidebar.classList.toggle("hidden");
                mainContent.classList.toggle("full");
                hamburgerBtn.classList.toggle("active");
            });

            const topicFilter = document.getElementById("topicFilter");
            const categoryFilter = document.getElementById("categoryFilter");
            const cards = document.querySelectorAll(".bootcamp-card");
            const emptyMessage = document.getElementById("emptyMessage");

            function filterCards() {
                let visibleCount = 0;
                const selectedTopic = topicFilter?.value;
                const selectedCategory = categoryFilter?.value;

                cards.forEach(card => {
                    const link = card.querySelector(".bootcamp-link");
                    const cardTopic = link?.dataset.topic;
                    const cardCategory = link?.dataset.category;

                    const matchTopic = !selectedTopic || cardTopic === selectedTopic;
                    const matchCategory = !selectedCategory || cardCategory == selectedCategory;

                    if (matchTopic && matchCategory) {
                        card.style.display = "block",
                        visibleCount++;
                    } else {
                        card.style.display = "none";
                    }
                });

                if (emptyMessage) {
                    emptyMessage.style.display = visibleCount === 0 ?  "block" : "none";
                }
            }

            topicFilter?.addEventListener("change", filterCards);
            categoryFilter?.addEventListener("change", filterCards);

            const notifBtn = document.getElementById("notificationbtn");
            const notifDropdown = document.getElementById("notifDropdown");
            const profileBtn = document.getElementById("profilebtn");
            const profileDropdown = document.getElementById("profileDropdown");

            profileDropdown?.addEventListener("click", e => {
                e.stopPropagation();
            });

            let notifAlreadyMarked = false;

            notifBtn?.addEventListener("click", async(e) => {
                e.stopPropagation();

                notifDropdown?.classList.toggle("show-dropdown");
                profileDropdown?.classList.remove("show-dropdown");

                if (!notifAlreadyMarked) {
                    notifAlreadyMarked = true;

                    try {
                        await fetch('/notifications/read-all', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json'
                            }
                        });

                        document.querySelectorAll(".notif-item.unread")
                            .forEach(item => item.classList.remove('unread'));

                        document.querySelector('.notif-badge')?.remove();
                    } catch (err) {
                        console.error(err);
                    }
                }
            });

            profileBtn?.addEventListener("click", e => {
                e.stopPropagation();
                profileDropdown?.classList.toggle("show-dropdown");
                notifDropdown?.classList.remove("show-dropdown");
            });

            document.addEventListener("click", function (e) {
                if (
                    notifDropdown.classList.contains("show-dropdown") &&
                    !notifDropdown.contains(e.target) &&
                    !notifBtn.contains(e.target)
                ) {
                    notifDropdown.classList.remove("show-dropdown");
                }

                if (
                    profileDropdown.classList.contains("show-dropdown") &&
                    !profileDropdown.contains(e.target) &&
                    !profileBtn.contains(e.target)
                ) {
                    profileDropdown.classList.remove("show-dropdown");
                }
            });

            notifDropdown?.addEventListener("click", e => {
                e.stopPropagation();
            });

            const searchInput = document.getElementById("searchInput");
            searchInput?.addEventListener("keypress", e => {
                if (e.key === "Enter") {
                    const query = searchInput.value.trim();
                    if (query) {
                        window.location.href = `/search?query=${encodeURIComponent(query)}`;
                    }
                }
            });

            let slideIndex = 0;
            const slides = document.querySelectorAll('.banner-slider-upgraded .slide');
            const dots = document.querySelectorAll('.banner-slider-upgraded .dot');

            function showSlide(index) {
                slides.forEach((s, i) => {
                    s.classList.remove('active');
                    dots[i]?.classList.remove('active-dot');
                });
                slides[index]?.classList.add('active');
                dots[index]?.classList.add('active-dot');
                slideIndex = index;
            }

            function changeSlide(step) {
                slideIndex = (slideIndex + step + slides.length) % slides.length;
                showSlide(slideIndex);
            }

            function goToSlide(index) {
                slideIndex = index;
                showSlide(index);
            }

            setInterval(() => changeSlide(1), 5000);
            showSlide(slideIndex);
            document.querySelector('.banner-slider-upgraded .prev')?.addEventListener('click', () => changeSlide(-1));
            document.querySelector('.banner-slide-upgraded .next')?.addEventListener('click', () => changeSlide(-1));
            dots.forEach((dot, i) => dot.addEventListener('click', () => goToSlide(i)));

            const switchPopup = document.getElementById("switchRolePopup");
            const openSwitchBtn = document.getElementById("openSwitchRolePopup");
            const cancelSwitchBtn = document.getElementById("cancelSwitchRole");

            openSwitchBtn?.addEventListener("click", e => {
                e.stopPropagation();
                profileDropdown?.classList.remove("show-dropdown");
                switchPopup.style.display = "flex";
            });

            cancelSwitchBtn?.addEventListener("click", () => switchPopup.style.display = "none");
            switchPopup?.addEventListener("click", e => {
                if (e.target === switchPopup) switchPopup.style.display = "none";
            });

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            cards.forEach(card => {
                const startDateStr = card.dataset.startDate;
                if (!startDateStr) return;

                const startDate = new Date(startDateStr);
                startDate.setHours(0, 0, 0, 0);

                const diffDays = Math.ceil((startDate - today) / (1000 * 60 * 60 * 24));
                const badge = card.querySelector(".countdown-badge");
                if (!badge) return;

                if (diffDays > 1) badge.textContent = `Starts in ${diffDays} days`, badge.classList.add("upcoming");
                else if (diffDays === 1) badge.textContent = "Starts tomorrow", badge.classList.add("soon");
                else if (diffDays === 0) badge.textContent = "Starts today", badge.classList.add("today");
                else badge.textContent = "Started", badge.classList.add("started");
            });
        });
    </script>
</body>
</html>