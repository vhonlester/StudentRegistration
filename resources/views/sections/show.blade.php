@extends('layouts.app')

@section('title', 'Section Details')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4><i class="fas fa-layer-group me-2"></i>Section Details</h4>
                <div class="btn-group">
                    <a href="{{ route('sections.edit', $section) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit
                    </a>
                    <form action="{{ route('sections.destroy', $section) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this section? This will also delete all students in this section.')">
                            <i class="fas fa-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Section Information</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $section->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Code:</strong></td>
                                <td><span class="badge bg-secondary">{{ $section->code }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Capacity:</strong></td>
                                <td>{{ $section->capacity }} students</td>
                            </tr>
                            <tr>
                                <td><strong>Description:</strong></td>
                                <td>{{ $section->description ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Statistics</h6>
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Total Students:</strong></td>
                                <td><span class="badge bg-info">{{ $section->students->count() }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Available Spots:</strong></td>
                                <td><span class="badge bg-success">{{ $section->capacity - $section->students->count() }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Utilization:</strong></td>
                                <td>
                                    @php
                                        $utilization = $section->capacity > 0 ? ($section->students->count() / $section->capacity) * 100 : 0;
                                    @endphp
                                    <div class="progress" style="width: 100px;">
                                        <div class="progress-bar" role="progressbar" style="width: {{ $utilization }}%"></div>
                                    </div>
                                    <small>{{ number_format($utilization, 1) }}%</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                @if($section->students->count() > 0)
                    <hr>
                    <h6 class="text-muted mb-3">Students in this Section</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($section->students as $student)
                                <tr>
                                    <td>{{ $student->student_id }}</td>
                                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>
                                        <a href="{{ route('students.show', $student) }}" class="btn btn-sm btn-outline-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                
                <div class="mt-4">
                    <a href="{{ route('sections.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Sections
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
