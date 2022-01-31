<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Thing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::simplePaginate(10);
        return view('places.index', ['places'=>$places]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $place = new Place();
        if (auth()->user()->cannot('update', $place)) {
            abort(403);
        }
        return view("places.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=> ["required", "string"],
            'description'=> ["required", 'string'],
            'status' => ['required'],
            'id' => ['required']
        ]);

        if ($data['id'] == 'null') {
            $place = new Place();
        }
        else {
            $place = Place::findorFail($data['id']);
        }

        if (auth()->user()->cannot('update', $place)) {
            abort(403);
        }

        $place -> name = $data['name'];
        $place -> description = $data['description'];
        if ($data['status'] == 'work') {
            $place -> repair = false;
            $place -> work = true;
        }
        else {
            $place -> repair = true;
            $place -> work = false;
        }
        $place->save();

        return redirect('/places/'.$place->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::findorFail($id);
        return view('places.view', ['place' => $place]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::findorFail($id);
        if (auth()->user()->cannot('update', $place)) {
            abort(403);
        }
        return view('places.edit', ['place' => $place]);
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $place = Place::findorFail($id);
        if (auth()->user()->cannot('update', $place)) {
            abort(403);
        }
        DB::table('use_models')
            ->where('place_id', $id)
            ->delete();
        Place::where('id', $id)->delete();
        $place->delete();
        return redirect('/places');
    }
}
