<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransmissionController extends Controller
{

    private $transmission;

    public function __construct(Transmission $transmission)
    {
        $this->transmission = $transmission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $transmissions = $this->transmission->get();

        return view('admin.transmissions.index', compact('transmissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.transmissions.create');
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
            'name' => 'required|unique:transmissions|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.transmissions.create')->withErrors($validator)->withInput();
        } else {

            $data = $request->all();

            $this->transmission->create($data);

            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.transmissions.index');
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
    public function edit($transmission)
    {

        $transmission = $this->transmission->findOrFail($transmission);

        return view('admin.transmissions.edit', compact('transmission'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $transmission)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.transmissions.edit', ['transmission' => $transmission])->withErrors($validator)->withInput();
        } else {

            $transmission = $this->transmission->find($transmission);

            $data = $request->all();

            $transmission->update($data);

            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('admin.transmissions.index');
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

        $transmission = $this->transmission->find($id);

        if ($transmission->delete() == TRUE) {

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('admin.transmissions.index');
        }
    }
}
