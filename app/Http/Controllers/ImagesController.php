<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Response;
use DB;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = DB::table('images')->orderBy('id','desc')->get();
        $response = Response::json($images, 200);
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if((!$request->title) || (!$request->thumbnail) || (!$request->imageLink)){
            $response = Response::json([
                'message' => 'Por favor escriba todos los campos requeridos'
            ], 200); //error 422 pero no pasara mensaje
            return $response;
        }

        $image = new Image(array(
            'thumbnail' => trim($request->thumbnail),
            'imageLink' => trim($request->imageLink),
            'title' => trim($request->title),
            'description' => trim($request->description),
            'user_id' => 1
        ));

        $image->save();

        $message = 'Su imagen ha sido añadida de modo correcto';

        $response = Response::json([
            'message' => $message,
            'data' => $image,
        ], 201);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $image = Image::find($id);

        if(!$image){
            return Response::json([
                'error' => [
                    'message' => "No se ha encontrado la imagen."
                ]
            ], 404);
        }

        return Response::json($image, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if((!$request->title) || (!$request->thumbnail) || (!$request->imageLink)){
            $response = Response::json([
                'message' => 'Por favor escriba todos los campos requeridos'
            ], 200); //error 422 pero no pasara mensaje
            return $response;
        }

        $image = Image::find($id);

        if(!$image){
            return Response::json([
                'error' => [
                    'message' => "No se ha encontrado la imagen."
                ]
            ], 404);
        }

        $image->thumbnail = trim($request->thumbnail);
        $image->imageLink = trim($request->imageLink);
        $image->title = trim($request->title);
        $image->description = trim($request->description);
        $image->save();

        $message = 'La imagen ha sido actualizada de modo correcto';

        $response = Response::json([
            'message' => $message,
            'data' => $image,
        ], 201);

        return $response;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
