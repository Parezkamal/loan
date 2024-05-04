<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="flex flex-col h-screen bg-gray-100">

        @include('admin.sections.header')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:flex-row"> <!-- Add responsive classes -->
            <!-- Sidebar -->
            @include('admin.sections.sidebar')

            <!-- Page content -->
            <div class="flex-1 p-4 md:p-10"> <!-- Add responsive padding -->

                @yield('content')
            </div>
        </div>

        <!-- Footer -->
        @include('admin.sections.footer')
    </div>

   <!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');

    profileButton.addEventListener('click', () => {
        profileDropdown.classList.toggle('hidden');
    });

    window.addEventListener('click', (event) => {
        if (!profileDropdown.contains(event.target) && !profileButton.contains(event.target)) {
            profileDropdown.classList.add('hidden');
        }
    });

    function confirmDelete(userId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form' + userId).submit();
            }
        });
    }

    function deleteData(userId) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('delete.user', ':userId') }}".replace(':userId', userId),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Error!",
                    text: "An error occurred while deleting the file.",
                    icon: "error"
                });
            }
        });
    }
</script>

<script>


    function confirmDeleteLoanType(ltId) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                deleteLoanType(ltId);
            }
        });
    }

    function deleteLoanType(ltId) {
        $.ajax({
            type: "DELETE",
            url: "{{ route('delete.loan_type', ':id') }}".replace(':id', ltId),
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    title: "Deleted!",
                    text: "Loan type has been deleted.",
                    icon: "success"
                }).then(() => {
                    location.reload(); // Reload the page after successful deletion
                });
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: "Error!",
                    text: "An error occurred while deleting the loan type.",
                    icon: "error"
                });
            }
        });
    }
</script>

</body>
</html>
