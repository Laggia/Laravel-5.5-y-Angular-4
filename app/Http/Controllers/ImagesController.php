<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use Illuminate\Support\Facades\Response;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
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
        //
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
        //
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
