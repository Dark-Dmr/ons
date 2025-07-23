@extends('layouts.admin')

@section('title', 'رفع المحتوى')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-file-upload me-2"></i> رفع المحتوى</h5>
            <a href="{{ route('contents.index') }}" class="btn btn-light">
                <i class="fas fa-arrow-left me-1"></i> العودة إلى المحتويات
            </a>
        </div>
    </div>

    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                {{-- رسائل النجاح والخطأ --}}
                @if(session()->has('success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div>{{ session('error') }}</div>
                    </div>
                @endif

                {{-- منطقة رفع الملف --}}
                <div class="bg-light p-4 rounded shadow-sm text-center">
                    <div class="mb-4">
                        <i class="far fa-file-word fa-5x text-primary"></i>
                    </div>
                    <h4 class="text-primary mb-2">رفع ملف Word</h4>
                    <p class="text-muted mb-4">قم برفع ملف .doc أو .docx ليتم تحويله إلى تنسيق محتوى إسلامي</p>

                    <form action="{{ route('upload.convert') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        {{-- اختر التصنيف --}}
                        <div class="mb-4">
                            <label for="category_id" class="form-label fw-bold">اختر التصنيف:</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="" selected disabled>اختر التصنيف</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback text-start mt-1">يرجى اختيار التصنيف</div>
                        </div>

                        <div class="mb-4">
                            <label for="documentUpload" class="form-label fw-bold">اختر الملف:</label>
                            <input type="file" class="form-control" id="documentUpload" name="document" accept=".doc,.docx" required>
                            <div class="invalid-feedback text-start mt-1">يرجى رفع ملف بصيغة .doc أو .docx</div>
                        </div>

                        <button type="submit" id="convertBtn" class="btn btn-primary px-4 py-2 shadow-sm" disabled>
                            <i class="fas fa-exchange-alt me-2"></i> تحويل إلى محتوى
                            <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                        </button>
                    </form>
                </div>

                {{-- الإرشادات --}}
                <div class="mt-5 p-4 bg-white border rounded">
                    <h5 class="text-primary mb-3"><i class="fas fa-info-circle me-2"></i> إرشادات الرفع</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> تأكد من أن الملف يحتوي على عناوين واضحة وبنية سليمة.</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i> يفضل استخدام خطوط عربية قياسية.</li>
                        <li><i class="fas fa-check-circle text-success me-2"></i> حجم الملف يجب أن لا يتجاوز 5 ميجابايت.</li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        const fileInput = $('#documentUpload');
        const convertBtn = $('#convertBtn');

        fileInput.on('change', function () {
            const file = this.files[0];
            if (file && (file.name.endsWith('.docx') || file.name.endsWith('.doc'))) {
                if (file.size <= 5 * 1024 * 1024) {
                    convertBtn.prop('disabled', false);
                } else {
                    alert('حجم الملف يتجاوز الحد الأقصى المسموح به (5 ميجابايت).');
                    convertBtn.prop('disabled', true);
                }
            } else {
                convertBtn.prop('disabled', true);
            }
        });

        $('form').on('submit', function () {
            convertBtn.prop('disabled', true);
            convertBtn.find('.spinner-border').removeClass('d-none');
            convertBtn.find('i').addClass('d-none');
        });

        (function () {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    });
</script>
@endpush
