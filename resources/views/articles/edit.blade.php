@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card-header">
            <h5>Edit & Update </h5>
        </div>

        <form action="{{ url('/articles/detail/update', $article->id)}}" method="POST">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $article->title }}" class="form-control">
            </div>
            <div class="mb-3">
                <label>Body</label>
                <textarea name="body" class="form-control">{{ $article->body }}</textarea>
            </div>
            <div class="mb-3">
                <label>Category</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <a class="btn btn-primary" href="{{ url("/articles/detail/$article->id") }}">
                Back
            </a>
            <input type="submit" value="Update" class="btn btn-success">
        </form>
    </div>
    
@endsection