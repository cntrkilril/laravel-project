<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use App\Models\User;
use Illuminate\Http\Request;

class ThingsController extends Controller
{
    public function index() {
        $things = Thing::simplePaginate(10);
        return view("things.index", ["things" => $things]);
    }

    public function create()
    {
        return view("things.create");
    }

    public function show($id) {
        $thing = Thing::findorFail($id);
        return view('things.view', ['thing' => $thing]);
    }

    public function edit($id) {
        $thing = Thing::findorFail($id);
        return view('things.edit', ['thing' => $thing]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=> ["required", "string"],
            'description'=> ["required", 'string'],
            'wrnt'=> ["required"],
            'id'=>['required']
        ]);

        if ($data['id'] == 'null') {
            $thing = new Thing();

        }
        else {
            $thing = Thing::findorFail($data['id']);
        }

        $data['wrnt'] = str_split($data['wrnt']);
        $new_date = $data['wrnt'][8]."".$data['wrnt'][9].'.'.$data['wrnt'][5]."".$data['wrnt'][6].".".$data['wrnt'][0]."".$data['wrnt'][1]."".$data['wrnt'][2]."".$data['wrnt'][3];

        $thing -> name = $data['name'];
        $thing -> description = $data['description'];
        $thing -> wrnt = $new_date;
        $thing -> master_id = auth()->user()->id;
        $thing->save();

        return redirect('/things/'.$thing->id);
    }

    public function destroy($id) {
        $thing = Thing::findorFail($id);
        Thing::where('id', $id)->delete();
        $thing->delete();
        return redirect('/things');
    }
}
