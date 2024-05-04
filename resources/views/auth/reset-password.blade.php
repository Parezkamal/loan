<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('backend/css/tailwind.min.css') }}">
    @vite('resources/css/app.css')
    <style>
        body {
            background-color: #f3f8ff; /* Light blue background color */
        }

        .card {
            background-color: #ffffff; /* White background color for the card */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
            border-radius: 10px; /* Rounded corners */
            max-width: 400px; /* Max width for better readability */
            margin: auto; /* Center the card horizontally */
            padding: 40px 20px; /* Padding for content */
            text-align: center; /* Center align text */
        }

        .form-input {
            padding: 12px; /* Padding for inputs */
            margin-bottom: 20px; /* Spacing between inputs */
            width: 100%; /* Full width input */
            border: 1px solid #d1d5db; /* Light gray border */
            border-radius: 8px; /* Rounded corners */
            outline: none; /* Remove outline */
        }

        .form-button {
            background-color: #2563eb; /* Blue button color */
            color: #ffffff; /* White text color */
            padding: 12px; /* Padding for button */
            border: none; /* No border */
            border-radius: 8px; /* Rounded corners */
            width: 100%; /* Full width button */
            cursor: pointer; /* Cursor pointer on hover */
            transition: background-color 0.3s ease; /* Smooth transition */
        }

        .form-button:hover {
            background-color: #1e40af; /* Darker blue color on hover */
        }

        .form-button:focus {
            outline: none; /* Remove outline on focus */
        }

        .back-link {
            color: #2563eb; /* Blue link color */
            text-decoration: none; /* Remove underline */
            transition: color 0.3s ease; /* Smooth transition */
        }

        .back-link:hover {
            color: #1e40af; /* Darker blue color on hover */
        }
    </style>
</head>

<body>
    <div class="card">
        <img src="{{asset('images/cihan.png')}}" alt="">
        <h1 class="text-3xl font-semibold mb-4 text-gray-800">Reset Password</h1>
        <p class="text-gray-700 mb-6">Please enter a new password for your account.</p>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            @if ($errors->has('email') || $errors->has('password'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <ul>
                    @if ($errors->has('email'))
                    <li>{{ $errors->first('email') }}</li>
                    @endif
                    @if ($errors->has('password'))
                    <li>{{ $errors->first('password') }}</li>
                    @endif
                </ul>
            </div>
            @endif

            <div class="mb-4">
                <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}"
                    class="form-input" placeholder="Current email" required>
            </div>
            <div class="mb-4">
                <input type="password" id="password" name="password" class="form-input"
                    placeholder="New Password" required>
            </div>
            <div class="mb-4">
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="form-input" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="form-button">Reset Password</button>
        </form>
        <a href="{{ route('login.create') }}" class="back-link block mt-4">Back to Login</a>
    </div>
</body>

</html>
