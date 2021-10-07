<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fuel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FuelController extends Controller
{
    private $fuel;

    public function __construct(Fuel $fuel)
    {
        $this->fuel = $fuel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $fuels = $this->fuel->get();
        
        return view('admin.fuels.index', compact('fuels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.fuels.create');
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
            'name' => 'required|unique:fuels|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.fuels.create')->withErrors($validator)->withInput();

        } else {

            $data = $request->all();

            $this->fuel->create($data);

            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.fuels.index');
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
    public function edit($fuel)
    {
        
        $fuel = $this->fuel->findOrFail($fuel);

        return view('admin.fuels.edit', compact('fuel'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $fuel)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.fuels.edit', ['fuel' => $fuel])->withErrors($validator)->withInput();

        } else {

            $fuel = $this->fuel->find($fuel);

            $data = $request->all();

            $fuel->update($data);

            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('admin.fuels.index');
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

        $fuel = $this->fuel->find($id);

        if ($fuel->delete() == TRUE) {

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('admin.fuels.index');
        }
    }
}
