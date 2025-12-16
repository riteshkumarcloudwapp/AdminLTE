@extends('admin.layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header">
                    <h4>Edit Testimonial</h4>
                </div>

                <div class="card-body">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('testimonial.update', $testimonial->id) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ old('name', $testimonial->name) }}"
                                   required>
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="4"
                                      required>{{ old('description', $testimonial->description) }}</textarea>
                        </div>

                        {{-- Designation --}}
                        <div class="mb-3">
                            <label class="form-label">Designation</label>
                            <input type="text"
                                   name="designation"
                                   class="form-control"
                                   value="{{ old('designation', $testimonial->designation) }}"
                                   required>
                        </div>

                        {{-- Existing Image --}}
                        <div class="mb-3">
                            <label class="form-label">Current Image</label><br>
                            @if ($testimonial->images)
                                <img src="{{ asset('uploads/testimonials/' . $testimonial->images) }}"
                                     width="120"
                                     height="120"
                                     style="object-fit:cover;border-radius:6px;">
                            @else
                                <p class="text-muted">No image uploaded</p>
                            @endif
                        </div>

                        {{-- Upload New Image --}}
                        <div class="mb-3">
                            <label class="form-label">Change Image</label>
                            <input type="file"
                                   name="image"
                                   class="form-control">
                        </div>

                        

                        {{-- Buttons --}}
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                Update Testimonial
                            </button>
                            <a href="{{ url('/testimonial') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
