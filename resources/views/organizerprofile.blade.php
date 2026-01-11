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
            color: #1e90ff;
            text-decoration: none;
            border-radius: 6px;
        }

        .back-button:hover {
            color: #0c6ad8;

        }

        .organizer-header {
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
            background-color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
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

        .favorite-wrapper {
            margin-top: 5px;
            width: 100%;
            margin: 0 auto;
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
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
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
            width: 100%;
            padding: 0 15px;
            margin-top: 15px;
            box-sizing: border-box;
            margin-left: -10px;
        }

        .view-details-btn {
            width: 100%;
            display: block;
            padding: 12px 15px;
            background-color: #3490dc;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 15px;
            text-align: center;
            font-weight: 600;
            transition: 0.2s ease;
        }

        .view-details-btn:hover {
            background-color: #2779bd;
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

        .countdown-badge.ended {
            background: #555;
        }
    </style>

</head>
<body>
 
        <main id="mainpage" class="main-content">
            <a href="{{ request('return_to') ?? url()->previous() }}" class="btn-back">← Back</a>
            <section class="organizer-header">
                <img src="{{ $organizer->profile_picture_url }}"
                    alt="Organizer Photo"
                    class="organizer-photo">
                
                <div class="organizer-info">
                    <h2>{{ $organizer->name }}</h2>
                    <p>{{ $organizer->description }}</p>

                    @if ($organizer->social_link)
                        <div class="social-link">
                            <a href="{{ $organizer->social_link }}" target="_blank" rel="noopener noreferrer">
                                {{ $organizer->social_link }}
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            <div class="favorite-wrapper">
                <form method="POST" action="{{ route('organizer.favorite', $organizer->id) }}">
                    @csrf
                    <input type="hidden" name="organizer_id" value="{{ $organizer->id }}">
                    <input type="hidden" name="bootcamp_id" value="{{ $bootcampId }}">
                    <input type="hidden" name="return_to" value="{{ request('return_to') ?? url()->previous() }}">
                    @if ($isFavorited)
                        <button type="submit" class="unfavorited-btn">Unfavorite</button>
                    @else
                        <button type="submit" class="favorite-btn">Favorite</button>
                    @endif
                </form>
            </div>
            <section class="bootcamp-list">
                <div class="bootcamp-grid">
                        @forelse($organizer->events as $event)
                            <div class="bootcamp-card clickable-card"
                                data-url="{{ route('bootcamp.detail', $event->id) }}"
                                data-start-date="{{ \Carbon\Carbon::parse($event->start_date)->toIso8601String() }}">
                                
                                <div class="bootcamp-card-banner">
                                    <img src="{{ $event->image_path && file_exists(public_path($event->image_path))
                                            ? asset( $event->image_path) 
                                            : asset('images/defaults.png') }}"
                                    alt="{{ $event->title }}"
                                    onerror="this.onerror=null;this.src='/images/defaults.png';">

                                    <div class="banner-tags">
                                        <span class="tag price-tag">
                                            @if ($event->price == 0)
                                                FREE
                                            @else
                                                Rp {{ number_format($event->price, 0, ',', '.') }}
                                            @endif
                                        </span>

                                        <span class="tag category-tag">{{ $event->category }}</span>
                                        <span class="tag topics-tag">{{ $event-> topic }}</span>
                                    </div>
                                    <div class="countdown-badge"></div>
                                </div>

                                <div class="bootcamp-content">
                                    <h3 class="bootcamp-title">{{ $event->title }}</h3>
                                    <p class="bootcamp-description">{{ Str::limit($event->description, 80) }}</p>

                                    <div class="organizer-info" style="margin-top: 10px;">
                                        <a href="{{ route('organizer.profile', [ 'id' => $event->organizer->id, 'return_to' => url()->previous() ]) }}" class="organizer-link">
                                            <img
                                                src="{{ $event->organizer->profile_picture_url }}"
                                                alt="Organizer Photo"
                                                class="organizer-avatar">
                                            <span class="organizer-name">{{ $event->organizer->name }}</span>
                                        </a>
                                    </div>

                                    <div class="view-details-wrapper">
                                        <a href="{{ route('bootcamp.detail', $event->id) }}" class="view-details-btn">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>No bootcamps available yet.</p>
                        @endforelse

                </div>
            </section>
        </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cards = document.querySelectorAll(".bootcamp-card");
            const today = new Date();
            today.setHours(0,0,0,0);

            cards.forEach(card => {
                const startDateStr = card.dataset.startDate;
                if (!startDateStr) return;

                const startDate = new Date(startDateStr);
                startDate.setHours(0,0,0,0);

                const diffDays = Math.ceil((startDate - today)/(1000 * 60 * 60 * 24));
                const badge = card.querySelector(".countdown-badge");
                if (!badge) return;

                if (diffDays > 1) {
                    badge.textContent = `Starts in ${diffDays} days`;
                    badge.classList.add("upcoming");
                } else if (diffDays === 1) {
                    badge.textContent = "Starts tomorrow";
                    badge.classList.add("soon");
                } else if (diffDays === 0) {
                    badge.textContent = "Starts today";
                    badge.classList.add("today");
                } else {
                    badge.textContent = "Ended";
                    badge.classList.add("ended");
                } 
            });

            document.querySelectorAll(".clickable-card").forEach(card => {
                card.addEventListener("click", function(e) {
                    if (e.target.closest(".view-details-btn")) return;
                    window.location = this.dataset.url;
                });
            });
        });
    </script>
</body>
</html>