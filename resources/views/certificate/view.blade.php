<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Certificate - {{ $enrollment->event->title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafc;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-bottom: 16px;
            color: #2e3a59;
        }

        .preview {
            border: 1px solid #ddd;
            padding: 16px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .btn {
            display: inline-block;
            margin-top: 16px;
            padding: 10px 16px;
            border-radius: 6px;
            background: #1976d2;
            color: #fff;
            text-decoration: none;
        }

        .btn:hover {
            background: #125a9c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Certificate - {{ $enrollment->event->title }}</h1>
        <p>Peserta: {{ $enrollment->user->name ?? '-' }}</p>
        <p>Tanggal selesai: {{ $enrollment->updated_at->format('d M Y') }}</p>

        <div class="preview">
            <strong> Certificate Preview</strong>
            <p> Name: {{ $enrollment->user->name }}</p>
            <p> Course: {{ $enrollment->event->title }}</p>
        </div>
    </div>
</body>
</html>
