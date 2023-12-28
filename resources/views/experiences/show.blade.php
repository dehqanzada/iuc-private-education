@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-sm-6 col-md-6">
                <h3>{{$student->name}} -> @if(isset($group))
                        {{$group->name}}
                    @endif</h3>
            </div>
            <div class="col-sm-6 col-md-6 text-end">
                <h3>
                    <a href="{{route('home')}}" class="btn btn-sm btn-secondary">{{__('trans.Back')}}</a>
                </h3>
            </div>
        </div>



        <div class="container mt-4">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="row align-items-center" action="{{ route('getReports', [$student->id, $group->id]) }}"
                                  method="get">
                                <div class="col">
                                    <label for="studentId" class="visually-hidden">{{__('trans.Choose Student')}}</label>
                                    <select name="studentId" id="studentId" class="form-select">
                                        @foreach($students ?? [] as $stdnt)
                                            <option
                                                value="{{$stdnt->id}}" {{(isset($student->id) && $student->id == $stdnt->id) ? 'selected':''}}>{{$stdnt->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="groupId" class="visually-hidden">{{__('trans.Choose Group')}}</label>
                                    <select name="groupId" id="groupId" class="form-select">
                                        @foreach($groups ?? [] as $grp)
                                            <option
                                                value="{{$grp->id}}" {{(isset($group->id) && $group->id == $grp->id) ? 'selected':''}}>{{$grp->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">{{__('trans.Search')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            @foreach($student->experiences ?? [] as $experience)
                <div class="card mb-3">
                    <img src="{{ asset('storage/experiences/' . $experience->image_url) }}"> {{$experience->image_url}}

{{--                    <img src="{{ asset($experiences->image_url) }}" class="card-img-top" alt="Experience Image">--}}
                    <div class="card-body">
                        <p class="card-text text-center">{{$experience->created_at->format('d/m/Y H:i')}}</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
@endsection
