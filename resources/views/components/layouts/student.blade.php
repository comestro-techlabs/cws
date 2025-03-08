<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $title ?? 'Student' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @livewireStyles
</head>
<body class="bg-gray-100">
    <x-student-navbar>
        <x-slot:main>
            <x-student-header />
            {{ $slot }}
        </x-slot>
    </x-student-navbar>

    @livewireScripts
    @stack('scripts')

    @auth
        <script>
            // Handle session-based alerts on page load
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof Swal === 'undefined') {
                    console.error('SweetAlert2 is not loaded.');
                    return;
                }

                @if (session('success'))
                    Swal.fire({
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        icon: 'success',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#662d91'
                    });
                @endif

                @if (session('error'))
                    Swal.fire({
                        title: 'Error!',
                        text: "{{ session('error') }}",
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#662d91'
                    });
                @endif
            });

            // Membership payment handling
            document.getElementById('membership-pay-button')?.addEventListener('click', function(e) {
                e.preventDefault();
                this.disabled = true;

                fetch('/student/membership/checkout', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = data.redirect_url;
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message || 'Something went wrong',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#662d91'
                        });
                        this.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong',
                        icon: 'error',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#662d91'
                    });
                    this.disabled = false;
                });
            });
        </script>
    @endauth
</body>
</html>
