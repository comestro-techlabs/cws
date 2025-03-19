<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - {{ $certificate->user->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #certificate-container, #certificate-container * {
                visibility: visible;
            }
            #certificate-container {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
            }
            .no-print {
                display: none !important;
            }
            @page {
                size: landscape;
                margin: 0;
            }
        }
        
        #certificate-container {
            background-image: url('{{ asset('certificate.jpeg') }}');
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen p-4 bg-gray-100">
    <div class="text-center">
        <div id="certificate-container" class="relative w-[995px] h-[695px] bg-no-repeat bg-cover shadow-xl">
            <div class="absolute top-[350px] left-1/2 transform -translate-x-1/2">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800" style="font-family: 'Great Vibes', cursive;">
                    {{ $certificate->user->name }}
                </h2>
            </div>
            
            <div class="absolute top-[420px] left-[100px] right-[90px] px-8">
                <p class="text-lg text-gray-800">
                    This certificate is awarded to <strong class="text-black">{{ $certificate->user->name }}</strong> 
                    for achieving a score of <strong class="text-black">{{ number_format($certificate->overall_percentage, 2) }}%</strong> 
                    in recognition of their performance in the final examination, viva voce, and project evaluation 
                    for the course titled <strong class="text-black">{{ $certificate->course->title }}</strong>, 
                    conducted by <strong>Comestro Techlabs Pvt Ltd.</strong>
                </p>
            </div>

            <div class="absolute top-[330px] right-[-75px] transform rotate-90 text-gray-800 font-semibold text-lg tracking-wider">
                Certificate No: {{ $certificate->certificate_no }}
            </div>

            <div class="absolute bottom-[25px] left-[510px]">
                <p class="text-lg text-gray-800 text-center">{{ $certificate->date->format('d F Y') }}</p>
            </div>
        </div>

        <div class="mt-8 space-x-4 no-print">
            <a href="{{ route('admin.certificate.course') }}" 
                class="px-6 py-3 bg-gray-500 text-white rounded-lg shadow-lg hover:bg-gray-600 transition inline-block">
                Back to Certificates
            </a>
            
            @if(!$certificate->admin_approve)
                <button wire:click="approveCertificate"
                    class="px-6 py-3 bg-green-500 text-white rounded-lg shadow-lg hover:bg-green-600 transition">
                    Approve Certificate
                </button>
            @endif

            <button onclick="printCertificate()" 
                class="px-6 py-3 bg-gradient-to-r from-yellow-500 to-yellow-700 text-white rounded-lg shadow-lg hover:from-blue-700 hover:to-blue-500 transition duration-300">
                Print Certificate
            </button>
        </div>
    </div>

    <script>
        // Force background printing in Chrome
        const style = document.createElement('style');
        style.textContent = `
            @media print {
                body { -webkit-print-color-adjust: exact !important; }
                #certificate-container { 
                    background-image: url('{{ asset('certificate.jpeg') }}') !important;
                    -webkit-print-color-adjust: exact !important;
                    color-adjust: exact !important;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
