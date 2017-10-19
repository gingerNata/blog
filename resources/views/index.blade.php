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



@endsection


