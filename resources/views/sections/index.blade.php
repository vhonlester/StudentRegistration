@extends('layouts.app')

@section('title', 'Sections')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-layer-group me-2"></i>Sections</h2>
    <a href="{{ route('sections.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i>Create New Section
    </a>
</div>

@if($sections->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Capacity</th>
                    <th>Students</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sections as $section)
                <tr>
                    <td><span class="badge bg-secondary">{{ $section->code }}</span></td>
                    <td>{{ $section->name }}</td>
                    <td>{{ $section->description ?? 'N/A' }}</td>
                    <td>{{ $section->capacity }}</td>
                    <td>
                        <span class="badge bg-info">{{ $section->students->count() }}</span>
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('sections.show', $section) }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('sections.edit', $section) }}" class="btn btn-sm btn-outline-warning">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('sections.destroy', $section) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                        onclick="return confirm('Are you sure you want to delete this section? This will also delete all students in this section.')">
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
        {{ $sections->links() }}
    </div>
@else
    <div class="text-center py-5">
        <i class="fas fa-layer-group fa-3x text-muted mb-3"></i>
        <h4 class="text-muted">No sections created yet</h4>
        <p class="text-muted">Start by creating your first section.</p>
        <a href="{{ route('sections.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Create First Section
        </a>
    </div>
@endif
@endsection
