@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="container">
            @if(session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="video-list">
                @foreach ($videos as $video)
                <div class="video-item col-md-10 pull-left panel panel-default">
                    <div class="panel-body">
                        <!--imagen del video  -->
                        @if (Storage::disk('images')->has($video->image))
                        <div class="video-image-thumb col-md-4 pull-left">
                            <div class="">
                                <img class="img-fluid video-image" src="{{url('/miniatura/'.$video->image)}}" alt=""/>
                            </div>        
                        </div>
                        @endif
                        <div class="data">                   
                            <h4 class="video-tittle text-left"><a href="{{ route('detailVideo', ['video_id' => $video->id] )}}">{{$video->title}}</a></h4>
                            <p>{{$video->user->name.' '.$video->user->surname}}</p>
                        </div>  
                        <!--botones de accion  -->
                        <div class="buttns">
                            <a href="#" class="btn btn-success">Ver</a>
                            @if (Auth::check() && Auth::user()->id == $video->user->id)
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Eliminar</a>
                            @endif
                        </div>
                    </div>
                </div>     
                @endforeach
            </div>
        </div>
        {{$videos->links()}}
    </div>
</div>
@endsection
