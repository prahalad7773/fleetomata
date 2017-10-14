<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use Illuminate\Http\Request;

class TrucksController extends Controller
{

    public function index()
    {
        return view("trucks.index")->with([
            'trucks' => Truck::all()
        ]);
    }

    public function store()
    {
        request()->validate([
            'number' => 'unique:trucks,number',
            'type' => 'required'
        ]);
        Truck::create([
            'number' => request('number'),
            'type' => request('type'),
            'created_by' => auth()->id(),
        ]);
        return redirect()->back();
    }

    public function show(Truck $truck)
    {
        return view("trucks.show")->with([
            'truck' => $truck
        ]);
    }


}
