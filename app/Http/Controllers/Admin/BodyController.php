<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Body;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BodyController extends Controller
{
    private $body;

    public function __construct(Body $body)
    {
        $this->body = $body;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bodies = $this->body->get();

        return view('admin.bodies.index', compact('bodies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bodies.create');
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
            'name' => 'required|unique:bodies|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.bodies.create')->withErrors($validator)->withInput();
        } else {

            $data = $request->all();

            $this->body->create($data);

            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.bodies.index');
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
    public function edit($body)
    {

        $body = $this->body->findOrFail($body);

        return view('admin.bodies.edit', compact('body'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $body)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.bodies.edit', ['body' => $body])->withErrors($validator)->withInput();
        } else {

            $body = $this->body->find($body);

            $data = $request->all();

            $body->update($data);

            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('admin.bodies.index');
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

        $body = $this->body->find($id);

        if ($body->delete() == TRUE) {

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('admin.bodies.index');
        }
    }
}
