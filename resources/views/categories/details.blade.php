@extends('layouts.admin')

@section('title', 'Category Details')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Category Details</h5>
    </div>
    
    <div class="card-body">
        <!-- View Mode -->
        <div id="view-mode">
            <h3>{{ $categories->name }}</h3>
            <hr>
            
            <div class="d-flex gap-2">
                <button class="btn btn-warning" onclick="toggleEdit(true)">
                    <i class="fas fa-edit me-2"></i> Edit
                </button>
                <form action="{{ route('category.delete', $categories->id) }}" method="POST" 
                    data-confirm="Are you sure you want to delete this category?">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i> Delete
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Edit Mode -->
        <div id="edit-mode" style="display: none;">
            <form method="POST" action="{{ route('category.update', $categories->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" value="{{ $categories->name }}" class="form-control" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i> Save Changes
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="toggleEdit(false)">
                        <i class="fas fa-times me-2"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function toggleEdit(show) {
        document.getElementById('view-mode').style.display = show ? 'none' : 'block';
        document.getElementById('edit-mode').style.display = show ? 'block' : 'none';
    }
</script>
@endpush
@endsection