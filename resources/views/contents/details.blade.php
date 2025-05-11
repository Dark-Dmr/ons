@extends('layouts.admin')

@section('title', 'Content Details')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Content Details</h5>
    </div>
    
    <div class="card-body">
        <!-- View Mode -->
        <div id="view-mode">
            <h3>{{ $contents->tittle }}</h3>
            <hr>
            <div class="mb-4">
                {!! nl2br(e($contents->text)) !!}
            </div>
            
            @if($contents->categories->count() > 0)
            <div class="mb-4">
                <h6>Categories:</h6>
                @foreach($contents->categories as $category)
                    <span class="badge bg-secondary me-2">{{ $category->name }}</span>
                @endforeach
            </div>
            @endif
            
            <div class="d-flex gap-2">
                <button class="btn btn-warning" onclick="toggleEdit(true)">
                    <i class="fas fa-edit me-2"></i> Edit
                </button>
                <form action="{{ route('content.delete', $contents->id) }}" method="POST" 
                    data-confirm="Are you sure you want to delete this content?">
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
            <form method="POST" action="{{ route('content.update', $contents->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="tittle" value="{{ $contents->tittle }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Text</label>
                    <textarea name="text" class="form-control" rows="6" required>{{ $contents->text }}</textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Select Categories:</label>
                    <div class="row">
                        @foreach ($categories as $category)
                        <div class="col-md-4 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="categories_id[]" 
                                    value="{{ $category->id }}" id="category-{{ $category->id }}"
                                    {{ in_array($category->id, $contents->categories->pluck('id')->toArray()) ? 'checked' : '' }}>
                                <label class="form-check-label" for="category-{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
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