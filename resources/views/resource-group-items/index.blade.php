@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h2>Resource Groups</h2>
                <a href="{{route('resource-groups.create')}}" class="btn btn-primary">Add New Resource Groups</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-start">Name</th>
                        <th class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($resourceGroups as $resourceGroup)
                        <tr>
                            <td class="text-start">
                                <a href="{{ route('resource-groups.show', $resourceGroup->id) }}"
                                    style="text-decoration: none"
                                >
                                    {{ $resourceGroup->name }}
                                </a>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('resource-groups.edit', $resourceGroup->id) }}" class="btn btn-sm btn-success">
                                    Update
                                </a>
                                <button onclick="confirmDelete({{ $resourceGroup->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                                <form id="delete-form-{{ $resourceGroup->id }}"
                                      action="{{ route('resource-groups.destroy', $resourceGroup->id) }}" method="POST"
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
