<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Organizer Profile</title>
  <link rel="stylesheet" href="your-styles.css" />
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
        }

        .main-content {
            padding: 2rem;
            background-color: #f9f9f9;
            min-height: 100vh;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-back {
            display: inline-block;
            margin: 10px 0 20px 0;
            padding: 10px 16px;
            color: #333;
            text-decoration: none;
            border-radius: 6px;
        }

        .organizer-header {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            background-color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.5);
        }
        
        .organizer-header img.organizer-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .organizer-info h2 {
            margin: 0 0 8px;
            font-size: 1.6rem;
        }

        .organizer-info p {
            word-break: break-word;
            color: #555;
        }

        .social-link {
            margin-top: 8px;
            margin-bottom: 20px;
        }

        .social-link a {
            font-size: 0.9rem;
            color: #3490dc;
            text-decoration: none;
        }

        .social-link a:hover {
            text-decoration: underline;
        }

        .favorite-wrapper button {
            width: 100%;
            height: 45px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            color: white;
            transition: 0.2s;
        }

        .favorite-btn {
            background-color: #28a745;
        }

        .favorite-btn:hover {
            background-color: #1e7e34;
        }

        .unfavorited-btn {
            background-color: #dc3545;
        }

        .unfavorited-btn:hover {
            background-color: #b32432;
        }

        @media (max-width: 768px) {
            .organizer-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .organizer-header img.organizer-photo {
                width: 130px;
                height: 130px;
            }

            .favorite-wrapper button {
                width: 100%;
            }
        }

        .bootcamp-list {
            padding: 40px 20px;
            background-color: #f8f9fa;
        }

        .bootcamp-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }

        .bootcamp-card {
            background-color: #fff;
            border-radius: 12px;
            box-shadow:  0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            transition: transform 0.3s ease;
            position: relative;
        }

        .bootcamp-card:hover {
            transform: translateY(-5px);
        }

        .bootcamp-card-banner {
            position: relative;
            width: 100%;
            height: 180px;
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
            padding: 5px 12px;
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
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .bootcamp-title {
            margin: 0 0 10px;
            font-size: 1.1rem;
            color: #333;
        }

        .bootcamp-description {
            flex-grow: 1;
            font-size: 0.95rem;
            color: #666;
            margin-bottom: 12px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .organizer-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #333;
        }

        .organizer-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        .organizer-name {
            font-size: 14px;
        }

        .view-details-wrapper {
            margin-top: 15px;
        }

        .view-details-btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
            width: 100%;
            transition: 0.2s;
        }

        .view-details-btn:hover {
            background-color: #2779bd;
        }
    </style>

</head>
<body>

        <main id="mainpage" class="main-content">
            <a href="{{ $bootcampId ? route('bootcamp.detail', ['id' => $bootcampId]) : url()->previous() }}" class="btn-back">← Back</a>

            <section class="organizer-header">
                <img src="{{ $organizer->profile_picture 
                            ? asset('storage/' . $organizer->profile_picture) 
                            : asset('images/default-profile.jpg') }}"
                    alt="Organizer Photo" class="organizer-photo">
                               
                <div class="organizer-info">
                    <h2>{{ $organizer->name }}</h2>
                    <p>{{ $organizer->description }}</p>

                    @if ($organizer->social_link)
                        <div class="social-links">
                            <a href="{{ $organizer->social_link }}" target="_blank" rel="noopener noreferrer">
                                {{ $organizer->social_link }}
                            </a>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('organizer.favorite', $organizer->id) }}">
                        @csrf
                        <input type="hidden" name="organizer_id" value="{{ $organizer->id }}">
                        @if($isFavorited)
                            <button type="submit" class="unfavorite-btn">
                                Unfavorite
                            </button>
                        @else
                            <button type="submit" class="favorite-btn">
                                Favorite
                            </button>
                        @endif
                    </form>
                </div>
            </section>

            <section class="bootcamp-list">
                <div class="bootcamp-grid">
                        @forelse($organizer->bootcamps as $bootcamp)
                            <div class="bootcamp-card">
                                <img src="{{ $bootcamp->image_path ? asset('storage/' . $bootcamp->image_path) : asset('images/placeholder.jpg') }}" alt="{{ $bootcamp->title }}" class="bootcamp-image">

                                <div class="bootcamp-info">
                                    <h4>{{ $bootcamp->title }}</h4>
                                    <p>{{ \Illuminate\Support\Str::limit($bootcamp->description, 120) }}</p>

                                    <a href="{{ route('bootcamp.detail', ['id' => $bootcamp->id]) }}" class="view-btn">View Bootcamp</a>
                                </div>
                            </div>
                        @empty
                            <p>No bootcamps available yet.</p>
                        @endforelse

                </div>
            </section>
        </main>
</body>
</html>