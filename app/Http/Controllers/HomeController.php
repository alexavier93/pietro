<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {       

        $brands = Brand::all();

        $vehicles = DB::table('vehicles')
            ->leftJoin('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->leftJoin('models', 'models.id', '=', 'vehicles.model_id')
            ->leftJoin('versions', 'versions.id', '=', 'vehicles.version_id')
            ->leftJoin('transmissions', 'transmissions.id', '=', 'vehicles.transmission_id')
            ->leftJoin('fuels', 'fuels.id', '=', 'vehicles.fuel_id')
            ->leftJoin('bodies', 'bodies.id', '=', 'vehicles.body_id')
            ->where('vehicles.image', '!=', null)
            ->select(
                'vehicles.*',
                'brands.name as brand_name',
                'brands.slug as brand_slug',
                'models.name as model_name',
                'models.slug as model_slug',
                'versions.name as version_name',
                'transmissions.name as transmission_name',
                'fuels.name as fuel_name',
                'bodies.name as body_name',
            )
            ->orderBy('id', 'desc')
            ->limit(8)->get();

        return view('home.index', compact('brands', 'vehicles'));

    }

    
}
