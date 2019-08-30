<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Video;
use App\Comment;


class VideoController extends Controller
{
   public function createVideo(){
       return view('video.createVideo');
   }

   public function saveVideo(Request $request){

       //validar formilario /crear-video
       $validateData = $this->validate($request, [
       'tittle' => 'required|min:5',
       'description' => 'required',
       'video' => 'mimes:mp4'
       ]);

       $video = new Video();
       $user = \Auth::user();
       $video->user_id = $user->id;
       $video->title = $request->input('tittle');
       $video->description = $request->input('description');

        //Subir la miniatura 
        $image  = $request->file('image');
            if ($image) {
                $image_path = time().$image->getClientOriginalName();   //le concateno el time y obtengo el nombre original
                \Storage::disk('images')->put($image_path, \File::get($image)); //al disk carpeta images le paso la fecha concatenada con el nombre y el rachivo que obtube en el formulario 

                $video->image = $image_path;
            }
        //Subir el video 
        $video_file  = $request->file('video');
            if ($video_file) {
                $video_path = time().$video_file->getClientOriginalName();   //le concateno el time y obtengo el nombre original
                \Storage::disk('videos')->put($video_path, \File::get($video_file)); //al disk carpeta images le paso la fecha concatenada con el nombre y el rachivo que obtube en el formulario 
        
                $video->video_path = $video_path;
            }

       $video->save();

       return redirect()->route('home')->with(array(
            'message' => 'El video se ha subido correctamente'
       ));
    } 
    //obtener las imagenes del disk
    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    //detalles de video
    public function getVideoDetail($video_id){
        $video = Video::find($video_id);

        return view('video.detail', array(
            'video' => $video
        ));
    }

        //obtener las video del disk
        public function getVideo($filename){
            $file = Storage::disk('videos')->get($filename);
            return new Response($file, 200);
        }

        public function delete($video_id){
            $user = \Auth::user();
            $video = Video::find($video_id);
            $comments = Comment::where('video_id', $video_id)->get();
            
    
            if($user && $video->user_id == $user->id){
                
                //eliminar los comentarios 
                if ($comments && count($comments) >= 1) {
                    foreach ($comments as $comment) {
                        $comment->delete();
                    }
                }
               

                //eliminar archovos de laraval (imagen y el video)
                storage::disk('images')->delete($video->image);
                storage::disk('videos')->delete($video->video_path);

                //eliminar el video 
                $video->delete();
                
                $message = array('message'=>'Video eliminado correctamente');
            }else {
                $message = array('message'=>'El video no se ha eliminado');
            }



            return redirect()->route('home')->with($message);
        }


        public function edit($video_id){

            $user = \Auth::user();
            $video = Video::find($video_id);

            if($user && $video->user_id == $user->id){
                
                return view('video.edit',array('video' => $video));
            }else {
                return redirect()->route('home');
            }

        }


    public function update($video_id, Request $request){

         //validar formilario /crear-video
       $validateData = $this->validate($request, [
        'tittle' => 'required|min:5',
        'description' => 'required',
        'video' => 'mimes:mp4'
        ]);

        $user = \Auth::user();
        $video = Video::find($video_id);
        $video->user_id = $user->id;
        $video->title = $request->input('tittle');
        $video->description = $request->input('description');

        $image  = $request->file('image');
        if ($image) {
            $image_path = time().$image->getClientOriginalName();   //le concateno el time y obtengo el nombre original
            \Storage::disk('images')->put($image_path, \File::get($image)); //al disk carpeta images le paso la fecha concatenada con el nombre y el rachivo que obtube en el formulario 

            $video->image = $image_path;
        }

         //Subir el video 
         $video_file  = $request->file('video');
         if ($video_file) {
             $video_path = time().$video_file->getClientOriginalName();   //le concateno el time y obtengo el nombre original
             Storage::disk('videos')->put($video_path, \File::get($video_file)); //al disk carpeta images le paso la fecha concatenada con el nombre y el rachivo que obtube en el formulario 
     
             $video->video_path = $video_path;
         }

    $video->update();

    return redirect()->route('home')->with(array(
         'message' => 'El video se ha actualizado correctamente'
    ));


    }
    

}
