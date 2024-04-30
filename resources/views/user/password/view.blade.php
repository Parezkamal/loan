@extends('user.dashboard')
@section('content')
<div class="p-6">
    <div class="bg-white shadow-md rounded-lg p-4 w-screen mx-auto max-w-screen-lg">
        <h2 class="text-2xl font-semibold mb-4">Change Password</h2>

        <form class="mt-6" method="POST" action="{{ route('user.password.store') }}">
            @csrf
            @if ($errors->has('current_password') || $errors->has('password'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <ul>
                    @if ($errors->has('current_password'))
                        <li>{{ $errors->first('current_password') }}</li>
                    @endif
                    @if ($errors->has('password'))
                        <li>{{ $errors->first('password') }}</li>
                    @endif
                </ul>
            </div>
            @endif
            <div class="mb-4">
                <label for="current_password" class="block text-gray-700 font-medium">Current Password</label>
                <div class="relative">
                    <input type="password" id="current_password" name="current_password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 bg-gray-200 p-2">
                    <span class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                        onclick="togglePassword('current_password', 'toggleCurrentPassword')">
                        Show
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700 font-medium">New Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 bg-gray-200 p-2">
                    <span class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                        onclick="togglePassword('password', 'toggleNewPassword')">
                        Show
                    </span>
                </div>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-gray-700 font-medium">Confirm Password</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 bg-gray-200 p-2">
                    <span class="toggle-password absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                        onclick="togglePassword('password_confirmation', 'toggleConfirmPassword')">
                        Show
                    </span>
                </div>
            </div>
            <button type="submit"
                class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                Save Changes
            </button>
        </form>
    </div>
</div>

<script>
    function togglePassword(fieldId, toggleId) {
        const passwordField = document.getElementById(fieldId);
        const togglePasswordButton = document.getElementById(toggleId);

        const type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;
        togglePasswordButton.textContent = type === 'password' ? 'Show' : 'Hide';
    }
</script>

@endsection
