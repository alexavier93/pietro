@extends('layouts.app')

@section('title', '- Veículos')

@section('content')

    <div class="page-title-content" style="background: url('{{ asset('assets/images/banner-page/banner-veiculos.jpg') }}')"></div>

    <section id="search-box" class="mt-5">

        <div class="container">

            <form class="formSearch p-3 py-4" action="{{ route('veiculos.busca') }}" action="post">

                <div class="row align-items-center">

                    <div class="col-12 col-md-6 col-lg-2 my-2">
                        <select class="form-control select" name="marca" data-url="{{ route('veiculos.getModel') }}">
                            <option value="">Marca</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->slug }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-2 my-2">
                        <select class="form-control select" name="modelo">
                            <option value="">Modelo</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-2 my-2">
                        <select class="form-control select" name="ano">
                            <option value="">Ano</option>
                            @php $currentYear = date('Y', time()); @endphp
                            @foreach (range(1950, $currentYear) as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-lg-2 my-2">

                        <div class="input-group">
                            <span class="input-group-text" id="preco-minimo">R$</span>
                            <input type="text" class="form-control price_form" name="preco_min" placeholder="Preço Mínimo"
                                aria-label="Preço Mínimo" aria-describedby="preco-minimo">
                        </div>

                    </div>

                    <div class="col-12 col-md-6 col-lg-2 my-2">
                        <div class="input-group">
                            <span class="input-group-text" id="preco-maximo">R$</span>
                            <input type="text" class="form-control price_form" name="preco_max" placeholder="Preço Máximo"
                                aria-label="Preço Máximo" aria-describedby="preco-maximo">
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-2 my-2">
                        <button class="btn btn-primary w-100">Busca</button>
                    </div>

                </div>

            </form>

        </div>

    </section>

    <section id="veiculos" class="py-5">

        <div id="cars">

            <div class="container">

                <div class="text-center">
                    <h1 class="text-secondary">VEÍCULOS</h1>
                </div>


                <div class="row mt-5">

                    

                    @if ($vehicles->isNotEmpty())

                        @foreach ($vehicles as $vehicle)

                            <div class="col-md-4 col-sm-6 mb-3">

                                <div class="car-box card">
                                    <div class="car-thumbnail">
                                        <a href="{{ route('veiculos.anuncio', ['marca' => $vehicle->brand_slug, 'modelo' => $vehicle->model_slug, 'ano' => $vehicle->year, 'id' => $vehicle->id]) }}"
                                            class="car-img">
                                            <img class="d-block w-100" src="{{ asset('storage/' . $vehicle->image) }}"
                                                alt="car">
                                        </a>
                                    </div>

                                    <div class="card-body detail">
                                        <h1 class="title">
                                            <a class="text-uppercase"
                                                href="{{ route('veiculos.anuncio', ['marca' => $vehicle->brand_slug, 'modelo' => $vehicle->model_slug, 'ano' => $vehicle->year, 'id' => $vehicle->id]) }}">{{ $vehicle->model_name . ' ' . $vehicle->version_name . ' ' . $vehicle->fuel_name . ' ' . $vehicle->doors . 'P ' . $vehicle->transmission_name }}</a>
                                        </h1>

                                        <h4 class="price">R$ {{ number_format($vehicle->price, 2, ',', '.') }}
                                        </h4>

                                        <div class="facilities row">

                                            <div class="col col-md-3 py-2 d-flex align-items-center">
                                                <i class="icon icon-calendar me-1"></i>
                                                <span>{{ $vehicle->year }}</span>
                                            </div>

                                            <div class="col col-md-3 py-2 d-flex align-items-center">
                                                <i class="icon icon-gearshift me-1"></i>
                                                <span>{{ $vehicle->transmission_name }}</span>
                                            </div>

                                            <div class="col col-md-3 py-2 d-flex align-items-center">
                                                <i class="icon icon-road me-1"></i>
                                                <span>{{ $vehicle->km }}</span>
                                            </div>

                                            <div class="col col-md-3 py-2 d-flex align-items-center">
                                                <a href="{{ route('veiculos.anuncio', ['marca' => $vehicle->brand_slug, 'modelo' => $vehicle->model_slug, 'ano' => $vehicle->year, 'id' => $vehicle->id]) }}"
                                                    class="btn btn-default btn-sm">Detalhes</a>
                                            </div>

                                        </div>

                                    </div>



                                </div>

                            </div>

                        @endforeach

                    @else
                        <div class="text-center my-5">
                            <h3>NENHUM REGISTRO ENCONTRADO</h3>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </section>

@endsection
