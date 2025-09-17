@extends('layouts.default')
@section('title', 'Create Notice')

@section('content')
@include('layouts.navbar')
<div class="container mt-5">
    
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- Success / Error Message --}}
            @include('layouts.message')


            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">➕ Create New Notice</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('notice.store')}}" method="POST">

                        @csrf

                        <input type="hidden" name="form_type" value="notice">
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Notice Title</label>
                            <input type="text" 
                                   name="title" 
                                   id="title" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   value="{{ old('title') }}" 
                                   placeholder="Enter notice title" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Notice Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">Notice Description</label>
                            <textarea name="description" 
                                      id="description" 
                                      rows="5" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Write the notice details..." required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                       

                        {{-- Submit Button --}}
                        <div class="d-flex justify-content-between">
                            <a href="" class="btn btn-secondary">⬅ Back</a>
                            <button type="submit" class="btn btn-success">✅ Save Notice</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
