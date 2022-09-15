

@extends('layout.base')
@section('subheader')
<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
							<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
								<!--begin::Info-->
								<div class="d-flex align-items-center flex-wrap mr-1">
									<!--begin::Page Heading-->
									<div class="d-flex align-items-baseline flex-wrap mr-5">
										<!--begin::Page Title-->
										<h5 class="text-dark font-weight-bold my-1 mr-5">&Aacute;rea</h5>
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
												<a href="" class="text-muted">&Aacute;rea</a>
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
											<h3 class="card-label">&Aacute;rea
											<span class="d-block text-muted pt-2 font-size-sm">nomenclaor para agrupar las &aacute;reas del sistema</span></h3>
										</div>
										<div class="card-toolbar">
										<!--begin::Button-->
											<a href="{{route('area.create')}}" class="btn btn-primary font-weight-bolder">
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
											</span>Adicionar &aacute;rea</a>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Search Form-->
										<!--end: Search Form-->
										<!--begin: Datatable-->
										<!--<div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>-->
										<!--end: Datatable-->
                     <table id="areaTable" class="table table-ligth">
                        <thead class="thead-ligth">
                            <tr>
                                <th>Nombre</th> 
                                <th>Descripcion</th> 
                                <th>Acciones</th> 
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($data as $e)
                            <tr id="area{{$e->id}}">
                            <td>{{$e->name}}</td>
                            <td>{{$e->description}}</td>
                            <td>   
                              <a href="{{route('area.edit',$e->id)}}" class="btn btn-icon btn-xs btn-primary">
                                <i class="fa fa-edit"></i>
                              </a>
                              <a  onclick="daleteEntity({{$e->id}},'{{ csrf_token() }}','area','&Aacute;rea')" class="btn btn-icon btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                              </a>
                             </td>
                            </tr>
                            @endforeach
                        </tbody>
                     </table>
                     <div class="d-flex justify-content-between align-items-center flex-wrap">
                          <div class="d-flex flex-wrap py-2 mr-3">
                              <a id="areaPrevFinal" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-double-arrow-back icon-xs"></i></a>
                              <a id="areaPrev"  class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-back icon-xs"></i></a>
							 <div id="areaPagesContainer">
								@for($i = 1; $i < $cantPages+1; $i++)
								<a id="areapage{{$i}}" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">{{$i}}</a>
								@endfor
							 </div>
                              <a id="areaNext" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-arrow-next icon-xs"></i></a>
                              <a id="areaNextFinal" class="btn btn-icon btn-sm btn-light mr-2 my-1"><i class="ki ki-bold-double-arrow-next icon-xs"></i></a>
                          </div>
                          <div class="d-flex align-items-center py-3">
                              <div class="d-flex align-items-center">
                                  <div class="mr-2 text-muted">Loading...</div>
                                  <div class="spinner mr-10"></div>
                              </div>

                              <select id="areaLimitCombo" class="form-control form-control-sm font-weight-bold mr-4 border-0 bg-light" style="width: 75px;">
                                  <option value="5">5</option>
                                  <option value="10">10</option>
                                  <option value="20">20</option>
                                  <option value="30">30</option>
                                  <option value="50">50</option>
                                  <option value="100">100</option>
                              </select>
                              <span id="areaDiplay">Mostrando {{count($data)}} de {{$total}} entradas</span>
                          </div>
                      </div>
									</div>
								</div>
								<!--end::Card-->
@endsection
@section('extrajs')
<script type="text/javascript">
$("#areaLimitCombo").val("5");
$('#areapage'+currentPage).removeClass('btn-light');
$('#areapage'+currentPage).addClass('active btn-primary');

 $('#areaLimitCombo').change(function(){
	console.warn('evento change'); 
	console.warn(this.value);
	let param={
		"token": "{{csrf_token()}}",
		"url": "/storeArea",
        "limit": this.value,
        "offset":"{{$offset}}",
		"endpoint":"area",
		"name":"&Aacute;rea",
		"columns":["name","description"]
	}
	currentPage=1;
	reloadDataTable(param); 
 });
 $('#areaPrev').click(function(){
	if(offset>0){
		offset=offset-parseInt($('#areaLimitCombo').val());
		let param={
			"token": "{{csrf_token()}}",
			"url": "/storeArea",
			"limit": $('#areaLimitCombo').val(),
			"offset":offset,
			"endpoint":"area",
			"name":"&Aacute;rea",
			"columns":["name","description"]
		}
	currentPage--;
	reloadDataTable(param);
	console.warn("puto next page",param)
	}
 });

 $('#areaNext').click(function(){
  	if(pageItemCant<{{$total}}){
		offset=offset+parseInt($('#areaLimitCombo').val());
		let param={
		"token": "{{csrf_token()}}",
		"url": "/storeArea",
        "limit": $('#areaLimitCombo').val(),
        "offset":offset,
		"endpoint":"area",
		"name":"&Aacute;rea",
		"columns":["name","description"]
	}
	currentPage++;
	reloadDataTable(param);
	}
 });
 $('#areaPrevFinal').click(function(){
	if(offset>0){
		offset=0;
		let param={
		"token": "{{csrf_token()}}",
		"url": "/storeArea",
        "limit": $('#areaLimitCombo').val(),
        "offset":offset,
		"endpoint":"area",
		"name":"&Aacute;rea",
		"columns":["name","description"]
	}
	currentPage=1;
	reloadDataTable(param);
	}
 });
 $('#areaNextFinal').click(function(){ 
  	if(pageItemCant<{{$total}}){
		offset=parseInt($('#areaLimitCombo').val())*(parseInt({{$cantPages}}-1));
		let param={
		"token": "{{csrf_token()}}",
		"url": "/storeArea",
        "limit": $('#areaLimitCombo').val(),
        "offset":offset,
		"endpoint":"area",
		"name":"&Aacute;rea",
		"columns":["name","description"]
	}
	currentPage=parseInt({{$cantPages}});
	reloadDataTable(param);
	}
 });

</script>
@endsection
