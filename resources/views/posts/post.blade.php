@extends('layouts.layout')
@section('content')
    <div class="container-fluid main-content">
        <!-- Pagecontent Content -->
        @if (Gate::allows('post-owner', $data['post']))
            <div class="">
                <a class="btn-default btn" href="{{ route('editPost', $data['post']->id) }}">Редагувати</a>
                <a href="{{ route('deletePost', ['id' => $data['post']->id]) }}" class="btn btn-danger">Видалити</a>
            </div>
        @endif
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8 blog-main">
                    <div class="sharethis-inline-share-buttons"></div>
                    <article>
                        <div class="row">
                        <div class="post-submitted-info col-md-1 hidden-sm hidden-xs">

                            <div class="submitted-date">
                                <div class="month">{{ date('M', strtotime($data['post']->created_at)) }}</div>
                                <div class="day">{{ date('d', strtotime($data['post']->created_at)) }}</div>
                                <div class="year">{{ date('Y', strtotime($data['post']->created_at)) }}</div>
                            </div>
                        </div>
                        <div class="main-content custom-width col-md-11">
                            <h1 class="mt-4">{{ $data['post']->title }}</h1>
                            <p class="lead">
                                Автор: <a
                                        href="{{ route('authorPage', $data['author']->id) }}">{{ $data['post']->user->name }}</a>
                            </p>
                            <p class="views"><span>{{ $data['post']->views }}</span></p>
                            <hr>
                            <!-- Preview Image -->
                            <img class="img-fluid img-responsive rounded"
                                 src="{{ asset('storage/images/big/' . $data['post']->image) }}"
                                 alt="">
                            <hr>
                            <!-- Post Content -->
                            <p class="lead">
                                {!!  $data['post']->body !!}
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
</div>
                    </article>
                </div>
                <div class="col-md-4 col-xs-12 sidebar">
                    <div class="sidebar-module sidebar-module-popular-posts">
                        <hr>
                        <h3 class="block-title">Популярні</h3>
                        <hr>
                        @foreach($data['popular_posts'] as $popular_post)
                            <div class="row">
                                <div class="col-sm-offset-1 col-sm-4 col-xs-12 tr-image">
                                    <a href="{{ route('post', ['id' => $popular_post->id]) }}">
                                        <img class="img-fluid rounded"
                                             src="{{ asset('storage/images/medium/' . $popular_post->image) }}"
                                             alt="">
                                    </a>
                                    <div class="date text-muted">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        {{ date('j-m-Y', strtotime($data['post']->created_at)) }}
                                    </div>
                                </div>
                                <div class="col-sm-7 col-xs-12 tr-title">
                                    <a href="{{ route('post', ['id' => $popular_post->id]) }}">
                                        <h4>{{ $popular_post->title }}</h4>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="sidebar-module">
                        <hr>
                        <h3 class="block-title">Соціальні мережі</h3>
                        <hr>
                        <div class="social-links">
                            <div class="social">
                                <a href="#" class="link facebook" target="_parent"><span
                                            class="fa fa-facebook-square"></span></a>
                                <a href="#" class="link twitter" target="_parent"><span
                                            class="fa fa-twitter"></span></a>
                                <a href="#" class="link vk-plus" target="_parent"><span
                                            class="fa fa-vk-plus-square"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-module">
                        <hr>
                        <h3 class="block-title">Популярні теми</h3>
                        <hr>
                        <ul>
                            @foreach($data['themes'] as $theme)
                                <li><a href="{{ route('postsByTheme', $theme->id) }}">{{ $theme->title }}</a>
                                    <span class="text-muted">({{ $theme->count }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


@section('bottom-content')
    <div class="row">
        <h3 class="block-title">Нові статті</h3>
        <hr>
        @foreach($data['new_posts'] as $new_post)
            <div class="col-md-3">
                <a href="{{ route('post', ['id' => $new_post->id]) }}">
                    <img class="img-fluid rounded" src="{{ asset('storage/images/medium/' . $new_post->image) }}"
                         alt="">
                </a>
                <a href="{{ route('post', ['id' => $new_post->id]) }}">
                    <h4>{{ $new_post->title }}</h4>
                </a>
            </div>
        @endforeach
    </div>
@endsection