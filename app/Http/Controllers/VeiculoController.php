<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Option;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\ModelCar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VeiculoController extends Controller
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
            ->paginate(12);


        return view('veiculos.index', compact('vehicles', 'brands'));
    }

    public function anuncio($marca, $modelo, $ano, $id)
    {

        $vehicles = Vehicle::find($id);

        $vehicle = DB::table('vehicles')
            ->leftJoin('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->leftJoin('models', 'models.id', '=', 'vehicles.model_id')
            ->leftJoin('versions', 'versions.id', '=', 'vehicles.version_id')
            ->leftJoin('transmissions', 'transmissions.id', '=', 'vehicles.transmission_id')
            ->leftJoin('fuels', 'fuels.id', '=', 'vehicles.fuel_id')
            ->leftJoin('bodies', 'bodies.id', '=', 'vehicles.body_id')
            ->leftJoin('colors', 'colors.id', '=', 'vehicles.color_id')

            ->where('vehicles.id', '=', $id)
            ->select(
                'vehicles.*',
                'brands.name as brand_name',
                'brands.slug as brand_slug',
                'brands.image as brand_image',
                'models.name as model_name',
                'models.slug as model_slug',
                'versions.name as version_name',
                'transmissions.name as transmission_name',
                'fuels.name as fuel_name',
                'bodies.name as body_name',
                'colors.name as color_name',


            )->first();

        $images = VehicleImage::where('vehicle_id', $vehicle->id)->get();

        $options = Option::all();


        return view('veiculos.info', compact('vehicle', 'vehicles', 'images', 'options'));
    }

    public function busca(Request $request)
    {


        $marca = $request->input('marca');
        $modelo = $request->input('modelo');
        $ano = $request->input('ano');
        $preco_min = $request->input('preco_min');
        $preco_max = $request->input('preco_max');
        $preco_min = str_replace('.', '', $preco_min);
        $preco_max = str_replace('.', '', $preco_max);


        $query = DB::table('vehicles')
            ->leftJoin('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->leftJoin('models', 'models.id', '=', 'vehicles.model_id')
            ->leftJoin('versions', 'versions.id', '=', 'vehicles.version_id')
            ->leftJoin('transmissions', 'transmissions.id', '=', 'vehicles.transmission_id')
            ->leftJoin('fuels', 'fuels.id', '=', 'vehicles.fuel_id')
            ->leftJoin('bodies', 'bodies.id', '=', 'vehicles.body_id');

        if ($request->input('marca')) {
            $query = $query->where('brands.slug', '=', $marca);
        }

        if ($request->input('modelo')) {
            $query = $query->where('models.slug', '=', $modelo);
        }

        if ($request->input('ano')) {
            $query = $query->where('vehicles.year', '=', $ano);
        }

        if ($request->input('preco_min') || $request->input('preco_max')) {
            $query->whereBetween('price', [$preco_min, $preco_max]);
        }

        $vehicles = $query->where('vehicles.image', '!=', null)
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
                    ->paginate(12);

        $brands = Brand::all();

        return view('veiculos.index', compact('vehicles', 'brands'));
    }


    /**
     * Buscar Modelos
     */
    public function getModel(Request $request)
    {

        if (isset($_POST["brand"])) {

            $brand = $request->brand;

            $brand = Brand::where('slug', $brand)->first();

            $models = ModelCar::where('brand_id', $brand->id)->orderBy('id', 'DESC')->get();

            $html = '';

            if ($models->count() > 0) {

                foreach ($models as $model) {
                    $html .= '<option value="' . $model->slug . '">' . $model->name . '</option>';
                }

                echo $html;
            } else {

                echo '<option value="0">Não há registros</option>';
            }
        }
    }
}
