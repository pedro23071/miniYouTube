@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <h2>Crear un nuevo video</h2>
        <hr/>
    <form action="{{ route('saveVideo') }}" method="post" enctype=multipart/form-data class="col-lg-7">
            
        {!! csrf_field() !!}
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

            <div class="form-group">
                <label for="tittle">Titulo</label>
                <input type="text" class="form-control" id="tittle" name="tittle"  value="{{ old('tittle') }}"/>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea type="text" class="form-control" id="description" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Miniatura</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="form-group">
                <label for="video">Archivo del video</label>
                <input type="file" class="form-control" id="video" name="video">
            </div>
            <button type="submit" class="btn btn-success">Crear Video</button>
        </form>
    </div>
</div>



@endsection