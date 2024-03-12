<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\DailyEarning;
class SettingsController extends Controller
{
    public function index()
    {
        $types = Type::all();
        $dailyEarnings = DailyEarning::all();
        return view('settings', compact('types','dailyEarnings'));
    }

    public function store(Request $request)
{
    $type = new Type();
    $type->name = $request->name;
    $type->price = $request->price;
    $type->save();
    dump($request->all());
    error_log($request->all());

    return redirect()->route('settings.index')->with('success', 'Type added successfully.');
}

    public function destroy(Type $type)
    {
        $type->delete();

        return redirect()->route('settings.index')->with('success', 'Type deleted successfully.');
    }
}
