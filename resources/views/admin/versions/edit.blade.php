@extends('admin.layouts.app')

@section('title', '- Editar Versão')

@section('content')

    <!-- Page Heading -->
    <div class="page-header-content py-3">

        <div class="d-sm-flex align-items-center justify-content-between">
            <h1 class="h3 mb-0 text-gray-800">Versões</h1>
        </div>

        <ol class="breadcrumb mb-0 mt-4">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.versions.index') }}">Versões</a></li>
            <li class="breadcrumb-item active" aria-current="page">Editar Versão</li>
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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.versions.update', ['version' => $version->id]) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method("PUT")

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Marcas</label>
                            <div class="col-md-10">
                                <select name="model_id" class="form-control select">
                                    @foreach ($models as $model)
                                        <option value="{{ $model->id }}" {{ $version->model_id ==  $model->id ? 'selected' : '' }}>{{ $model->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Versão</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" value="{{ $version->name }}" >
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
