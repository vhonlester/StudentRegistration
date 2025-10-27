@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-users me-2"></i>Students</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Register New Student
    </a>
</div>

@if($students->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td>{{ $student->student_id }}</td>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->phone ?? 'N/A' }}</td>
                    <td>
                        <span class="badge bg-info">{{ $student->section->name }}</span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Are you sure you want to delete this student?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $students->links() }}
    </div>
@else
    <div class="text-center py-5">
        <i class="fas fa-users fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">No students registered yet</h4>
        <p class="text-muted">Start by registering your first student.</p>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Register First Student
        </a>
    </div>
@endif
@endsection
