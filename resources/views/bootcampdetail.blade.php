<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
            overflow-x: hidden;
        }

        #mainpage {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        #mainpage.shifted {
            margin-left: 170px;
            transition: margin-left 0.3s ease;
        }

        #mainpage.full {
            margin-left: 0;
        }

        .main-content {
            transition: transform 0.3s ease;
            max-width: 100%;
        }

        .main-content.full {
            margin-left: 0 !important;

        }
     
        /* Container utama bootcamp */
        .bootcamp-container {
            background: #ffffff;
            padding: 30px;
            margin: 30px auto;
            border-radius: 16px;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            max-width: 900px;
            width: 100%;
            transition: all 0.3s ease-in-out;
        }

        /* Gambar banner */
        .bootcamp-banner img {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        /* Judul dan deskripsi */
        .bootcamp-container h1 {
            font-size: 2.2em;
            font-weight: 700;
            color: #1f2d3d;
            margin-bottom: 15px;
        }

        .bootcamp-container p {
            font-size: 1.05em;
            line-height: 1.7;
            color: #4a4a4a;
            margin-bottom: 25px;
        }

        /* Nama penyelenggara */
        .organizer-name {
            margin: 20px 0;
        }

        .organizer-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #2e3a59;
            font-weight: bold;
            gap: 10px;
        }

        .organizer-photo {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }


        /* Harga */
        .bootcamp-price {
            background: #eef6ff;
            color: #1f6fba;
            font-size: 1.1em;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 10px;
            display: inline-block;
            margin-bottom: 25px;
        }

        .bootcamp-price::before {
            content: "💰 ";
        }

        .section-divider {
            border: none;
            border-top: 2px solid #d0d7e2;
            width: 100%;
            margin: 30px 0;
        }

        .section-divider-full {
            border: none;
            border-top: 2px solid #d0d7e2;
            width: 100%;
            margin: 40px 0;
            position: relative;
            transform: translateX(-50%);
        }

        /* Tombol enroll */
        .enroll-button {
            display: inline-block;
            background-color: #1e90ff;
            color: #ffffff;
            padding: 12px 26px;
            font-size: 1em;
            font-weight: 600;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-bottom: 30px;
        }

        .enroll-button:hover {
            background-color: #0c6ad8;

        }

        .bootcamp-bottom-section {
            border-top: 2px solid #d0d7e2;
            padding-top: 30px;
            margin-top: 40px;
        }

        /* Bagian Timeline dan Feature */
        .timeline-section, .feature-section {
            background: #f4f7fb;
            border-left: 4px solid #1e90ff;
            padding: 14px 18px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            font-size: 0.9em;
        }
        

        .timeline-section h2,
        .feature-section h2 {
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 10px;
            color: #1e90ff;
        }

        .timeline-section p {
            font-size: 0.95em;
            margin: 0;
            color: #555;
        }

        .feature-section p {
            font-size: 0.95em;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #444;
        }

        .feature-section p span {
            font-size: 0.85em;
            padding: 4px 10px;
            border-radius: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .feature-section .active {
            background-color: #e6f9f2;
            color: #1e9e6a;
            border: 1px solid #1e9e6a;
        }

        .feature-section .inactive {
            background-color: #ffe6e6;
            color: #d9534f;
            border: 1px solid #d9534f;
        }


        /* Status aktif/tidak aktif */
        .active {
            color: #1e9e6a;
            font-weight: 600;
        }

        .inactive {
            color: #d9534f;
            font-weight: 600;
        }

        /* Tombol back */
        .back-button {
            margin-left: 170px;
            margin-bottom: 20px;
            text-align: left;
        }

        .back-button a {
            color: #1e90ff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .back-button a:hover {
            color: #0c6ad8;

        }

        .divider-with-text {
            display: flex;
            align-items: center;
            text-align: center;
            width: 100vw;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            margin: 40px 0;
        }

        .divider-with-text::before,
        .divider-with-text::after {
            content: '';
            flex: 1;
            border-top: 2px solid #d0d7e2;
        }

        .divider-with-text span {
            padding: 0 20px;
            font-weight: 600;
            color: #555;
            font-size: 0.95em;
        }

        @media (max-width: 768px) {

            #mainpage.shifted {
                margin-left: 170px;
            }
            
            .bootcamp-container {
                padding-left: 20px;
                padding-right: 20px;
            }

            .back-button {
                margin-left: 16px;
            }
        }
        
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }


        .modal-content {
            background: #fff;
            padding: 2rem;
            border-radius: 12px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: fadeInUp 0.3s ease-in-out;
        }

        .modal-content button[onclick="closeModal()"] {
            top: 1rem;
            right: 1rem;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            margin-bottom: 1.5rem;
            padding: 1rem;
            border-radius: 6px;
            font-size: 0.9rem;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .enroll-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .enroll-form input[type="email"],
        .enroll-form input[type="file"] {
            width: 100%;
            padding: 0.6rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            line-height: 1.4;
        }

        .forms-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1rem;
        }

        .submit-btn, .back-btn {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .submit-btn {
            background-color: #1e90ff;
            color: white;
        }

        .submit-btn:hover {
            background-color: #0c6ad8;
        }

        .back-btn {
            background-color:rgb(227, 227, 227);
            color: #333;
        }

        .back-btn:hover {
            background-color: #cacaca;
        }

        #image-preview {
            transition: transform 0.2s ease;
        }

        #image-preview:hover {
            transform: scale(1.05);
            filter: grayscale(0%);
        }

        .input-with-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-with-icon input[type="file"] {
            width: 100%;
            padding-right: 40px;
        }

        .input-with-icon .icon-btn {
            position: absolute;
            right: 10px;
            top: 9px;
            transform: translateY(0);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
        }

        .breakword {
            overflow-wrap: break-word;
            word-wrap: break-word;
            word-break: break-word;
        }

        #details-panel {
            overflow: hidden;
            max-height: 0;
        }

        .detail-tags {
            margin-top: 10px;
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .tag {
            padding: 8px 13px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
            color: #fff;
            margin-bottom: 20px;
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

        .tag.almost-full {
            background-color: #ffa500;
        }

        .tag.active {
            background-color: #555;
        }

        .tag.inactive {
            background-color: #d9534f;
        }

        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal-content {
            background: #fff;
            padding: 2rem;
            border-radius: 14px;
            width: 90%;
            max-width: 500px;
            position: relative;
            animation: modalFade 0.3s ease;
        }

        @keyframes modalFade {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        body.modal-open {
            overflow: hidden;
        }

    </style>
</head>

<body>

    @php
        $organizer = $event->organizer;
    @endphp

    <main id="mainpage" class="main-content">
            <div class="back-button" style="margin-top: 90px;">
                <a href="/aamainhome" onclick="history.back()">&larr; Back</a>
            </div>

            <section class="containers">
                @if (!$event)
                    <p style="text-align:center; color:#666;">No data available for this bootcamp.</p>
                @else
                <div class="bootcamp-container">
                    <div class="bootcamp-banner">
                        <img src="{{   $event->image_path && file_exists(public_path('storage/' . $event->image_path))
                                    ? asset('storage/' . $event->image_path)
                                    : asset('images/defaults.png')
                                }}"
                            onerror="this.onerror=null; this.src='{{ asset('images/default-banner.jpg') }}';"
                            width="100%" height="auto" loading="lazy">
                    </div>

                    <h1 class="breakword">{{ $event->title }}</h1>
                    <p class="breakword">{{ $event->description }}</p>

                    <div class="organizer-name">
                        <a href="{{ route('organizer.profile', ['id' => $event->organizer->id]) }}" class="organizer-link">
                            <img src="{{ $organizer->profile_picture_url }}"
                                alt="Organizer Photo"
                                class="organizer-photo">

                            <span>{{ $event->organizer->name }}</span>
                        </a>
                    </div>

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

                        @php
                            $enrolledCount = $event->enrolls->count() ?? 0;
                            $quota = $event->quota ?? 0;
                            $remaining = $quota - $enrolledCount;
                        @endphp

                        @if(!$quota)
                            <span class="tag active">Unlimited Participants</span>
                        @elseif($event->is_full || $remaining <= 0)
                            <span class="tag inactive">Full</span>
                        @elseif($remaining <= 10)
                            <span class="tag almost-full">Almost Full</span>
                        @else
                            <span class="tag active">{{ $enrolledCount }}/{{ $quota }} Participant</span>
                        @endif
                    </div>

                    @if(session('unenroll_success'))
                        <div class="alert alert-danger">
                            {{ session('unenroll_success') }}
                        </div>
                    @endif

                    <div style="display: flex; gap: 10px; margin-bottom: 30px;">
                        @if(!$isEnrolled)
                            <button onclick="openModal()" class="enroll-button">
                                Enroll Now
                            </button>
                        @else
                            @if($event->price == 0)
                                <form action="{{ route('enroll.cancel', $event->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="enroll-button"
                                        style="background: #b2babb; cursor: pointer;">
                                        Enrolled
                                    </button>
                                </form>
                            @else
                                <button class="enroll-button"
                                    style="background: #b2babb; cursor:not-allowed;"
                                    disabled>
                                    Enrolled
                                </button>

                                <small style="color: #555; margin-top: 5px;">
                                    Before canceling your enrollment, please contact the committee if a refund is required.
                                </small>
                            @endif
                        @endif

                        <button class="enroll-button"
                            style="background: #566573;"
                            onclick="toggleDetails()">
                            Details
                        </button>
                    </div>

                </div>

                <hr class="section-divider">
                <div id="details-panel" style="display:none;">
                    <div class="divider-with-text"><span>DETAIL</span></div>

                        <div class="bootcamp-container">
                                <div class="timeline-section">
                                    <h2>Timeline</h2>
                                    <p>
                                        {{ \Carbon\Carbon::parse($event->start_date)->translatedFormat('l, F j, Y • H:i') }}
                                        -
                                        {{ \Carbon\Carbon::parse($event->end_date)->translatedFormat('l, F j, Y • H:i') }}
                                    </p>
                                </div>

                                <div class="feature-section">
                                    <h2>Feature</h2>
                                    <p>Evaluation Test:
                                        <span class="{{ $event->evaluation_test_url ? 'active' : 'inactive' }}">
                                            {{ $event->evaluation_test_url ? 'Available' : 'Unavailable' }}
                                        </span>
                                    </p>
                                    <p>Group:
                                        <span class="{{ $event->group_url ? 'active' : 'inactive' }}">
                                            {{ $event->group_url ? 'Available' : 'Unavailable' }}
                                        </span>
                                    </p>
                                </div>
                        </div>
                    </div>
                </div>
                @endif
            </section>
    </main>

    <div id="enrollModal" class="modal-overlay">
        <div class="modal-content">
            <button onclick="closeModal()" style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:1.2rem; cursor:pointer;">&times;</button>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Oops! There's something wrong</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form action="{{ route('enroll.store') }}" method="POST" enctype="multipart/form-data" class="enroll-form">
                @csrf
                <input type="hidden" name="bootcamp_id" value="{{ $event->id }}">
                <div class="form-group">
                    <label for="email">Account Email</label>
                    <input type="email" id="email" name="email" required placeholder="you@example.com">
                    @error('email')
                        <small style="color: red;">{{ $message }}</small>
                    @enderror
                </div>


                @if($event->price > 0)
                    <div class="form-group">
                        <label for="payment-proof">Payment Proof Upload (.jpg / .png)</label>
                        <div class="input-with-icon">
                            <input type="file" id="payment_proof" name="payment_proof" accept=".png,.jpg" required onchange="setPreviewFile(event)">
                            <button type="button" class="icon-btn" onclick="openImagePreview()" title="Preview gambar">
                            </button>
                        </div>
                        @error('payment_proof')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>
                @else
                    <p style="color: green;">This bootcamp is free. No payment proof required.</p>
                @endif

                <div class="forms-buttons">
                    <button type="button" class="back-btn" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
    </div>

    <div id="unenrollModal" class="modal-overlay">
        <div class="modal-content">

            <button type="button" onclick="closeUnenrollModal()"
                style="position:absolute; top:12px; right:14px; background:none; border:none; font-size:1.4rem;">
                &times;
            </button>

            <h3>Cancel Enrollment</h3>
            <p>Are you sure you want to cancel?</p>

            <form id="unenrollForm" method="POST">
                @csrf
                @method('DELETE')

                <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
                    <button type="button" class="back-btn" onclick="closeUnenrollModal()">No</button>
                    <button type="submit" class="submit-btn" style="background:#e74c3c;">Yes</button>
                </div>
            </form>
        </div>
    </div>


    <script>
        function confirmSubmit(event) {
            const confirmed = confirm("Are you sure you want to submit?");
            if (!confirmed) {
                event.preventDefault();
                return false;
            }
            return true;
        }

        let previewFile = null;

        function setPreviewFile(event) {
            if (event.target.files.length > 0) {
                previewFile = URL.createObjectURL(event.target.files[0]);
            }
        }

        function openImagePreview() {
            if (!previewFile) {
                alert("Silakan pilih gambar terlebih dahulu.");
                return;
            }

            const imageWindow = window.open("");
            imageWindow.document.write("<title>Preview Gambar</title>");
            imageWindow.document.write('<img src="' + previewFile + '" style="width: 100%; height: auto;">');
        }

        function toggleDetails() {
            const panel = document.getElementById("details-panel");

            if (panel.style.display === "none" || panel.style.display === "") {
                panel.style.display = "block";
                panel.style.maxHeight = "0px";
                setTimeout(() => {
                    panel.style.transition = "max-height 0.4s ease";
                    panel.style.maxHeight = "2000px";
                }, 10);
            } else {
                panel.style.transition = "max-height 0.4s ease";
                panel.style.maxHeight = "0px";
                setTimeout(() => {
                    panel.style.display = "none";
                }, 400);
            }
        }

        function openModal() {
            const modal = document.getElementById('enrollModal');
            modal.classList.add('show');
            document.body.classList.add('modal-open');
        }

        function closeModal() {
            const modal = document.getElementById('enrollModal');
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
        }

        function openUnenrollModal(eventId) {
            const modal = document.getElementById('unenrollModal');
            const form = document.getElementById('unenrollForm');

            form.action = '/enroll/cancel/' + eventId;
            modal.classList.add('show');
            document.body.classList.add('modal-open');
        }

        function closeUnenrollModal() {
            const modal = document.getElementById('unenrollModal');
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
        }

        window.addEventListener('click', function(e) {
            document.querySelectorAll('.modal-overlay').forEach(modal => {
                if (e.target === modal) {
                    modal.classList.remove('show');
                    document.body.classList.remove('modal-open');
                }
            });
        });

    </script>

</body>
</html>