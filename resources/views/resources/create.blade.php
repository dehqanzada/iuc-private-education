@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Sol Form -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">Left Form</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="form_type" value="left">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>

                            <div class="form-group mb-3">
                                <label for="auto_voiceover" class="form-label">Auto Voiceover</label>
                                <input type="checkbox" id="auto_voiceover" name="auto_voiceover" onchange="toggleMusicUpload()">
                            </div>

                            <div class="form-group mb-3" id="leftMusicUploadField">
                                <label for="left_music" class="form-label">Music</label>
                                <input type="file" class="form-control" id="left_music" name="left_music">
                            </div>

                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('resources.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sağ Form -->
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">Right Form</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="form_type" value="right">
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>

                            <div class="form-group mb-3">
                                <label for="right_music" class="form-label">Music</label>
                                <input type="file" class="form-control" id="right_music" name="right_music">
                            </div>

                            <button type="submit" class="btn btn-info">Save</button>
                            <a href="{{ route('resources.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleMusicUpload() {
            var autoVoiceoverChecked = document.getElementById('auto_voiceover').checked;
            var leftMusicField = document.getElementById('leftMusicUploadField');

            leftMusicField.style.display = autoVoiceoverChecked ? 'none' : 'block';
        }

        document.addEventListener('DOMContentLoaded', function() {
            toggleMusicUpload(); // Sayfa yüklendiğinde ses dosyası alanını kontrol et
        });
    </script>
@endsection
