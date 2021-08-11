@extends('layout')

@section('content')
<form id="article__import" method="post" enctype="multipart/form-data" action="{{ route('article.import') }}">
@csrf
<div class="container-fluid">
    <div class="row">
        
        <div class="col-12">
            <h1>Import Articles</h1>
        </div>

        @if ( ! empty($success) )
        <div class="col-12">
            <p>{{ $success }}</p>
        </div>
        @endif

        @if ( count($errors) > 0 )
        <div class="col-12">
            <p>The following errors have occurred:</p>

            <ul>
            @foreach( $errors->all() as $message )
              <li>{{ $message }}</li>
            @endforeach
            </ul>
        </div>
        @endif

        <div class="col-4">
            
            <div class="input-group">
                <input type="file" name="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                <button class="btn btn-outline-secondary" type="submit" id="inputGroupFileAddon04">Import</button>
            </div>

        </div>

    </div>
</div>
</form>
@endsection