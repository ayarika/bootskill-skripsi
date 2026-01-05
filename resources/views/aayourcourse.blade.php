<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Course</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <style>

        html, body {
            margin: 0;
            padding: 0;
            max-width: 100%;
            overflow-x: hidden;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
        }

        .full {
            transition: margin-left 0.3s ease;
        }

        .hamburger-btn {
            position: fixed;
            top: 20px;
            left: 10px;
            background: transparent;
            border: none;
            z-index: 1001;
            color: #2e3a59;
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
            transform: translateX(0);
            transition: transform 0.3s ease;
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
            margin-left: 0;
            width: 100%;
            padding: 40px 32px;
            box-sizing: border-box;
            position: relative;
            z-index: 0;
            transition: margin-left 0.4s ease;
        }

        .main-content.full {
            margin-left: 170px;
            width: calc(100% - 170px);
        }

        .your-course-section {
            width: 100%;
            box-sizing: border-box;
            padding-left: 0;
            padding-right: 0;
        }

        .hidden {
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

        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin-top: 32px;
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

        .your-course-section h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .bootcamp-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 16px;
            padding-left: 60px;
            padding-right: 32px;
            box-sizing: border-box;
            justify-content: center;
        }

        .bootcamp-card {
            display: flex;
            position: relative;
            flex-direction: column;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .badge-container {
            position: absolute;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 6px;
            z-index: 2;
        }

        .badge {
            padding: 4px 8px;
            font-size: 0.7rem;
            font-weight: bold;
            border-radius: 10px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }

        .bootcamp-card .badge.category {
            background: #28a745;
        }

        .bootcamp-card .badge.price {
            background: #1e90ff;
        }

        .bootcamp-card .badge.price.paid {
            background: #1e90ff;
        }

        .badge-container .badge {
            min-width: 50px;
            text-align: center;
        }

        .status-badge-container {
            position: absolute;
            top: 10px;
            right: 10px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            z-index: 3;
        }

        .status-badge {
            padding: 2px 6px;
            font-size: 0.65rem;
            font-weight: bold;
            border-radius: 6px;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            opacity: 0;
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .bootcamp-card:hover .status-badge {
            opacity: 1;
            transform: translateY(0);
        }

        .status-badge.ended {
            background-color: #dc3545;
        }

        .status-badge.today {
            background-color: #1e90ff;
        }

        .status-badge.no-session {
            background-color: #6c757d;
        }

        .bootcamp-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .bootcamp-card img.bootcamp-banner {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-bottom: 1px solid #eee;
        }

        .bootcamp-content {
            flex: 1 1 auto;
            padding: 16px;
            flex-direction: column;
        }

        .bootcamp-content h3 {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 8px;
            color: #2e3a59;
            min-height: 2.4em;
        }

        .bootcamp-content p {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 12px;
            max-height: 2.6em;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bootcamp-content p.description {
            flex: 1 1 auto;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .organizer-info {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            font-style: italic;
            margin: 0.1rem 0 0.3rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .organizer-info img {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            object-fit: cover;
        }

        .bootcamp-info {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 12px;
        }

        .bootcamp-info small {
            display: block;
        }

        .bootcamp-card.selected {
            border-color: #007bff;
            background-color: #e6f0ff;
            transform: scale(1.02);
            box-shadow: 0 8px 16px rgba(0, 123, 255, 0.2);
        }

        .card-body p {
            margin: 0;
            padding: 0;
        }

        .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            gap: 8px;
            margin-top: 12px;
        }

        .card-body h3 {
            font-size: 0.95rem;
            line-height: 1.1;
            margin: 0.1rem 0;
            min-height: 2.1em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .bootcamp-card .description {
            font-size: 0.85rem;
            line-height: 1.2;
            margin: 0.05rem 0 0.25rem;
        }

        .card-body {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .bootcamp-card .price-status {
            font-size: 0.82rem;
            font-weight: bold;
            color: #555;
            margin: 0.05rem 0 0.25rem;
        }

        .card-body .description {
            font-size: 0.85rem;
            height: 1.3em;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0.1rem 0 0.3rem;
        }

        .card-body .price-status {
            font-size: 0.82rem;
            font-weight: bold;
            color: #555;
            margin: 0.05rem 0 0.25rem;
        }

        .card-body .organizer-name {
            font-size: 0.82rem;
            font-style: italic;
            margin: 0.1rem 0 0.3rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .bootcamp-actions {
            margin-top: auto;
            display: flex;
            gap: 8px;
        }

        .bootcamp-card .organizer-name {
            font-style: italic;
            font-size: 0.9rem;
            margin-bottom: 0.75rem;
        }

        .bootcamp-card .btn-started {
            width: 100%;
            display: block;
            padding: 10px 0;
            margin-top: auto;
            border-radius: 2px;
            flex: 1;
            font-weight: bold;
            text-align: center;
            background: #1e90ff;
            border-radius: 8px;
            color: white;
            text-decoration: none;
        }

        .bootcamp-card .btn-started:hover {
            background-color: #0c6ad8;
        }

        .btn-started {
            width: 100%;
            padding: 8px 0;
            background-color: #1e90ff;
            color: white;
            font-weight: bold;
            text-align: center;
            border-radius: 6px;
            text-decoration: none;
        }

        .btn-started:hover {
            background-color: #0c6ad8;
        }

        .btn-started.blue {
            background-color: #1e90ff;
        }

        .btn-started.blue:hover {
            background-color: #0c6ad8;
        }

        .btn-started.green {
            background-color: #28a745;
        }

        .btn-started.green:hover {
            background-color: #218838;
        }

        .btn-started svg {
            margin-right: 6px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-content h3 {
            margin-bottom: 15px;
        }

        .modal-content .close {
            color: #aaa;
            float: right;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .bill-button {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-left: 8px;
        }

        .bootcamp-thumbnail {
            width: 100%;
            aspect-ratio: 16 / 9;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .bootcamp-actions {
                flex-direction: column;
            }

            .btn-started {
                width: 100%;
            }

            .bootcamp-grid {
                display: grid;
                grid-template-columns: 1fr !important;
                gap: 16px;
            }

            .bootcamp-card {
                max-width: 100% !important;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .main-content.full {
                margin-left: 170px;
                width: calc(100% - 170px);
            }

            .sidebar.hidden {
                transform: translateX(-100%);
            }

            .sidebar {
                width: 170px;
                transform: translateX(0);
            }
        }

        @media (min-width: 1024px) {
            .bootcamp-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }

            .main-content.full {
                margin-left: 170px;
            }

            .main-content {
                margin-left: 0;
            }
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .bootcamp-grid {
                .main-content:not(.full) .bootcamp-grid {
                    grid-template-columns: 1fr;
                }
                .main-content.full .bootcamp-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }
        }

        .filter-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-bar select {
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: #fff;
            font-size: 0.9rem;
            color: #333;
            outline: none;
            transition: border 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .progress-container {
            margin-top: 10px;
            margin-bottom: 8px;
            min-height: 38px;
        }

        .progress-container.empty {
            visibility: hidden;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            border-radius: 6px;
            background: #e9eef8;
            overflow: hidden;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .progress-bar > div {
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #4cacfe, #1976d2);
            border-radius: 6px;
            transition: width 0.6s ease;
        }

        .progress-text {
            margin: 4px 0 0;
            font-size: 0.85rem;
            color: #555;
            font-weight: 500;
        }

        .bootcamp-card .quick-actions {
            display: flex;
            gap: 6px;
            margin: 8px 0 10px;
            flex-wrap: wrap;
            justify-content: flex-start;
            opacity: 1;
            pointer-events: auto;
            transform: translateY(5px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .bootcamp-card .quick-actions .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 3px 10px;
            font-size: 0.75rem;
            font-weight: bold;
            border-radius: 30px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            text-decoration: none;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 0 0 auto;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            transition: transform 0.2s ease, opacity 0.2s ease, background 0.3s ease;
        }

        .bootcamp-card .btn-action:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .btn-action.resume {
            background: #1976d2;
        }

        .btn-action.next-session {
            background: #28a745;
        }

        .btn-action.review {
            background: #ff9800;
        }

        .btn-action:hover {
            opacity: 0.9;
        }

        @media (min-width: 768px) {
            .bootcamp-card:hover .quick-actions {
                opacity: 1;
                pointer-events: auto;
                transform: translateY(0);
            }

            .bootcamp-card:hover .quick-actions .btn-action {
                max-width: none;
                opacity: 1;
            }
        }

        @media (max-width: 767px) {
            .bootcamp-card .quick-actions {
                opacity: 1;
                pointer-events: auto;
                flex-direction: row;
                flex-wrap: wrap;
                gap: 6px;
                justify-content: flex-start;
                align-items: stretch;
                transform: translateY(0);
            }

            .bootcamp-card .quick-actions .btn-action {
                max-width: 100%;
                opacity: 1;
                justify-content: center;
            }
            
        }

        .topics-tag {
            background: #722db7;
        }

        .badge-container {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            max-width: calc(100% - 20px);
        }

        .badge {
            white-space: nowrap;
        }

        .badge.topics-tag {
            max-width: 110px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .status-badge.upcoming {
            background: #ff9800;
            color: white;
        }

        .certificate-section {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-top: 6px;
        }

        .evaluation-badge {
            display: inline-block;
            width: fit-content;
            padding: 4px 10px;
            font-size: 0.75rem;
            border-radius: 12px;
            background: #e8f1ff;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            color: #1976d2;
            font-weight: 500;
            text-decoration: none;
        }

        .evaluation-badge:hover {
            background: #dbe9ff;
        }
        
    </style>
</head>
<body>
    <button id="hamburgerbtn" class="hamburger-btn">
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

    <main id="mainpage" class="main-content">
        <section class= "your-course-section">
             <h2 style="margin-left: 60px;">Your Enrolled Courses</h2>

             <div class="filter-bar" style="margin-left:60px; margin-bottom:15px;">
                <select id="filter-progress">
                    <option value="all">All Progress</option>
                    <option value="incomplete">Incomplete</option>
                    <option value="completed">Completed</option>
                </select>

                <select id="filter-price">
                    <option value="all">All Price</option>
                    <option value="free">Free</option>
                    <option value="paid">Paid</option>
                </select>

                <select id="filter-session">
                    <option value="all">All Sessions</option>
                    <option value="today">Today Session</option>
                    <option value="ongoing">Ongoing</option>
                    <option value="next">Next Session (7 days)</option>
                    <option value="upcoming">Upcoming Session (2 weeks)</option>
                    <option value="ended">Ended Session</option>
                </select>
            </div>

            <div class="bootcamp-grid">
                @forelse($enrollments as $enrollment)
                @php
                    $event = $enrollment->event;
                    $organizer = $event->organizer;
                    $description = strlen($event->description) > 100 ? substr($event->description, 0, 100) . '...' : $event->description;
                    $priceText = $event->price > 0 ? 'Rp ' .number_format($event->price, 0, ',', '.') : 'Free';

                    $progress = $enrollment->progress ?? 0;

                    $nextSchedule = $enrollment->next_schedule ?? null;
                @endphp

                @php
                    $eventDate = $event->start_date
                        ? \Carbon\Carbon::parse($event->start_date)->startOfDay()
                        : null;
                    $today = \Carbon\Carbon::today();
                @endphp
                
               @php
                    $now = \Carbon\Carbon::now();
                    $startDate = $event->start_date ? \Carbon\Carbon::parse($event->start_date) : null;
                    $endDate = $event->end_date ? \Carbon\Carbon::parse($event->end_date) : null;

                    $sessionStatus = 'all';
                    $isEnded = false;

                    if ($endDate && $now->gt($endDate)) {
                        $sessionStatus = 'ended';
                        $isEnded = true; // <-- set di sini
                    } elseif ($startDate && $endDate && $now->between($startDate, $endDate)) {
                        $sessionStatus = 'ongoing';
                    } elseif ($startDate && $startDate->isToday()) {
                        $sessionStatus = 'today';
                    } elseif ($startDate && $startDate->gt($now) && $startDate->lte($now->copy()->addDays(7))) {
                        $sessionStatus = 'next';
                    } elseif ($startDate && $startDate->gt($now) && $startDate->lte($now->copy()->addDays(14))) {
                        $sessionStatus = 'upcoming';
                    }
                @endphp


                <div class="bootcamp-card"
                            data-progress="{{ $event->materials->count() ? $progress : 100 }}"
                            data-price="{{ $event->price > 0 ? 'paid' : 'free' }}" 
                            data-session="{{ $sessionStatus }}"
                            >
                    <div class="badge-container">
                        <span class="badge price {{ $event->price > 0 ? 'paid' : 'free' }}">{{ $priceText }}</span>
                        <span class="badge category">{{ $event->category }}</span>
                        <span class="badge topics-tag">{{ $event->topic }}</span>

                    </div>

                    <div class="status-badge-container">
                        @if($sessionStatus === 'today')
                            <span class="status-badge today">Today</span>
                        
                        @elseif($sessionStatus === 'ongoing')
                            <span class="status-badge ongoing">Ongoing</span>
                        
                        @elseif($sessionStatus === 'next')
                            <span class="status-badge upcoming">Next Session</span>
                        
                        @elseif($sessionStatus === 'upcoming')
                            <span class="status-badge upcoming">Upcoming</span>
                        
                        @elseif($sessionStatus === 'ended')
                            <span class="status-badge ended">Ended</span>
                        @endif
                    </div>

                    
                    <img class="bootcamp-banner"
                        src="{{ $event->image_path ? asset('storage/' . $event->image_path) : asset('images/defaults.png') }}"
                        alt="{{ $event->title }} Banner"
                        onerror="this.onerror=null; this.src='/images/defaults.png';" />

                    <div class="bootcamp-content">
                        <h3>{{ $event->title }}</h3>
                        <div class="bootcamp-info organizer-info" style="margin-bottom: 15px">
                                <img src="{{ $event->organizer->profile_picture 
                                    ? asset('storage/' . $event->organizer->profile_picture) 
                                    : asset('images/default-profile.jpg') }}">
                            <span> {{ $event->organizer->name ?? '-' }}</span>
                        </div>

                        <p>{{ Str::limit($event->description, 100) }} </p>
                                                
                        <div class="quick-actions">

                            @if($isEnded)

                                @if($event->certificate_path)
                                    <a href="{{ $event->certificate_path }}"
                                    target="_blank"
                                    class="btn-action review">
                                        Review / Download Certificate
                                    </a>

                                    @if($event->evaluation_event_url)
                                        <a href="{{ $event->evaluation_event_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="evaluation-badge">
                                            Evaluation Event
                                        </a>
                                    @endif
                                @else
                                    <p class="btn-action review">
                                        Certificate not available yet.
                                    </p>
                                @endif

                            @else

                                <a href="{{ route('participant.getstarted', $enrollment->id) }}"
                                class="btn-action resume">
                                    Resume
                                </a>

                                @if($nextSchedule && \Carbon\Carbon::parse($nextSchedule)->isToday())
                                    <a href="{{ route('participant.getstarted', $enrollment->id) }}"
                                    class="btn-action next-session">
                                        Go to Next Session
                                    </a>
                                @endif

                            @endif

                        </div>

                        <div class="progress-container {{ $event->materials->count() ? '' : 'empty' }}">
                            @if($event->materials->count())
                                <div class="progress-container" style="margin-top:8px;">
                                    <div class="progress-bar" style="height:8px; border-radius: 6px; background:#e9eef8;">
                                        <div style="width:{{ $progress }}%; height:100%; background:linear-gradient(90deg, #4cacfef. #1976d2); border-radius:6px;"></div>
                                    </div>
                                    <p class="progress-text" style="margin:6px 0 0; font-size:0.85rem;">
                                        {{ $progress }}% Completed
                                    </p>
                                </div>  
                            @endif
                        </div>

                        @if($nextSchedule)
                            <p class="schedule" style="margin-top:6px; color:#555; font-size:0.9rem;">
                                Next session: {{ \Carbon\Carbon::parse($nextSchedule)->format('d M Y, h:i A') }}
                            </p>
                        @endif

                        <div class="bootcamp-actions">
                            <a href="{{ route('participant.getstarted', $enrollment->id) }}" class="btn-started blue">Get Started</a>

                            @if($enrollment->event->price > 0 && $enrollment->payment_proof)
                                <a href="javascript:void(0);" class="btn-started green"
                                    onclick="openBillModal(
                                        '{{ route('participant.paymentproof.show', $enrollment->id) }}',
                                        '{{ $enrollment->event->title }}'
                                    )">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
                                        <path d="M21 8V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v1h18zm0 2H3v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-9zm-9 7a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm1.5-4h-3v-2h3v2z"/>
                                    </svg>
                                    &nbsp;Bill
                                </a>
                            @endif
                        </div>
                    </div>

                </div>

                @empty
                    <p style="margin-left: 60px;">You haven't enrolled in any bootcamps yet.</p>
                @endforelse

            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburgerBtn = document.getElementById('hamburgerbtn');
            const sidebar = document.querySelector('.sidebar');
            const mainContent = document.querySelector('.main-content');

            if(localStorage.getItem('sidebarVisible') === 'true') {
                sidebar.classList.remove('hidden');
                mainContent.classList.add('full');
                hamburgerBtn.classList.add('active');
            } else {
                sidebar.classList.add('hidden');
                mainContent.classList.remove('full');
                hamburgerBtn.classList.remove('active');
            }

            hamburgerBtn.addEventListener('click', () => {
                const isHidden = sidebar.classList.contains('hidden');

                if(isHidden) {
                    sidebar.classList.remove('hidden');
                    mainContent.classList.add('full');
                    hamburgerBtn.classList.add('active');
                    localStorage.setItem('sidebarVisible', 'true');
                } else {
                    sidebar.classList.add('hidden');
                    mainContent.classList.remove('full');
                    hamburgerBtn.classList.remove('active');
                    localStorage.setItem('sidebarVisible', 'false');
                }
            });

            const utils = {
                handleImageError: (imgElement, fallbackSrc = '/images/defaults.png') => {
                    imgElement.onerror = null;
                    imgElement.src = fallbackSrc;
                }
            };

            const cards = document.querySelectorAll('.bootcamp-card');
            cards.forEach(card => {
                card.addEventListener('click', () => {
                    cards.forEach(c => c.classList.remove('selected'));
                    card.classList.add('selected');
                });
            });

            function openBillModal(imageUrl, title) {
                document.getElementById('billTitle').innerText = 'Bootcamp: ' + title;
                const img = document.getElementById('billImage');
                img.src = imageUrl;
                img.alt = 'Bukti Pembayaran untuk ' + title;
                img.onerror = () => {
                    img.src = '/images/defaultproof.png';
                };
                document.getElementById('billModal').style.display = 'block';
            }

            function closeBillModal() {
                document.getElementById('billModal').style.display = 'none';
            }

            function handleOutsideClick(event) {
                if(event.target.id === 'billModal') {
                    closeBillModal();
                }
            }

            window.openBillModal = openBillModal;
            window.closeBillModal = closeBillModal;
            window.handleOutsideClick = handleOutsideClick;

            const filterProgress = document.getElementById("filter-progress");
            const filterPrice = document.getElementById("filter-price");
            const filterSession = document.getElementById("filter-session");
            const bootcampGrid = document.querySelector(".bootcamp-grid");
            const filterCards = bootcampGrid.querySelectorAll(".bootcamp-card");

            let noResultMessage = document.createElement('p');
            noResultMessage.innerText = "No courses found for selected filters.";
            noResultMessage.style.marginLeft = "60px";
            noResultMessage.style.display = "none";
            bootcampGrid.parentElement.appendChild(noResultMessage);

            function applyFilters() {
                const progressFilter = filterProgress.value;
                const priceFilter = filterPrice.value;
                const sessionFilter = filterSession.value;
                let visibleCount = 0;

                filterCards.forEach(card => {
                    const progress = parseInt(card.dataset.progress || 0, 10);
                    const price = card.dataset.price || 'free';
                    const session = (card.dataset.session || 'all').trim();

                    let show = true;
                    
                    if(progressFilter === "incomplete" && progress === 100) show = false;
                    if (progressFilter === "completed" && progress < 100) show = false;
                    if(priceFilter !== "all" && priceFilter !== price) show = false;
                    if (sessionFilter !== "all" && sessionFilter !== session) {
                        show = false;
                    }

                    card.style.display = show ? "flex" : "none";
                    if(show) visibleCount++;
                });
                
                noResultMessage.style.display = visibleCount === 0 ? "block" : "none";
            }

            filterProgress.addEventListener('change', applyFilters);
            filterPrice.addEventListener('change', applyFilters);
            filterSession.addEventListener('change', applyFilters);

            applyFilters();
        });
    </script>

    <div id="billModal" class="modal" onclick="handleOutsideClick(event)">
        <div class="modal-content" onclick="event.stopPropagation();">
            <h3 id="billTitle">Bootcamp:</h3>
            <img id="billImage" src="" alt="Bukti Pembayaran" style="max-width: 100%; height: auto; border-radius: 6px; margin-top: 10px;" />
            <button onclick="closeBillModal()" class="btn-started" style="margin-top: 10px;">Close</button>
        </div>
    </div>    

</body>
</html>