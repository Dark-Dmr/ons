@extends('layouts.admin')

@section('title', 'تفاصيل المحتوى')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">تفاصيل المحتوى</h5>
    </div>
    
    <div class="card-body">
        <!-- وضع العرض -->
        <div id="view-mode">
            <h3>{{ $contents->tittle }}</h3>
            <hr>

            <div class="mb-4 bg-light p-3 rounded text-start" dir="ltr" style="white-space: pre-wrap; font-family: inherit;">
                @php
                    $lines = json_decode($contents->text, true);
                @endphp

                @if(is_array($lines))
                    {{ implode("\n", $lines) }}
                @else
                    {!! nl2br(e($contents->text)) !!}
                @endif
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning" onclick="toggleEdit(true)">
                    <i class="fas fa-edit me-2"></i> تعديل
                </button>

                <form id="deleteForm" action="{{ route('content.delete', $contents->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                        <i class="fas fa-trash me-2"></i> حذف
                    </button>
                </form>
            </div>
        </div>
        
        <!-- وضع التعديل -->
        <div id="edit-mode" style="display: none;">
            <form method="POST" action="{{ route('content.update', $contents->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">العنوان</label>
                    <input type="text" name="tittle" value="{{ $contents->tittle }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">النص</label>
                    <textarea name="text" class="form-control" rows="10" required>@if(is_array(json_decode($contents->text, true)))
{{ implode("\n", json_decode($contents->text, true)) }}
@else
{{ $contents->text }}
@endif</textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i> حفظ التغييرات
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="toggleEdit(false)">
                        <i class="fas fa-times me-2"></i> إلغاء
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- مودال تأكيد الحذف -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد أنك تريد حذف هذا المحتوى؟ لا يمكن التراجع عن هذه العملية.
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
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        const deleteForm = document.getElementById('deleteForm');

        confirmDeleteBtn.addEventListener('click', function () {
            deleteForm.submit();
        });
    });
</script>
@endpush
