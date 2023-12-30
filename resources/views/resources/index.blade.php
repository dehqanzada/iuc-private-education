@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h2>{{__('trans.Resource List')}}</h2>
                <a href="{{route('resources.create')}}" class="btn btn-sm btn-primary">{{__('trans.Add New Resource')}}</a>
            </div>
        </div>
        <audio id="audioPlayer" controls style="display:none;"></audio>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-start">{{__('trans.Name')}}</th>
                        <th class="text-center">{{__('trans.Image')}}</th>
                        <th class="text-center">{{__('trans.Music')}}</th>
                        <th class="text-center">{{__('trans.Auto Voiceover')}}</th>
                        <th class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($resources ?? [] as $resource)
                        <tr>
                            <td class="text-start">
                                @if(isset($resource->name) && $resource->name !== null)
                                    {{ $resource->name }}
                                @endif
                            </td>
                            <td class="text-center">
                                <img src="
                                @if(isset($resource->image_url) && $resource->image_url !== null) {{ asset('storage/images/' . $resource->image_url) }}@endif"
                                     class="img-fluid image-item" style="max-width: 150px; max-height: 150px;">
                            </td>
                            <td class="text-center music-item"
                                data-url="
                                @if(isset($resource->music_url) && $resource->music_url !== null)
                                    {{ asset('storage/musics/' . $resource->music_url) }}
                                @endif
                                ">
                                @if(isset($resource->music_url) && $resource->music_url !== null)
                                    <i class="bi bi-music-note btn btn-sm btn-info" style="font-size: 20px;"></i>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($resource->auto_voiceover)
                                    <i class="bi bi-volume-up" style="font-size: 20px;"></i>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('resources.edit', $resource->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i> {{__('trans.Update')}}
                                </a>
                                <button onclick="confirmDelete({{ $resource->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> {{__('trans.Delete')}}
                                </button>
                                <form id="delete-form-{{ $resource->id }}"
                                      action="{{ route('resources.destroy', $resource->id) }}" method="POST"
                                      style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>




@endsection
@section('css-style')


@endsection
@section('java-script')

    <script>
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
