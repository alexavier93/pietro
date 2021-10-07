<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OptionController extends Controller
{
    private $option;

    public function __construct(Option $option)
    {
        $this->option = $option;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $options = $this->option->get();

        return view('admin.options.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.options.create');
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
            'name' => 'required|unique:options|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.options.create')->withErrors($validator)->withInput();
        } else {

            $data = $request->all();

            $this->option->create($data);

            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.options.index');
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
    public function edit($option)
    {

        $option = $this->option->findOrFail($option);

        return view('admin.options.edit', compact('option'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $option)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.options.edit', ['option' => $option])->withErrors($validator)->withInput();
        } else {

            $option = $this->option->find($option);

            $data = $request->all();

            $option->update($data);

            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('admin.options.index');
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

        $option = $this->option->find($id);

        if ($option->delete() == TRUE) {

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('admin.options.index');
        }
    }
}
