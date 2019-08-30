@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    <h2>Editar {{$video->title}}</h2>
      <hr/>
      <form action="{{ route('updateVideo',['video_id' => $video->id]) }}" method="post" enctype=multipart/form-data class="col-lg-7">
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
                     <input type="text" class="form-control" id="tittle" name="tittle"  value="{{ $video->title }}"/>
                  </div>
                  <div class="form-group">
                     <label for="description">Description</label>
                          <textarea type="text" class="form-control" id="description" name="description">{{ $video->description }}</textarea>
                  </div>
                  <div class="form-group">
                        <p for="image">Miniatura:</p>
                        @if (Storage::disk('images')->has($video->image))
                            <div class="video-image-thumb col-md-4 pull-left">
                                <div class="">
                                     <img class="img-fluid video-image" src="{{url('/miniatura/'.$video->image)}}" alt=""/>
                                 </div>        
                           </div>
                       @endif
                       <br>
                          <input type="file" class="form-control" id="image" name="image">
                          
                   </div>
                  <div class="form-group">
                       <p for="video">Archivo del video:</p>
                       <video controls autoplay id="video-player">
                            <source src="{{route('fileVideo', ['filename' => $video->video_path] )}}" />
                            videoPlayer 
                       </video><br>
                       
                       <input type="file" class="form-control" id="video" name="video">
                  </div>
                        <button type="submit" class="btn btn-success">Editar Video</button>
      </form>
    </div>
</div>
                                           


@endsection