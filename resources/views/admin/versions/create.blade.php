@extends('admin.layouts.app')

@section('title', '- Nova Versão')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Versões</h1>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.versions.index') }}">Versões</a></li>
            <li class="breadcrumb-item active" aria-current="page">Nova Versão</li>
        </ol>

    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-xl-12 col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">

                <div class="card-header">
                    <span class="m-0 font-weight-bold text-primary">Informações</span>
                </div>

                <div class="card-body">

                    @include('flash::message')

                    <form action="{{ route('admin.versions.store') }}" method="post">

                        @csrf

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Modelos</label>
                            <div class="col-md-10">
                                <select name="model_id" class="form-control select">
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}">{{ $model->name .' ('. $model->nameBrand.')'}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Versão</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>

                    </form>


                </div>

            </div>

        </div>

    </div>


@endsection
