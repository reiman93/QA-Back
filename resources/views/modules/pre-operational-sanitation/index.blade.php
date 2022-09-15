

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
                                <th>&Aacute;rea</th> 
                                <th>Aceptable<th> 
                                <th>QA</th> 
                                <th>Fecha</th> 
                                <th>Opciones</th> 
                            </tr>
                        </thead>
                        <tbody>
						@if(count($data)!=0)         
						@foreach($data as $e)
                            <tr id="preOperSani{{$e->id}}">
                            <td>{{$e->area->name}}</td>
                            <td>{{$e->aceptable}}</td>
                            <td>{{$e->quality_analyst->name}}</td>
                            <td>{{$e->date}}</td>
                            <td>   
                              <a href="{{route('preOperSani.edit',$e->id)}}" class="btn btn-icon btn-xs btn-primary">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a  onclick="daleteEntity({{$e->id}},'{{ csrf_token() }}','preOperSani','Departamento')" class="btn btn-icon btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                              </a>
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
@section('extrajs')
	<script type="text/javascript">
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
