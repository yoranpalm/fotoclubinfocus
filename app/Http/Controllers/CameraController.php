<?php

namespace App\Http\Controllers;

use App\Camera;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cameras = \App\Camera::all();
        return view('pages.home')->with(["cameras" => $cameras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.newCameraForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            "cameraMerk.required" => "Merk van camera is verplicht"
        ];

        $data = request()->validate([
            'cameraMerk' => ['required'],
            'cameraType' => []
        ], $message);

        Camera::create($data);
        return redirect("/foto/create")->with("upload", "Camera is aangemaakt");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function show(Camera $camera)
    {
        return view('pages.user')->with(["camera" => $camera]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function edit(Camera $camera)
    {
        return view('pages.users.newCameraForm')->with(["camera" => $camera]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camera $camera)
    {
        $data = request()->validate([
            'cameraMerk' => ['required', 'string'],
            'cameraType' => ['string']
        ]);


        $camera->update($data);
        return redirect('/foto/create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Camera $camera)
    {
        $camera->delete();
        return redirect('pages.home');
    }
}
