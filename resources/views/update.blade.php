@extends('master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-6 offset-3">
                <a class="text-decoration-none my-3" href="{{ route('post#createPage')}}"><<<< Back To Home</a>
                <h3 class="my-4 px-3">{{ $post['title'] }}</h3>
                <hr>
                @if ($post['image']==null)
                    <img src="{{ asset('404.jpg')}}" class="img-thumbnail w-75 my-3">
                @else
                    <img src="{{ asset('storage/'.$post['image'])}}" class="img-thumbnail w-75 my-3">
                @endif
                <p class="my-4 px-3">{{ $post['description'] }}</p>
                <span>
                    <small><i class="fa-solid fa-dollar-sign"></i> {{ $post['price'] }} Kyats </small>
                </span> |
                <span>
                    <i class="fa-solid fa-location-dot"></i> {{ $post['address'] }}
                </span> |
                <span>
                    {{ $post['rating'] }} <i class="fa-solid fa-star text-warning"></i>
                </span>
            </div>
            <div class="row">
                <div class="col-3 offset-8">
                    <a href="{{ route('post#editPage',$post['id'])}}">
                        <button class="btn btn-success" type="submit">Edit</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection