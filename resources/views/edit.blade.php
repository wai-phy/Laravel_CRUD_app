@extends('master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 my-4 py-3 offset-3 bg-light shadow">
                <div class="">
                    <a class="text-decoration-none my-3" href="{{ route('post#updatePage', $post['id']) }}">
                        <<<< Back To Home</a>
                </div>
                <form action="{{ route('post#update') }}" method="post" enctype="multipart/form-data" >
                    @csrf
                    <div class="form-item my-3">
                        <input type="hidden" name="postId" value="{{ $post['id'] }}" class="form-control">
                    </div>
                    <div class="form-item my-3">
                        <input type="text" name="postTitle" value="{{ old('postTitle', $post['title']) }}"
                            class="form-control  @error('postTitle') is-invalid @enderror" placeholder="Enter Post Title">
                        @error('postTitle')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-item my-3">
                        <textarea name="postDescription" class="form-control @error('postDescription') is-invalid @enderror" cols="30"
                            rows="10" placeholder="Enter Post Description">{{ old('postDescription', $post['description']) }}</textarea>
                        @error('postDescription')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-item my-3">
                        @if ($post['image'] == null)
                            <img src="{{ asset('404.jpg') }}" class="img-thumbnail w-75 my-3">
                        @else
                            <img src="{{ asset('storage/' . $post['image']) }}" class="img-thumbnail w-75 my-3">
                        @endif
                        <label for="" class="form-label">Image</label>
                            <input name="postImage" class="form-control  @error('postImage') is-invalid @enderror" placeholder="Enter Image" type="file">
                        @error('postImage')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-item my-3">
                        <input type="text" name="postFee" value="{{ old('postFee', $post['price']) }}"
                            class="form-control  @error('postFee') is-invalid @enderror" placeholder="Enter Post Fee">
                        @error('postFee')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-item my-3">
                        <input type="text" name="postAddress" value="{{ old('postAddress', $post['address']) }}"
                            class="form-control  @error('postAddress') is-invalid @enderror"
                            placeholder="Enter Post Address">
                        @error('postAddress')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-item my-3">
                        <input type="text" name="postRating" value="{{ old('postRating', $post['rating']) }}"
                            class="form-control  @error('postRating') is-invalid @enderror" placeholder="Enter Post Rating">
                        @error('postRating')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-item me-3">
                        <input class="btn btn-success float-end" type="submit" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
