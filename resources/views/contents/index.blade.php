@extends('layouts.admin')

@section('title', 'إدارة المحتوى')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">إدارة المحتوى</h5>
            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#createOptionsModal">
                <i class="fas fa-plus me-2"></i> إضافة جديد
            </button>
        </div>
    </div>

    <div class="card-body">
        <div class="list-group">
            @foreach($contents as $content)
                @php
                    $decoded = json_decode($content->text, true);

                    // استخلاص HTML من JSON
                    $html = is_array($decoded) && isset($decoded['html']) 
                        ? $decoded['html'] 
                        : (is_string($decoded) ? $decoded : $content->text);

                    // إزالة <style> أو PHPWord
                    $clean = preg_replace('/<style\b[^>]*>(.*?)<\/style>/is', '', $html);
                    $clean = str_replace('PHPWord', '', $clean);

                    // إزالة جميع وسوم HTML وتحويل الكيانات
                    $plainText = strip_tags(html_entity_decode($clean));

                    // تحديد طول المعاينة
                    $previewText = \Illuminate\Support\Str::limit(trim($plainText), 120);
                @endphp

                <a href="{{ route('content.details', $content->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $content->title ?? 'بدون عنوان' }}</h5>
                        <small>{{ $content->created_at?->diffForHumans() ?? 'لا يوجد تاريخ' }}</small>
                    </div>
                    <p class="mb-1 text-muted" dir="rtl" style="text-align: right;">
                        {{ $previewText }}
                    </p>
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="createOptionsModal" tabindex="-1" aria-labelledby="createOptionsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createOptionsModalLabel">كيف تريد إضافة المحتوى؟</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="option-card" onclick="window.location.href='{{ route('contents.create') }}'">
                            <i class="fas fa-edit"></i>
                            <h5 class="mt-2">كتابة يدوية</h5>
                            <p class="text-muted">إنشاء محتوى جديد بالكتابة المباشرة</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="option-card" onclick="window.location.href='{{ route('upload.showForm') }}'">
                            <i class="fas fa-file-upload"></i>
                            <h5 class="mt-2">رفع ملف</h5>
                            <p class="text-muted">استيراد محتوى من ملف خارجي</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.option-card').on('click', function () {
            $('#createOptionsModal').modal('hide');
        });
    });
</script>
@endpush
