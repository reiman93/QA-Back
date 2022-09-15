var offset = 0; //variable para manejar el offset en el paginado de las tablas;
var currentPage = 1; //variable para manejar la pagina actual
var pageItemCant = 0;
var totalItemCont = 0;
var cantPages = 0;

var daleteEntity = function (id, token, endpoint, name) {
    Swal.fire({
        title: "Está seguro que desea eliminar?",
        text: "Esta acción es irreversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar"
    }).then(function (result) {
        if (result.value) {
            var data = {
                "_token": token,
                "id": id
            }
            $.ajax({
                url: '/' + endpoint + '/' + id,
                type: 'delete',
                dataType: 'json',
                contentType: 'application/json',
                success: function (data) {
                    Swal.fire(
                        "Eliminado:",
                        name + "ha sido eliminado exitosamente",
                        "success"
                    )
                    $('#' + endpoint + "Table").find("tr").each(function (index, element) {
                        if (element.id == endpoint + id) {
                            $('#' + endpoint + id).remove();
                        }
                    });
                },
                error: function (data) {
                    Swal.fire(
                        "Error de la peticion!",
                        data.responseJSON.message,
                        "error"
                    )
                },
                data: JSON.stringify(data)
            });
        }
    });
}
var daletePaginEntity = function (params) {
    console.warn("estos son los parametrs del daletePaginEntity area por paginado", params)
    Swal.fire({
        title: "Está seguro que desea eliminar?",
        text: "Esta acción es irreversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Aceptar"
    }).then(function (result) {
        if (result.value) {
            var data = {
                "_token": params.token,
                "id": params.id
            }
            $.ajax({
                url: '/' + params.endpoint + '/' + params.id,
                type: 'delete',
                dataType: 'json',
                contentType: 'application/json',
                success: function (data) {
                    Swal.fire(
                        "Eliminado:",
                        params.name + " ha sido eliminado exitosamente",
                        "success"
                    )
                    $('#' + params.endpoint + "Table").find("tr").each(function (index, element) {
                        if (element.id == params.endpoint + params.id) {
                            $('#' + params.endpoint + params.id).remove();
                        }
                    });
                    pageItemCant--;
                    totalItemCont=data.total;
                    $("#" + params.endpoint + "Diplay").html("Mostrando " + pageItemCant + " de " + totalItemCont + " entradas");
                },
                error: function (data) {
                    Swal.fire(
                        "Error de la peticion!",
                        data.responseJSON.message,
                        "error"
                    )
                },
                data: JSON.stringify(data)
            });
        }
    });
}

var selectLanguage = function (key) {
    lang = key;
}

var reloadDataTable = (params) => {
    console.warn("Estos son los parametros", params)
    var data = {
        "_token": params.token,
        "limit": params.limit,
        "offset": params.offset,
        "currentPage": currentPage
    }
    $.ajax({
        url: params.url,// + params.endpoint + '/',
        type: 'POST',
        dataType: 'json',
        contentType: 'application/json',
        success: function (resp) {
            console.warn("estos son los datos de resp", resp)
            var data = [];
            if (resp.data.length) {
                data = resp.data;
            } else {
                for (key in resp.data) {
                    data.push(resp.data[key]);
                }
            }
            offset = resp.offset;

            $('#' + params.endpoint + "Table > tbody").empty();
            var rows = '';
            totalItemCont = resp.total;
            cantPages = resp.cantPages;
            pageItemCant = resp.cantItemsDisplayed;
            for (var i = 0; i < data.length; i++) {
                let delParams = {
                    "token": params.token,
                    "endpoint": params.endpoint,
                    "name": params.name,
                    "id": data[i].id
                };
                let row = document.createElement('tr');
                row.setAttribute('id', params.endpoint + data[i].id);
/************************building data columns ***************************************** */
                 for (const key in params.columns) {
                     let tdColumn=document.createElement('td');
                     tdColumn.innerHTML = data[i][params.columns[key]];
                     row.appendChild(tdColumn);
                 }
               /* let tdName = document.createElement('td');
                tdName.innerHTML = data[i].name;
                let tdDescription = document.createElement('td');
                tdDescription.innerHTML = data[i].description;*/
 /**************End of data columns****************************************************** */ 
               /****************Building the update and delete options******************************* */
                let tdoptions = document.createElement('td');
                let aUpdate = document.createElement('a');
                // aUpdate.setAttribute('href',"{{route('area.edit',"+data[i].id+")}}");
                aUpdate.setAttribute("class", "btn btn-icon btn-xs btn-primary");
                aUpdate.setAttribute('href', "/"+params.endpoint+"/" + data[i].id + "/edit");
                let iUpdate = document.createElement("i");
                iUpdate.setAttribute("class", "fa fa-edit");
                aUpdate.appendChild(iUpdate);
                let aDelete = document.createElement('a');
                aDelete.setAttribute("class", "btn btn-icon btn-xs btn-danger");
                //  aDelete.setAttribute('onClick',daletePaginEntity(delParams));
                aDelete.onclick = function(evt){
                    evt.preventDefault();
                    daletePaginEntity(delParams);
                }

                let iDelete = document.createElement("i");
                iDelete.setAttribute("class", "fa fa-trash");
                aDelete.appendChild(iDelete);
                tdoptions.appendChild(aUpdate);
                tdoptions.appendChild(aDelete);
               /* row.appendChild(tdName);
                row.appendChild(tdDescription);*/
                row.appendChild(tdoptions);
    /******************End of options*********************************** */    
                /* rows = '<tr id="' + params.endpoint + data[i].id + '">\
                 <td>' + data[i].name + '</td>\
                 <td>' + data[i].description + '</td>\
                 <td>\
                 <a href="{{'+route(area.edit, + data[i].id  )+'}}"  class="btn btn-icon btn-xs btn-primary" > <i class="fa fa-edit"></i></a>\
                 <a  onclick="\"daletePaginEntity('+ delParams + ')"\" class="btn btn-icon btn-xs btn-danger"><i class="fa fa-trash"></i></a>\
                   </td>\
                 </tr>';*/
                $('#' + params.endpoint + "Table tbody").append(row);
            }//daleteEntity('+ data[i].id+',"'+params.token+'","area","&Aacute;rea")
            $("#" + params.endpoint + "Diplay").html("Mostrando " + pageItemCant + " de " + totalItemCont + "  elementos");
            /*********Construyendo la cantidad de paginas*********** */
            $("#" + params.endpoint + "PagesContainer").empty();
            for (var p = 1; p <= resp.cantPages; p++) {
                $("#" + params.endpoint + "PagesContainer").append('<a id="'+params.endpoint+'page' + p + '" class="btn btn-icon btn-sm border-0 btn-light mr-2 my-1">' + p + '</a>');
            }
            $('#'+params.endpoint+'page' + currentPage).removeClass('btn-light');
            $('#'+params.endpoint+'page' + currentPage).addClass('active btn-primary');
            /****************************************************** */

        },
        error: function (data) {
            Swal.fire(
                "Error de la peticion!",
                data.responseJSON.message,
                "error"
            )
            offset = 0;
            $('#areapage' + currentPage).removeClass('active btn-primary');
            $('#areapage' + currentPage).addClass('btn-light');
            currentPage = 1;
            $('#areapage' + currentPage).removeClass('btn-light');
            $('#areapage' + currentPage).addClass('active btn-primary');
        },
        data: JSON.stringify(data)
    });
}
