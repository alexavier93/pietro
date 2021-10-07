@extends('layouts.app')

@section('title', '- '. $vehicle->model_name.' '.$vehicle->version_name.' '.$vehicle->fuel_name.' '.$vehicle->doors.'P '.$vehicle->transmission_name)
@section('content')

    <section id="veiculo" class="py-5">

        <div class="container">

            <div class="row">

                <div class="col-md-12 header">

                    <div class="row">

                        <div class="col-md-8 d-md-flex justify-content-start align-items-center">
                            <img class="me-3" src="{{ asset('storage/'. $vehicle->brand_image) }}" style="height: 80px;">
                            <h4 class="m-0 text-uppercase">{{ $vehicle->model_name.' '.$vehicle->version_name.' '.$vehicle->fuel_name.' '.$vehicle->doors.'P '.$vehicle->transmission_name }}</h4>
                        </div>

                        <div class="col-md-4 d-flex justify-content-start justify-content-md-end align-items-center">
                            <h3 class="preco">R$ {{ number_format($vehicle->price,2,",",".") }}</h3>
                        </div>

                    </div>

                </div>

                <div class="col-lg-8 col-md-12 main-content">


                    <div class="slide-cars mb-5">

                        <div class="slick-cars-for">
                            @foreach ($images as $image)
                                <div>
                                    <a href="{{ asset('storage/'. $image->image) }}" data-fancybox="images">
                                        <img src="{{ asset('storage/'. $image->thumbnail) }}" alt="" class="slick-img w-100">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="slick-cars-nav d-none d-md-none d-lg-block px-5">
                            @foreach ($images as $image)
                                <div><img src="{{ asset('storage/'. $image->thumbnail) }}" alt="" class="slick-img w-100"></div>
                            @endforeach
                        </div>

                    </div>


                    <div class="informacoes">
                        
                        <div class="my-4">
                            <h4 class="fw-bold">Opcionais</h4>

                            <div class="row py-3">
                                @foreach ($options as $option)
                                    @if ($vehicles->options->contains($option))
                                        <div class="col-md-3 d-flex align-items-start">
                                            <div class="me-2"><i class="fas fa-check"></i></div>
                                            <div><span class="fw-bold mb-0"> {{ $option->name }}</span></div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="my-4">
                            <h4 class="fw-bold">Observações</h4>
                            <div class="fw-light">{!! $vehicle->description !!}</div>
                        </div>

                    </div>

                </div>

                <div class="col-lg-4 col-md-12 side-content">

                    <div class="info-car mb-4">

                        <h5 class="m-0 p-3">DADOS DO VEÍCULO</h5>

                        <ul class="list-group">
                            <li class="list-group-item list-group-item-secondary">
                                <i class="icon icon-road me-2"></i> {{ $vehicle->km }} km
                            </li>
                            <li class="list-group-item list-group-item-dark">
                                <i class="icon icon-gearshift me-2"></i> {{ $vehicle->transmission_name }}
                            </li>
                            <li class="list-group-item list-group-item-secondary">
                                <i class="icon icon-calendar me-2"></i> {{ $vehicle->year }}
                            </li>
                            <li class="list-group-item list-group-item-dark">
                                <i class="icon icon-fuel me-2"></i> {{ $vehicle->fuel_name }}
                            </li>
                            <li class="list-group-item list-group-item-secondary">
                                <i class="icon icon-car me-2"></i> {{ $vehicle->body_name }}
                            </li>
                            <li class="list-group-item list-group-item-dark">
                                <i class="icon icon-engine me-2"></i> {{ $vehicle->version_name }}
                            </li>

                            <li class="list-group-item list-group-item-dark">
                                <i class="icon icon-palette me-2"></i> {{ $vehicle->color_name }}
                            </li>
                            
                        </ul>

                    </div>

                    <div class="fixed-content">

                        <h5 class="m-0 p-3 mb-2">ENVIE SUA PROPOSTA</h5>

                        <div class="form-imovel px-5 pt-2 pb-3">

                            @include('flash::message')

                            <form action="{{ route('contato.enviaEmail') }}" method="POST" class="my-4">

                                @csrf

                                <div class="my-3">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Nome">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="my-3">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="E-mail">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="my-3">
                                    <input type="text" name="phone"
                                        class="form-control telefone @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" placeholder="Telefone">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="my-3">
                                    <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                                        rows="5" placeholder="Olá, Estou interessado"
                                        required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-check my-3">
                                    <input class="form-check-input" type="checkbox" value="" id="checkBox">
                                    <label class="form-check-label fw-italic" for="checkBox">Receber também uma cotação de
                                        seguro</label>
                                </div>


                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

@endsection
