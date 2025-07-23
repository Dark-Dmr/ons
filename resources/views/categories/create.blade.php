@extends('layouts.admin')

@section('title', 'إنشاء تصنيف')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">إنشاء تصنيف جديد</h5>
    </div>

    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST" id="categoryForm">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">اسم التصنيف</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save me-2"></i> حفظ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
