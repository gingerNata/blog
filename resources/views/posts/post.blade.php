@extends('layouts.layout')
@section('content')
    <!-- Pagecontent Content -->
    <div class="form-control">
        <a class="btn-default btn" href="{{ route('editPost', $data['post']->id) }}">Редагувати</a>
    </div>
    <div class="container">

        <div class="row">
            <!-- Post Content Column -->
            <div class="col-lg-8">
                <div class="sharethis-inline-share-buttons"></div>
                <article>
                    <div class="post-submitted-info">

                        <div class="submitted-date">
                            <div class="month">{{ date('M', strtotime($data['post']->created_at)) }}</div>
                            <div class="day">{{ date('d', strtotime($data['post']->created_at)) }}</div>
                            <div class="year">{{ date('Y', strtotime($data['post']->created_at)) }}</div>
                        </div>
                    </div>
                    <div class="main-content custom-width">
                        <h1 class="mt-4">{{ $data['post']->title }}</h1>
                        <p class="lead">
                            Автор: <a href="{{ route('authorPage', $data['author']->id) }}">{{ $data['post']->user->name }}</a>
                        </p>
                        <p class="views"><span>{{ $data['post']->views }}</span></p>
                        <hr>
                        <!-- Preview Image -->
                        <img class="img-fluid rounded" src="{{ asset('storage/images/big/' . $data['post']->image) }}"
                             alt="">
                        <hr>
                        <!-- Post Content -->
                        <p class="lead">
                            {{ $data['post']->body }}
                        </p>
                        <p> Тема: {{ $data['theme']->title }}</p>

                        <div class="likes">
                            <button class="like-btn {{ $data['like'] }}" id="like-{{ $data['post']->id }}"
                                    onclick="likePost({{ $data['post']->id }})"></button>
                            <span id="count-likes-{{ $data['post']->id }}"> {{ $data['post']->votes }}</span>
                            <div class="sharethis-inline-share-buttons"></div>
                        </div>

                        <script type="text/javascript"
                                src="//platform-api.sharethis.com/js/sharethis.js#property=59d61a1420f64600117cead7&product=inline-share-buttons"></script>
                    </div>

                </article>
            </div>
        </div>
    </div>
@endsection