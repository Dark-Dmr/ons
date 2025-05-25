@extends('layouts.admin')

@section('title', 'إنشاء محتوى')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">إنشاء محتوى جديد</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('store.content') }}" method="POST" id="contentForm">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">عنوان المحتوى</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="text" class="form-label">نص المحتوى</label>
                <textarea id="text" name="text" rows="10" class="form-control"></textarea>
                <div class="invalid-feedback" id="textError" style="display: none;">
                    يرجى إدخال نص المحتوى.
                </div>
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

@push('scripts')
<script src="{{ asset('vendor/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Init TinyMCE
        tinymce.init({
            selector: '#text',
            height: 500,
            language: 'ar',
            directionality: 'rtl',
            menubar: false,
            branding: false,
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

        // Validate on submit
        const form = document.getElementById('contentForm');
        form.addEventListener('submit', function (e) {
            tinymce.triggerSave(); // sync content to textarea
            const content = tinymce.get('text').getContent({ format: 'text' }).trim();

            const errorBox = document.getElementById('textError');
            if (!content) {
                errorBox.style.display = 'block';
                e.preventDefault();
            } else {
                errorBox.style.display = 'none';
            }
        });
    });
</script>
@endpush
