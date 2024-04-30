@extends('user.dashboard')
@section('content')
<div class="p-6">
    <div class="bg-white shadow-md rounded-lg p-4 w-screen mx-auto max-w-screen-lg">
        <h2 class="text-2xl font-semibold mb-4">My Profile</h2>
        <div class="flex items-center space-x-4">
        <img id="profilePreview" src="{{asset(Auth::user()->image)}}" alt="User Profile" class="w-20 h-20 rounded-full">
        <div>
          <h3 class="text-lg font-semibold">{{Auth::user()->name}}</h3>
          <p class="text-gray-500">{{Auth::user()->role}}</p>
        </div>
      </div>

      <form class="mt-6" method="POST" action="{{route('user.profile.update')}}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-medium">Name</label>
          <input type="text" id="name" name="name" value="{{Auth::user()->name}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 bg-gray-200 p-2">
        </div>
        <div class="mb-4">
          <label for="phoneNumber" class="block text-gray-700 font-medium">Phone Number</label>
          <input type="text" id="phoneNumber" name="phone" value="{{Auth::user()->phone}}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 bg-gray-200 p-2">
        </div>
        <div class="mb-4">
          <label for="profileImage" class="block text-gray-700 font-medium">Profile Image</label>
          <input type="file" id="profileImage" name="image" accept="image/*" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-300 bg-gray-200 p-2" onchange="previewImage()">
          <div id="imagePreview" class="w-20 h-20 mt-2 rounded-full border border-gray-300 overflow-hidden">
            <img id="selectedImage" src="user-profile-picture.jpg" alt="image    _example" class="w-full h-full object-cover rounded-full ">
          </div>
        </div>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-200 focus:ring-opacity-50">Save Changes</button>
      </form>
    </div>
  </div>



@endsection


<script>
    function previewImage() {
    const fileInput = document.getElementById('profileImage');
    const imagePreview = document.getElementById('selectedImage');
    const profilePreview = document.getElementById('profilePreview');

    const file = fileInput.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = (e) => {
        imagePreview.src = e.target.result;
        profilePreview.src = e.target.result;
        };

        reader.readAsDataURL(file);
    }
    }
</script>
