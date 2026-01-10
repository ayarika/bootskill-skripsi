<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Event</title>

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
      padding: 90px 30px 40px 30px;
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

       .main-content,
       .dropdown-section {
            margin-left: 0 !important;
            padding: 80px 20px 20px 20px;
        }

        .profile-section {
            flex-direction: column;
            text-align: center;
        }

        .organizer-photo {
            margin: 0 0 20px 0;
        }

        .dropdown-btn {
            font-size: 0.95rem;
        }

        .form-container {
            padding: 20px;
        }           
    }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 22px;
        }

        .form-group small {
            margin-bottom: 6px;
            line-height: 1.4;
        }

        label { 
            display: block; 
            font-weight: bold; 
            margin-bottom: 5px; 
        }

        input, 
        textarea, 
        select {
            width: 100%; 
            padding: 10px 12px; 
            border: 1px solid #ccc; 
            border-radius: 4px;
        }

        img { 
            width: 100%; 
            max-height: 200px; 
            object-fit: cover; 
            margin-bottom: 10px; 
            border-radius: 8px; 
            border: 1px solid #ccc;

        }

        button { 
            padding: 10px 20px; 
            background: #1f6fba; 
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }

        .form-container h1{
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .switch-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 28px;
        }

        .switch-group {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f9f9f9;
            padding: 8px 12px;
            border-radius: 6px;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: background 0.2s ease;
            white-space: nowrap;
            
            justify-content: flex-start;
            min-width: 160px;
            
        }
        
        .switch-group label {
            font-size: 14px;
            font-weight: 500;
            color: #333;
            margin: 0;
            cursor: pointer;
        }

        .switch-group:hover {
            background: #eef4ff;
        }

        .switch-group input[type="checkbox"] {
            transform: scale(1.1);
            cursor: pointer;
        }

        .select-container {
            position: relative;
            width: 100%;
        }

        .custom-select{
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            transition: all 0.2s ease;
            background: #fff;
            cursor: pointer;
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
            max-height: 220px;
            overflow-y: auto;
            display: none;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .dropdown-list:-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-list::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 4px;
        }

        .dropdown-list::webkit-scrollbar-thumb:hover {
            background: #aaa;
        }

        .dropdown-list div {
            padding: 10px 14px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s ease color 0.2s ease;
        }

        .dropdown-list div:hover {
            background-color: #eaf2fb;
            color: #1f6fba;
            font-weight: 500;
        }

        .btn-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            margin-top: 25px;
        }

        .btn-draft {
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
            background-color: #e0e0e0;
            color: #2e3a59;
            font-weight: 600;
            border: none;
            outline: none;
        }

        .btn-draft:hover {
            background-color: #d5d5d5;
        }

        .btn-publish {
            background-color: #1e90ff;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-publish:hover {
            background-color: #0c6ad8;
        }
        
        .form-text.text-muted {
            color: #888;
            font-style: italic;
        }

        #materials-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .material-item {
           display: flex;
           flex-direction: column;
           gap: 10px;
           background: #fff;
           border: 1px solid #ddd;
           padding: 15px;
           border-radius: 8px;
           margin-bottom: 20px;
           box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .material-item select,
        .material-item input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            width: 100%;
        }

        .material-row {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .material-item .remove-btn {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            transition: background 0.2s ease-in-out;
        }

        .material-item .remove-btn:hover {
            background: #c0392b;
        }

        .add-material-btn {
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s ease-in-out;
            background-color: #fff;
            color: #2e3a59;
            border: 2px solid #d8d4d4ff;
            font-weight: 600;
            opacity: 0.8;
        }

        .add-material-btn:hover {
            background: #d8d4d4ff;
        }

        .material-preview {
            margin-top: 8px;
            position: relative;
        }

        .material-preview a {
            color: #007bff;
            text-decoration: underline;
            font-size: 14px;
        }

        .material-preview video,
        .material-preview iframe {
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ddd;
        }

        .fullscreen-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            padding: 5px 8px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            z-index: 10;
        }

        .fullscreen-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
        }

        .fullscreen-modal.active {
            display: flex;
        }

        .fullscreen-content {
            width: 90%;
            height: 90%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #000;
        }

        .fullscreen-content iframe,
        .fullscreen-content video {
            width: 100%;
            height: 100%;
            border: none;
            object-fit: contain;
        }

        .close-btn {
            position: absolute;
            top: 6px;
            right: 15px;
            font-size: 28px;
            font-weight: normal;
            background: none !important;
            border: none !important;
            color: white;
            cursor: pointer;
            z-index: 10000;
        }

        .material-preview {
            margin-top: 8px;
            position: relative;
        }

        .material-preview a {
            color: #007bff;
            text-decoration: underline;
            font-size: 14px;
        }

        .material-preview video,
        .material-preview iframe {
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ddd;
            width: 100%;
            max-height: 250px;
        }

        .materials-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 10px;
        }

        .form-container h1 {
            margin-bottom: 40px;
        }

        #start_date,
        #end_date {
            margin-top: 8px;
        }

        .btn-row {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        @media (min-width: 769px) {
            .form-container {
                padding-top: 40px;
                padding-bottom: 40px;
            }
        }
        #materials-container > div {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .material-header {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .material-header input[type="text"] {
            flex: 2;
        }

        .material-header select {
            flex: 1;
        }

        #materials-container input[type="text"] {
            margin-bottom: 5px;
        }

        #materials-container .remove-btn {
            align-self: flex-end;
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        

        #materials-container .remove-btn:hover {
            background: #c0392b;
        }

        .material-preview {
            margin-top: 10px;
        }

        .remove-btn {
            align-self: flex-end;
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .remove-btn:hover {
            background: #c0392b;
        }

        .material-wrapper {
            margin-bottom: 20px;
        }

        .material-wrapper input[type="text"] {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }

        .material-item .form-group {
            margin-bottom: 10px;
        }

        .material-item input[type="text"],
        .material-item select,
        .material-item input[type="file"],
        .material-item input[type="url"] {
            display: block;
            width: 100%;
            flex: 1;
            padding: 7px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            background: #fff;
        }

        .material-item input[type="file"] {
            width: 100%;
            height: 42px;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 8px 10px;
            font-size: 14px;
            background-color: #fff;
            cursor: pointer;
            display: block;
            color: #333;
            line-height: normal;
        }      

        .file-input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
        }

        .file-input-wrapper input[type="file"] {
            flex: 1;
        }

        .file-name {
            font-size: 13px;
            color: #444;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 250px;
        }

        .material-preview {
            margin-top: 8px;
            width: 100%;
        }

        .material-preview iframe,
        .material-preview video {
            width: 100%;
            height: 300px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        
        @media (min-width: 769px) {
            .sidebar.desktop-closed {
                transform: translateX(-100%);
            }

            .main-content.collapsed {
                margin-left: 0;
            }
        }

        .hamburger-btn {
            color: #2e4a59;
            transition: color 0.3s ease;
        }

        @media (max-width: 768px) {
            .hamburger-btn.active {
                color: #fff;
            }
        }

        .title-p {
            color: #2e3a59;
        }

        input[data-locked="true"] {
            opacity: 0.5;
        }

        .quota-modal {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.45);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99999;
        }

        .quota-modal.active {
            display: flex;
        }

        .quota-modal-content {
            background: #fff;
            padding: 25px 30px;
            border-radius: 10px;
            max-width: 380px;
            width: 90%;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            animation: scaleIn 0.2s ease;
        }

        .quota-modal-content h3 {
            margin-bottom: 12px;
            color: #2e3a59;
        }

        .quota-modal-content p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        .quota-modal-content button {
            background: #1e90ff;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .quota-modal-content button:hover {
            background: #0c6ad8;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.9);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .switch-group {
            min-width: unset;
            padding: 8px 14px;
        }

        .switch-group label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin: 0;
            cursor: pointer;
        }

        .switch-group input[type="checkbox"] {
            margin: 0;
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

        .hidden {
            display: none;
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

    <div class="main-content" id="form-container">
        <form id="event-form" action="{{ route('organizer.updateevent', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="event_image" class="title-p">Event Image</label>
                <small class="form-text text-muted">
                    *Image format: jpeg, png, jpg - <strong>Max size 2MB</strong>
                </small>
                <img id="image-preview"
                    src="{{ $event->image_path ? asset($event->image_path) : asset('images/defaults.png') }}"
                    alt="Preview">
                <input type="file" id="event_image" name="event_image" accept="image/png, image/jpeg, image/jpg" onchange="previewImage(event)">
            </div>

            <div class="form-group">
                <label for="title" class="title-p">Title</label>
                <small class="form-text text-muted">
                    <strong>*Required</strong>, describe your event clearly
                </small>
                <input type="text" id="title" name="title" value="{{ old('title', $event->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description" class="title-p">Description</label>
                <textarea id="description" name="description" rows="5" required>{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="start_date" class="title-p">Start Date</label>
                <input type="datetime-local" id="start_date" name="start_date"
                    value="{{ $startDateValue }}" required>
            </div>

            <div class="form-group">
                <label for="end_date" class="title-p">End Date</label>
                <input type="datetime-local" id="end_date" name="end_date"
                    value="{{ $endDateValue }}" required>
                <small id="date-error" style="color:red; display:none;">End date cannot be earlier than start date.</small>
            </div>

            <div class="form-group">
                <label for="features" class="title-p">Features</label>
            </div>

            <div class="switch-container">
                <div class="switch-group">
                    <input 
                    type="checkbox" 
                    id="evaluation_test_switch" 
                    name="has_evaluation_test"
                    onclick="toggleInput('evaluation_test')"
                        {{ old('evaluation_test_url', $event->evaluation_test_url) ? 'checked' : '' }}>
                    <label for="evaluation_test_switch" class="title-p"> Evaluation Test</label>
                </div>

                <div class="switch-group">
                    <input 
                        type="checkbox" 
                        id="group_switch" 
                        name="has_group"
                        onclick="toggleInput('group')"
                        {{ old('group_url', $event->group_url) ? 'checked' : '' }}>
                    <label for="group_switch" class="title-p">Group</label>
                </div>

                <div class="switch-group">
                    <input 
                        type="checkbox" 
                        id="paid_switch" 
                        name="has_paid"
                        onclick="toggleInput('paid')"
                        {{ old('price', $event->price) ? 'checked' : '' }}>
                    <label for="paid_switch" class="title-p">Paid</label>
                </div>
            </div>

            <div class="form-group optional-inputs" id="evaluation_test_input" style="display: none;">
                <label for="evaluation_test_url" class="title-p">Evaluation Test URL</label>
                <input type="url" name="evaluation_test_url" id="evaluation_test_url"
                    value="{{ old('evaluation_test_url', $event->evaluation_test_url) }}">
            </div>
            <div class="form-group optional-inputs" id="group_input" style="display:none;">
                <label for="group_url" class="title-p">Group URL</label>
                <input type="url" name="group_url" id="group_url" value="{{ old('group_url', $event->group_url) }}">
            </div>
            <div class="form-group optional-inputs" id="paid_input" style="display:none;">
                <label for="price" class="title-p">Price (Rp) </label>
                <input type="number" name="price" id="price" min="0" value="{{ old('price', $event->price) }}">
            </div>

            <div class="form-group">
                <label for="topic" class="title-p">Topic</label>
                <div class="select-container">
                    <input type="text" name="topic" id="topic"
                        value="{{ old('topic', ucwords($event->topic)) }}"
                        placeholder="Select or type a topic" required autocomplete="off" class="custom-select">
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
                        value="{{ old('category', ucwords($event->category)) }}"
                        placeholder="Select or type a category" required autocomplete="off" class="custom-select">
                    <div id="category-list" class="dropdown-list">
                        @foreach($categories as $category)
                            <div>{{ $category }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="title-p">Quota</label>
                <small class="form-text text-muted">
                    <strong>*Optional</strong>, leave empty for unlimited participants
                </small>
                <input 
                    type="number" 
                    name="quota" 
                    min="1"
                    placeholder="e.g. 50"
                    value="{{ old('quota', $event->quota) }}">
            </div>

            <div class="form-group">
                <label class="title-p">Event Status</label>
                <div class="switch-container">
                    <div class="switch-group">
                        <input type="checkbox"
                                name="is_almost_full"
                                value="1"
                                @if(old('is_almost_full', $event->is_almost_full)) checked @endif>
                        <label>Almost Full</label>
                    </div>

                    <div class="switch-group">
                        <input type="checkbox"
                                name="is_full"
                                value="1"
                                {{ old('is_full', $event->is_full) ? 'checked' : '' }}>
                        <label>Full</label>
                    </div>
                </div>

                <small class="form-text text-muted">
                    *If <strong>Full</strong> is checked, enrollment will be closed.
                </small>
            </div>

            <div class="form-group">
                <label for="evaluation_event_url" class="title-p">Evaluation Event URL</label>
                <small class="form-text text-muted">
                    <strong>*Optional</strong>, must be a valid URL if filled
                </small>
                <input type="url" name="evaluation_event_url" id="evaluation_event_url"
                        value="{{ old('evaluation_event_url', $event->evaluation_event_url) }}">
            </div>

            <div class="form-group">
                <label for="meeting_link" class="title-p">Meeting Link</label>
                <small class="form-text text-muted">
                    <strong>*Optional</strong>, must be a valid URL if filled
                </small>
                <input type="url" name="meeting_link" id="meeting_link"
                    value="{{ old('meeting_link', $event->meeting_link) }}"
                    placeholder="https://your-meeting-link.com">
            </div>

            <div class="form-group">
                <label for="certificate_path" class="title-p">Certificate Link</label>
                <small class="form-text text-muted">
                    <strong>*Optional</strong>, link to certificate (PDF / image / Drive / Canva)
                </small>
                <input
                    type="url"
                    name="certificate_path"
                    id="certificate_path"
                    value="{{ old('certificate_path', $event->certificate_path) }}">
            </div>

            <div id="materials-wrapper">
                <div id="materials-container">
                    <label for="materials" class="title-p">Materials</label>
                    <small class="form-text text-muted">
                        <strong>*Required</strong> if you have material (video: mp4 / document: pdf).
                        Tap <strong>remove</strong> if you don't have any material.
                    </small>
                    @if(!empty($event->materials))
                    
                        @foreach($event->materials as $index => $material)
                            <div class="material-item" data-material-id="{{ $material->id }}">
                                <input type="hidden" name="materials[{{ $material->id }}][existing]" value="1">

                                <input type="text"
                                    name="materials[{{ $material->id}}][title]"
                                    value="{{ $material->title }}"
                                    placeholder="Material Title"
                                    required>

                                <div class="material-row">
                                    <select name="materials[{{ $material->id }}][type]" class="material-type">
                                        <option value="pdf" {{ $material->type == 'pdf' ? 'selected' : '' }}>PDF</option>
                                        <option value="video_file" {{ $material->type == 'video_file' ? 'selected' : '' }}>Video File</option>
                                        <option value="video_link" {{ $material->type == 'video_link' ? 'selected' : ''}}>Video Link</option>
                                    </select>

                                    <div class="file-input-wrapper" style="{{ in_array($material->type,['pdf', 'video_file']) ? '' : 'display:none;' }}">
                                        <input type="file"
                                            name="materials[{{ $material->id }}][file]"
                                            accept=".pdf,video/mp4"
                                            class="material-file"
                                            style="{{ in_array($material->type, ['pdf','video_file']) ? '' : 'display:none;' }}">
                                        <div class="file-name"></div>
                                    </div>
                                    <input type="url"
                                        name="materials[{{ $material->id }}][video_link]"
                                        value="{{ $material->video_link }}"
                                        class="material-link"
                                        placeholder="https://youtube.com/..."
                                        style="{{ $material->type === 'video_link' ? '' : 'display:none;' }}">
                                </div>

                                    <div class="material-preview"
                                        data-link="{{ $material->video_link ?? '' }}"
                                        data-file="{{ $material->file_path ? asset($material->file_path) : ''}}">
                                        @if($material->type == 'pdf' && $material->file_path)
                                            <button type="button" class="fullscreen-btn" onclick="openFullscreen(this)">⛶</button>
                                            <iframe src="{{ asset($material->file_path) }}" style="width:100%; height: 250px; border: none;"></iframe>
                                        @elseif($material->type == 'video_file' && $material->file_path)
                                            <button type="button" class="fullscreen-btn" onclick="openFullscreen(this)">⛶</button>
                                            <video controls style="width: 100%; max-height: 250px;">
                                                <source src="{{ asset($material->file_path) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @elseif($material->type == 'video_link')
                                        @endif
                                    </div>


                                <button
                                    type="button"
                                    class="remove-btn">
                                    Remove
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div id="new-materials"></div>
            </div>

            <div id="fullscreenModal" class="fullscreen-modal">
                <span class="close-btn" onclick="closeFullscreen()">&times;</span>
                <div class="fullscreen-content" id="fullscreenContent"></div>
            </div>
            <div class="btn-row">
                <button type="button" id="add-material-btn" class="add-material-btn" onclick="addMaterial()">+ Add Material</button>
                <button type="submit" name="status" value="draft" class="btn-draft">Save as Draft</button>
                <button type="submit" name="status" value="published" class="btn-publish">Update Event</button>
            </div>

            <div id="quotaModal" class="quota-modal">
                <div class="quota-modal-content">
                    <h3>Cannot Change Status</h3>
                    <p id="quotaModalMessage">
                        This checkbox can only be enabled when participants reach 70% of quota.
                    </p>
                    <button type="button" onclick="closeQuotaModal()">OK</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById("sidebar");
            const hamburgerBtn = document.getElementById("hamburgerbtn");
            const closeSidebarBtn = document.getElementById("closeSidebarBtn");
            const mainContent = document.querySelector(".main-content");
            const container = document.getElementById('materials-container');
            const addBtn = document.getElementById('add-material-btn');
            const form = document.getElementById('event-form');

            function isMobileView() {
                return window.innerWidth <= 768;
            }

            function updateHamburgerColor() {
                if (isMobileView()) {
                    hamburgerBtn.classList.toggle(
                        "active",
                        sidebar.classList.contains("active")
                    );
                } else {
                    hamburgerBtn.style.color = sidebar.classList.contains("desktop-closed")
                        ? "#2e4a59"
                        : "#fff";
                }
            }

            function closeSidebarDesktop() {
                sidebar.classList.add("desktop-closed");
                mainContent.classList.add("collapsed");
                updateHamburgerColor();
            }

            function openSidebarDesktop() {
                sidebar.classList.remove("desktop-closed");
                mainContent.classList.remove("collapsed");
                updateHamburgerColor();
            }

            hamburgerBtn.addEventListener("click", (e) => {
                e.stopPropagation();

                if (isMobileView()) {
                    sidebar.classList.toggle("active");
                } else {
                    sidebar.classList.contains("desktop-closed")
                        ? openSidebarDesktop()
                        : closeSidebarDesktop();
                }

                updateHamburgerColor();
            });

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
                if (window.innerWidth > 768) {
                    sidebar.classList.remove("desktop-closed");
                    sidebar.classList.remove("active");
                    document.body.style.overflow = "auto";
                }
                updateHamburgerColor();
            });

            updateHamburgerColor();

            let newMaterialCount = 0;

            function addMaterial() {
                const id = `new_${newMaterialCount++}`;

                const html = `
                    <div class="material-item" data-material-id="${id}">
                        <input type="text" name="materials[${id}][title]" placeholder="Material Title" required>

                        <div class="material-row">
                            <select name="materials[${id}][type]" class="material-type">
                                <option value="pdf">PDF</option>
                                <option value="video_file">Video File</option>
                                <option value="video_link">Video Link</option>
                            </select>

                            <div class="file-input-wrapper">
                                <input type="file" 
                                        name="materials[${id}][file]" 
                                        class="material-file" 
                                        accept=".pdf,video/mp4">
                                <div class="file-name"></div>
                            </div>

                            <input type="url" name="materials[${id}][video_link]" class="material-link" placeholder="https://www.youtube.com/embed/abc123" style="display:none;">
                        </div>

                        <div class="material-preview"></div>
                        <button type="button" class="remove-btn">Remove</button>
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', html);
            }

            if (addBtn) addBtn.addEventListener('click', addMaterial);

            container.addEventListener('change', function(e) {

                if (e.target.classList.contains('material-type')) {
                    const parent = e.target.closest('.material-item');
                    const fileWrapper = parent.querySelector('.file-input-wrapper');
                    const linkInput = parent.querySelector('.material-link');
                    const preview = parent.querySelector('.material-preview');

                    preview.innerHTML = '';

                    if (e.target.value === 'video_link') {
                        fileWrapper.style.display = 'none';
                        linkInput.style.display = 'block';
                        linkInput.readOnly = false;
                        linkInput.focus();
                        renderVideoLinkPreview(parent);
                    } else {
                        fileWrapper.style.display = 'block';

                        linkInput.value = '';
                        linkInput.style.display = 'none';
                    }
                }

                if (e.target.classList.contains('material-file')) {
                    const input = e.target;
                    const parent = input.closest('.material-item');
                    const preview = parent.querySelector('.material-preview');
                    const nameBox = parent.querySelector('.file-name');
                    preview.innerHTML = '';

                    const file = input.files[0];
                    if (!file) return;
                    nameBox.textContent = `Selected: ${file.name}`;

                    if (file.type === 'application/pdf') {
                        const iframe = document.createElement('iframe');
                        iframe.src = URL.createObjectURL(file);
                        iframe.style.width = '100%';
                        iframe.style.height = '250px';
                        iframe.style.border = '1px solid #ccc';
                        iframe.style.borderRadius = '8px';
                        preview.appendChild(iframe);
                    } else if (file.type.startsWith('video/')) {
                        const video = document.createElement('video');
                        video.src = URL.createObjectURL(file);
                        video.controls = true;
                        video.style.width = '100%';
                        video.style.maxHeight = '250px';
                        video.style.borderRadius = '8px';
                        preview.appendChild(video);
                    }
                }
            });

            container.addEventListener('input', function(e) {

                if (e.target.classList.contains('material-link')) {
                   const item = e.target.closest('.material-item');
                   renderVideoLinkPreview(item);
                }
            });

            form.addEventListener('click', function (e) {
                const removeBtn = e.target.closest('.remove-btn');
                if (!removeBtn) return;

                e.preventDefault();
                const item = removeBtn.closest('.material-item');
                if (!item) return;

                const materialId = item.dataset.materialId;

                console.log('REMOVE:', materialId);

                if (materialId && !materialId.startsWith('new_')) {
                    const removedInput = document.createElement('input');
                    removedInput.type = 'hidden';
                    removedInput.name = 'removed_materials[]';
                    removedInput.value = materialId;
                    form.appendChild(removedInput);
                }

                item.remove();
            });


            const almostFullCheckbox = document.querySelector('input[name="is_almost_full"]');
            const fullCheckbox = document.querySelector('input[name="is_full"]');
            const quotaInput = document.querySelector('input[name="quota"]');

            const participantsCount = {{ $event->enrollments_count ?? 0 }};

            function updateCheckboxStatus() {
                const quota = parseInt(quotaInput.value) || 0;
                const threshold = Math.ceil(quota * 0.7);

                const canEnable = quota > 0 && participantsCount >= threshold;

                almostFullCheckbox.dataset.locked = canEnable ? "false" : "true";
                fullCheckbox.dataset.locked = canEnable ? "false" : "true";
            }

            updateCheckboxStatus();

            quotaInput.addEventListener('input', updateCheckboxStatus);

            almostFullCheckbox.addEventListener('change', function () {
                if (this.dataset.locked === "true") {
                    showQuotaModal('This checkbox can only be enabled when participants reach 70% of quota.');
                    this.checked = false;
                    return;
                }

                if(this.checked) fullCheckbox.checked = false;
            });

            fullCheckbox.addEventListener('change', function() {
                if (this.dataset.locked === "true") {
                    showQuotaModal('This checkbox can only be enabled when participants reach 70% of quota.');
                    this.checked = false;
                    return;
                }

                if (this.checked) almostFullCheckbox.checked = false;
            });

            toggleInput('evaluation_test');
            toggleInput('group');
            toggleInput('paid');

            form.addEventListener('submit', function(e) {
                let valid = true;
                document.querySelectorAll('.material-item').forEach(item => {
                    const typeSelect = item.querySelector('.material-type');
                    const linkInput = item.querySelector('.material-link');
                    const fileInput = item.querySelector('.material-file');

                    if (!typeSelect) return;

                    if (typeSelect.value === 'video_link') {

                        if (!linkInput.value) {
                            alert('Video Link material cannot be empty!');
                            valid = false;
                        }
                    } else {
                        if (linkInput) {
                            linkInput.value = '';
                        }
                    }
                });

                if (!valid) e.preventDefault();
            });
        });

        function openFullscreen(button) {
            const preview = button.closest('.material-preview');
            const iframe = preview.querySelector('iframe');
            const video = preview.querySelector('video');
            const fullscreenContent = document.getElementById('fullscreenContent');
            const fullscreenModal = document.getElementById('fullscreenModal');

            fullscreenContent.innerHTML = '';

            if (iframe) {
                const newIframe = document.createElement('iframe');
                newIframe.src = iframe.src;
                newIframe.style.width = '100%';
                newIframe.style.height = '100%';
                newIframe.style.border = 'none';
                fullscreenContent.appendChild(newIframe);
            } else if (video) {
                const newVideo = document.createElement('video');
                newVideo.src = video.querySelector('source') ? video.querySelector('source').src : video.src;
                newVideo.controls = true;
                newVideo.autoplay = true;
                newVideo.style.width = '100%';
                newVideo.style.height = '100%';
                fullscreenContent.appendChild(newVideo);
            }

            fullscreenModal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeFullscreen() {
            const fullscreenModal = document.getElementById('fullscreenModal');
            const fullscreenContent = document.getElementById('fullscreenContent');
            fullscreenModal.style.display = 'none';
            fullscreenContent.innerHTML = '';
            document.body.style.overflow = '';
        }

        document.addEventListener('click', function (e) {
            const modal = document.getElementById('fullscreenModal');
            const content = document.getElementById('fullscreenContent');

            if (modal && modal.style.display === 'flex' && !content.contains(e.target) && !e.target.classList.contains('fullscreen-btn')) {
                closeFullscreen();
            }
        });

        function showQuotaModal(message) {
            document.getElementById('quotaModalMessage').textContent = message;
            document.getElementById('quotaModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeQuotaModal() {
            document.getElementById('quotaModal').classList.remove('active');
            document.body.style.overflow = '';
        }
        

        document.addEventListener('click', function (e) {
            const modal = document.getElementById('quotaModal');
            const content = modal?.querySelector('.quota-modal-content');

            if (modal?.classList.contains('active') && !content.contains(e.target)) {
                closeQuotaModal();
            }
        });

         function toggleInput(type) {
            const inputMap = {
                evaluation_test: 'evaluation_test_input',
                group: 'group_input',
                paid: 'paid_input'
            };

            const checkbox = document.getElementById(`${type}_switch`);
            const target = document.getElementById(inputMap[type]);

            if (!checkbox || !target) return;

            target.style.display = checkbox.checked ? 'block' : 'none';
        }

        function toEmbed(url) {
            if (!url) return '';

            url = url.replace(/["<>]/g, '').trim();

            if (url.includes('youtube.com/watch')) {
                const id = new URL(url).searchParams.get('v');
                return id ? `https://www.youtube.com/embed/${id}` : '';
            } if (url.includes('youtu.be/')) {
                const id = url.split('/').pop();
                return `https://www.youtube.com/embed/${id}`;
            }

            if (url.endsWith('.mp4')) return url;

            return url;
        }

        function renderVideoLinkPreview(item) {
            if (!item) return;

            const typeSelect = item.querySelector('.material-type');
            const linkInput = item.querySelector('.material-link');
            const preview = item.querySelector('.material-preview');

            if (!typeSelect || !linkInput || !preview) return;
            if (typeSelect.value !== 'video_link') return;

            let url = (linkInput.value || preview.dataset.link || '').trim();
            preview.innerHTML = '';

            if (!url) {
                preview.textContent = 'Preview not available';
                return;
            }

            if (url.includes('youtube.com') || url.includes('youtu.be')) {
                const iframe = document.createElement('iframe');
                iframe.src = toEmbed(url);
                iframe.style.width = '100%';
                iframe.style.height = '250px';
                iframe.style.border = '1px solid #ccc';
                iframe.style.borderRadius = '8px';
                iframe.allowFullscreen = true;
                preview.appendChild(iframe);
                return;
            }

            preview.textContent = 'Preview not available';
        }

        function renderFilePreview(preview, type, fileUrl) {
            if (!preview || !fileUrl) return;

            preview.innerHTML = '';

            if (type === 'pdf') {
                const iframe = document.createElement('iframe');
                iframe.src = fileUrl;
                iframe.style.width = '100%';
                iframe.style.height = '250px';
                iframe.style.border = '1px solid #ccc';
                 iframe.style.borderRadius = '8px';
                preview.appendChild(iframe);
            } else if (type === 'video_file') {
                const video = document.createElement('video');
                video.src = fileUrl;
                video.controls = true;
                video.style.width = '100%';
                video.style.maxHeight = '250px';
                video.style.borderRadius = '8px';
                preview.appendChild(video);
            }
        }


        document.querySelectorAll('.material-item').forEach(item => {
            const typeSelect = item.querySelector('.material-type');
            const preview = item.querySelector('.material-preview');
            const fileUrl = preview.dataset.file;
            const videoLink = preview.dataset.link;

            if (!typeSelect || !preview) return;

            if (typeSelect.value === 'video_link' && videoLink) {
                const linkInput = item.querySelector('.material-link');
                if (linkInput) linkInput.value = videoLink;
                renderVideoLinkPreview(item);
            } else if ((typeSelect.value === 'pdf' || typeSelect.value === 'video_file') && fileUrl) {
                renderFilePreview(preview, typeSelect.value, fileUrl);
            }
        });

        document.querySelectorAll('.material-item').forEach(item => {
            const typeSelect = item.querySelector('.material-type');
            const linkInput  = item.querySelector('.material-link');
            const preview    = item.querySelector('.material-preview');
            const fileWrap   = item.querySelector('.file-input-wrapper');

            if (!typeSelect || typeSelect.value !== 'video_link') return;

            if (fileWrap) fileWrap.style.display = 'none';
            if (linkInput) linkInput.style.display = 'block';

            const savedLink = preview?.dataset?.link?.trim();

            if (savedLink && linkInput && !linkInput.value) {
                linkInput.value = savedLink;
            }

            renderVideoLinkPreview(item);
        });

    </script>


</body>
</html>