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
    <a href="{{route('proyecto.create')}}" class="btn btn-rounded btn-success"><i class="fas fa-plus"></i>&nbsp;
        Registrar</a>
</div>


<section class="card">
    <div class="card-block d-flex justify-content-center flex-wrap">
        @foreach($sql as $item)
        <div class="card m-2" style="width: 25rem;">
        
            <img src="data:image/jpg;base64,<?= base64_encode($item->foto) ?>" class="card-img-top" width="200px" height="200px">
            <div class="card-body">
                <h5 class="card-title" style="font-weight: bold;">Nombre del proyecto: {{$item->nombre}}</h5>
                <p class="card-text"  style="font-weight: bold;">Descripcion del proyecto: {{$item->descripcion}}</p>
                <p class="card-text"  style="font-weight: bold;">Fecha de inicio: {{$item->fecha_inicio}}</p>
                <p class="card-text"  style="font-weight: bold;">Fecha de fin: {{$item->fecha_final}}</p>
                @if ($item->estado === 1)
                <p  class="card-text">Estado: Activo</p>
                @else
                <p  class="card-text">Estado: Finalizado</p>
                @endif
                <div class="d-flex justify-content-center">
                    <a href="{{route('proyecto.edit',$item->id_proyecto)}}" class="btn btn-warning"><i class="fas fa-edit"></i>&nbsp;
                        Editar</a>
                        <a style="top: 0" href="{{route('salida.edit',$item->id_proyecto)}}"
                                    class="btn mx-1   btn-success ">Agregar Herramientas</a>
                    <!-- <form action="{{route('proyecto.destroy',$item->id_proyecto)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-rounded btn-danger"><i class="fas fa-trash-alt"></i>&nbsp;
                            Eliminar</button>
                    </form> -->
                </div>
                <!--<a href="#" class="btn btn-primary">agregar herramientas</a> -->
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection