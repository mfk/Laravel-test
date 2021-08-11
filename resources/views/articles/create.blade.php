@extends('layout')

@section('content')
<form id="article__upsert" method="post" action="@if(!empty($article)){{ route('article.update', [ 'article' => $article ]) }}@else{{ route('article.store') }}@endif">
<div class="container-fluid">
    <div class="row">

        <div class="col-12 mb-3">
            <a class="btn btn-outline-secondary" href="{{ route('article.index') }}" role="button">&lsaquo; back to articles list</a>
        </div>
        <div class="col-10">
        
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="article__title" name="article__title" placeholder="Title" required="true" @if(!empty($article)) value="{{ $article->title }}" @endif>
                <label for="article__title">Title</label>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Text" id="article__text" name="article__text" style="height: 200px;" required="true">@if(!empty($article)){{ $article->title }}@endif</textarea>
                <label for="article__text">Text</label>
            </div>

            <button class="btn btn-success" type="submit">Save</button>

        </div>
        <div class="col-2">
            
            <div class="card">
                <div class="card-header">Categories</div>
                <div class="card-body">

                    <select class="form-select" name="article__categories" multiple>
                        @foreach( $categories as $category )
                        <option value="{{ $category->id }}" @if(!empty($article) && in_array($category->id, $article->categories->pluck('id')->toArray())) selected @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>

                </div>
            </div>

        </div>

    </div>
</div>
</form>
@endsection