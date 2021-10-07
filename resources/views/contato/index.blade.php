@extends('layouts.app')

@section('title', '- Contato')

@section('content')

<div class="page-title-content" style="background: url('{{ asset('assets/images/banner-page/banner-veiculos.jpg') }}')"></div>

    <section id="contato" class="py-5">

        <div class="container">

            <div class="row">

                <div class="col-md-6 col-lg-4 offset-lg-1">

                    <h2 class="text-center mb-3">CONTATO</h2>

                    <div class="card text-center p-5">

                        <h5>ENDEREÇO</h5>

                        <p>Lorem Ipsum dolor, 123 - Sit Amet</p>

                        <hr>


                        <h5>TELEFONE</h5>

                        <p>11 9999-9999</p>
                        <p>11 9999-9999</p>

                        <hr>

                        <h5>ATENDIMENTO</h5>

                        <p>Seg - Sex: 8hs às 19hs<br>
                            Sábado: 8hs às 14hs</p>

                    </div>

                </div>

                <div class="col-md-6 col-lg-5 offset-lg-1 mt-5 mt-md-0">

                    <h2 class="text-center mb-3">CONTATO</h2>

                    <form id="formContato" action="">

                        @csrf

                        <div class="mb-3">
                            <input type="text" name="name" class="form-control " value="" placeholder="Nome">
                        </div>

                        <div class="mb-3">
                            <input type="email" name="email" class="form-control " value="" placeholder="E-mail" >
                        </div>

                        <div class="mb-3">
                            <input type="text" name="phone" class="form-control telefone " value="" placeholder="Telefone" maxlength="15">
                        </div>

                        <div class="mb-3">
                            <textarea name="description" class="form-control " rows="5" placeholder="Mensagem"></textarea>
                        </div>

                        <div class="mb-3 text-end">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>

                    </form>


                </div>

            </div>

        </div>


    </section>

@endsection
