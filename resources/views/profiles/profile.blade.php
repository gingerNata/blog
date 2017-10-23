@extends('layouts.layout')



@section('content')

    <div class="container main-content">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h1 class="text-center">{{ $user->name }}</h1>
                <hr>
                <div class="col-md-4">
                    <img class="img-circle" src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Avatar image">

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                    @if($allow)
                    {!! Form::model($user, ['method' => 'PATCH', 'action' => ['Profiles\UserController@updateAvatar'],
                     'enctype' => "multipart/form-data"]) !!}

                    <div class="form-group">
                        {{--                        {!! Form::label('Змінити аватар') !!}--}}
                        {!!  Form::file('avatar', NULL,
                            array('class' => 'pull-right btn btn-sm btn-primary'
                            )) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Змінити',
                          array('class'=>'btn btn-primary')) !!}
                    </div>
                    {{ csrf_field() }}
                    {!! Form::close() !!}
                    @endif
                </div>

                <div class="col-md-4">
                    <div class="e-mail"><b>E-mail:</b> {{ $user->email }}</div>
                    <div class="e-mail"><b>Про себе:</b> {{ $user->about or 'Інформація відсутня'}}</div>
                    <br>
                    @if($allow)
                    <a class="btn btn-primary" href="{{ route('editProfile') }}"> Редагувати профіль</a>
                    @endif
                </div>
                @if($allow)
                <div class="col-md-3">
                    {!! Form::model(Auth::user(), ['method' => 'POST', 'action' => ['Profiles\UserController@delete']]) !!}

                    <div class="form-group">
                        {!! Form::submit('Видалити профіль',
                          array('class'=>'btn btn-danger')) !!}
                    </div>

                    {{ csrf_field() }}
                    {!! Form::close() !!}
                </div>
                @endif
            </div>
        </div>

    </div>
    <div class="container-fluid main-content grey-bg">
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