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
    @foreach($posts as $i => $post)
            @if($i%4 == 1 || $i == 0)<div class="row">@endif
{{ $i }}
        <aricle>
            <div class="col-md-3 post-preview">
                <div class="author">
                    <a href="{{ route('authorPage', $post->user->id) }}">
                        <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}" alt="">
                    </a>
                </div>
                <p class="author">
                    <a href="{{ route('authorPage', $post->user->id) }}">
                        {{ $post->user->name }}
                    </a>
                </p>
                <a href="{{ route('post', ['id' => $post->id]) }}"><img class="img-fluid rounded"
                                                                        src="{{ asset('storage/images/medium/' . $post->image) }}"
                                                                        alt=""></a>
                <a href="{{ route('post', ['id' => $post->id]) }}"><h3>{{ $post->title }}</h3></a>

                <div class="bottom-article">
                    <p class="views"><span>{{ $post->views }}</span></p>
                    <div class="likes">
                        <button class="like-btn {{ Cookie::has('post_' . $post->id) ? 'active' : ''}}"
                                id="like-{{ $post->id }}"
                                onclick="likePost({{ $post->id }})"></button>
                        <span id="count-likes-{{ $post->id }}"> {{ $post->votes }}</span>
                    </div>
                </div>
                {{--<p><a href="{{ route('editPost', ['id' => $post->id]) }}" class="btn btn-default">Редагувати</a>--}}
                {{--<a href="{{ route('deletePost', ['id' => $post->id]) }}" class="btn btn-default">Видалити</a>--}}
                {{--</p>--}}
            </div>
        </aricle>

            @if($i%4 == 1 || $i == count($posts))</div>@endif

            @endforeach


@endsection
