<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Event</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            transition: filter 0.3s ease;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background: linear-gradient(to bottom, #66aef6ff, #79beedff);
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s ease, transform 0.3s ease;
            padding-top: 60px;
            overflow-x: hidden;
            z-index: 1000;
        }

        .sidebar.collapsed {
            transform: translateX(-100%);
        }

        .sidebar a {
            display: block;
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            white-space: nowrap;
        }

        .sidebar a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: transparent;
            border: none;
            color: white;
            font-size: 22px;
            cursor: pointer;
            display: none;
            z-index: 3001;
        }

        .hamburger-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            background: transparent;
            color: #2e4a59;
            border: none;
            font-size: 24px;
            cursor: pointer;
            z-index: 3000;
            padding: 5px 10px;
            border-radius: 6px;
            transition: color 0.3s ease;
        }

        .hamburger-btn svg {
            width: 30px;
            height: 30px;
            fill: currentColor;
            transition: fill 0.2s ease;
        }

        .hamburger-btn.active {
            color: #fff;
        }

        .main-content {
            position: relative;
            z-index: 1;
            margin-left: 200px;
            padding: 40px 30px;
            transition: margin-left 0.3s ease;
        }

        .main-content.collapsed {
            margin-left: 0;
        }

        @media (max-width: 768px) {
            body {
                overflow-x: hidden;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh;
                background-color: #2e3a59;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
                z-index: 2500;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .close-btn {
                display: block;
            }

            .main-content {
                margin-left: 0 !important;
                padding: 20px;
            }
        }

        .form-container {
            max-width: 100%;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0, 0.1);
        }

        .form-group {
            margin-top: 50px;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .form-group input[type="text"],
        .form-group input[type="url"],
        .form-group input[type="datetime-local"],
        .form-group input[type="number"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .form-group img {
            width: 100%;
            max-height: 200px;
            object-fit: cover;
            margin-bottom: 10px;
            border-radius: 6px;
        }

        .switch-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        

        .switch-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .optional-inputs {
            margin-top: 10px;
        }

        .btn-row {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }

        .btn {
            padding: 10px 20px;
            background-color: #1e90ff;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #0c6ad8;
        }

        .btn.draft {
            background-color: #999;
        }

        .btn.draft:hover {
            background-color: #777;
        }

        .select-container {
            position: relative;
            width: 100%;
        }

        .custom-select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .custom-select:focus {
            border-color: #1f6fba;
            box-shadow: 0 0 0 3px rgba(31, 111, 186, 0.2);
        }

        .dropdown-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-top: none;
            border-radius: 0 0 8px 8px;
            max-height: 200px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        }

        .dropdown-list::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-list::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .dropdown-list::-webkit-scrollbar-thumbh:hover {
            background: #aaa;
        }

        .dropdown-list div {
            padding: 10px 14px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s ease;
        }

        .dropdown-list div:hover {
            background-color: #eaf2fb;
            color: #1f6ba;
            font-weight: 500;
        }

        #materials-container {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-top: 10px;
        }

        .material-item {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            background: #fafafa;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            align-items: center;
        }

        .material-item select,
        .material-item input[type="text"],
        .material-item input[type="url"],
        .material-item input[type="file"] {
            flex: 1;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            min-width: 150px;
        }

        .material-item input[type="file"] {
            padding: 5px;
        }

        .material-item button.remove-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .material-item button.remove-btn:hover {
            background-color: #c0392b;
        }

        #materials-container .material-item select {
            max-width: 160px;
        }

        #materials-container .material-item input[type="text"] {
            flex: 2;
        }

        .add-material-btn {
            margin-top: 10px;
            padding: 10px 16px;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s ease;
            background-color: #fff;
            color: #2e3a59;
            border: 2px solid #d8d4d4ff;
            font-weight: 600;
            opacity: 0.8;
        }

        .add-material-btn:hover {
            background-color: #d8d4d4ff;
        }

        .btn-draft {
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s ease;
            background-color: #e0e0e0;
            color: #2e3a59;
            font-weight: 600;
            border: none;
            outline: none;
        }

        .btn-draft:hover {
            background-color: #d5d5d5;
        }

        .select-container {
            position: relative;
            width: 100%;
        }

        .custom-select {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .dropdown-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ccc;
            border-top: none;
            max-height: 150px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
        }

        .dropdown-list div {
            padding: 8px;
            cursor: pointer;
        }

        .dropdown-list div:hover {
            background-color: #f0f0f0;
        }

        .form-text {
            display: block;
            font-size: 13px; 
            color: #666;
            margin-top: 6px;
            line-height: 1.4;
        }

        .form-text.text-muted {
            color: #888;
            font-style: italic;
        }

        .form-text.error {
            color: #e74c3c;
            font-style: normal;
            font-weight: 500;
        }

        #main-content.collapsed {
            margin-left: 40px;
        }

        .main-content.collapsed .form-container {
            max-width: 100% !important;
        }

        .main-content {
            transition: margin-left 0.25s ease, width 0.25sp ease;
        }

        .main-content.full-width {
            margin-left: 0 !important;
        }

        .sidebar.desktop-closed {
            transform: translateX(-100%);
        }

        .type-op {
            color: #555;
        }

        .title-p {
            color: #2e3a59;
        }

        .logout-form {
            margin: 0;
        }

        .logout-btn {
            display: block;
            width: 100%;
            background: transparent;
            border: none;
            color: white;
            padding: 15px 20px;
            text-align: left;
            font-size: 1rem;
            cursor: pointer;
            white-space: nowrap;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 6px;
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

    <div id="sidebar" class="sidebar">
        <button id="closeSidebarBtn" class="close-btn">✕</button>
            <a href="{{ route('organizer.home') }}">Home</a>
            <a href="{{ route('organizer.yourevent') }}">Your Event</a>
            <a href="{{ route('organizer.help') }}">Help</a>
            <form action="{{ route('logout') }}" method="GET" class="logout-form">
                <button type="submit" class="logout-btn">Sign Out</button>
            </form>
    </div>

    <div class="main-content" id="main-content">
        <div class="form-container">
            <form action="{{ route('organizer.event.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="event_image" class="title-p">Event Image</label>
                    <small class="form-text text-muted">
                        *Image format: jpeg, png, jpg - <strong>Max size 2MB</strong>
                    </small>
                    <img id="image-preview"
                        src="{{ isset($event) && $event->event_path ? asset('storage/' . $event->image_path) : asset('images/defaults.png') }}"
                            alt="Preview">
                    <input type="file" id="event_image" name="event_image" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">
                </div>

                <div class="form-group">
                    <label for="title" class="title-p">Event Title</label>
                    <small class="form-text text-muted">
                        <strong>*Required</strong>, max 255 characters
                    </small>
                    <input type="text" id="title" name="title" value="{{ old('title', $event->title ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="description" class="title-p">Event Description</label>
                    <small class="form-text text-muted">
                        <strong>*Required</strong>, describe your event clearly
                    </small>
                    <textarea id="description" name="description" rows="5" required>{{ old('description', $event->description ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="start_date" class="title-p">Start Date</label>
                    <input type="datetime-local" id="start_date" name="start_date"
                        value="{{ old('start_date', $startDateValue ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="end_date" class="title-p">End Date</label>
                    <input type="datetime-local" id="end_date" name="end_date" 
                        value="{{ old ('end_date', $endDateValue ?? '') }}" required>
                    <small id="date-error" class="form-text error" style="display: none;">
                        End date cannot be earlier than start date.
                    </small>
                </div>

                <div class="form-group">
                    <label for="features" class="title-p">Feature</label>
                </div>
                <div class="switch-container">
                    <div class="switch-group">
                    <input type="checkbox" id="evaluation_test_switch" onclick="toggleInput('evaluation_test')"
                        {{ old('evaluation_test_url', $event->evaluation_test_url ?? '') ? 'checked' : '' }}>
                        <label for="evaluation_test_switch" class="title-p">Evaluation Test</label>
                    </div>
                    <div class="switch-group">
                        <input type="checkbox" id="group_switch" onclick="toggleInput('group')">
                        <label for="group_switch" class="title-p">Group</label>
                    </div>
                    <div class="switch-group">
                        <input type="checkbox" id="paid_switch" onclick="toggleInput('paid')">
                        <label for="paid_switch" class="title-p">Paid</label>
                    </div>
                </div>

                <div class="form-group optional-inputs" id="evaluation_test_input" style="display: none;">
                    <label for="evaluation_test_url" class="title-p">Evaluation Test URL</label>
                    <input type="url" name="evaluation_test_url" id="evaluation_test_url" value="{{ old('evaluation_test_url', $event->evaluation_test_url ?? '') }}">
                </div>
                <div class="form-group optional-inputs" id="group_input" style="display: none;">
                    <label for="group_url" class="title-p">Group URL</label>
                    <input type="url" name="group_url" id="group_url">
                </div>
                <div class="form-group optional-inputs" id="paid_input" style="display: none;">
                    <label for="price" class="title-p">Price (Rp)</label>
                    <input type="number" name="price" id="price" min="0">
                </div>

                <div class="form-group">
                    <label for="topic" class="title-p">Topic</label>
                    <div class="select-container">
                        <input type="text" name="topic" id="topic"
                            value="{{ old('topic', isset($event) ? ucwords($event->topic) : '') }}"
                            placeholder="Select or type a topic" required
                            class="custom-select" autocomplete="off">
                        <div id="topic-list" class="dropdown-list">
                            @foreach($topics as $topic)
                                <div>{{ $topic }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="category" class="title-p">Category</label>
                    <div class="select-container">
                        <input type="text" name="category" id="category"
                            value="{{ old('category', isset($event) ? ucwords($event->category) : '') }}"
                            placeholder="Select or type a category" required
                            class="custom-select" autocomplete="off">
                        <div id="category-list" class="dropdown-list">
                            @foreach($categories as $category)
                                <div>{{ $category }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="quota" class="title-p">Quota</label>
                    <small class="form-text text-muted">
                        <strong>*Optional</strong>, leave empty for unlimited participants
                    </small>
                    <input
                        type="number"
                        name="quota"
                        id="quota"
                        min="1"
                        placeholder="e.g. 50"
                        value="{{ old('quota', $event->quota ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="evaluation_event_url" class="title-p">Evaluation Event URL</label>
                    <small class="form-text text-muted">
                        <strong>*Optional</strong>, must be a valid URL if filled
                    </small>
                    <input type="url" name="evaluation_event_url" id="evaluation_event_url" value="{{ old('evaluation_event_url', $event->evaluation_event_url ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="meeting_link" class="title-p">Meeting Link</label>
                    <small class="form-text text-muted">
                        <strong>*Optional</strong>, must be a valid URL if filled
                    </small>
                    <input type="url" name="meeting_link" id="meeting_link" placeholder="https://your-meeting-link.com" style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc;">
                </div>

                <div class="form-group">
                    <label for="materials" class="title-p">Materials</label>
                    <small class="form-text text-muted">
                        <strong>*Required</strong> if you have material (video: mp4 / document: pdf).
                        Tap <strong>remove</strong> if you don't have any material.
                    </small>
                    <div id="materials-container">
                        <div class="material-item">
                            <select name="materials[0][type]" onchange="toggleMaterialInput(this)" required class="type-op">
                                <option value="">Select Type</option>
                                <option value="pdf">PDF</option>
                                <option value="video_file">Video File</option>
                                <option value="video_link">Video Link</option>
                            </select>
                            <input type="text" name="materials[0][title]" placeholder="Material Title" required>
                            <input type="file" name="materials[0][file]" accept=".pdf,video/mp4" style="display:none;">
                            <input type="url" name="materials[0][video_link]" placeholder="https://www.youtube.com/embed/abc123" style="display:none;">
                            <button type="button" class="remove-btn" onclick="removeMaterial(this)">Remove</button>
                        </div>
                    </div>
                    <button type="button" class="add-material-btn" onclick="addMaterial()">+ Add Material</button>
                </div>

                <div class="btn-row">
                    <button type="submit" name="status" value="draft" class="btn-draft">Save as Draft</button>
                    <button type="submit" name="status" value="published" class="btn">Publish Event</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById("sidebar");
        const hamburgerBtn = document.getElementById("hamburgerbtn");
        const closeSidebarBtn = document.getElementById("closeSidebarBtn");
        const mainContent = document.getElementById("main-content");

        function isMobileView() {
            return window.innerWidth <= 768;
        }

        hamburgerBtn.addEventListener("click", (e) => {
            e.stopPropagation();

            if (isMobileView()) {
                sidebar.classList.toggle("active");
            } else {
                sidebar.classList.toggle("desktop-closed");
                mainContent.classList.toggle("collapsed");
                document.querySelector(".form-container").classList.toggle("full-width");
            }

            updateHamburgerColor();
        });

        function updateHamburgerColor() {
            if (isMobileView()) {
                hamburgerBtn.classList.toggle(
                    "active",
                    sidebar.classList.contains("active")
                );
                hamburgerBtn.style.color = "";
            } else {
                hamburgerBtn.classList.remove("active");

                if (sidebar.classList.contains("desktop-closed")) {
                    hamburgerBtn.style.color = "#2e4a59";
                } else {
                    hamburgerBtn.style.color = "#fff";
                }
            }
        }

        closeSidebarBtn.addEventListener("click", () => {
            if (isMobileView()) {
                sidebar.classList.remove("active");
                updateHamburgerColor();
            }
        });

        document.addEventListener("click", (e) => {
            if (
                isMobileView() &&
                sidebar.classList.contains("active") &&
                !sidebar.contains(e.target) &&
                e.target !== hamburgerBtn
            ) {
                sidebar.classList.remove("active");
                updateHamburgerColor();
            }
        });

        window.addEventListener("resize", () => {
            if (isMobileView()) {
                sidebar.classList.remove("desktop-closed");
                sidebar.classList.remove("active");
                mainContent.classList.remove("collapsed");
            }

            updateHamburgerColor();
        });

        updateHamburgerColor();
        
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('image-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function toggleInput (type) {
            const inputMap = {
                evaluation_test: 'evaluation_test_input',
                group: 'group_input',
                paid: 'paid_input'
            };

            const checkbox = document.getElementById(`${type}_switch`);
            const target = document.getElementById(inputMap[type]);

            if(checkbox.checked) {
                target.style.display = 'block';
            } else {
                target.style.display = 'none';
                target.querySelector('input').value = '';
            }
        }

        function addMaterial() {
            const container = document.getElementById('materials-container');
            const index = container.children.length;
            const div = document.createElement('div');
            div.classList.add('material-item');
            div.innerHTML = `
                <select name="materials[${index}][type]" onchange="toggleMaterialInput(this)" required>
                    <option value="">Select Type</option>
                    <option value="pdf">PDF</option>
                    <option value="video_file">Video File</option>
                    <option value="video_link">Video Link</option>
                </select>
                <input type="text" name="materials[${index}][title]" placeholder="Material Title" required>
                <input type="file" name="materials[${index}][file]" accept=".pdf, video/mp4" style="display: none;">
                <input type="url" name="materials[${index}][video_link]" placeholder="https://example.com" style="display:none;">
                <button type="button" class="remove-btn" onclick="removeMaterial(this)">Remove</button>
            `;
            container.appendChild(div);
        }

        function toggleMaterialInput(select) {
            const parent = select.closest('.material-item');
            const fileInput = parent.querySelector('input[type="file"]');
            const linkInput = parent.querySelector('input[type="url"]');
            fileInput.style.display = "none";
            linkInput.style.display = "none";

            if (select.value === "pdf" || select.value === "video_file") {
                fileInput.style.display = "inline-block";
                fileInput.required = true;
                linkInput.required = false;
            } else if (select.value === "video_link") {
                linkInput.style.display = "inline-block";
                linkInput.required = true;
                fileInput.required = false;
            }
        }

        function removeMaterial(btn) {
            btn.closest('.material-item').remove();
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('#materials-container select').forEach(select => {
                toggleMaterialInput(select);
            });
        });

        function setupDropdown(inputId, listId) {
            const input = document.getElementById(inputId);
            const list = document.getElementById(listId);
            const items = list.children;

            input.addEventListener('focus', () => {
                list.style.display = 'block';
            });

            input.addEventListener('input', () => {
                const filter = input.value.toLowerCase();
                Array.from(items).forEach(item => {
                    item.style.display = item.textContent.toLowerCase().includes(filter)
                        ? 'block' : 'none';
                });
                list.style.display = 'block';
            });

            Array.from(items).forEach(item => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    input.value = item.textContent;
                    list.style.display = 'none';
                });
            });

            document.addEventListener('click', (e) => {
                if (!input.contains(e.target) && !list.contains(e.target)) {
                    list.style.display = 'none';
                }
            });
        }

        document.addEventListener('DOMContentLoaded', () => {
            setupDropdown('topic', 'topic-list');
            setupDropdown('category', 'category-list');
        });

        const startDateInput = document.getElementById("start_date");
        const endDateInput = document.getElementById("end_date");
        const errorText = document.getElementById("date-error");

        function validateDates() {
            const start = new Date(startDateInput.value);
            const end = new Date(endDateInput.value);

            if (startDateInput.value && endDateInput.value && end < start) {
                errorText.style.display = "block";
                endDateInput.setCustomValidity("End date cannot be earlier than start date");
            } else {
                errorText.style.display = "none";
                endDateInput.setCustomValidity("");
            }
        }

        startDateInput.addEventListener("change", validateDates);
        endDateInput.addEventListener("change", validateDates);

    </script>
</body>
</html>