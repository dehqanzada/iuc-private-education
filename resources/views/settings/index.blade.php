@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h2>Settings</h2>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-start">Text</th>
                        <th class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($settings as $setting)
                        @if(!$setting->show_style)
                            <tr>
                                <td class="text-start">{{ $setting->name }}</td>
                                <td class="text-end">
                                    @php
                                        $buttonText = $setting->status ? 'True' : 'False';
                                        $buttonClass = $setting->status ? 'btn-success' : 'btn-danger';
                                        $route = $setting->status ? 'settings.edit' : 'settings.show';
                                    @endphp

                                    <a href="{{ route($route, $setting->id) }}" class="btn btn-sm {{ $buttonClass }}">
                                        {{ $buttonText }}
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="card">
            <div class="card-body">

                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-start">Text style</th>
                        <th class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <form action="{{route('updateSettingStyle')}}" method="post"> @csrf
                        @foreach ($settings as $setting)
                            @if($setting->show_style)
                                <tr>
                                    <td class="text-start">{{ $setting->name }}</td>
                                    <td class="text-end">
                                        <div class="col">

                                            @if($setting->id === 5)
                                                <select name="style" id="style" class="form-select">
                                                    @foreach($styles ?? [] as $style)
                                                        <option
                                                        {{($setting->font_style == $style) ? 'selected':''}}
                                                        value="{{$style}}">{{$style}}</option>
                                                    @endforeach
                                                </select>
                                            @elseif($setting->id === 6)
                                                <input type="number" class="form-control" name="size"
                                                       min="10" max="150"
                                                       value="{{$setting->font_size}}" required>
                                            @elseif($setting->id === 7)
                                                <select name="color" id="color" class="form-select">
                                                    @foreach($colors ?? [] as $color)
                                                        <option
                                                            {{($setting->font_color == $color) ? 'selected':''}}
                                                            value="{{$color}}">{{$color}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </td>
                                </tr>

                            @endif
                        @endforeach
                        <tr>
                            <td></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-success" type="submit">Update</button>
                            </td>
                        </tr>
                    </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
