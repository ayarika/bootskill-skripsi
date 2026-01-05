<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Enroll Bootcamp</title>
  <link rel="stylesheet" href="your-styles.css" />
  <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff;
            color: #333;
        }

        .full {
            transition: margin-left 0.3 ease;
        }

        .main-content {
            margin-left: 170px;
            padding: 50px;
            transition: margin-left 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .hidden {
            display: none !important;
        }

        .main-content.full {
            margin-left: 0;
        }

        .enroll-form {
            max-width: 500px;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0, 0.1);
        }

        .enroll-form .form-group {
            margin-bottom: 1rem;
        }

        .enroll-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .enroll-form input[type="email"],
        .enroll-form input[type="file"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .forms-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .back-btn {
            text-decoration: none;
            color: #1976d2;
            font-weight: bold;
        }

        .submit-btn{
            background-color: #1976d2;
            color: #fff;
            padding: 0.5rem 1.2rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background-color: #155a9c;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solide #c3e6cb;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }

  </style>
</head>
<body>
    <main id="mainpage" class="main-content">
            @if(session('success'))
                <div class="alert alert-success" style="margin 1rem 0; padding: 1rem; background-color: #d4edda; color: #155724; border-radius: 6px;">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger" style="background-color: #f2dede; color: #a94442; border-radius: 6px; padding: 1rem; margin-top: 1rem;">
                    <strong> Oops! There's something wrong</strong>
                    <ul style="margin: 0.5rem 0 0 1rem;">
                        @foreach ($errors-> all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form class ="enroll-form" method="POST" enctype="multipart/form-data" action="{{ route('enroll.submit', ['id' => $bootcampId]) }}">

                @csrf

                <input type="hidden" name="bootcamp_id" value="{{ $bootcampId }}">

                <div class="form-group">
                    <label for="email"> Account Email</label>
                    <input type="email" id="email" name="email" required placeholder="you@example.com">

                    @error('email')
                        <small style="color: red;"> {{ $message }}</small>
                    @enderror
                </div>

                @if($bootcamp->price > 0)
                    <div class="form-group">
                        <label for="payment-proof"> Payment Proof Upload (.jpg / .png)</label>
                        <input type="file" id="payment_proof" name="payment_proof" accept=".png,.jpg" required>
                        @error('payment_proof')
                            <small style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>
                @else
                    <p style="color: green;">This bootcamp is free. No payment proof required.</p>
                @endif

                <div class="forms-buttons">
                    <a href="{{ url('/bootcamp/' . $bootcampId) }}" class="back-btn">← Back</a>
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
    </main>

</body>
</html>