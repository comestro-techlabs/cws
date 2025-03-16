<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $title ?? 'Student' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Parisienne&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        * {
            font-family: "Poppins", sans-serif !important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
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
                    }).then(() => {
                        triggerConfetti();
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

                @if (session('warning'))
                    Swal.fire({
                        title: 'Warning!',
                        text: "{{ session('warning') }}",
                        icon: 'warning',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#662d91'
                    });
                @endif  
                    });

            // Function to trigger confetti
            function triggerConfetti() {
                confetti({
                    particleCount: 100,
                    spread: 150,
                    origin: { y: 0.6 }
                });
            }

            // Membership payment handling
            document.getElementById('membership-pay-button')?.addEventListener('click', function (e) {
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