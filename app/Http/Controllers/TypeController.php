<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }
    public function show($id)
{
    $type = Type::findOrFail($id);
    return response()->json($type);
}

    public function store(Request $request)
    {
        $type = new Type();
        $type->name = $request->name;
        $type->price = $request->price;
        $type->save();

        return redirect()->back()->with('success', 'Type added successfully.');
    }
    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->back()->with('success', 'Type added successfully.');
    }
}
