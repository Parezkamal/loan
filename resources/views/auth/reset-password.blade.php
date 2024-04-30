<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('backend/css/tailwind.min.css') }}">

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg p-8 w-full sm:w-96">
        <h1 class="text-3xl font-semibold mb-4 text-center text-gray-800">Reset Password</h1>
        <p class="text-gray-700 mb-6 text-center">Please enter a new password for your account.</p>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            @if ($errors->has('email') || $errors->has('password'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rouned relative mb-4" role="alert">
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
                <label for="email" class="block text-gray-700 font-medium">Current email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" class="p-3 mt-1 block w-full bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">New Password</label>
                <input type="password" id="password" name="password" class="p-3 mt-1 block w-full bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            </div>
            <div class="mb-4">
                <label for="confirmPassword" class="block text-gray-700 font-medium">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="p-3 mt-1 block w-full bg-gray-200 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-transparent">
            </div>
            <button type="submit" class="w-full bg-blue-500 text-blue-500 py-3 rounded-md hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 transition duration-300 ease-in-out">
                Reset Password
            </button>

        </form>
        <a href="{{ route('login.create') }}" class="block text-center mt-4 text-blue-500 hover:underline">Back to Login</a>
    </div>
</body>

</html>
