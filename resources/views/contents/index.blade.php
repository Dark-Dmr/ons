@extends('layouts.admin')

@section('title', 'Contents Management')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Contents Management</h5>
            <a href="{{ route('contents.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-2"></i> Create New
            </a>
        </div>
    </div>
    
    <div class="card-body">
        <div class="list-group">
            @foreach($contents as $content)
            <a href="{{ route('content.details', $content->id) }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $content->tittle ?? 'No Title' }}</h5>
                    @if($content->created_at)
                        <small>{{ $content->created_at->diffForHumans() }}</small>
                    @else
                        <small>No date</small>
                    @endif
                </div>
                <p class="mb-1">{{ Str::limit($content->text ?? 'No content', 100) }}</p>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection