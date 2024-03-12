<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// HomeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function vehiclespages()
    {
        return view('vehicles');
    }
}
