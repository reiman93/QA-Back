
@extends('layout.base')
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<!--begin::Info-->
		<div class="d-flex align-items-center flex-wrap mr-1">
			<!--begin::Page Heading-->
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<!--begin::Page Title-->
				<h5 class="text-dark font-weight-bold my-1 mr-5">Pre-operaci&oacute;n</h5>
				<!--end::Page Title-->
				<!--begin::Breadcrumb-->
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="" class="text-muted">Reportes</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a href="" class="text-muted">Pre-operaci&oacute;n</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a href="" class="text-muted">Adicionar</a>
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
												<h3 class="card-title">Adicionar Pre-operaci&oacute;n </h3>
												<div class="card-toolbar">
													<div class="example-tools justify-content-center">
														<span class="example-toggle" data-toggle="tooltip" title="View code"></span>
														<span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
													</div>
												</div>
											</div>
											<!--begin::Form-->
											<form class="form" action="{{url('/preOperSani')}}" method="post">
                                                @csrf 
												<div class="card-body">
													<h3 class="font-size-lg text-dark font-weight-bold mb-6">Pre-operaci&oacute;n:</h3>
													<div class="mb-15">
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">&Aacute;rea:</label>
														<div class="col-lg-4 col-md-9 col-sm-12">
															<select class="form-control" id="kt_select2_4" name="areas_id">
															@foreach($area as $e)
															<option value="{{$e->id}}">{{$e->name}}</option>
															@endforeach
															</select>
														</div>
													</div>
														  <div class="form-group row">
														     <label class="col-form-label text-right col-lg-3 col-sm-12">Estado</label>
														      <div class="col-lg-9 col-md-9 col-sm-12">
															    <input id="preOperSwitch" data-switch="true" type="checkbox" checked="checked" name="aceptable" data-on-text="Aceptable" data-off-text="Reject" data-on-color="primary" />
														      </div>
													      </div>
														  <div class="form-group row">
															<label class="col-form-label text-right col-lg-3 col-sm-12">Fecha de revisi&oacute;n</label>
															<div class="col-lg-4 col-md-9 col-sm-12">
															<div class="input-group date" id="kt_datetimepicker_3" data-target-input="nearest">
															<input id="date" name="date" type="text" class="form-control datetimepicker-input" placeholder="Select date & time" data-target="#kt_datetimepicker_1"/>
															 <div class="input-group-append" data-target="#kt_datetimepicker_3" data-toggle="datetimepicker">
																<span class="input-group-text">
																<i class="ki ki-calendar"></i>
																</span>
															  </div>
															 </div>
															</div>
														 </div>
														 <div class="form-group row">
															<label class="col-form-label text-right col-lg-3 col-sm-12">Nota:</label>
															<div class="col-lg-3">
															 <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
															</div>
														</div>
													</div>
											<div class="form-group row">
												<label class="col-form-label text-right col-lg-3 col-sm-12">Analista:</label>
												<div class="col-lg-4 col-md-9 col-sm-12">
													<select class="form-control" id="kt_select2_5" name="quality_analysts_id">
													@foreach($analyst as $e)
													  <option value="{{$e->id}}">{{$e->name}}</option>
													  @endforeach
													</select>
												</div>
											</div>
												</div>
												<div class="card-footer">
													<div class="row">
														<div class="col-lg-3"></div>
														<div class="col-lg-6">
															<button type="submit" class="btn btn-success mr-2">Aceptar</button>
															<button type="reset" class="btn btn-secondary">Cancel</button>
														</div>
													</div>
												</div>
												<input type="text" id ="departments_id" name="departments_id" style="display:none;"/>
												<input type="text" id ="janitor_id" name="janitosr_id" style="display:none;"/>
												<input type="text" id ="relapse_action_id" name="relapse_actions_id" style="display:none;"/>
												<input type="text" id ="deficiency_type_id" name="deficiency_types_id" style="display:none;"/>
											</form>
											<!--end::Form-->														

                        </div>
@endsection
                     @section('extra-container')	
							<!--begin::Modal-->
							<div class="modal fade" id="kt_switch_modal" tabindex="-1" role="dialog" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title">Detalles de deficiencia </h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<i aria-hidden="true" class="ki ki-close"></i>
												</button>
											</div>
											<form class="form form--fit">
												<div class="modal-body">
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Tipo de deficiencia</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
													   <select class="form-control" id="kt_select2_1" name="deficiency_type_id">
														@foreach($deficiency as $e)
														<option value="{{$e->id}}">{{$e->name}}</option>
														@endforeach
												      </select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Acci&oacute;n correctiva</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
														<select class="form-control" id="kt_select2_2" name="relapse_action_id">
														@foreach($relapse as $e)
														<option value="{{$e->id}}">{{$e->name}}</option>
														@endforeach
												       </select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Empleado de limpieza</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
														<select class="form-control" id="kt_select2_3" name="janitor_id">
														@foreach($janitor as $e)
														<option value="{{$e->id}}">{{$e->name}}</option>
														@endforeach
												       </select>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-form-label text-right col-lg-3 col-sm-12">Departamento</label>
														<div class="col-lg-9 col-md-9 col-sm-12">
														<select class="form-control" id="kt_select2_8" name="department_id">
														@foreach($department as $e)
														<option value="{{$e->id}}">{{$e->name}}</option>
														@endforeach
												       </select>
														</div>
													</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-primary mr-2" data-dismiss="modal">Close</button>
													<button type="button" id="detailsPreOper" data-dismiss="modal" class="btn btn-secondary">Aceptar</button>
												</div>
											</form>
										</div>
									</div>
								</div>
								<!--end::Modal-->		
                       @endsection
@section('extrajs')
<script>
	$('#preOperSwitch').on('switchChange.bootstrapSwitch', function (e, data) {
		console.warn('se ejevuta', e, data)
		if(data==false){
			$('#kt_switch_modal').modal('show');
		}else{
			$('#deficiency_type_id').val('');
			$('#relapse_action_id').val('');
			$('#janitor_id').val('');	
			$('#departments_id').val('');	
		}  
		});
	$('#detailsPreOper').on('click', function (e) {
		  console.warn('se click del kt_select2_1', $('#kt_select2_1').val());
		  console.warn('se click del kt_select2_2', $('#kt_select2_2').val());
		  console.warn('se click del kt_select2_3', $('#kt_select2_3').val());
		  $('#deficiency_type_id').val($('#kt_select2_1').val());
		  $('#relapse_action_id').val($('#kt_select2_2').val());
		  $('#janitor_id').val($('#kt_select2_3').val());
		  $('#departments_id').val($('#kt_select2_8').val());
		});
</script>
@endsection