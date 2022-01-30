<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use App\Models\User;
use App\Models\UseModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThingsController extends Controller
{
    public function index() {
        $things = Thing::simplePaginate(10);
        return view("things.index", ["things" => $things]);
    }

    public function indexMy() {
        $things = Thing::where('master_id',auth()->user()->id)->get();
        return view('things.indexMy', ['things'=>$things]);
    }

    public function indexRepair() {
        $things = DB::table('use_models')
            ->join('places', 'use_models.place_id','=','places.id')
            ->join('things', 'use_models.thing_id', '=', 'things.id')
            ->where('places.repair', '1')
            ->select('things.*')
            ->get();
        return view('things.indexRepair', ['things'=>$things]);
    }

    public function indexWork() {
        $things = DB::table('use_models')
            ->join('places', 'use_models.place_id','=','places.id')
            ->join('things', 'use_models.thing_id', '=', 'things.id')
            ->where('places.work', '1')
            ->select('things.*')
            ->get();
        return view('things.indexWork', ['things'=>$things]);
    }

    public function indexUsed() {
        $things = DB::table('things')
            ->join('use_models', 'things.id', '=', 'use_models.thing_id')
            ->select('things.*')
            ->get();
        return view('things.indexUsed', ['things'=>$things]);
    }

    public function indexTaken() {
        $things = DB::table('things')
            ->join('use_models', 'things.id', '=', 'use_models.thing_id')
            ->where('use_models.user_id', auth()->user()->id)
            ->select('things.*')
            ->get();
        return view('things.indexTaken', ['things'=>$things]);
    }

    public function create()
    {
        return view("things.create");
    }

    public function show($id) {
        $thing = Thing::findorFail($id);
        $uses = [new UseModel()];
        $free_count = 0;
        if (UseModel::where('thing_id', $id)->exists()) {
            $uses = UseModel::where('thing_id', $id)->get();
            for ($i=0 ;$i<count($uses);$i++) {
                $free_count = $free_count + $uses[$i]->amount;
            }
            $free_count = $thing->amount - $free_count;
        }
        else {
            $uses[0] -> amount = null;
            $free_count = $thing->amount;
        }
        return view('things.view', ['thing' => $thing, 'uses' => $uses, 'free_count' => $free_count]);
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
            'id'=>['required'],
            'amount'=>['required', 'integer']
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
        $thing -> amount = $data['amount'];
        $thing -> master_id = auth()->user()->id;
        $thing->save();

        return redirect('/things/'.$thing->id);
    }

    public function destroy($id) {
        $thing = Thing::findorFail($id);
        DB::table('use_models')
            ->where('thing_id', $id)
            ->delete();
        Thing::where('id', $id)->delete();
        $thing->delete();
        return redirect('/things');
    }
}
