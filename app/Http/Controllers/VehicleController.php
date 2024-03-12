<?php

// VehicleController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;
use App\Models\Type;
use App\Models\DailyEarning;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();
        $types = Type::all();
        return view('vehicles.index', compact('vehicles', 'types'));
    }

  

    public function destroy(Vehicle $vehicle)
    {
           // Günlük kazancı kaydet
    $exitTime = Carbon::now();
    $totalFee = number_format(($vehicle->hourly_rate * $exitTime->diffInSeconds($vehicle->entry_time)) / 3600, 2);      
    $today = Carbon::now()->format('Y-m-d');
    $dailyEarning = DailyEarning::where('date', $today)->first();
    if (!$dailyEarning) {
        DailyEarning::create(['date' => $today, 'earning' => $totalFee]);
    } else {
        $dailyEarning->increment('earning', $totalFee);
    }
        $vehicle->delete();
        return redirect()->route('vehicles.index');
    }
    public function store(Request $request)
{
    $vehicle = new Vehicle();
    $vehicle->plate_number = $request->plate_number;
    $vehicle->type = $request->type;
    $vehicle->hourly_rate = $request->hourly_rate;
    $vehicle->entry_time = Carbon::now(); // Aracın giriş zamanını kaydet
    $vehicle->save();
    return redirect()->route('vehicles.index');
}


public function checkout(Vehicle $vehicle)
{
    // Aracın çıkış zamanını şu anki zaman olarak ayarla
    $exitTime = Carbon::now();
    
    // Aracın giriş zamanını al
    $entryTime = $vehicle->entry_time;

    // Eğer aracın giriş zamanı null (boş) ise, geri dön ve hata mesajı göster
    if (!$entryTime) {
        return redirect()->route('vehicles.index')->with('error', 'Entry time is missing.');
    }

    // Park süresini saniye cinsinden hesapla
    $parkDurationSeconds = $exitTime->diffInSeconds($entryTime);

    // Toplam ücreti hesapla (saniye cinsinden park süresi * saatlik ücret / 3600)
    $totalFee = ($parkDurationSeconds * $vehicle->hourly_rate) / 3600;

    // Çıkış zamanını ve ödenecek ücreti veritabanına kaydet
    $vehicle->exit_time = $exitTime;
    $vehicle->total_fee = $totalFee;
    $vehicle->save();

 

    return redirect()->route('vehicles.index')->with('success', 'Checkout successful. Total fee: $' . number_format($totalFee, 2));
}
}
