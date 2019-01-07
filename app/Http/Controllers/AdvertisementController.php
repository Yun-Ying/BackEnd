<?php

namespace App\Http\Controllers;

use App\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $advertisements_Biggest = Advertisement::orderBy('id', 'asc')->take(5)->get();
        $slider = Advertisement::where('id', '>' , 5)->where('is_used', '=', 2)->get();
        $rotation = Advertisement::where('id', '>' , 5)->where('is_used', '=', 1)->get();
        $normal = Advertisement::where('id', '>' , 5)->where('is_used', '=', 0)->get();


        $data = [
            'bigs' => $advertisements_Biggest,
            'sliders' => $slider,
            'rotations' => $rotation,
            'normals' => $normal,
        ];


        return view('advertisements.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('advertisements.create');
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
        //dd($request);
        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
            'file' => 'required|image',
        ]);

        $tempAd = new Advertisement([
            'name' => $request->input('name'),
            'url' => $request->input('url'),
            'is_used' => $request->input('is_used'),
            'file_path' => '',
        ]);

        if($request->has('duration_left'))
        {
            $tempAd->duration_left = $request->input('duration_left');
        }

        $tempAd->save();

        $request->file('file')->storeAs('public/advertisements', 'advertisement'.$tempAd->id.'.jpg');
        $file_path = asset('storage/advertisements/advertisement'.$tempAd->id.'.jpg');

        $tempAd->file_path = $file_path;

        $tempAd->save();

        return redirect()->route('advertisements.index');

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
    public function edit(Advertisement $advertisement)
    {
        //
        $data =[
            'advertisement' => $advertisement,
        ];

        return view('advertisements.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        //

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required|url',
        ]);



        //change the image
        $advertisement->update($request->all());
        if($request->has('file'))
        {
            $request->file('file')->storeAs('public/advertisements', 'advertisement'.$advertisement->id.'.jpg');
            $file_path = asset('storage/advertisements/advertisement'.$advertisement->id.'.jpg');
            $advertisement->file_path = $file_path;
            $advertisement->save();
        }
        return redirect()->route('advertisements.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        //
        if(file_exists(public_path().'/storage/advertisements/advertisement'.$advertisement->id.'.jpg'))
        {
            Storage::delete('public/advertisements/advertisement'.$advertisement->id.'.jpg');
        }


        $advertisement->delete();

        return redirect()->route('advertisements.index');
    }
}
