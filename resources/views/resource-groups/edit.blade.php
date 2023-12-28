@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">{{__('trans.Update Resource Group')}}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resource-groups.update', $resourceGroup->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">{{__('trans.Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $resourceGroup->name }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">{{__('trans.Description')}}</label>
                                <textarea name="description" class="form-control" id="description" cols="30" rows="6"
                                          required>{{ $resourceGroup->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-success">{{__('trans.Update')}}</button>
                            <a href="{{ route('resource-groups.index') }}" class="btn btn-secondary">{{__('trans.Back')}}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

