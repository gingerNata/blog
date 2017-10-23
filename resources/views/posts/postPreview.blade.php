<div class="post-preview">
    <aricle>
        <div class="author">
            <div class="author-image">
                <a href="{{ route('authorPage', $post->user->id) }}">
                    <img src="{{ asset('storage/avatars/' . $post->user->avatar) }}" alt="">
                </a>
            </div>
            <p class="author">
                <a href="{{ route('authorPage', $post->user->id) }}">
                    {{ $post->user->name }}
                </a>
            </p>
        </div>
        <div class="preview-image">
            <a href="{{ route('post', ['id' => $post->id]) }}">
                <img class="img-fluid rounded" src="{{ asset('storage/images/medium/' . $post->image) }}" alt="">
            </a>
        </div>
        <a href="{{ route('post', ['id' => $post->id]) }}"><h3>{{ $post->title }}</h3></a>

        <div class="bottom-article">
            <p class="views"><span>{{ $post->views }}</span></p>
            <div class="likes">
                <button class="like-btn {{ in_array($post->id,Cookie::get('post')) ? 'active' : ''}}"
                        id="like-{{ $post->id }}"
                        onclick="likePost({{ $post->id }})"></button>
                <span id="count-likes-{{ $post->id }}"> {{ $post->votes }}</span>
            </div>
        </div>
        @if (Gate::allows('post-owner', $post))
            <div class="btn-group btn-group-justified" role="group">
                <a href="{{ route('editPost', ['id' => $post->id]) }}" class="btn btn-default">Редагувати</a>
                <a href="{{ route('deletePost', ['id' => $post->id]) }}" class="btn btn-danger">Видалити</a>
            </div>
        @endif
    </aricle>
</div>

