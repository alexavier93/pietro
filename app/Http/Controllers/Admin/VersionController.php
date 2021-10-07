<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelCar;
use App\Models\Version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VersionController extends Controller
{

    private $version;

    public function __construct(Version $version)
    {
        $this->version = $version;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $versions = DB::table('versions')
            ->leftJoin('models', 'models.id', '=', 'versions.model_id')
            ->select('versions.*', 'models.name as nameModel')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.versions.index', compact('versions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $models = DB::table('models')
            ->leftJoin('brands', 'brands.id', '=', 'models.brand_id')
            ->select('models.*', 'brands.image as imageBrand', 'brands.name as nameBrand')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.versions.create', compact('models'));
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
            'name' => 'required|unique:versions|max:255',
            'model_id' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.versions.create')->withErrors($validator)->withInput();
        } else {

            $data = $request->all();

            $this->version->create($data);

            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.versions.index');
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
    public function edit($version)
    {
        $version = $this->version->findOrFail($version);

        $models = ModelCar::all();

        return view('admin.versions.edit', compact('version', 'models'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $version)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.versions.edit', ['version' => $version])->withErrors($validator)->withInput();
        } else {

            $version = $this->version->find($version);

            $data = $request->all();

            $version->update($data);

            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('admin.versions.index');
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

        $version = $this->version->find($id);

        if ($version->delete() == TRUE) {

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('admin.versions.index');
        }
    }
}
