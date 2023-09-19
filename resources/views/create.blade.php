@extends('master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                @if (session('insertSuccess'))
                    <div class="alert-message">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('insertSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session('updateSuccess'))
                    <div class="alert-message">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('updateSuccess') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                <div class="p-4 bg-light shadow">
                    <form action="{{ route('post#create') }}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="text-group">
                            <label for="" class="form-label">Title</label>
                            <input type="text" name="postTitle"
                                class="form-control @error('postTitle') is-invalid @enderror"
                                placeholder="Enter Title Name">
                            @error('postTitle')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror


                        </div>
                        <div class="text-group">
                            <label for="" class="form-label">Description</label>
                            <textarea name="postDescription" cols="30" rows="10"
                                class="form-control @error('postDescription') is-invalid @enderror" placeholder="Enter Description"></textarea>
                            @error('postDescription')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-group">
                            <label for="" class="form-label">Image</label>
                            <input name="postImage" class="form-control" placeholder="Enter Image" type="file">

                        </div>
                        <div class="text-group">
                            <label for="" class="form-label">Fee</label>
                            <input name="postFee" class="form-control @error('postFee') is-invalid @enderror"
                                placeholder="Enter Fee" type="number">
                            @error('postFee')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-group">
                            <label for="" class="form-label">Address</label>
                            <input name="postAddress" class="form-control @error('postAddress') is-invalid @enderror"
                                placeholder="Enter Address" type="text">
                            @error('postAddress')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-group">
                            <label for="" class="form-label">Rating</label>
                            <input name="postRating" min="1" max="5"
                                class="form-control @error('postRating') is-invalid @enderror" placeholder="Enter Rating"
                                type="number">
                            @error('postRating')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <input type="submit" value="Create" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-7 ">
                <div class="data-container">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-4">
                                <h3>Total= {{ $posts->total() }}</h3>
                            </div>
                            <div class="col-4 offset-4">
                                <form action="{{ route('post#createPage') }}" method="get">
                                    <div class="row">
                                        <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                                            class="col-7" placeholder="Search Here .....">
                                        <button type="submit" class="btn btn-primary col-2"><i
                                                class="fa-solid fa-magnifying-glass "></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($posts) != 0)
                    @foreach ($posts as $item)
                        <div class="p-3 mb-2 bg-light shadow">
                            <div class="row">
                                <h3 class="col-8">{{ $item->title }}</h3>
                                <h6 class="col-4">{{ $item['created_at']->format('j-F-Y') }}</h6>
                            </div>
                            <p>{{ Str::words($item['description'], 15, '...') }}</p>
                            <span>
                                <small><i class="fa-solid fa-dollar-sign"></i> {{ $item->price }} Kyats </small>
                            </span> |
                            <span>
                                <i class="fa-solid fa-location-dot"></i> {{ $item->address }}
                            </span> |
                            <span>
                                {{ $item->rating }} <i class="fa-solid fa-star text-warning"></i>
                            </span>

                            <div class="text-end ">
                                <a class="btn btn-sm btn-danger" href="{{ route('post#delete', $item['id']) }}"><i
                                        class="fa-solid fa-trash"></i></a>
                                <a class="btn btn-sm btn-info" href="{{ route('post#updatePage', $item['id']) }}"><i
                                        class="fa-solid fa-file-invoice"></i></a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4 class="text-danger text-center mt-5">There is No Data Here .....</h4>
                @endif
                {{ $posts->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
