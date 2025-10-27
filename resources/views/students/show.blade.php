@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-user me-2"></i>Student Details</h4>
                <div class="btn-group">
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this student?')">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Student Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Student ID:</strong></td>
                                <td>{{ $student->student_id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $student->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $student->phone ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Additional Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Date of Birth:</strong></td>
                                <td>{{ $student->date_of_birth->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Age:</strong></td>
                                <td>{{ $student->date_of_birth->age }} years old</td>
                            </tr>
                            <tr>
                                <td><strong>Section:</strong></td>
                                <td>
                                    <span class="badge bg-info">{{ $student->section->name }}</span>
                                    <small class="text-muted">({{ $student->section->code }})</small>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $student->address ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="{{ route('students.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Students
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
