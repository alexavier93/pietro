<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Body;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Fuel;
use App\Models\ModelCar;
use App\Models\Option;
use App\Models\Transmission;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class VehicleController extends Controller
{

    private $vehicle;

    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $vehicles = DB::table('vehicles')
            ->leftJoin('brands', 'brands.id', '=', 'vehicles.brand_id')
            ->leftJoin('models', 'models.id', '=', 'vehicles.model_id')
            ->select('vehicles.*', 'brands.image as imageBrand', 'models.name as nameModel')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();

        $transmissions = Transmission::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();
        $fuels = Fuel::orderBy('name', 'asc')->get();
        $bodies = Body::orderBy('name', 'asc')->get();
        $options = Option::orderBy('name', 'asc')->get();

        return view('admin.vehicles.create', compact('brands', 'transmissions', 'colors', 'fuels', 'bodies', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        if ($request->filled('price')) {
            $data['price'] = str_replace(',', '.', str_replace('.', '', $request->price));
        }

        $vehicle = $this->vehicle->create($data);
        $vehicle->options()->sync($data['options']);

        if ($vehicle) {
            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.vehicles.edit', ['vehicle' => $vehicle->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle)
    {

        $vehicle = $this->vehicle->findOrFail($vehicle);

        $brands = Brand::all();
        $models = ModelCar::all();
        $versions = Version::all();

        $transmissions = Transmission::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();
        $fuels = Fuel::orderBy('name', 'asc')->get();
        $bodies = Body::orderBy('name', 'asc')->get();
        $options = Option::orderBy('name', 'asc')->get();

        return view('admin.vehicles.edit', compact('vehicle', 'brands', 'models', 'versions', 'transmissions', 'colors', 'fuels', 'bodies', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vehicle)
    {
        $vehicle = $this->vehicle->find($vehicle);

        $data = $request->all();

        if ($request->filled('price')) {
            $data['price'] = str_replace(',', '.', str_replace('.', '', $request->price));
        }
        if ($request->filled('km')) {
            $data['km'] = number_format($request->km, 3, '.', '');
        }

        $vehicle->update($data);

        flash('Registro atualizado com sucesso!')->success();
        return redirect()->route('admin.vehicles.edit', ['vehicle' => $vehicle->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * Buscar Modelos
     */
    public function getModel(Request $request)
    {

        if (isset($_POST["brand"])) {

            $brand = $request->brand;

            $models = ModelCar::where('brand_id', $brand)->orderBy('id', 'DESC')->get();

            if ($models->count() > 0) {

                $html = '<option value="">Selecione uma opção</option>';

                foreach ($models as $model) {
                    $html .= '<option value="' . $model->id . '">' . $model->name . '</option>';
                }

                echo $html;
            } else {

                echo '<option value="0">Não há registros</option>';
            }
        }
    }

    /**
     * Buscar Versão
     */
    public function getVersion(Request $request)
    {

        if (isset($_POST["model"])) {

            $model = $request->model;

            $models = Version::where('model_id', $model)->orderBy('id', 'DESC')->get();

            if ($models->count() > 0) {

                $html = '<option value="">Selecione uma opção</option>';

                foreach ($models as $model) {
                    $html .= '<option value="' . $model->id . '">' . $model->name . '</option>';
                }

                echo $html;
            } else {

                echo '<option value="0">Não há registros</option>';
            }
        }
    }


    /*
    * IMAGENS
    */

    public function getGaleria()
    {

        $vehicle_id = $_POST["vehicle_id"];

        $images = VehicleImage::where('vehicle_id', $vehicle_id)->get();

        $html = '';

        foreach ($images as $image) {

            $html .= '

                <div class="col-md-4 col-lg-2 mb-3" id="' . $image->id . '">
        
                    <div class="card">
                        <div class="img"><img src="' . asset('storage/' . $image->thumbnail) . '" class="card-img-top"></div>
                        <div class="p-2 d-flex flex-column align-items-center">

                        <div class="form-check">
                            <input class="form-check-input checkCover" type="checkbox" value="1" id="cover-' . $image->id . '" data-url="' . route('admin.vehicles.makeCover') . '" data-id="' . $image->id . '"';
            $html .= $image->cover == 1 ? 'checked' : '';
            $html .= '>
                            <label class="form-check-label" for="cover-' . $image->id . '"> Imagem Capa </label>
                        </div>

                        <button type="button" class="btn btn-sm btn-default delete_image" data-toggle="modal" data-target="#modalDelete" data-id="' . $image->id . '" data-url="' . route('admin.vehicles.deleteImagem') . '"><i class="far fa-trash-alt"></i> Eliminar</button>

                        </div>
                    </div>
                
                </div>
            ';
        }

        echo json_encode($html);
    }

    public function uploadGaleria(Request $request)
    {
        $vehicle_id = $request->vehicle_id;

        if ($request->TotalFiles > 0) {

            for ($x = 0; $x < $request->TotalFiles; $x++) {

                if ($request->hasFile('images' . $x)) {

                    $image = $request->file('images' . $x);

                    $hash = str_replace('.', '', str_replace('/', '', Hash::make('&U%v3#tBcpeA%0Rs')));

                    $input['thumbnail'] = $hash . '_thumbnail.' . $image->extension();
                    $input['image'] = $hash . '.' . $image->extension();

                    $dir = 'vehicles/images/';

                    if (!Storage::disk('public')->exists($dir)) {
                        Storage::disk('public')->makeDirectory($dir, 0755, true, true);
                    }

                    $filePath = public_path('storage/' . $dir);

                    $img = Image::make($image->path());

                    $img->fit(750, 500, function ($const) {
                        $const->aspectRatio();
                    })->save($filePath . '/' . $input['thumbnail']);

                    $image->move($filePath, $input['image']);

                    $data[$x]['vehicle_id'] = $vehicle_id;
                    $data[$x]['image'] = $dir . $input['image'];
                    $data[$x]['thumbnail'] = $dir . $input['thumbnail'];
                }
            }

            //inserir no banco
            VehicleImage::insert($data);

            $response = array('success' => 'Upload de imagens feito com sucesso');
        } else {

            $response = array('erro' => 'Ocorreu um erro, tente novamente.');
        }

        echo json_encode($response);
    }

    public function deleteImagem(Request $request)
    {

        $id = $request->id;

        $image = VehicleImage::find($id);
        $vehicle = $image->vehicle_id;



        if ($image->delete()) {

            if ($image->cover == '1') {
                Vehicle::where('id', $vehicle)->update(array('image' => null));
            }

            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
                Storage::disk('public')->delete($image->thumbnail);
                $response = array('success' => 'Imagem removida com sucesso!');

       
            }
        } else {

            $response = array('erro' => 'Ocorreu um erro, tente novamente.');
        }

        echo json_encode($response);
    }



    public function makeCover(Request $request)
    {

        $id = $request->id;

        $image = VehicleImage::find($id);
        $vehicle = $image->vehicle_id;

        $images = VehicleImage::where('vehicle_id', $vehicle)->get();

        foreach ($images as $images) {
            VehicleImage::where('vehicle_id', $vehicle)->update(array('cover' => null));
        }

        $image = $image->update(array('cover' => '1'));

        if ($image) {
            $cover = VehicleImage::where('cover', '1')->first();
            Vehicle::where('id', $vehicle)->update(array('image' => $cover['thumbnail']));
            $response = array('success' => 'Capa selecionada!');
        } else {
            $response = array('erro' => 'Ocorreu algum erro!');
        }

        echo json_encode($response);
    }
}
