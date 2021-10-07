<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ModelCar;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ModelController extends Controller
{

    private $model;

    public function __construct(ModelCar $model)
    {
        $this->model = $model;
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = DB::table('models')
            ->leftJoin('brands', 'brands.id', '=', 'models.brand_id')
            ->select('models.*', 'brands.image as imageBrand', 'brands.name as nameBrand')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.models.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();

        return view('admin.models.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:models|max:255',
            'brand_id' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.brands.create')->withErrors($validator)->withInput();

        }else {

            $data = $request->all();

            $slug = Str::slug($request->name, '-');
            $data['slug'] = $slug;

            $this->model->create($data);

            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.models.index');

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
    public function edit($model)
    {

        $brands = Brand::all();

        $model = $this->model->findOrFail($model);
        
        return view('admin.models.edit', compact('model', 'brands'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $model)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.models.edit', ['model' => $model])->withErrors($validator)->withInput();

        }else {

            $model = $this->model->find($model);

            $data = $request->all();

            $slug = Str::slug($request->name, '-');
            $data['slug'] = $slug;

            $model->update($data);

            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('admin.models.index');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->id;

        $model = $this->model->find($id);

        if ($model->delete() == TRUE) {

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('admin.models.index');

        }
        
    }

}
