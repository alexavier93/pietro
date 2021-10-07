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

                    @if ($vehicle->image == null)
                        <div class="alert alert-warning" role="alert"> Faça upload das imagens e escolha uma capa</div>
                    @endif

                    @include('flash::message')

                    <div class="alert" role="alert" style="display: none;"></div>

                    <nav>
                        <div class="nav nav-pills" id="tabStep" role="tablist">
                            <a class="nav-link active" id="step1-tab" data-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true">Definições básicas</a>
                            <a class="nav-link" id="step2-tab" data-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="false">Galeria</a>
                        </div>
                    </nav>

                    <form action="{{ route('admin.vehicles.update', ['vehicle' => $vehicle->id]) }}" method="post">

                        @csrf
                        @method("PUT")

                        <input type="hidden" id="vehicle_id" value="{{ $vehicle->id }}">

                        <input type="hidden" id="urlGetModel" value="{{ route('admin.vehicles.getModel') }}">
                        <input type="hidden" id="urlGetVersion" value="{{ route('admin.vehicles.getVersion') }}">

                        <div class="tab-content mt-2" id="nav-tabContent">

                            <!-- Definições Básica -->
                            <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">

                                <div class="card p-3">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Em destaque</label>
                                            <div class="col-sm-9">
                                                <select name="featured" class="form-control select" required>
                                                    <option value="1" {{ $vehicle->featured == '1' ? 'selected' : '' }}>Sim</option>
                                                    <option value="0" {{ $vehicle->featured == '0' ? 'selected' : '' }}>Não</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Em oferta</label>
                                            <div class="col-sm-9">
                                                <select name="offer" class="form-control select" required>
                                                    <option value=""></option>
                                                    <option value="1" {{ $vehicle->offer == '1' ? 'selected' : '' }}>Sim</option>
                                                    <option value="0" {{ $vehicle->offer == '0' ? 'selected' : '' }}>Não</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Marca</label>
                                            <div class="col-sm-9">
                                                <select name="brand_id" class="form-control select" required>
                                                    <option value=""></option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $vehicle->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Modelo</label>
                                            <div class="col-sm-9">
                                                <select name="model_id" class="form-control select" required>
                                                    @foreach ($models as $model)
                                                        <option value="{{ $model->id }}" {{ $vehicle->model_id == $model->id ? 'selected' : '' }}>{{ $model->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Versão</label>
                                            <div class="col-sm-9">
                                                <select name="version_id" class="form-control select" required>
                                                    @foreach ($versions as $version)
                                                        <option value="{{ $version->id }}" {{ $vehicle->version_id == $version->id ? 'selected' : '' }}>{{ $version->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Estado do carro</label>
                                            <div class="col-sm-9">
                                                <select name="state" class="form-control select" required>
                                                    <option value=""></option>
                                                    <option value="0" {{ $vehicle->state == '0' ? 'selected' : '' }}>Novo</option>
                                                    <option value="1" {{ $vehicle->state == '1' ? 'selected' : '' }}>Usado</option>
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
                                                    <option value="{{ $year }}" {{ $vehicle->year == $year ? 'selected' : '' }}>{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Placa</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="license_plate" class="form-control" value="{{ $vehicle->license_plate }}" maxlength="7" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Kilometragem</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="km" class="form-control km" value="{{ $vehicle->km }}" required>
                                            </div>
                                        </div>
                                        

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Preço</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="price" class="form-control money" value="{{ $vehicle->price }}" required>
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
                                                        <option value="{{ $transmission->id }}" {{ $vehicle->transmission_id == $transmission->id ? 'selected' : '' }}>{{ $transmission->name }}</option>
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
                                                        <option value="{{ $color->id }}" {{ $vehicle->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}</option>
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
                                                        <option value="{{ $fuel->id }}" {{ $vehicle->fuel_id == $fuel->id ? 'selected' : '' }}>{{ $fuel->name }}</option>
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
                                                        <option value="{{ $body->id }}" {{ $vehicle->body_id == $body->id ? 'selected' : '' }}>{{ $body->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Número de portas</label>
                                            <div class="col-sm-9">
                                                <select name="doors" class="form-control select" required>
                                                    <option value="1" {{ $vehicle->doors == '1' ? 'selected' : '' }}>1</option>
                                                    <option value="2" {{ $vehicle->doors == '2' ? 'selected' : '' }}>2</option>
                                                    <option value="3" {{ $vehicle->doors == '3' ? 'selected' : '' }}>3</option>
                                                    <option value="4" {{ $vehicle->doors == '4' ? 'selected' : '' }}>4</option>
                                                    <option value="5" {{ $vehicle->doors == '5' ? 'selected' : '' }}>5</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Tipo de negociação</label>
                                            <div class="col-sm-9">
                                                <select name="negotiation" class="form-control select" required>
                                                    <option value=""></option>
                                                    <option value="1" {{ $vehicle->negotiation == '1' ? 'selected' : '' }}>Aceita troca</option>
                                                    <option value="0" {{ $vehicle->negotiation == '0' ? 'selected' : '' }}>Não aceita troca</option>
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
                                                        <option value="{{ $option->id }}" @if ($vehicle->options->contains($option)) selected @endif>{{ $option->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">                                                
                                    
                                        <div class="form-group row">
                                            <label class="col-md-12 col-form-label">Descrição</label>
                                            <div class="col-md-12">
                                                <textarea name="description" class="form-control summernote">{{ $vehicle->description }}</textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </div>

                                </div>

                                </div>

                            </div>

                            <!-- Galeria -->
                            <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">

                                <div class="card p-3">

                                    <div class="row">

                                        <div class="col-lg-12 mb-3">

                                            <input type="hidden" id="getGaleria" value="{{ route('admin.vehicles.getGaleria') }}">
                                            <input type="hidden" id="urlUploadGaleria" value="{{ route('admin.vehicles.uploadGaleria') }}">

                                            <div class="images form-inline">
                                                <div class="form-group">
                                                    <input type="file" name="images[]" id="images" class="form-control" placeholder="Selecione as imagens" multiple>
                                                </div>
                                                <button type="button" id="uploadGaleria" class="btn btn-primary ml-3">Fazer Upload</button>
                                            </div>

                                        </div>

                                        <div class="col-lg-12">
                                            <div id="galeriaVeiculo" class="row"></div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

        <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="py-3 m-0">Tem certeza que deseja excluir este registro?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-danger btn-sm delete">Excluir</button>
                </div>
            </div>
        </div>
    </div>


@endsection
