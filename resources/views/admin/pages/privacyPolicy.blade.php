@extends('admin.layouts.master')

@section('content')

<div class="container mt-4">

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Privacy Policy</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.privacypolicy') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="form-group mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="form-control"
                           value="{{ $policy->title ?? '' }}"
                           placeholder="Enter title" required>
                </div>

                <!-- Description (CKEditor) -->
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Description</label>

                    <textarea name="description" 
                              id="description" 
                              class="form-control"
                              placeholder="Write the full privacy policy here..." required>
                        {{ $policy->description ?? '' }}
                    </textarea>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">Save</button>
            </form>

            <!-- CKEditor -->
            <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

            <script>
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .catch(error => {
                        console.error(error);
                    });
            </script>

        </div>
    </div>

</div>

@endsection
