@extends('layouts.layout')

@section('body-class')grey-bg @endsection

@section('content')
    <div class="container main-content">
    <h1>{{ $theme_title }}</h1>
    <div class="count">Кількість статей: {{ $count }}</div>
    <div class="col-md-3 col-1">
        <div class="row">
            @if(!empty($posts[1]))
                @foreach($posts[1] as $i => $post)
                    @include('posts.postPreview',['post'=>$post])
                @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-3 col-2">
        <div class="row">
            @if(!empty($posts[2]))
            @foreach($posts[2] as $i => $post)
                @include('posts.postPreview',['post'=>$post])
            @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-3 col-3">
        <div class="row">
            @if(!empty($posts[3]))
            @foreach($posts[3] as $i => $post)
                @include('posts.postPreview',['post'=>$post])
            @endforeach
            @endif
        </div>
    </div>
    <div class="col-md-3 col-4">
        <div class="row">
            @if(!empty($posts[4]))
            @foreach($posts[4] as $i => $post)
                @include('posts.postPreview',['post'=>$post])
            @endforeach
            @endif
        </div>
    </div>
    </div>
@endsection