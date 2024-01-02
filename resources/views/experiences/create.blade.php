@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="row mb-4 alert alert-secondary">
                <div class="col-sm-4 col-md-4">
                    <h4>{{$student->name}}</h4>
                </div>
                <div class="col-sm-4 col-md-4 text-center">
                    <h5>
                        {{__('trans.Total')}}: {{$tutorialGroup->resource_group_items_count}}
                        {{__('trans.Remaining')}}: {{$remainingQuestionsCount}}
                    </h5>
                </div>
                <div class="col-sm-4 col-md-4 text-end">
                    <h4>{{$tutorialGroup->name}}</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-4 text-start music-item"
                     data-url="{{ isset($examItem->resourceGroupItem->resource->music_url) ? asset('storage/musics/' . $examItem->resourceGroupItem->resource->music_url) : '' }}">
                    <i class="bi bi-volume-up" style="font-size: 30px;"></i>
                </div>
                <div class="col-md-4 col-sm-4 text-center">
                    <i class="bi bi-eraser-fill text-primary" onclick="clearCanvas()" style="font-size: 30px;"></i>
                </div>
                <div class="col-md-4 col-sm-4 text-end">
                    <a href="javascript:void(0)"
                       class="btn btn-sm btn-success" onclick="saveCanvasToDatabase()">{{__('trans.Next question')}}</a>
                </div>
            </div>
            <input type="range" id="lineWidth" min="1" max="10" value="2">

            <audio id="audioPlayer" controls style="display:none;"></audio>
            <canvas id="harfCanvas" width="800" height="200"></canvas>

            {{--            <button onclick="harfGoster()" class="btn btn-sm btn-outline-primary">Harf Göster</button>--}}
            {{--            <button onclick="saveCanvasAsPNG()">PNG Olarak Kaydet</button>--}}


        </div>
    </div>

@endsection



@section('css-style')


