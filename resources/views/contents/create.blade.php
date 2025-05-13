@extends('layouts.admin')

@section('title', 'إنشاء محتوى')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">إنشاء محتوى جديد</h5>
    </div>
    
    <div class="card-body">
        <form action="{{ route('store.content') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tittle" class="form-label">عنوان المحتوى</label>
                <input type="text" class="form-control" id="tittle" name="tittle" required>
            </div>
            
            <div class="mb-3">
                <label for="text" class="form-label">نص المحتوى</label>
                <textarea class="form-control" id="text" name="text" rows="5" required></textarea>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> حفظ المحتوى
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
