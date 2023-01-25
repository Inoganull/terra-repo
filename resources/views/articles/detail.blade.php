@extends("layouts.app")

@section("content")
    <div class="container">
    @if(session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title"><strong>{{ $article->title }}</strong></h5>
                <div class="card-subtitle mb-2 text-muted small">
                    {{ $article->created_at->diffForHumans() }}, 
                    By <b>{{ $article->user->name }}</b>,
                    Category: <b>{{ $article->category->name }}</b>
                </div>
                <p class="card-text">{{ $article->body }}</p>
                <a class="btn btn-info" href="{{ url("/articles") }}">
                    Back
                </a>
                @auth
                <a class="btn btn-warning" href="{{ url("/articles/detail/edit/$article->id") }}">
                    Edit
                </a>
                <a class="btn btn-danger" href="{{ url("/articles/delete/$article->id") }}">
                    Delete
                </a>
                @endauth
            </div>
        </div>

        <ul class="list-group mb-2">
            <li class="list-group-item active">
                <b>Comments ({{ count($article->comments) }})</b>
            </li>
            @foreach($article->comments as $comment)
                <li class="list-group-item">
                    <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end" ></a>
                    {{ $comment->content }}
                    <div class="small mt-2">
                        By <b>{{ $comment->user->name }}</b>, 
                        {{ $comment->created_at->diffForHumans() }}
                    </div>
                </li>
            @endforeach
        </ul>

        @auth
        <form action="{{ url('/comments/add')}}" method="POST">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-secondary">
        </form>
        @endauth
    </div>
@endsection