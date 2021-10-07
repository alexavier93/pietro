@extends('admin.layouts.app')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Veículos</h1>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}">Veículos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Novo Veículo</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-xl-12 col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                

                <div class="card-body">

                    <form action="{{ route('admin.vehicles.store') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        <input type="hidden" id="urlGetModel" value="{{ route('admin.vehicles.getModel') }}">
                        <input type="hidden" id="urlGetVersion" value="{{ route('admin.vehicles.getVersion') }}">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Em destaque</label>
                                    <div class="col-sm-9">
                                        <select name="featured" class="form-control select" required>
                                            <option value=""></option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Em oferta</label>
                                    <div class="col-sm-9">
                                        <select name="offer" class="form-control select" required>
                                            <option value=""></option>
                                            <option value="1">Sim</option>
                                            <option value="0">Não</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Marca</label>
                                    <div class="col-sm-9">
                                        <select name="brand_id" class="form-control select" required>
                                            <option value=""></option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Modelo</label>
                                    <div class="col-sm-9">
                                        <select name="model_id" class="form-control select" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Versão</label>
                                    <div class="col-sm-9">
                                        <select name="version_id" class="form-control select" required>
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Estado do carro</label>
                                    <div class="col-sm-9">
                                        <select name="state" class="form-control select" required>
                                            <option value=""></option>
                                            <option value="0">Novo</option>
                                            <option value="1">Usado</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ano</label>
                                    <div class="col-sm-9">
                                        <select name="year" class="form-control select" required>
                                            <option value=""></option>
                                            @php $currentYear = date('Y', time()); @endphp
                                            @foreach (range(1950, $currentYear) as $year)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Placa</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="license_plate" class="form-control" value="{{ old('license_plate') }}" maxlength="7" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Kilometragem</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="km" class="form-control" value="{{ old('km') }}" required>
                                    </div>
                                </div>
                                

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Preço</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="price" class="form-control" value="{{ old('price') }}" required>
                                    </div>
                                </div>



                            </div>

                            <div class="col-md-6">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Câmbio</label>
                                    <div class="col-sm-9">
                                        <select name="transmission_id" class="form-control select" required>
                                            <option value=""></option>
                                            @foreach ($transmissions as $transmission)
                                                <option value="{{ $transmission->id }}">{{ $transmission->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Cor</label>
                                    <div class="col-sm-9">
                                        <select name="color_id" class="form-control select" required>
                                            <option value=""></option>
                                            @foreach ($colors as $color)
                                                <option value="{{ $color->id }}">{{ $color->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Combustível</label>
                                    <div class="col-sm-9">
                                        <select name="fuel_id" class="form-control select" required>
                                            <option value=""></option>
                                            @foreach ($fuels as $fuel)
                                                <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Carroceria</label>
                                    <div class="col-sm-9">
                                        <select name="body_id" class="form-control select" required>
                                            <option value=""></option>
                                            @foreach ($bodies as $body)
                                                <option value="{{ $body->id }}">{{ $body->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Número de portas</label>
                                    <div class="col-sm-9">
                                        <select name="doors" class="form-control select" required>
                                            <option value=""></option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tipo de negociação</label>
                                    <div class="col-sm-9">
                                        <select name="negotiation" class="form-control select" required>
                                            <option value=""></option>
                                            <option value="1">Aceita troca</option>
                                            <option value="0">Não aceita troca</option>
                                        </select>
                                    </div>
                                </div>



                            </div>

                            <div class="col-md-12"> 

                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label">Opcionais</label>
                                    <div class="col-md-12">
                                        <select class="form-control select" name="options[]" multiple="multiple">
                                            <option value=""></option>
                                            @foreach ($options as $option)
                                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12">                                                
                            
                                <div class="form-group row">
                                    <label class="col-md-12 col-form-label">Descrição</label>
                                    <div class="col-md-12">
                                        <textarea name="description" class="form-control summernote">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>

                    </form>


                </div>

            </div>

        </div>

    </div>


@endsection
