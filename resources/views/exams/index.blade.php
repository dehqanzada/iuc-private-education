@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row mb-3">
            <div class="col-sm-6 col-md-6">
                <h3>{{__('trans.Ongoing Examination')}}</h3>
            </div>
            <div class="col-sm-6 col-md-6 text-end">
                <h3>
                    {{__('trans.Number of students')}}: {{$totalUniqueStudents}}
                </h3>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-start">{{__('trans.Student name')}}</th>
                        <th class="text-start">{{__('trans.Group name')}}</th>
                        <th class="text-end"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($exams as $exam)
                            <tr>
                                <td class="text-start">{{ $exam->student_name }}</td>
                                <td class="text-start">{{ $exam->group_name }}</td>
                                <td class="text-end">
                                    <a href="{{route('doExperience', [$exam->student_id, $exam->group_id])}}" class="btn btn-sm btn-info">
                                        {{__('trans.Continue with the exam')}}
                                    </a>
                                    <button onclick="confirmDelete({{ $exam->exam_id }})" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> {{__('trans.Delete')}}
                                    </button>
                                    <form id="delete-form-{{ $exam->exam_id }}"
                                          action="{{ route('exams.destroy', $exam->exam_id) }}" method="POST"
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
