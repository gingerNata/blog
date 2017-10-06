@extends('layouts.layout')

@section('slider')
    <div class="jumbotron">
        <div class="container">
            <h1>Our blog</h1>
            <p>My new blog</p>
        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        @foreach($posts as $post)
            <aricle>
                <div class="col-md-3">
                    <div class="avatar">
                        <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}" alt="">
                    </div>
                    <p class="author">{{ $post->user->name }}</p>
                    <a href="{{ route('post', ['id' => $post->id]) }}"><img class="img-fluid rounded"
                                                                            src="{{ asset('storage/images/medium/' . $post->image) }}"
                                                                            alt=""></a>
                    <a href="{{ route('post', ['id' => $post->id]) }}"><h3>{{ $post->title }}</h3></a>
                    <p><a href="{{ route('editPost', ['id' => $post->id]) }}" class="btn btn-default">Редагувати</a>
                        <a href="{{ route('deletePost', ['id' => $post->id]) }}" class="btn btn-default">Видалити</a>
                    </p>
                </div>
            </aricle>
        @endforeach
    </div>

@endsection
