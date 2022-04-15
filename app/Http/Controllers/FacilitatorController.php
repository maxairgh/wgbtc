<?php

namespace App\Http\Controllers;

use App\Models\Facilitator;
use Illuminate\Http\Request;
use Vimeo\Laravel\Facades\Vimeo;

class FacilitatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facilitator  $facilitator
     * @return \Illuminate\Http\Response
     */
    public function show(Facilitator $facilitator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facilitator  $facilitator
     * @return \Illuminate\Http\Response
     */
    public function edit(Facilitator $facilitator)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facilitator  $facilitator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facilitator $facilitator)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facilitator  $facilitator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facilitator $facilitator)
    {
        //
    }

    public function uploadVideo(Request $request){
      
        dd($request);
        // Upload videos.
        $url = Vimeo::upload($request->file('Nfile'),[
            'name' => 'Test video',
            'description' => 'test video uploaded.',
        ]
    );
    dd($url);
        $validated = $request->validate([
            'nContentId' => ['required','integer'],  
            'Nfile' => ['required'],  //'mimetypes:video/mp4,video/x-msvideo','max:500000'
        ]);
        
        dd($validated['Nfile']); 

        $done = Content::where('id',$this->nContentId)->update([
             'video' => $this->Nfile,
             'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }

}
