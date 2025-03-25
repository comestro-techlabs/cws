<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="{{ url('/') }}/">
    @vite('resources/css/app.css')
    <title>{{ $title ?? 'Student' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Parisienne&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Poppins", sans-serif !important;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            @page {
                size: landscape;
                margin: 0;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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
    
    <script>
        window.printCert = function() {
            const certificateContainer = document.getElementById('certificate-container');
            if (!certificateContainer) return;

            // Use html2canvas to capture the certificate with background
            html2canvas(certificateContainer, {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                const printWindow = window.open('', '_blank', 'width=1000,height=700');
                const imageData = canvas.toDataURL('image/png');
                
                printWindow.document.write(`
                    <!DOCTYPE html>
                    <html>
                        <head>
                            <title>Print Certificate</title>
                            <style>
                                body {
                                    margin: 0;
                                    padding: 0;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    min-height: 100vh;
                                }
                                img {
                                    width: 995px;
                                    height: 695px;
                                    object-fit: contain;
                                }
                                @media print {
                                    body {
                                        margin: 0;
                                        padding: 0;
                                    }
                                    img {
                                        width: 100%;
                                        height: auto;
                                        max-width: 995px;
                                        max-height: 695px;
                                    }
                                    @page {
                                        size: landscape;
                                        margin: 0;
                                    }
                                }
                            </style>
                        </head>
                        <body>
                            <img src="${imageData}" alt="Certificate">
                        </body>
                    </html>
                `);

                printWindow.document.close();
                printWindow.focus();
                
                // Wait for image to load before printing
                printWindow.onload = function() {
                    printWindow.print();
                    setTimeout(() => printWindow.close(), 500);
                };
            });
        };

        window.saveCert = function() {
            const element = document.getElementById('certificate-container');
            if (!element) return;

            html2canvas(element, {
                scale: 2,
                useCORS: true,
                allowTaint: true,
                backgroundColor: '#ffffff'
            }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'certificate.png';
                link.href = canvas.toDataURL('image/png', 1.0);
                link.click();
            });
        };
    </script>

    @auth
        <script>
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
                        confetti({
                            particleCount: 100,
                            spread: 150,
                            origin: { y: 0.6 }
                        });
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