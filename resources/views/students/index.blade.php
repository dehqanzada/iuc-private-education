@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h2>Student Lists</h2>
                <a href="{{route('students.create')}}" class="btn btn-sm btn-primary">Add New Student</a>
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
                    @foreach ($students as $student)
                        <tr>
                            <td class="text-start">{{ $student->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('experiences.show', $student->id) }}" class="btn btn-sm btn-secondary">
                                    Reports
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-success">
                                    <i class="fas fa-edit"></i> Update
                                </a>
                                <button onclick="confirmDelete({{ $student->id }})" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                                <form id="delete-form-{{ $student->id }}"
                                      action="{{ route('students.destroy', $student->id) }}" method="POST"
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
