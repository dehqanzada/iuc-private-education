@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <!-- Sol Form -->
            @if($resource->form_type === 'left')
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">Update Left Resource</div>
                    <img src="{{asset('storage/images/'.$resource->image_url)}}" alt="">
                    <div class="card-body">
                        <form method="POST" action="{{ route('resources.update', $resource->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="form_type" value="left">

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $resource->name }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="auto_voiceover" class="form-label">Auto Voiceover</label>
                                <input type="checkbox" id="auto_voiceover" name="auto_voiceover" {{ $resource->auto_voiceover ? 'checked' : '' }}>
                            </div>

                            <div class="form-group mb-3">
                                <label for="left_music" class="form-label">Music</label>
                                <input type="file" class="form-control" id="left_music" name="left_music" value="{{$resource->music_url}}">
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('resources.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <!-- Sağ Form -->
            @if($resource->form_type === 'right')
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">Update Right Resource</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resources.update', $resource->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <input type="hidden" name="form_type" value="right">

                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image" value="{{$resource->image_url}}">
                            </div>

                            <div class="form-group mb-3">
                                <label for="right_music" class="form-label">Music</label>
                                <input type="file" class="form-control" id="right_music" name="right_music" value="{{$resource->music_url}}">
                            </div>

                            <button type="submit" class="btn btn-info">Update</button>
                            <a href="{{ route('resources.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let auto_voiceover = $('#auto_voiceover');
            let left_music = $('#left_music');
            toggleMusicField(auto_voiceover.is(':checked'));
            auto_voiceover.change(function() {
                toggleMusicField($(this).is(':checked'));
            });
            function toggleMusicField(isChecked) {
                if (isChecked) {
                    left_music.hide();
                    left_music.required = true;
                } else {
                    left_music.show();
                    left_music.required = false;
                }
            }
        });
    </script>
@endsection
