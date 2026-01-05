<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafc;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .bootcamp-detail {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        .bootcamp-detail h2 {
            margin-bottom: 8px;
            font-size: 1.6rem;
            color: #2e3a59;
        }

        .bootcamp-detail .meta {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 16px;
        }

        .meeting-share-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .btn-started {
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            margin-top: 10px;
            border: none;
            outline: none;
            box-shadow: none;
            transition: background-color 0.2s ease-in-out;
        }

        .share-buttons {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .share-btn {
            padding: 6px 10px;
            border-radius: 6px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.85rem;
            transition: background 0.2s ease;
        }

        .share-btn img {
            width: 28px;
            height: 28px;
            display: block;
            transition: transform 0.2s ease;
        }

        .share-btn:hover img {
            transform: scale(1.1);
            filter: brightness(0) invert(1);
        }

        .share-btn.whatsapp {
            background: #25D366;
        }

        .share-btn.whatsapp:hover {
            background: #1DA851;
        }

        .share-btn.telegram {
            background: #0088cc;
        }

        .share-btn.telegram:hover {
            background: #006699;
        }

        .share-btn.twitter {
            background: #1da1f2;
        }

        .share-btn.twitter:hover {
            background: #0d95e8;
        }

        .btn-started.green {
            background: #28a745;
        }

        .btn-started.green:hover {
            background: #218838;
        }

        .btn-started.red {
            background: #dc3545;
            color: #fff;
        }

        .btn-started.red:hover {
            background: #b52b39;
        }

        .btn-started.disabled {
            background: #ccc;
            cursor: not-allowed;
        }

        .progress-container {
            margin-top: 20px;
        }

        .progress-bar {
            width: 100%;
            background: #e9eef8;
            border-radius: 10px;
            overflow: hidden;
            height: 20px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }

        .progress-bar > div {
            height: 100%;
            width: 0;
            background: linear-gradient(90deg, #66aef6, #1976d2);
            color: #fff;
            text-align: center;
            font-size: 0.8rem;
            font-weight: bold;
            transition: width 0.6s ease-in-out;
        }
        
        .materials {
            margin-top: 30px;
        }

        .materials h3 {
            margin-bottom: 12px;
            font-size: 1.2rem;
            color: #2e3a59;
        }

        .material-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f1f4fa;
            padding: 12px 16px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .material-item span {
            font-weight: 500;
        }

        .material-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .mark-done {
            padding: 6px 14px;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            background: #bbb;
            color: #fff;
            transition: background 0.3s;
        }

        .mark-done.completed {
            background: #28a745;
        }


        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .modal-content {
            position: relative;
            width: 90%;
            max-width: 600px;
            background: #000;
            border-radius: 8px;
            overflow: hidden;
        }

        .modal-content iframe {
            width: 100%;
            height: 450px;
            border: none;
        }

        .close {
            position: absolute;
            top: 8px;
            right: 12px;
            font-size: 28px;
            color: #0d0d0dff;
            cursor: pointer;
        }

        @media (max-width: 480px) {
            .material-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .material-actions button,
            .material-actions a {
                width: 100%;
            }
        }

        @media (max-width: 600px) {
            .modal-content iframe{
                height: 250px;
            }
        }

        @media (min-width: 768px) {
            .modal-content {
                width: 50%;
                max-width: 600px;
            }

            .modal-content iframe {
                height: 400px;
            }
        }

        .mark-done.completed::after {
            content: "✓";
            margin-left: 6px;
        }

        .bootcamp-detail .meta {
            line-height: 1.5;
        }

        .btn-download {
            padding: 6px 12px;
            background: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            margin-left: 8px;
        }

        .btn-download:hover {
            background: #2779bd;
        }

        .floating-share {
            position: fixed;
            right: 20px;
            bottom: 20px;
            display: flex;
            flex-direction: column-reverse;
            align-items: center;
            z-index: 9999;
        }
        
        .main-share-btn {
            width: 55px;
            height: 55px;
            border-radius: 50%;
            border: none;
            background: #2e3a59;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 8px rgba(0,0,0, 0.2);
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .main-share-btn img {
            width: 26px;
            height: 26px;
            filter: brightness(0) invert(1);
        }

        .main-share-btn:hover {
            background: #1a2236;
            transform: scale(1.1);
        }

        .share-dropup {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 10px;
            opacity: 0;
            pointer-events: none;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .floating-share.active .share-dropup {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }

        .share-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: transform 0.2s ease;
        }

        .share-button img {
            width: 22px;
            height: 22px;
            filter: brightness(0) invert(1);
        }

        .share-button:hover {
            transform: scale(1.15);
        }

        .share-button.whatsapp {
            background: #25D366;
        }

        .share-button.telegram {
            background: #0088cc;
        }

        .share-button.twitter {
            background: #1da1fa;
        }

        .bootcamp-banner {
            width: 100%;
            height: 300px;
            margin-bottom: 16px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .bootcamp-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit:cover;
            display: block;
        }

        .bootcamp-info.organizer-info img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        .bootcamp-info.organizer-info {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            margin: 16px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }

        .bootcamp-info.organizer-info span {
            font-size: 1rem;
            font-weight: 600;
            color: #2e3a59;
        }

        .bootcamp-info.organizer-info span {
            font-size: 1rem;
            font-weight: 600;
            color: #2e3a59;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 16px;
            padding: 8px 14px;
            color:#2e3a59;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
        }

        .badge-status {
            display: inline-block;
            margin-left: auto;
            padding: 1px 8px;
            align-items: center;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            color: #fff;
        }

        .btn-play {
            background: #1976d2;
            color: #fff;
            border: none;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .btn-play:hover {
            background: #0d47a1;
        }
        
        .btn-play::before {
            font-size: 14px;
        }

    </style>
</head>
<body>

    <div class="bootcamp-detail">
        <a href="{{ route('your.course') }}" class="btn-back">
            ← Back to Your Course
        </a>
        
        <img class="bootcamp-banner"
            src="{{ $event->image_path ? asset('storage/' . $event->image_path) : asset('images/defaults.png') }}"
            alt="{{ $event->title }} Banner"
            onerror="this.onerror=null; this.src='/images/defaults.png';" />

        <h2>{{ $event->title ?? 'Bootcamp Detail' }}

            @php
                $now = \Carbon\Carbon::now();
                if ($event->end_time < $now) {
                    $status = 'Ended';
                    $color = '#dc3545';
                } elseif($event->start_time > $now) {
                    $status = "Upcoming";
                    $color = '#ffc107';
                } else {
                    $status = 'Active';
                    $color = '#28a745';
                }
            @endphp
            
            <span class="badge-status" style="background: {{ $color }};">
                {{ $status }}
            </span>
        </h2>

        <div class="bootcamp-info organizer-info" style="margin-bottom: 15px">
            <img src="{{ $event->organizer->profile_picture 
                ? asset('storage/' . $event->organizer->profile_picture) 
                : asset('images/default-profile.jpg') }}">
            <span> {{ $event->organizer->name ?? '-' }}</span>
        </div>

        <p>{{ Str::limit($event->description, 100) }} 
            <span id="read-more" style="color:#1976d2; cursor:pointer;"> Read more</span>
        </p>

        <p id="desc-full" style="display:none;">{{ $event->description }} 
            <span id="read-less" style="color:#1976d2; cursor:pointer;"> Read less</span>
        </p>

        <div class="meta">
            Schedule:
            {{ \Carbon\Carbon::parse($event->start_time)->format('d M Y h:i A') }} -
            {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
        </div>

        <div class= "meeting-share-container">
            @if($status === 'Ended')
                <span class="btn-started disabled">Meeting Ended</span>
            @elseif($status === 'Upcoming')
                <span class="btn-started disabled">Coming Soon</span>
            @elseif($status === 'Active')
                <a href="{{ $event->meeting_link }}" target="_blank" class="btn-started green">
                    Join Meeting
                </a>

                <div class="share-buttons">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($event->title. ' '.$event->meeting_link) }}" target="_blank" class="share-btn whatsapp" title="Share via WhatsApp">
                        <img src="{{ asset('icons/whatsapp.svg') }}" alt="WhatsApp" />
                    </a>
                    <a href="https://t.me/share/url?url={{ urlencode($event->meeting_link) }}&text={{ urlencode($event->title) }}" target="_blank" class="share-btn telegram" title="Share via Telegram">
                        <img src="{{ asset('icons/telegram.svg') }}" alt="Telegram" />
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->title. ' '.$event->meeting_link) }}" target="_blank" class="share-btn twitter" title="Share via Twitter">
                        <img src="{{ asset('icons/twitter.svg') }}" alt="Twitter" />
                    </a>
                </div>
            @endif
        </div>

        <div class="progress-container">
            <div class="progress-bar">
                <div id="progress-bar-fill" style="width: {{ $progress }}%;"></div>
            </div>
            <p id="progress-text">{{ $progress }}%</p>
        </div>

        <div class="progress-actions">
            <button id="mark-complete" class="btn-started green">Mark All Done</button>
        </div>


        <div class="materials">
            <h3>Bootcamp Course</h3>

            @foreach($event->materials as $material)
                <div class="material-item">
                    <span>{{ $material->title }}</span>

                    <div class="material-actions">
                        @if($material->type === 'video')
                            <button class="btn-play" data-url="{{ asset('storage/' . $material->file_path) }}">▶ Play</button>
                        @elseif($material->type === 'pdf')
                            <a href="{{ asset('storage/' . $material->file_path) }}" download class="btn-download">⬇ Download PDF</a>
                        @endif

                        <button
                            class="mark-done {{ in_array($material->key, $materialProgress ?? []) ? 'completed' : '' }}"
                            data-key="{{ $material->key }}">
                            {{ in_array($material->key, $materialProgress ?? []) ? 'Completed' : 'Done' }}
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        <div id="videoModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height: 100%; background:rgba(0,0,0,0.7); justify-content:center; align-items:center;">
            <div class="modal-content">
                <button id="closeModal" class="close">✖</button>
                <iframe id="videoFrame" src="" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </div>

    <div class="floating-share">
        <button class="main-share-btn" id="toggleShare">
             <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="white">
                <path d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.03-.47-.09-.7l7.02-4.11c.54.5 1.25.81 2.07.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.07 8.81C7.54 8.3 6.83 8 6 8c-1.66 0-3 1.34-3 3s1.34 3 3 3c.83 0 1.54-.3 2.07-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3s3-1.34 3-3-1.34-3-3-3z"/>
            </svg>
        </button>
        <div class="share-dropup">
            <a href="https://wa.me/?text={{ urlencode($event->title . ' ' . $event->meeting_link) }}" 
                target="_blank" class="share-button whatsapp" title="Share on WhatsApp">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" viewBox="0 0 24 24">
                    <path d="M12.04 2.003c-5.514 0-9.988 4.475-9.988 9.988 0 1.761.461 3.48 1.336 5.012l-1.414 5.163 5.286-1.39c1.478.804 3.142 1.224 4.78 1.224 5.513 0 9.988-4.475 9.988-9.988S17.553 2.003 12.04 2.003zm0 18.222c-1.408 0-2.781-.366-3.982-1.058l-.285-.165-3.139.825.837-3.057-.186-.314c-.832-1.404-1.271-3.017-1.271-4.653 0-4.94 4.02-8.96 8.96-8.96s8.96 4.02 8.96 8.96-4.02 8.96-8.96 8.96zm4.835-6.675c-.264-.132-1.559-.77-1.8-.857-.24-.088-.415-.132-.59.132s-.677.857-.83 1.032c-.152.176-.304.198-.568.066-.264-.132-1.115-.411-2.125-1.31-.785-.699-1.315-1.56-1.468-1.824-.152-.264-.016-.406.116-.538.119-.118.264-.308.396-.462.132-.154.176-.264.264-.44.088-.176.044-.33-.022-.462-.066-.132-.59-1.425-.809-1.95-.212-.51-.428-.442-.59-.45-.152-.007-.33-.009-.508-.009-.176 0-.462.066-.706.33-.24.264-.924.902-.924 2.2s.947 2.552 1.08 2.728c.132.176 1.865 2.85 4.523 3.993.632.273 1.126.437 1.511.56.634.202 1.21.173 1.666.105.508-.076 1.559-.637 1.778-1.252.22-1.142.154-1.252-.066-.11-.24-.4-.176-.504-.308z"/>
                </svg>
            </a>
            <a href="https://t.me/share/url?url={{ urlencode($event->meeting_link) }}&text={{ urlencode($event->title) }}" 
                target="_blank" class="share-button telegram" title="Share on Telegram">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" viewBox="0 0 24 24">
                    <path d="M9.9 14.4l-.4 5.6c.6 0 .9-.2 1.3-.6l3.1-3 6.4 4.6c1.2.6 2-.4 2-1.4l3.6-16.8c.4-1.8-.7-2.6-1.9-2.1L1.2 9.8c-1.8.7-1.8 1.6-.3 2.1l5.8 1.8 13.5-8.5-10.3 9.2z"/>
                </svg>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode($event->meeting_link) }}&text={{ urlencode($event->title) }}" 
                target="_blank" class="share-button twitter" title="Share on Twitter">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" viewBox="0 0 24 24">
                    <path d="M23.954 4.569c-.885.392-1.83.656-2.825.775 1.014-.611 1.794-1.574 2.163-2.723-.951.555-2.005.96-3.127 1.184-.897-.959-2.178-1.555-3.594-1.555-2.72 0-4.924 2.204-4.924 4.924 0 .39.045.765.127 1.124-4.094-.205-7.725-2.165-10.158-5.144-.424.729-.666 1.577-.666 2.475 0 1.708.87 3.216 2.188 4.099-.807-.026-1.566-.247-2.228-.616v.061c0 2.385 1.693 4.374 3.946 4.827-.413.111-.849.171-1.296.171-.317 0-.626-.03-.928-.086.627 1.956 2.444 3.379 4.6 3.419-1.68 1.318-3.809 2.104-6.102 2.104-.396 0-.788-.023-1.175-.069 2.179 1.397 4.768 2.21 7.557 2.21 9.054 0 14-7.496 14-13.986 0-.21 0-.423-.015-.633.962-.689 1.8-1.56 2.46-2.548l-.047-.02z"/>
                </svg>
            </a>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const markButtons = Array.from(document.querySelectorAll(".mark-done"));
            const progressFill = document.getElementById("progress-bar-fill");
            const progressText = document.getElementById("progress-text");
            const markAllBtn = document.getElementById("mark-complete");
            const total = markButtons.length || 1;
            let isSaving = false;
            
            const modal = document.getElementById("videoModal");
            const videoFrame = document.getElementById("videoFrame");
            const closeModal = document.getElementById("closeModal");

            function getCompletedCount() {
                return document.querySelectorAll(".mark-done.completed").length;
            }

            function updateUI(progress) {
                progress = Math.max(0, Math.min(100, Math.round(progress)));
                if (progressFill) progressFill.style.width = progress + "%";
                if (progressText) progressText.textContent = progress + "%";
            }

            function setItemState(button, isDone) {
                if(isDone) {
                    button.classList.add("completed");
                    button.textContent = "Completed";
                } else {
                    button.classList.remove("completed");
                    button.textContent = "Done";
                }
            }

            async function saveProgressToServer(materialKey, willComplete) {
                if (isSaving) return false;
                isSaving = true;
                try {
                    const res = await fetch("{{ route('yourcourse.updateMaterialProgress', $enroll->id) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        },
                        body: JSON.stringify({
                            material_key: materialKey,
                            completed: !!willComplete
                        })
                    });

                    if (!res.ok) throw new Error(res.statusText);

                    const data = await res.json();

                    if(data.success) {
                        updateUI(data.progress);

                        if(Array.isArray(data.completedKeys)) {
                            markButtons.forEach(btn => {
                                const k = btn.dataset.key;
                                setItemState(btn, data.completedKeys.includes(k));
                            });
                        }

                        if (markAllBtn) {
                            if (data.completedCount === data.totalMaterials && data.totalMaterials > 0) {
                                markAllBtn.textContent = "Cancel All";
                                markAllBtn.classList.add("red");
                                markAllBtn.classList.remove("green");
                            } else {
                                markAllBtn.textContent = "Mark All Done";
                                markAllBtn.classList.add("green");
                                markAllBtn.classList.remove("red");
                            }
                        }

                        return true;
                    } else {
                        console.error("API responded success:false", data);
                        return false;
                    }
                } catch (err) {
                    console.error("Save error", err);
                    alert("Gagal menyimpan progress");
                    return false;
                } finally {
                    isSaving = false;
                }
            }

            markButtons.forEach(button => {
                const key = button.dataset.key;
                button.addEventListener("click", async () => {
                    if (isSaving) return;
                    const willComplete = !button.classList.contains("completed");
                    setItemState(button, willComplete);

                    const ok = await saveProgressToServer(key, willComplete);
                    if (!ok) setItemState(button, !willComplete);
                });
            });

            if (markAllBtn){
                markAllBtn.addEventListener("click", async () => {
                    if (isSaving) return;
                    const allCompleted = getCompletedCount() === total;

                    if (allCompleted) {
                        markButtons.forEach(btn => setItemState(btn, false));
                        updateUI(0);
                        const ok = await saveProgressToServer("all", false);
                        if (!ok) alert("Gagal membatalkan semua progress");
                    } else {
                        markButtons.forEach(btn => setItemState(btn, true));
                        updateUI(100);
                        const ok = await saveProgressToServer("all", true);
                        if (!ok) alert("Gagal menyimpan semua progress");
                    }
                });
            }

            updateUI((getCompletedCount() / total) *100);

            closeModal.addEventListener("click", () => {
                modal.style.display = "none";
                videoFrame.src = "";
            });

            modal.addEventListener("click", e => {
                if(e.target === modal) {
                    modal.style.display = "none";
                    videoFrame.src = "";
                }
            });

            document.querySelectorAll(".btn-play").forEach(btn => {
                btn.addEventListener("click", () => {
                    const url = btn.getAttribute("data-url");
                    if(url) {
                        videoFrame.src = url + "?autoplay=1";
                        modal.style.display = "flex";
                    }
                })
            })
        });
    </script>
</body>
</html>