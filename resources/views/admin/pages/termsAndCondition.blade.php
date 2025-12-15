@extends('admin.layouts.master')

@section('content')

<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Terms & Conditions</h3>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.termsandcondition') }}" method="POST">
                @csrf

                <!-- Title -->
                <div class="form-group mb-3">
                    <label>Title</label>
                    <input type="text" 
                           name="title" 
                           class="form-control"
                           value="{{ $terms->title ?? '' }}"
                           required>
                </div>

                <!-- Description (CKEditor) -->
                <div class="form-group mb-3">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" required>
                        {{ $terms->description ?? '' }}
                    </textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>

            <!-- CKEditor CDN -->
            <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

            <script>
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .catch(error => { console.error(error); });
            </script>

        </div>
    </div>

</div>

@endsection
