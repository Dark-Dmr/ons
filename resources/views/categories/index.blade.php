@extends('layouts.admin')

@section('title', 'Categories Management')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Categories Management</h5>
            <a href="{{ route('category.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-2"></i> Create New
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <div class="list-group">
            @foreach($categories as $category)
            <a href="{{ route('category.details', $category->id) }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $category->name ?? 'Unnamed Category' }}</h5>
                    @if($category->created_at)
                        <small>{{ $category->created_at->diffForHumans() }}</small>
                    @else
                        <small>No date</small>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection