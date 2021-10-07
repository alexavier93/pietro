<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{

    private $categoria;

    public function __construct(Categoria $categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = $this->categoria->paginate(10);

        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorias.create');
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

        $slug = Str::slug($request->nome, '-');
        $data['slug'] = $slug;

        $this->categoria->create($data);

        flash('Categoria Criado com Sucesso!')->success();
        return redirect()->route('admin.categorias.index');
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
    public function edit($categoria)
    {
        $categoria = $this->categoria->findOrFail($categoria);
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoria)
    {
        $data = $request->all();

        $slug = Str::slug($request->nome, '-');
        $data['slug'] = $slug;

        $categoria = $this->categoria->find($categoria);

        $categoria->update($data);

        flash('Categoria Atualizado com Sucesso!')->success();
        return redirect()->route('admin.categorias.index');
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

        $categoria = $this->categoria->find($id);

        if ($categoria->delete() == TRUE) {

            flash('Categoria removido com sucesso!')->success();
            return redirect()->route('admin.categorias.index');

        }
        
    }
}
