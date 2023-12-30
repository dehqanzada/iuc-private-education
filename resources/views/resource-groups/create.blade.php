@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">{{__('trans.Resource Groups')}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resource-groups.store') }}">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{__('trans.Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">{{__('trans.Description')}}</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="6"
                                          required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">{{__('trans.Save')}}</button>
                            <a href="{{ route('resource-groups.index') }}" class="btn btn-secondary">{{__('trans.Back')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css-style')


@endsection
@section('java-script')


@endsection
