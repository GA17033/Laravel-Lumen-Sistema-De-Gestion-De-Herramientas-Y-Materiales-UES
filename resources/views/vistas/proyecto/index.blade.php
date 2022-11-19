@extends('layouts/app')
@section('titulo', "proyecto")

@section('content')

{{-- notificaciones --}}


@if (session('CORRECTO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"CORRECTO",
        type:"success",
        text:"{{session('CORRECTO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif



@if (session('INCORRECTO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"INCORRECTO",
        type:"error",
        text:"{{session('INCORRECTO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif

<h4 class="text-center text-secondary">LISTA DE PROYECTOS</h4>

<div class="pb-1 pt-2">
    <a href="{{route('proyecto.create')}}" class="btn btn-rounded btn-sucess"><i class="fas fa-plus"></i>&nbsp;
        Registrar</a>
</div>


<div class="card">
 
  <div class="card-body d-flex justify-content-start flex-wrap">
    @foreach ($sql as $item)
    <div class="card m-2" style="width: 18rem; border-radius:10%">
    <img class="card-img-top" src="data:image/jpg;base64,<?= base64_encode($item->foto) ?>" alt="" height="250px">
            <div class="card-body">
                <h5 class="card-title">Nombre del proyecto:{{$item->cate}}</h5>
                <p class="card-text">Descripcion: {{$item->descripcion}}</p>
                <p  class="card-text">Fecha de inicio: {{$item->fecha_inicio}}</p>
                <p  class="card-text">fecha de finalizacion :{{$item->fecha_final}}</p>
                @if ($item->estado === 1)
                <p  class="card-text">Estado: Activo</p>
                @else
                <p  class="card-text">Estado: Inactivo</p>
                @endif
                
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
    </div>

    @endforeach
  
  </div>
</div>




@endsection