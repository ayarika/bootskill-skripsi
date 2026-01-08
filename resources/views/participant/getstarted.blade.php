<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Course</title>
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

        .join-btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .join-btn.active {
            background: #4f8ef7;
            color: white;
        }

        .join-btn.disabled {
            background: #ccc;
            color: #666;
            cursor: not-allowed;
        }

        .event-datetime {
            margin-top: 6px;
            margin-bottom: 16px;
            font-size: 0.95rem;
            color: #666;
        }

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
        }

        .modal-overlay.hidden {
            display: none;
        }

        .modal-box {
            background: #fff;
            padding: 24px 28px;
            border-radius: 10px;
            width: 320px;
            max-width: 90%;
            text-align: center;
            animation: slideDown 0.25s ease;
        }

        .modal-box h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.1rem;
            color: #2e3a59;
        }

        .modal-box p {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 20px;
        }

        .modal-close-btn {
            padding: 8px 18px;
            border: none;
            border-radius: 6px;
            background: #4f8ef7;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .bootcamp-banner {
            width: 100%;
            height: 240px;
            object-fit: cover;
            border-radius: 14px;
            margin-bottom: 20px;
            background: #f3f3f3;
        }

        @media (max-width: 768px) {
            .bootcamp-banner {
                height: 160px;
                border-radius: 10px;
            }
        }

        .detail-tags{
            position: static;
            top: 10px;
            left: 10px;
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            z-index: 10;
            margin: 10px 0 14px 0;
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
        
        .progress-container {
            margin: 6px 0 16px;
            max-width: 420px;
        }

        .progress-bar {
            height: 8px;
            background: #e9eef8;
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #4fc4f7, #1976d2);
            border-radius: 6px;
            transition: width 0.4s ease;
        }

        .progress-text {
            margin-top: 6px;
            font-size: 0.85rem;
            color: #555;
        }

        .extra-links {
            display: flex;
            gap: 10px;
            margin: 14px 0 18px;
            flex-wrap: wrap;
        }

        .extra-btn {
            background: #f1f3f6;
            color: #333;
        }

        .extra-btn:hover {
            background: #e0e4ea;
        }

        .event-datetime {
            line-height: 1.6;
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            max-width: 720px;
            aspect-ratio: 16/9;
            margin-top: 12px;
            border-radius: 12px;
            overflow: hidden;
            background: #000;
        }

        .video-wrapper iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: none;
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

        <img class="bootcamp-banner"
                        src="{{ $event->image_path && file_exists(public_path($event->image_path))
                            ? asset( $event->image_path) 
                            : asset('images/defaults.png') }}"
                        alt="{{ $event->title }} Banner"
                        onerror="this.onerror=null; this.src='/images/defaults.png';" />

        <h1>{{ $event->title }}</h1>
        <p>{{ $event->description }}</p>

        <div class="detail-tags">
            <span class="tag price-tag">
                @if ($event->price == 0)
                    FREE
                @else
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                @endif
            </span>

            <span class="tag category-tag">{{ $event->category }}</span>
            <span class="tag topics-tag">{{ $event->topic }}</span>
        </div>

        @if($event->materials->count())
            <div class="progress-container">
                <div class="progress-bar">
                    <div id="progressFill" class="progress-fill" style="width: {{ $progress }}%;"></div>
                </div>
                <p id="progressText" class="progress-text">{{ $progress }}% Completed</p>
            </div>
        @endif

        @php
            $startDateTime = \Carbon\Carbon::parse($event->start_date);
            $endDateTime   = \Carbon\Carbon::parse($event->end_date);
        @endphp


        <p class="event-datetime">
            @if ($startDateTime->isSameDay($endDateTime))
                {{ $startDateTime->format('d M Y') }} •
                {{ $startDateTime->format('H:i') }} - {{ $endDateTime->format('H:i') }}
            @else
                {{ $startDateTime->format('d M Y H:i') }} <br>
                {{ $endDateTime->format('d M Y H:i') }}
            @endif
        </p>

        <div style="display:flex; align-items:center; gap:10px;">

            <button
                id="joinMeetingBtn"
                class="join-btn"
                data-start="{{ $startDateTime->format('Y-m-d H:i:s') }}"
                data-end="{{ $endDateTime->format('Y-m-d H:i:s') }}"
                data-link="{{ $event->meeting_link ?? '' }}"
            >
                Join Meeting
            </button>

            <button
                id="copyMeetingLinkBtn"
                class="join-btn"
                style="background: #eee; color: #333;"
                title="Copy meeting link"
            >
                Copy Link
            </button>
        </div>
        <p id="meetingCountdown"></p>

        <hr>

        @if($event->evaluation_test_url || $event->group_url)
            <h2>Features</h2>

            <div class="extra-links">
                @if($event->evaluation_test_url)
                    <button
                        class="join-btn extra-btn"
                        data-link="{{ $event->evaluation_test_url }}"
                    >
                        Copy Evaluation Test
                    </button>
                @endif

                @if($event->group_url)
                    <button
                        class="join-btn extra-btn"
                        data-link="{{ $event->group_url }}"
                    >
                        Copy Group Link
                    </button>
                @endif
            </div>
        @endif

        <h2>Materials</h2>

        @if($event->materials->count())
            <select id="materialSelect" style="padding:8px; margin-bottom: 16px;">
                <option value="">--Choose Material --</option>
                @foreach($event->materials as $index => $material)
                    <option value="material-{{ $index + 1 }}">
                        {{ $material->title }}
                    </option>
                @endforeach
            </select>

            @foreach($event->materials as $index => $material)
                @php
                    $key = 'material-' . ($index + 1);
                    $filePath = public_path(ltrim($material->file_path, '/'));
                    $fileUrl = asset(ltrim($material->file_path, '/'));
                @endphp

                <div class="material-card material-content"
                    id="{{ $key }}"
                    style="display:none; margin-top: 20px;">

                    <label style="display:block; margin-bottom: 10px;">
                        <input
                            type="checkbox"
                            class="material-checkbox"
                            data-enroll="{{ $enroll->id }}"
                            data-key="{{ $key }}"
                            {{ in_array($key, $completedKeys) ? 'checked' : '' }}
                        >
                        Mark as completed
                    </label>

                    <h4>{{ $material->title }}</h4>
                    
                    @if($material->type === 'pdf')
                        @if($material->file_path && file_exists($filePath))
                            <iframe src="{{ $fileUrl }}"
                                width="100%" height="400"></iframe>
                        @else
                            <p style="color:red;">PDF file not found.</p>
                        @endif
                    @elseif($material->type === 'video_file')
                        @if($material->file_path && file_exists($filePath))
                            <video controls width="100%" style="max-height:500px;">
                                <source src="{{ $fileUrl }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <p style="color:red;">Video file not found.</p>
                        @endif
                    @elseif($material->type === 'video_link')
                        <div class="video-wrapper">
                            <iframe
                                src="{{ $material->video_link }}"
                                allowfullscreen
                                loading="lazy">
                            </iframe>
                        </div>
                    @endif
                </div>
            @endforeach
        @else
            <p>No materials available.</p>
        @endif       
        
        <div id="meetingModal" class="modal-overlay hidden">
            <div class="modal-box">
                <h3>Not Available</h3>
                <p>The meeting link is <strong>not yet available</strong>.<br>Please wait for the organizer to activate <br>the link.</p>
                <button id="closeModalBtn" class="modal-close-btn">OK</button>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const hamburgerBtn = document.getElementById("hamburgerbtn");
            const sidebar = document.getElementById("mainmenu");
            const mainContent = document.querySelector("main");

            hamburgerBtn.addEventListener("click", function () {
                sidebar.classList.toggle("hidden");
                mainContent.classList.toggle("full");
                hamburgerBtn.classList.toggle("active");
            });

            const select = document.getElementById('materialSelect');
            const contents = document.querySelectorAll('.material-content');

            if (select) {
                select.addEventListener('change', () => {
                    contents.forEach(c => c.style.display = 'none');

                    const selected = document.getElementById(select.value);
                    if (selected) {
                        selected.style.display = 'block';
                    }
                });
            }

            const btn = document.getElementById('joinMeetingBtn');
            const countdownEl = document.getElementById('meetingCountdown');
            if (!btn) return;

            const start = new Date(btn.dataset.start.replace(' ', 'T')).getTime();
            const end = new Date(btn.dataset.end.replace(' ', 'T')).getTime();
            const link = btn.dataset.link;

            function formatTime(ms) {
                ms = Math.max(0, ms);

                const totalSeconds = Math.floor(ms / 1000);

                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                const h = hours > 0 ? `${hours}h ` : '';
                const m = String(minutes).padStart(2, '0');
                const s = String(seconds).padStart(2, '0');

                return `${h}${m}m ${s}s`;
            }

            const modal = document.getElementById('meetingModal');
            const closeModalBtn = document.getElementById('closeModalBtn');

            function showMeetingModal() {
                modal.classList.remove('hidden');
            }

            closeModalBtn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            const copyBtn = document.getElementById('copyMeetingLinkBtn');

            copyBtn.addEventListener('click', () => {
                if (!link) {
                    showMeetingModal();
                    return;
                }

                navigator.clipboard.writeText(link).then(() => {
                    copyBtn.textContent = 'Copied';
                    setTimeout(() => {
                        copyBtn.textContent = 'Copy Link';
                    }, 1500);
                });
            });

            function updateMeetingButton() {
                const now = Date.now();
                const diff = start - now;
                
                if (now < start) {
                    btn.classList.add('disabled');
                    btn.classList.remove('active');
                    btn.textContent = 'Meeting not started';
                    btn.onclick = null;

                    countdownEl.textContent = `Meeting starts in ${formatTime(diff)}`;
                } else if (now >= start && now <= end) {
                    btn.classList.remove('disabled');
                    btn.classList.add('active');
                    btn.textContent = 'Join Meeting';
                    countdownEl.textContent = '';

                    const enrollId = {{ $enroll->id }};
                    const link = btn.dataset.link;
                    btn.onclick = () => {
                        if (!link) {
                            showMeetingModal();
                        } else {
                            fetch(`/attendance/${enrollId}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    console.log('Attendance recorded:', data.timestamp);
                                }

                                window.open(link, '_blank');
                            })
                            .catch(err => {
                                console.error('Failed to record attendance', err);
                                window.open(link, '_blank');
                            });
                        };
                    };
                } else {
                    btn.classList.add('disabled');
                    btn.classList.remove('active');
                    btn.textContent = 'Meeting has ended';
                    countdownEl.textContent = '';
                    btn.onclick = null;
                }
            }

            updateMeetingButton();
            setInterval(updateMeetingButton, 1000);

            document.querySelectorAll('.material-checkbox').forEach(cb => {
                cb.addEventListener('change', function () {
                    fetch(`/yourcourse/${this.dataset.enroll}/update-progress`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            material_key: this.dataset.key,
                            completed: this.checked ? true : false
                        })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('progressFill').style.width =
                                data.progress + '%';

                            document.getElementById('progressText').innerText =
                                data.progress + '% Completed';
                        }
                    })
                    .catch(err => {
                        alert('Failed to update progress');
                        this.checked = !this.checked;
                    });
                });
            });

            document.querySelectorAll('.extra-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const link = btn.dataset.link;

                    navigator.clipboard.writeText(link).then(() => {
                        const original = btn.textContent;
                        btn.textContent = 'Copied';
                        setTimeout(() => {
                            btn.textContent = original;
                        }, 1500);
                    });
                });
            });
        });
    </script>
</body>
</html>
