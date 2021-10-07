@extends('layouts.app')

@section('content')

    <!-- Slide Section -->
    <div id="banner-carousel" class="owl-carousel owl-theme">

        <div class="item">
            <img class="img-fluid" src="{{ asset('assets/images/banner-home.jpg') }}" alt="">
        </div>
    </div>

    <div id="home">

        <section id="brands" class="mt-4">
            <div class="container">
                <div class="slide-brands owl-carousel owl-theme">
                    @foreach ($brands as $brand)
                        <div class="item"><a href="{{ url('veiculos/busca?marca='. $brand->slug) }}"><img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"></a></div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="search-box" class="my-5">

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
                                <input type="text" class="form-control money" name="preco_minimo" placeholder="Preço Mínimo"
                                    aria-label="Preço Mínimo" aria-describedby="preco-minimo">
                            </div>

                        </div>

                        <div class="col-12 col-md-6 col-lg-2 my-2">
                            <div class="input-group">
                                <span class="input-group-text" id="preco-maximo">R$</span>
                                <input type="text" class="form-control money" name="preco_maximo" placeholder="Preço Máximo"
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

        <section id="featured-cars">

            <div class="container">

                <div class="text-center">
                    <h1 class="text-secondary">VEÍCULOS EM DESTAQUE</h1>
                </div>


                <div class="row mt-5">
                    
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

                                    <h4 class="price">R$ {{ number_format($vehicle->price, 2, ',', '.') }}</h4>

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

                </div>

            </div>

        </section>

        <section class="about my-4 py-5">

            <div class="row justify-content-center">

                <div class="col-12 col-md-6 p-0 d-flex justify-content-start align-items-center">

                    <div class="p-5 px-lg-3 py-lg-0 px-xl-5 py-xl-0 col-11">
                        <h3 class="text-light">SOBRE NÓS</h3>
                        <h1 class="text-light">PIETRO MULTIMARCAS</h1>
                        <p class="text-light">Pietro Multimarcas, uma empresa onde os funcionários não são funcionários, são irmãos e os
                            clientes não são clientes, são grandes amigos. Onde não se vende carros e sim sonhos e
                            conquistas que juntas trazem felicidade. </p>

                        <p class="text-light">Venha conhecer esta empresa que vista de fora é uma empresa, mas para quem faz parte dela sabe
                            que é um grande ponto de encontro de amigos e conquistas, onde se pode fazer um grande negócio e
                            ter prazer e orgulho de participar desta grande família que é a Pietro Multimarcas.</p>

                        <p class="text-light">Pietro Multimarcas tem prazer em ajudar a conquistar seus sonhos!</p>
                    </div>

                </div>

                <div class="col-12 col-md-6 p-0">
                    <img class="w-100" src="{{ asset('assets/images/sobre-nos.jpg') }} " alt="">
                </div>
                
            </div>

        </section>

    </div>


@endsection
