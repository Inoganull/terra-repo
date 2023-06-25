@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><strong>{{ $user->name }}'s Profile</strong></h3>

                <ul class="list-group">
                    <li class="list-group-item">
                        <b>Email: {{ $user->email }}</b>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-body">
                <h3 class="card-title"><strong>{{ $user->name }}'s Articles</strong></h3>
                @foreach ($articles as $article)
                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ $article->title }}</strong></h5>
                        <div class="card-subtitle mb-2 text-muted small">
                            {{ $article->created_at->diffForHumans() }}
                        </div>
                        <p class="card-text">{{ $article->body }}</p>
                        <a class="card-link" href="{{ url("/articles/detail/$article->id") }}">
                            View Detail &raquo;
                        </a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>

@endsection

