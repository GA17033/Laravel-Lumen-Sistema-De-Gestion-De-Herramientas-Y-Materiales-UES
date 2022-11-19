@extends('layouts/app')
@section('titulo', "registrar categoria")

@section('content')


{{-- notificaciones --}}

@if (session('DUPLICADO'))
<script>
    $(function notificacion(){
    new PNotify({
        title:"DUPLICADO",
        type:"error",
        text:"{{session('DUPLICADO')}}",
        styling:"bootstrap3"
    });		
});
</script>
@endif

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


<h4 class="text-center text-secondary">ACTUALIZAR CATEGORIA</h4>

<div class="mb-0 col-12 bg-white p-5">
    @foreach ($sql as $item)
    <form action="{{route('categoria.update',$item->id_categoria)}}" method="POST">
        @csrf
        <div class="row">


            <div class="fl-flex-label mb-4 col-12">
                <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre *"
                    value="{{$item->nombre}}">
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <select class="input input__select" name="id_tipo" id="id_tipo">
                    <option value="">Seleccionar tipo Producto...</option>
                    @foreach ($sql3 as $item3)
                    <option {{$item->id_tipo == $item3->id_tipo ? 'selected' : ''}} value="{{$item3->id_tipo}}" >
                        {{$item3->nombre}}</option>
                    @endforeach
                </select>
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>


            <div class="text-right mt-0">
                <a href="{{route('categoria.index')}}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-success">Guardar</button>
            </div>
        </div>

    </form>
    @endforeach
</div>




@endsection