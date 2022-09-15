
@extends('layout.base')
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
    <!--begin::Info-->
    <div class="d-flex align-items-center flex-wrap mr-1">
        <!--begin::Page Heading-->
        <div class="d-flex align-items-baseline flex-wrap mr-5">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold my-1 mr-5">Departamento</h5>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                <li class="breadcrumb-item text-muted">
                    <a href="" class="text-muted">Gesti&oacute;n</a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="" class="text-muted">Nomencladores</a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="" class="text-muted">Departamento</a>
                </li>
                <li class="breadcrumb-item text-muted">
                    <a href="" class="text-muted">Editar</a>
                </li>
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page Heading-->
    </div>
    <!--end::Info-->
</div>
</div>
@endsection
@section('content')
                                    <div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
												<h3 class="card-title">Editar departamento </h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
														<span class="example-toggle" data-toggle="tooltip" title="View code"></span>
														<span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
													</div>
												</div>
											</div>
											<!--begin::Form-->
											<form class="form" action="{{url('/department/'.$data->id)}}" method="post">
                                                @csrf 
												{{method_field('PUT')}}
												<div class="card-body">
													<h3 class="font-size-lg text-dark font-weight-bold mb-6">Informaci&oacute;n del departamento:</h3>
													<div class="mb-15">
														<div class="form-group row">
															<label class="col-lg-3 col-form-label">Nombre:</label>
															<div class="col-lg-6">
																<input  id="name" type="text" name="name" value="{{$data->name}}" class="form-control" placeholder="nombre" />
																<span class="form-text text-muted">Por favor entre el nombre</span>
															</div>
														</div>
														<div class="form-group row">
															<label class="col-lg-3 col-form-label">Descripci&oacute;n:</label>
															<div class="col-lg-6">
																<input id="description" type="text" name="description" value="{{$data->description}}" class="form-control" placeholder="descripci&oacute;n" />
																<span class="form-text text-muted">Una breve descripci&oacute;n</span>
															</div>
														</div>
													</div>
												</div>
												<div class="card-footer">
													<div class="row">
														<div class="col-lg-3"></div>
														<div class="col-lg-6">
															<button type="submit" value="Login" class="btn btn-success mr-2">Aceptar</button>
															<button type="reset" class="btn btn-secondary">Cancel</button>
														</div>
													</div>
												</div>
											</form>
											<!--end::Form-->
										</div>
@endsection
@section('extrajs')
<script>

</script>
@endsection