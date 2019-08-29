@extends('layouts.app')
@section('content')
<div class="col-md-10 col-md-offset-1">
     <h2 class="">{{$video->title}}</h2>
     <hr/>
     <div class="col-md-8">
           <!--Video -->
     <video controls autoplay id="video-player">
        <source src="{{route('fileVideo', ['filename' => $video->video_path] )}}" />
        videoPlayer 
     </video>
           <!--descripcion -->
     <div class="panel panel-default video-data">
          <div class="panel-heading">
               <div class="panel-title">
               Subido por <strong>{{$video->user->name." ".$video->user->surname}}</strong>{{\FormatTime::LongTimeFilter($video->created_at)}}                                           
               </div>                    
          </div>
          <div class="panel-body">
               {{$video->description}}                                          
          </div>
     </div>
           <!--Comentario -->
          
           @include('video.comments')
          
     </div>
</div>
@endsection