@extends('layouts.admin')

@section('title', 'إدارة التصنيفات')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-tags me-2"></i> إدارة التصنيفات</h5>
            <a href="{{ route('categories.create') }}" class="btn btn-light">
                <i class="fas fa-plus me-1"></i> إضافة تصنيف
            </a>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if($categories->isEmpty())
            <div class="alert alert-warning text-center">
                لا توجد تصنيفات حالياً.
            </div>
        @else
           <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-light">
                    <tr>
                        <th>اسم التصنيف</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                        <tr class="clickable-row" data-href="{{ route('categories.show', $category->id) }}">
                            <td>{{ $category->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

            @endif
            </div>
            </div>
            @endsection

            @push('styles')
            <style>
                .clickable-row {
                    cursor: pointer;
                }

                .clickable-row:hover {
                    background-color: #535353;
                    transition: background-color 0.2s ease-in-out;
                }

                .table-hovered:hover {
                    box-shadow: 0 0 10px rgba(0, 123, 255, 0.3); /* subtle blue glow */
                    transition: box-shadow 0.3s ease;
                }
            </style>
            @endpush

            @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    document.querySelectorAll('.clickable-row').forEach(function (row) {
                        row.addEventListener('click', function () {
                            window.location.href = this.dataset.href;
                        });
                    });
                });
            </script>
            @endpush
