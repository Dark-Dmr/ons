@extends('layouts.admin')

@section('title', 'Create Content')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Create New Content</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('store.content') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tittle" class="form-label">Content Title</label>
                <input type="text" class="form-control" id="tittle" name="tittle" required>
            </div>
            
            <div class="mb-3">
                <label for="text" class="form-label">Content Text</label>
                <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Select Categories:</label>
                <div class="row">
                    @foreach ($categories as $category)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="categories_id[]" 
                                value="{{ $category->id }}" id="category-{{ $category->id }}">
                            <label class="form-check-label" for="category-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Save Content
                </button>
            </div>
        </form>
    </div>
</div>
@endsection