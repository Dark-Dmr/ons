@extends('layouts.admin')

@section('title', 'عرض التصنيف')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-tag me-2"></i> تفاصيل التصنيف</h5>
            <a href="{{ route('categories.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-1"></i> العودة إلى التصنيفات
            </a>
        </div>
    </div>

    <div class="card-body">

        {{-- View Mode --}}
        <div id="view-mode">
            <div class="mb-3">
                <label class="fw-bold">اسم التصنيف:</label>
                <div class="form-control bg-light">{{ $category->name }}</div>
            </div>

            <div class="mb-3">
                <label class="fw-bold">تاريخ الإضافة:</label>
                <div class="form-control bg-light">{{ $category->created_at->translatedFormat('Y-m-d H:i') }}</div>
            </div>

            <div class="mb-3">
                <label class="fw-bold">آخر تعديل:</label>
                <div class="form-control bg-light">{{ $category->updated_at->translatedFormat('Y-m-d H:i') }}</div>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <button class="btn btn-warning" onclick="toggleEdit(true)">
                    <i class="fas fa-edit me-1"></i> تعديل
                </button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash-alt me-1"></i> حذف
                </button>
            </div>
        </div>

        {{-- Edit Mode --}}
        <div id="edit-mode" style="display: none;">
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">اسم التصنيف</label>
                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> حفظ التغييرات
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="toggleEdit(false)">
                        <i class="fas fa-times me-1"></i> إلغاء
                    </button>
                </div>
            </form>
        </div>

        {{-- Delete Form --}}
        <form method="POST" action="{{ route('categories.destroy', $category->id) }}" id="deleteForm">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد أنك تريد حذف هذا التصنيف؟ لا يمكن التراجع عن هذه العملية.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">نعم، احذف</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleEdit(show) {
        document.getElementById('view-mode').style.display = show ? 'none' : 'block';
        document.getElementById('edit-mode').style.display = show ? 'block' : 'none';
    }

    document.addEventListener("DOMContentLoaded", function () {
        const deleteBtn = document.getElementById('confirmDeleteBtn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function () {
                document.getElementById('deleteForm').submit();
            });
        }
    });
</script>
@endpush
