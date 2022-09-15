@extends('layout.base')
                       @section('subheader')
                         <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">Pre operaci&oacute;n de sanidad</h5>
										<!--end::Page Title-->
										<!--begin::Breadcrumb-->
										<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
											<li class="breadcrumb-item text-muted">
												<a href="" class="text-muted">Reportes</a>
											</li>
											<li class="breadcrumb-item text-muted">
												<a href="" class="text-muted">Pre operaci&oacute;n de sanidad</a>
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
  		                      <!--begin::Card-->
                                <div class="card card-custom">
									<div class="card-header flex-wrap border-0 pt-6 pb-0">
										<div class="card-title">
											<h3 class="card-label">Pre operaci&oacute;n de sanidad
											<span class="d-block text-muted pt-2 font-size-sm">regristro de pre opreaciones de sanidad  realizadas</span></h3>
										</div>
										<div class="card-toolbar">
										<!--begin::Button-->
											<a href="{{route('preOperSani.create')}}" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>Adicionar Pre operaci&oacute;n </a>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Search Form-->
										<!--end: Search Form-->
										<!--begin: Datatable-->
										<!--<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>-->
										<!--end: Datatable-->
                     <table id="preOperSaniTable" class="table table-ligth">
                        <thead class="thead-ligth">
                            <tr>
                                <th>Nombre</th> 
                                <th>Descripci&oacute;n<th> 
                                <th>Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
						@if(count($data)!=0)         
						@foreach($data as $e)
                            <tr id="preOperSani{{$e->id}}">
                            <td>{{$e->name}}</td>
                            <td>{{$e->description}}</td>
                            <td>   
							
							<div class="checkbox-inline">
								<input id="preOperSwitch{{$e->id}}" style="display:none;" data-switch="true" type="checkbox" checked="checked" name="aceptable" data-on-text="Aceptable" data-off-text="Reject" data-on-color="primary" />
								<label class="checkbox">
								<input id="chkRevisada{{$e->id}}" type="checkbox" name="Checkboxes2" />
								<span></span>Revisar</label>
							</div>
                             </td>
                            </tr>
                            @endforeach   
							@else
								<tr><td ><spam>  No hay datos para mostrar</spam></td></tr>     
							@endif
                        </tbody>
                     </table>
                     <div class="d-flex justify-content-between align-items-center flex-wrap">
                          <div class="d-flex flex-wrap py-2 mr-3">
                              <a id="preOperSaniPrevFinal" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
                              <a id="preOperSaniPrev"  class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
							 <div id="preOperSaniPagesContainer">
								@for($i = 1; $i < $cantPages+1; $i++)
								<a id="preOperSanipage{{$i}}" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">{{$i}}</a>
								@endfor
							 </div>
                              <a id="preOperSaniNext" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
                              <a id="preOperSaniNextFinal" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
                          </div>
                          <div class="d-flex align-items-center py-3">
                              <div class="d-flex align-items-center">
                                  <div class="mr-2 text-muted">Loading...</div>
                                  <div class="spinner mr-10"></div>
                              </div>

                              <select id="preOperSaniLimitCombo" class="form-control form-control-sm font-weight-bold mr-4 border-0 bg-light" style="width: 75px;">
                                  <option value="5">5</option>
                                  <option value="10">10</option>
                                  <option value="20">20</option>
                                  <option value="30">30</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                              </select>
                              <span id="preOperSaniDiplay">Mostrando {{count($data)}} de {{$total}} entradas</span>
                          </div>
                      </div>
									</div>
								</div>
								<!--end::Card-->
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

	$('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                console.log("Checkbox is checked.",$(this).prop("id"));
            }
            else if($(this).prop("checked") == false){
                console.log("Checkbox is unchecked.");
            }
        });

	$('input[type="checkbox"]').on('switchChange.bootstrapSwitch', function (e, data) {
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

		$("#preOperSaniLimitCombo").val("5");
	$('#preOperSanipage'+currentPage).removeClass('btn-light');
	$('#preOperSanipage'+currentPage).addClass('active btn-primary');

	$('#preOperSaniLimitCombo').change(function(){
		console.warn('evento change'); 
		console.warn(this.value);
		let param={
			"token": "{{csrf_token()}}",
			"url": "/storePreOperSani",
			"limit": this.value,
			"offset":"{{$offset}}",
			"endpoint":"preOperSani",
			"name":"Departamento",
			"columns":["name","description"]
		}
		currentPage=1;
		reloadDataTable(param); 
	});
	$('#preOperSaniPrev').click(function(){
		if(offset>0){
			offset=offset-parseInt($('#preOperSaniLimitCombo').val());
			let param={
			"token": "{{csrf_token()}}",
			"url": "/storePreOperSani",
			"limit": $('#preOperSaniLimitCombo').val(),
			"offset":offset,
			"endpoint":"preOperSani",
			"name":"Departamento",
			"columns":["name","description"]
		}
		currentPage--;
		reloadDataTable(param);
		console.warn("puto next page",param)
		}
	});

	$('#preOperSaniNext').click(function(){
		if(pageItemCant<{{$total}}){
			offset=offset+parseInt($('#preOperSaniLimitCombo').val());
			let param={
			"token": "{{csrf_token()}}",
			"url": "/storePreOperSani",
			"limit": $('#preOperSaniLimitCombo').val(),
			"offset":offset,
			"endpoint":"preOperSani",
			"name":"Departamento",
			"columns":["name","description"]
		}
		currentPage++;
		reloadDataTable(param);
		}
	});
	$('#preOperSaniPrevFinal').click(function(){
		if(offset>0){
			offset=0;
			let param={
			"token": "{{csrf_token()}}",
			"url": "/storePreOperSani",
			"limit": $('#preOperSaniLimitCombo').val(),
			"offset":offset,
			"endpoint":"preOperSani",
			"name":"Departamento",
			"columns":["name","description"]
		}
		currentPage=1;
		reloadDataTable(param);
		}
	});
	$('#preOperSaniNextFinal').click(function(){ 
		if(pageItemCant<{{$total}}){
			offset=parseInt($('#preOperSaniLimitCombo').val())*(parseInt({{$cantPages}}-1));
			let param={
			"token": "{{csrf_token()}}",
			"url": "/storePreOperSani",
			"limit": $('#preOperSaniLimitCombo').val(),
			"offset":offset,
			"endpoint":"preOperSani",
			"name":"Departamento",
			"columns":["name","description"]
		}
		currentPage=parseInt({{$cantPages}});
		reloadDataTable(param);
		}
	});
</script>
@endsection