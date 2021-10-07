<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    private $color;

    public function __construct(Color $color)
    {
        $this->color = $color;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $colors = $this->color->get();

        return view('admin.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.colors.create');
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
            'name' => 'required|unique:colors|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.colors.create')->withErrors($validator)->withInput();
        } else {

            $data = $request->all();

            $this->color->create($data);

            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.colors.index');
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
    public function edit($color)
    {

        $color = $this->color->findOrFail($color);

        return view('admin.colors.edit', compact('color'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $color)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.colors.edit', ['color' => $color])->withErrors($validator)->withInput();
        } else {

            $color = $this->color->find($color);

            $data = $request->all();

            $color->update($data);

            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('admin.colors.index');
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

        $color = $this->color->find($id);

        if ($color->delete() == TRUE) {

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('admin.colors.index');
        }
    }
}
