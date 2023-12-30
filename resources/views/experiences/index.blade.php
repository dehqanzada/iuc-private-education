@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-sm-6 col-md-6">
                <h3>{{$student->name}}</h3>
            </div>
            <div class="col-sm-6 col-md-6 text-end">
                <h3>
                    <a href="{{route('home')}}" class="btn btn-sm btn-secondary">{{__('trans.Back')}}</a>
                </h3>
            </div>
        </div>

        <div class="row">
            @foreach($tutorialGroups ?? [] as $tGroup)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$tGroup->name}}</h5>
                            <small style="display: block; text-align: justify;">{{$tGroup->description}}</small>
                            <div class="text-center mt-3">
                                @if(!$tGroup->exams->isEmpty() && $tGroup->exams->first()->student_id == $student->id)
                                    <a href="{{route('doExperience', [$student->id, $tGroup->id])}}"
                                       class="btn btn-success btn-sm">{{__('trans.Continue')}}</a>
                                @else
                                    <a href="{{route('doExperience', [$student->id, $tGroup->id])}}"
                                       class="btn btn-primary btn-sm">{{__('trans.Start')}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


    </div>
@endsection

@section('css-style')


@endsection
@section('java-script')


@endsection
