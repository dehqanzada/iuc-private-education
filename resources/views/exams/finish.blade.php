@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-sm-6 col-md-6">
                <h3>Exam Finish</h3>
            </div>
            <div class="col-sm-6 col-md-6 text-end">
                <h3>
                    <a href="{{route('getReports', [$student->id, $tutorialGroup->id])}}" class="btn btn-sm btn-secondary">Report</a>
                </h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm congratulation-card">
                    <div class="congratulation-message">
                        @if(isset($student))
                            <h1 class="display-4 text-center text-dark">Tebrikler, {{$student->name}}!</h1>
                        @endif
                    </div>
                    @if(isset($tutorialGroup))
                        <h2 class="text-center"> <strong>{{$tutorialGroup->name}}</strong> başarıyla tamamlandı!</h2>
                    @endif
                    <div id="rain-container"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Animasyonlu Yağmur Damlaları için JavaScript -->
    <script>
        function createRain() {
            var rainContainer = document.getElementById('rain-container');

            function performAction() {
                for (var i = 0; i < 50; i++) { // 100 damla, sayıyı artırabilir veya azaltabilirsiniz
                    var drop = document.createElement('div');
                    drop.className = 'rain-drop';
                    drop.style.left = Math.random() * window.innerWidth + 'px'; // Rastgele bir başlangıç pozisyonu
                    rainContainer.appendChild(drop);
                }
            }

            function startSequentialActions() {
                for (let i = 0; i < 100; i++) {
                    setTimeout(function() {
                        performAction();
                    }, i * 1000);
                }
            }
            startSequentialActions();
        }

        window.onload = function() {
            createRain();
            // Animasyonu 5 saniye sonra durdur
            setTimeout(function() {
                document.getElementById('rain-container').innerHTML = '';
            }, 5000);
        };
    </script>
@endsection
@section('css-style')

    <!-- Özel Stiller ve Animasyonlar -->
    <style>
        .congratulation-card {
            position: relative;
            overflow: hidden;
            height: 100vh; /* Animasyonun tüm sayfayı kaplamasını sağlamak için */
        }

        .congratulation-message {
            z-index: 10;
            position: relative;
        }

        #rain-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        @keyframes drop {
            to { transform: translateY(100vh); }
        }

        .rain-drop {
            position: absolute;
            top: -10px; /* Dairelerin yukarıdan başlamasını sağlar */
            width: 10px;
            height: 10px;
            border-radius: 50%;
            opacity: 0.6;
            background-color: #3490dc; /* Mavi renk, istediğiniz renk kodu ile değiştirilebilir */
            animation: drop 5s linear;
        }

        /* Farklı süreler ve gecikmeler ile daha doğal bir etki */
        /* Toplam sürenin 5 saniye olmasını sağlamak için gecikmeleri ayarlayın */
        .rain-drop:nth-child(odd) { animation-delay: 0s; }
        .rain-drop:nth-child(even) { animation-delay: 0.5s; }
        .rain-drop:nth-child(3n) { animation-delay: 0.3s; }
    </style>

@endsection
