@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-12">
                <h1 class="display-4">{{ $resourceGroup->name }}</h1>
            </div>
        </div>

        <!-- Group Items -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">Group Items</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($resourceGroup->resourceGroupItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->name }}
                                <a href="{{ route('resources.edit', $resource->id) }}" class="btn btn-sm btn-danger">
                                    Remove
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Resources -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-info text-white">Resources</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($resources ?? [] as $resource)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $resource->name }}
                                <a href="{{ route('resources.edit', $resource->id) }}" class="btn btn-sm btn-success">
                                    Add
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
