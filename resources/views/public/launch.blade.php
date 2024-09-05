<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Launch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #0d0d0d;
            color: white;
            font-family: 'Poppins', sans-serif;
            overflow: hidden;
        }

        .container {
            text-align: center;
            animation: fadeIn 2s ease-in-out;
        }

        h1 {
            font-size: 3.5rem;
            margin-bottom: 30px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 5px;
            color: #ffcc00;
        }

        .countdown-timer {
            display: flex;
            justify-content: center;
            font-size: 4rem;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .countdown-timer div {
            margin: 0 20px;
            padding: 20px;
            background-color: #1a1a1a;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(255, 204, 0, 0.7);
            width: 100px;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .countdown-timer div:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 15px;
            background: linear-gradient(45deg, rgba(255, 204, 0, 0.3), rgba(255, 0, 128, 0.3));
            animation: pulse 2s infinite;
            z-index: -1;
        }

        .countdown-timer div span {
            display: block;
            font-size: 1rem;
            margin-top: 10px;
            text-transform: uppercase;
            font-weight: 300;
            letter-spacing: 1px;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes slideIn {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .countdown-timer div {
            animation: slideIn 1s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Launching Soon</h1>
        <div id="countdown-timer" class="countdown-timer">
            <div id="days">
                00
                <span>Days</span>
            </div>
            <div id="hours">
                00
                <span>Hours</span>
            </div>
            <div id="minutes">
                00
                <span>Minutes</span>
            </div>
            <div id="seconds">
                00
                <span>Seconds</span>
            </div>
        </div>
    </div>

    <!-- Audio for countdown and congratulations -->
    <audio id="countdown-sound" src="{{ asset('assets/timer.mp3') }}"></audio>
    <audio id="congratulations-sound" src="{{ asset('assets/congrats.wav') }}"></audio>

    <script>
    var launchDate  = new Date();

    // Add 2 minutes (120,000 milliseconds) to the current time
    launchDate.setTime(launchDate.getTime() + 1 * 60 * 1000);

        var countdownfunction = setInterval(function() {
            var now = new Date().getTime();
            var distance = launchDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("days").innerHTML = days;
            document.getElementById("hours").innerHTML = hours;
            document.getElementById("minutes").innerHTML = minutes;
            document.getElementById("seconds").innerHTML = seconds;

            if (distance <= 11000 && distance > 0) {
                document.getElementById('countdown-sound').play();
            }

            if (distance < 0) {
                clearInterval(countdownfunction);
                document.getElementById("countdown-timer").innerHTML = "WE ARE LIVE!";
                document.getElementById('congratulations-sound').play();
                
                setTimeout(function() {
                    window.location.href = "{{ url('/') }}";
                }, 3000);
            }
        }, 1000);
    </script>
</body>
</html>
