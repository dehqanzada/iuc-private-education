@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h2>{{__('trans.Resource Groups')}}</h2>
                <a href="{{route('resource-groups.create')}}" class="btn btn-sm btn-primary">{{__('trans.Add New Resource Groups')}}</a>
            </div>
        </div>




        <div class="row">
            @foreach ($resourceGroups as $resourceGroup)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow">
                        <div class="card-header text-center">
                            <h5 class="card-title my-2">
                                <a href="{{ route('resource-groups.show', $resourceGroup->id) }}">
                                    {{ $resourceGroup->name }} ({{ $resourceGroup->resource_group_items_count }})
                                </a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text" style="text-align: justify;">{{ $resourceGroup->description }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <div class="btn-group" role="group" aria-label="Resource group actions" style="width: 100%;">
                                <a href="{{ route('resource-groups.show', $resourceGroup->id) }}" class="btn btn-outline-primary" style="width: 50%;">
                                    <i class="fas fa-edit"></i> {{__('trans.Add Item')}}
                                </a>
                                <a href="{{ route('resource-groups.edit', $resourceGroup->id) }}" class="btn btn-outline-success" style="width: 50%;">
                                    <i class="fas fa-edit"></i> {{__('trans.Update')}}
                                </a>
                                <button onclick="confirmDelete({{ $resourceGroup->id }})" class="btn btn-outline-danger" style="width: 50%;">
                                    <i class="fas fa-trash-alt"></i> {{__('trans.Delete')}}
                                </button>
                            </div>
                            <form id="delete-form-{{ $resourceGroup->id }}"
                                  action="{{ route('resource-groups.destroy', $resourceGroup->id) }}" method="POST"
                                  style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
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
