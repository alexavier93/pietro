<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{

    private $brand;

    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brand->get();

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
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
            'name' => 'required|unique:brands|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.brands.create')->withErrors($validator)->withInput();

        }else {

            $data = $request->all();

            $slug = Str::slug($request->name, '-');
            $data['slug'] = $slug;

            $image = $request->file('image')->store('brands', 'public');
            $data['image'] = $image;

            // Redimensionando a imagem
            $image = Image::make(public_path("storage/{$image}"))->fit(200, 200);
            $image->save();

            $this->brand->create($data);

            flash('Registro criado com sucesso!')->success();
            return redirect()->route('admin.brands.index');

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
    public function edit($brand)
    {
        $brand = $this->brand->findOrFail($brand);
        
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $brand)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {

            return redirect()->route('admin.brands.edit', ['brand' => $brand])->withErrors($validator)->withInput();

        }else {

            $brand = $this->brand->find($brand);

            $data = $request->all();

            $slug = Str::slug($request->name, '-');
            $data['slug'] = $slug;

            if ($request->hasFile('image')) {

                if (Storage::disk('public')->exists($brand->image)) {
                    Storage::disk('public')->delete($brand->image);
                }

                $image = $request->file('image')->store('brands', 'public');
                $data['image'] = $image;
    
                // Redimensionando a imagem
                $image = Image::make(public_path("storage/{$image}"))->fit(650, 433);
                $image->save();
            }

            $brand->update($data);

            flash('Registro atualizado com sucesso!')->success();
            return redirect()->route('admin.brands.index');

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

        $brand = $this->brand->find($id);

        if ($brand->delete() == TRUE) {

            if (Storage::disk('public')->exists($brand->image)) {
                Storage::disk('public')->delete($brand->image);
            }

            flash('Registro removido com sucesso!')->success();
            return redirect()->route('admin.brands.index');

        }
        
    }

}
