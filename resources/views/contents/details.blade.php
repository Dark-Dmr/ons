@extends('layouts.admin')

@section('title', 'تفاصيل المحتوى')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">تفاصيل المحتوى</h5>
    </div>

    <div class="card-body">
        <!-- View Mode -->
        <div id="view-mode">
            <h3>{{ $contents->tittle }}</h3>
            <hr>
            <div class="mb-4 bg-light p-3 rounded" dir="rtl" style="line-height: 1.8;">
                @php
                    $decoded = json_decode($contents->text, true);
                @endphp
                {!! is_string($decoded) ? $decoded : $contents->text !!}
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning" onclick="toggleEdit(true)">
                    <i class="fas fa-edit me-2"></i> تعديل
                </button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fas fa-trash me-2"></i> حذف
                </button>
            </div>
        </div>

        <!-- Edit Mode -->
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
                    <textarea id="richTextEditor" name="text">
                        @php
                            $editText = json_decode($contents->text, true);
                            echo is_string($editText) ? $editText : $contents->text;
                        @endphp
                    </textarea>
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

        <!-- Delete Form -->
        <form method="POST" action="{{ route('content.delete', $contents->id) }}" id="deleteForm">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
<script src="{{ asset('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
    let editorInitialized = false;

    function initTinyMCE() {
        if (editorInitialized) return;
        tinymce.init({
            selector: '#richTextEditor',
            height: 500,
            language: 'ar',
            directionality: 'rtl',
            branding: false,
            menubar: false,
            plugins: 'lists link image table code directionality',
            toolbar: 'undo redo | styles | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | ltr rtl | removeformat code',
            content_style: `
                body {
                    font-family: Arial, sans-serif;
                    font-size: 14px;
                    direction: rtl;
                    text-align: right;
                    line-height: 1.8;
                }
            `
        });
        editorInitialized = true;
    }

    function toggleEdit(show) {
        document.getElementById('view-mode').style.display = show ? 'none' : 'block';
        document.getElementById('edit-mode').style.display = show ? 'block' : 'none';
        if (show) {
            setTimeout(initTinyMCE, 100);
        }
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
