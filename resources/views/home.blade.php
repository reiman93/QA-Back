@extends('layout.base')
@section('breadcrumb')
<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Inicio</a></li>
</ol>
<h6 class="font-weight-bolder mb-0">Inico</h6>
@endsection
@section('content')
esta es el home
@endsection
@section('extrajs')
<script>
    console.warn("esto funciona bine???",document.getElementById('home'));
   document.getElementById('home').classList.add("active", "bg-gradient-primary");
</script>
@endsection