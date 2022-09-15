
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
												<h3 class="card-title">Editar analista </h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
														<span class="example-toggle" data-toggle="tooltip" title="View code"></span>
														<span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
													</div>
												</div>
											</div>
											<!--begin::Form-->
											<form class="form" action="{{url('/qualityAnalyst/'.$data->id)}}" method="post">
											@csrf 
											{{method_field('PUT')}}
												<div class="card-body">
													<h3 class="font-size-lg text-dark font-weight-bold mb-6">Informaci&oacute;n del analista de calidad:</h3>
													<div class="mb-15">
														<div class="form-group row">
														<div class="form-group row">
															<label class="col-form-label text-right col-lg-3 col-sm-12">Nombre:</label>
															<div class="col-lg-6">
																<input  id="name" type="text" name="name" value="{{$data->name}}" class="form-control" placeholder="nombre" />
																<span class="form-text text-muted">Por favor entre el nombre</span>
															</div>
														</div>
														 <div class="form-group row">
															<label class="col-form-label text-right col-lg-3 col-sm-12">Apellidos:</label>
															<div class="col-lg-6">
																<input  id="lastname" type="text" name="lastname" value="{{$data->lastname}}" class="form-control" placeholder="apellidos" />
																<span class="form-text text-muted">Por favor entre los apellidos</span>
															</div>
														 </div>
														</div>
														<div class="form-group row">
														<div class="form-group row">
															<label class="col-form-label text-right col-lg-3 col-sm-12">Usuario:</label>
															<div class="col-lg-6 col-md-9 col-sm-12">
																<input id="user" type="text" name="user" value="{{$data->user}}" class="form-control" placeholder="descripci&oacute;n" />
																<span class="form-text text-muted">Por favor entre el usuario</span>
															</div>
															</div>
															<div class="form-group row">
															<label class="col-form-label text-right col-lg-3 col-sm-12">Contraseña:</label>
															<div class="col-lg-6 col-md-9 col-sm-12">
																<input id="password" type="password" name="password" value="{{$data->password}}" class="form-control" placeholder="descripci&oacute;n" />
																<span class="form-text text-muted">Por favor entre la contraseña</span>
															</div>
															</div>
														</div>
														<div class="form-group row">
														<div class="form-group row">
															<label class="col-form-label  col-lg-3">Correo:</label>
															<div class="col-lg-6 col-md-9">
																<input id="email" type="text" name="email" value="{{$data->email}}" class="form-control" placeholder="descripci&oacute;n" />
																<span class="form-text text-muted">>Por favor entre el correo</span>
															</div>
															</div>
															<div class="form-group row">
															<label class="col-form-label text-right col-lg-3">Tel&eacute;fono:</label>
														 	  <div class="col-lg-6 col-md-9 col-sm-12">
																<input id="phone" type="text" name="phone" value="{{$data->phone}}" class="form-control" placeholder="descripci&oacute;n" />
																<span class="form-text text-muted">>Por favor entre el tel&eacute;fono </span>
															  </div>
															</div>
														</div>
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Departamento:</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<select class="form-control" id="kt_select2_1" name="departments_id">
													@foreach($department as $e)
													  <option value="{{$e->id}}">{{$e->name}}</option>
													  @endforeach
													</select>
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