@extends('admin.layouts.app')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Veículos</h1>
            <a href="{{ route('admin.vehicles.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus text-white-50"></i> Novo Veículo
            </a>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Veículos</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            @include('flash::message')

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <span class="m-0 font-weight-bold text-primary">Veículos</span>

                    <a href="{{ route('admin.vehicles.create') }}"
                        class="btn btn-sm btn-primary float-right d-block d-sm-none">Novo Veículo</a>
                </div>

                <div class="card-body">

                    <div class="table-vehicles">

                        <table id="dataTables" class="table table-bordered dt-responsive">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">Marca</th>
                                    <th scope="col">Modelo</th>
                                    <th scope="col">Ano</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($vehicles as $vehicle)

                                    <tr>
                                        <td>{{ $vehicle->id }}</th>
                                        <td width="20%"><img class="w-75 img-thumbnail" src="{{ asset('storage/'. $vehicle->image) }}"></td>
                                        <td width="20%"> <img class="w-50 img-thumbnail" src="{{ asset('storage/' . $vehicle->imageBrand) }}"> </th>
                                        <td>{{ $vehicle->nameModel }}</td>
                                        <td>{{ $vehicle->year }}</td>
                                        <td width="15%">
                                            <a href="{{ route('admin.vehicles.edit', ['vehicle' => $vehicle->id]) }}" class="btn btn-sm btn-primary">Editar</a>
                                            <a href="javascript:;" data-toggle="modal" data-id='{{ $vehicle->id }}' data-target="#modalDelete" class="btn btn-sm btn-danger delete">Excluir</a>
                                        </td>
                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                        
                    </div>

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
                    <form action="{{ route('admin.vehicles.delete') }}" method="post" class="float-right">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
