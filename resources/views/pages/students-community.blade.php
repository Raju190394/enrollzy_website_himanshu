@extends('layouts.master')

@section('title', 'Community')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/community/intro.css') }}">
    <link rel="stylesheet" href="{{ asset('css/community/multiple-department.css') }}">
    <link rel="stylesheet" href="{{ asset('css/community/post.css') }}">
    <link rel="stylesheet" href="{{ asset('css/community/community.css') }}">
@endpush

@section('content')
    <section>
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show container mt-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @include('community.intro')
            @include('community.multiple-department')
            @include('community.post')
        </div>
    </section>

    <!-- Ask Question Modal -->
    <div class="modal fade" id="askQuestionModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold">Ask a Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('community.questions.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Category</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Your Question</label>
                            <textarea name="question_text" class="form-control" rows="5" placeholder="Type your question here... Please be specific." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Image (Optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="submit" class="btn btn-theme-one px-4">Post Question</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script src="{{ asset('js/student-community.js') }}"></script>
    <script src="{{ asset('js/multiple-department.js') }}"></script>
@endpush