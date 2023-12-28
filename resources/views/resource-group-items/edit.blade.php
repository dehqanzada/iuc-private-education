@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">Update Resource Group</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('resource-groups.update', $resourceGroup->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $resourceGroup->name }}" required>
                            </div>

                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('resource-groups.index') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

