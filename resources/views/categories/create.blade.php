@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Create New Category</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('store.category') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Save Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection