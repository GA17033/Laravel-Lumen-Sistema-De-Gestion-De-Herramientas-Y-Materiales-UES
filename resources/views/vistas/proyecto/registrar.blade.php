@extends('layouts/app')
@section('titulo', "registrar proyecto")

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


<h4 class="text-center text-secondary">REGISTRO DE PROYECTOS</h4>

<div class="mb-0 col-12 bg-white p-5">
    <form action="{{route('proyecto.store')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <select class="input input__select" name="cate">
                    <option value="">Seleccionar Encargado...</option>
                    @foreach ($sql as $item)
                    <option {{old('cate') == $item->id_usuario ? 'selected' : ''}} value="{{$item->id_usuario}}">
                        {{$item->nombre}}</option>
                    @endforeach
                </select>
                @error('cate')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre del proyecto *"
                    value="{{old('nombre')}}">
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12">
                <textarea class="input input__text" name="descripcion" cols="30" rows="3"
                    placeholder="Descripcion del producto">{{old('descripcion')}}</textarea>
            </div>

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <label for="foto">Fecha De Inicio</label>
                <input type="date" name="fecha_inicio" class="input input__text" id="fecha_inicio"
                    value="{{old('fecha_inicio')}}">
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
            <label for="foto">Fecha De Finalizacion</label>
                <input type="date" name="fecha_final" class="input input__text" id="fecha_final"
                    value="{{old('fecha_final')}}">
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="file" name="foto" class="input form-control-file input__text" value="{{old('foto')}}">
            </div>
            <label style="font-weight:bold">Datos del cliente </label>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="nombreC" class="input input__text" id="nombreC" placeholder="Nombre del cliente *"
                    value="{{old('nombreC')}}">
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="apellido" class="input input__text" id="apellido" placeholder="Apellido *"
                    value="{{old('apellido')}}">
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="tel" name="telefono" class="input input__text" id="telefono" placeholder="Telefono *"
                    value="{{old('telefono')}}">
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="direccion" class="input input__text" id="direccion" placeholder="Direccion *"
                    value="{{old('direccion')}}">
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

            <div class="text-right mt-0">
                <a href="{{route('herramienta.index')}}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-success">Guardar</button>
            </div>
        </div>

    </form>
</div>




@endsection