@endsection
@section('java-script')
    <script>

        function clearCanvas() {
            let canvas = document.getElementById('harfCanvas');
            let ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            location.reload();
        }

        document.addEventListener('DOMContentLoaded', function () {
            let canvas = document.getElementById('harfCanvas');
            let ctx = canvas.getContext('2d');
            let drawing = false;
            let lineWidthControl = document.getElementById('lineWidth');

            function calculateLinePositions(fontSize) {
                // İki boyut arasındaki fark
                const sizeDiff = 70 - 55;

                // Her çizgi için başlangıç ve bitiş oranları
                const lineRatios = {
                    firstLine: {start: 0.390, end: 0.360},
                    secondLine: {start: 0.450, end: 0.430},
                    thirdLine: {start: 0.570, end: 0.586},
                    forthLine: {start: 0.630, end: 0.656}
                };

                // Font boyutu farkına göre oranları ayarla
                const positions = {};
                for (const line in lineRatios) {
                    const startRatio = lineRatios[line].start;
                    const endRatio = lineRatios[line].end;
                    const ratioDiff = endRatio - startRatio;

                    // Oran farkını kullanarak yeni oranı hesapla
                    positions[line] = startRatio + (ratioDiff / sizeDiff) * (fontSize - 55);
                }

                return positions;
            }

            // Kullanım örneği
            const fontSize = '{{$settings->font_size}}'; // İstediğiniz boyut
            const linePositions = calculateLinePositions(fontSize);

            function drawLines() {

                ctx.strokeStyle = "rgba(0, 0, 0, 0.2)";
                ctx.lineWidth = 1;
                // 55
                // let firstLine = 0.390;
                // let secondLine = 0.450;
                // let thirdLine = 0.570;
                // let forthLine = 0.630;

                // 70
                // let firstLine = 0.360;
                // let secondLine = 0.430;
                // let thirdLine = 0.586;
                // let forthLine = 0.656;

                const canvasPositions = calculateLinePositions(fontSize);

                ctx.beginPath();
                ctx.moveTo(0, canvas.height * canvasPositions.firstLine);
                ctx.lineTo(canvas.width, canvas.height * canvasPositions.firstLine);
                ctx.stroke();

                // ctx.beginPath();
                // ctx.moveTo(0, canvas.height * firstLine);
                // ctx.lineTo(canvas.width, canvas.height * firstLine);
                // ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(0, canvas.height * canvasPositions.secondLine);
                ctx.lineTo(canvas.width, canvas.height * canvasPositions.secondLine);
                ctx.stroke();

                // ctx.beginPath();
                // ctx.moveTo(0, canvas.height * secondLine);
                // ctx.lineTo(canvas.width, canvas.height * secondLine);
                // ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(0, canvas.height * canvasPositions.thirdLine);
                ctx.lineTo(canvas.width, canvas.height * canvasPositions.thirdLine);
                ctx.stroke();

                // ctx.beginPath();
                // ctx.moveTo(0, canvas.height * thirdLine);
                // ctx.lineTo(canvas.width, canvas.height * thirdLine);
                // ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(0, canvas.height * canvasPositions.forthLine);
                ctx.lineTo(canvas.width, canvas.height * canvasPositions.forthLine);
                ctx.stroke();

                // ctx.beginPath();
                // ctx.moveTo(0, canvas.height * forthLine);
                // ctx.lineTo(canvas.width, canvas.height * forthLine);
                // ctx.stroke();
            }

            // Rastgele bir harf gösterme fonksiyonu
            function harfGoster() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                drawLines();

                let harfler = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                // let harfler = 'Zabcdefghijklmnopqrstuvwxyz';
                // let harfler = 'ABCDEFGHIJKLMNOPQRSTUVWXY';
                let rastgeleHarf = '';
                // rastgeleHarf = harfler.charAt(Math.floor(Math.random() * harfler.length));

                for (let i = 0; i < 8; i++) {
                    rastgeleHarf += harfler.charAt(Math.floor(Math.random() * harfler.length));
                }

                ctx.font = '{{$settings->font_size.'px'.' '.$settings->font_style}}';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillStyle = '{{$settings->font_color}}';
                ctx.fillText('{{$questionContent}}', canvas.width / 2, canvas.height / 2);
            }

            /*
            // Çizgileri çizme fonksiyonu
            function drawLines() {

                ctx.strokeStyle = 'black';
                ctx.lineWidth = 1;

                // 70
                // let firstLine = 0.360;
                // let secondLine = 0.430;
                // let thirdLine = 0.586;
                // let forthLine = 0.656;

                let firstLine = 0.39;
                let secondLine = 0.45;
                let thirdLine = 0.57;
                let forthLine = 0.63;

                ctx.beginPath();
                ctx.moveTo(0, canvas.height * firstLine);
                ctx.lineTo(canvas.width, canvas.height * firstLine);
                ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(0, canvas.height * secondLine);
                ctx.lineTo(canvas.width, canvas.height * secondLine);
                ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(0, canvas.height * thirdLine);
                ctx.lineTo(canvas.width, canvas.height * thirdLine);
                ctx.stroke();

                ctx.beginPath();
                ctx.moveTo(0, canvas.height * forthLine);
                ctx.lineTo(canvas.width, canvas.height * forthLine);
                ctx.stroke();
            }

            // Rastgele bir harf gösterme fonksiyonu
            function harfGoster() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                drawLines();

                let harfler = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                // let harfler = 'Zabcdefghijklmnopqrstuvwxyz';
                // let harfler = 'ABCDEFGHIJKLMNOPQRSTUVWXY';
                let rastgeleHarf = '';
                // rastgeleHarf = harfler.charAt(Math.floor(Math.random() * harfler.length));

                for (let i = 0; i < 8; i++) {
                    rastgeleHarf += harfler.charAt(Math.floor(Math.random() * harfler.length));
                }

                ctx.font = '55px serif';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.fillStyle = 'red';
                ctx.fillText('{{$questionContent}}', canvas.width / 2, canvas.height / 2);
            }
*/

            // Fare pozisyonunu hesaplama fonksiyonu
            function getMousePos(evt) {
                let rect = canvas.getBoundingClientRect();
                return {
                    x: (evt.clientX - rect.left) * (canvas.width / rect.width),
                    y: (evt.clientY - rect.top) * (canvas.height / rect.height)
                };
            }

            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                };
            }

            // Fare ile çizim yapma işlevleri
            function mouseDownHandler(e) {
                if (e.button === 0) {
                    ctx.strokeStyle = "black";
                    ctx.lineWidth = lineWidthControl.value;
                    drawing = true;
                    let pos = getMousePos(e);
                    ctx.beginPath();
                    ctx.moveTo(pos.x, pos.y);
                }
            }

            function mouseMoveHandler(e) {
                if (drawing) {
                    ctx.strokeStyle = "black";
                    ctx.lineWidth = lineWidthControl.value;
                    let pos = getMousePos(e);
                    ctx.lineTo(pos.x, pos.y);
                    ctx.stroke();
                }
            }

            function mouseUpHandler() {
                if (drawing) {
                    ctx.strokeStyle = "rgba(0, 0, 0, 0.1)";
                    ctx.lineWidth = 1;
                    drawing = false;
                }
            }

            // Dokunmatik olayları için ek fonksiyonlar
            function touchStartHandler(e) {
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }

            function touchMoveHandler(e) {
                var touch = e.touches[0];
                var mouseEvent = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(mouseEvent);
            }

            function touchEndHandler(e) {
                var mouseEvent = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(mouseEvent);
            }

            // Canvas'ı PNG olarak kaydetme fonksiyonu
            /*
            function saveCanvasAsPNG() {
                let tempCanvas = document.createElement('canvas');
                tempCanvas.width = canvas.width;
                tempCanvas.height = canvas.height;

                // Geçici canvas üzerine mevcut canvası çiz
                let tempCtx = tempCanvas.getContext('2d');
                tempCtx.fillStyle = 'white'; // Arka plan rengini beyaz olarak ayarla
                tempCtx.fillRect(0, 0, tempCanvas.width, tempCanvas.height); // Beyaz bir dikdörtgen çiz
                tempCtx.drawImage(canvas, 0, 0); // Mevcut canvası üzerine çiz

                // Geçici canvas'ı PNG olarak kaydet
                let dataURL = tempCanvas.toDataURL('image/png');
                let link = document.createElement('a');
                link.download = 'canvas-image-' + Date.now() + '.png';
                link.href = dataURL;
                link.click();
            }
             */

            function saveCanvasToDatabase() {
                let canvas = document.getElementById('harfCanvas');
                let imageData = canvas.toDataURL('image/png');

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "{{ route('saveExperience') }}", true);
                xhr.setRequestHeader("Content-Type", "application/json");
                xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);

                        if (response.success) {
                            {{--window.location.href = `/admin/do-experience/{{$student->id}}/{{$examItem->group_id}}/{{$examItem->id}}`;--}}
                                window.location.href = `{{route('doExperience', [$student->id, $examItem->group_id, $examItem->id])}}`;
                        } else {
                            Swal.fire({
                                title: '{{__("trans.Warning")}}!',
                                text: "{{__("trans.The recording of the image failed")}}.",
                                icon: 'error',
                                confirmButtonText: '{{__("trans.Okay")}}'
                            });
                        }

                    } else if (xhr.readyState === 4) {
                        console.error('Error:', xhr.responseText);
                    }
                };

                xhr.send(JSON.stringify({
                    image: imageData,
                    studentId: {{$student->id}},
                    groupId: {{$examItem->group_id}},
                    groupItemId: {{$examItem->group_item_id}}
                }));
            }


            // İlk yükleme ve pencere yeniden boyutlandırma için olay dinleyicileri
            window.addEventListener('resize', function () {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight / 2;
                drawLines();
                harfGoster();
            });

            // Buton olay dinleyicileri
            // document.querySelector("button[onclick='harfGoster()']").onclick = harfGoster;
            document.querySelector("a[onclick='saveCanvasToDatabase()']").onclick = saveCanvasToDatabase;

            // Fare olay dinleyicileri
            canvas.addEventListener('mousedown', mouseDownHandler);
            canvas.addEventListener('mousemove', mouseMoveHandler);
            canvas.addEventListener('mouseup', mouseUpHandler);

            canvas.addEventListener("touchstart", touchStartHandler, false);
            canvas.addEventListener("touchmove", touchMoveHandler, false);
            canvas.addEventListener("touchend", touchEndHandler, false);

            // İlk çizgileri çiz ve harfi göster
            drawLines();
            harfGoster();
        });


        document.addEventListener('DOMContentLoaded', function () {
            var musicItems = document.querySelectorAll('.music-item');
            musicItems.forEach(function (musicItem) {
                musicItem.addEventListener('click', function (e) {
                    if (e.target && e.target.nodeName === "I") {
                        var musicUrl = this.getAttribute('data-url');
                        var audioPlayer = document.getElementById('audioPlayer');
                        audioPlayer.src = musicUrl;
                        audioPlayer.play();
                        // audioPlayer.style.display = 'block';
                    }
                });
            });
        });
    </script>

@endsection
