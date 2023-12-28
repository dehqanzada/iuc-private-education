@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-sm-6 col-md-6">
                <h3>
                    <a href="{{route('resource-groups.show', $resourceGroup->id)}}">{{ $resourceGroup->name }}</a>
                </h3>
            </div>
            <div class="col-sm-6 col-md-6 text-end">
                <h3>
                    <a href="{{route('resource-groups.index')}}" class="btn btn-sm btn-secondary">Back</a>
                </h3>
            </div>
        </div>

        <div class="row mb-3">
            <small style="text-align: justify;">{{$resourceGroup->description}}</small>
        </div>
        <!-- Group Items -->
        <div class="row mb-4">
            <div class="col-sm-6 col-md-6 mb-3 mb-md-0">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">Group Items</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($resourceGroup->resourceGroupItems as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->resource->name }} <br>
                                <button onclick="confirmDelete({{ $item->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                                <form id="delete-form-{{ $item->id }}"
                                      action="{{ route('resource-group-items.destroy', $item->id) }}" method="POST"
                                      style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Resources -->
            <div class="col-sm-6 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-info text-white">Resources</div>
                    <ul class="list-group list-group-flush">
                        @foreach ($resources ?? [] as $resource)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $resource->name }}
                                <a href="{{ route('resource-group-items.edit', $resourceGroup->id) }}?resource_id={{ $resource->id }}" class="btn btn-sm btn-success">
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
