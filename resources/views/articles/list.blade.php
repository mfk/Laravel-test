@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        
        <div class="col-12">
            <h1>Articles <a class="btn btn-success" href="{{ route('article.create') }}" role="button">Add new</a> <a class="btn btn-outline-secondary" href="{{ route('api.article.export') }}" role="button" target="_blank">Export</a></h1>
        </div>
        <div class="col-12">

            @if ( $articles->total() > 0 )
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th class="col">#</th>
                        <th class="col">Title</th>
                        <th class="col">User</th>
                        <th class="col">Categories</th>
                        <th class="col">Date</th>
                        <th class="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->user->name }}</td>
                        <td>
                            @foreach($article->categories as $category)
                                {{ $category->title }}@if (!$loop->last), @endif
                            @endforeach
                        </td>
                        <td>{{ $article->updated_at->format('H:i d-m-Y') }}</td>
                        <td>
                            <a href="{{ route('article.edit', [ 'article' => $article ]) }}">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>#</td>
                        <td>Title</td>
                        <td>User</td>
                        <td>Categories</td>
                        <td>Date</td>
                        <td>&nbsp;</td>
                    </tr>
                </tfoot>
            </table>
            @else
            <p>No articles available</p>
            @endif

        </div>

        {!! $articles->links() !!}

    </div>
</div>
@endsection