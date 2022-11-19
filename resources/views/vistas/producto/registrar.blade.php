@extends('layouts/app')
@section('titulo', "registrar producto")

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


<h4 class="text-center text-secondary">REGISTRO DE PRODUCTOS</h4>

<div class="mb-0 col-12 bg-white p-5">
    <form action="{{route('producto.store')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="row">

        <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <select class="input input__select" name="id_tipo" id="id_tipo">
                    <option value="">Seleccionar tipo Producto...</option>
                    @foreach ($sql2 as $item2)
                    <option {{old('nombre') == $item2->id_tipo ? 'selected' : ''}} value="{{$item2->id_tipo}}" >
                        {{$item2->nombre}}</option>
                    @endforeach
                </select>
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <select class="input input__select" name="cate" id="cate">
                    
                </select>
                @error('cate')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

           

            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="text" name="nombre" class="input input__text" id="nombre" placeholder="Nombre *"
                    value="{{old('nombre')}}">
                @error('nombre')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>
          
            <!-- si id_tipo es igual a 1 precio 0-->
            <div class="fl-flex-label mb-4 col-12 col-lg-6">
                <input type="number" name="precio" class="input input__text" id="precio" placeholder="Precio *"
                    value="{{old('precio',1)}}">
                @error('precio')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>



            <div class="fl-flex-label mb-4 col-12 col-lg-6">

                <input type="number" min="0" name="stock" class="input input__text" placeholder="Stock *"
                    value="{{old('stock',0)}}" >
                @error('stock')
                <small class="error error__text">{{$message}}</small>
                @enderror
            </div>

            <div class="fl-flex-label mb-4 col-12">
                <textarea class="input input__text" name="descripcion" cols="30" rows="3"
                    placeholder="Descripcion del producto">{{old('descripcion')}}</textarea>
            </div>

            <div class="text-right mt-0">
                <a href="{{route('producto.index')}}" class="btn btn-rounded btn-secondary m-2">Atras</a>
                <button type="submit" class="btn btn-rounded btn-success">Guardar</button>
            </div>
        </div>

    </form>
</div>

<script>
    //si el tipo de producto es 1 precio 0 y desabilitar y aparecer categoria segun el tipo de producto
    $(document).ready(function () {
        $('#id_tipo').change(function () {
            var id_tipo = $(this).val();
            if (id_tipo == 1) {
                //si es id_tipo 1 precio 0
               let precio = document.getElementById('precio');
                // precio.value = 1;
                // //blockear precio
                // precio.hidden = true;

                
                get_cat(id_tipo);
 
            } else {
                $('#precio').val('');
                $('#precio').attr('hidden', false);
            get_cat(id_tipo);
           
            }
        });
    });

    id_tipo = $('#id_tipo').val();

   const get_cat = (id_tipo)=>{
    $.get('/categoria-elemento/' + id_tipo, function (data) {
                    //console.log(data);
                
                    $('#cate').empty();
                    $('#cate').append("<option value=''>Seleccionar categoria...</option>");
                    $.each(data, function (index, value) {
                        $('#cate').append("<option value='" + value.id_categoria + "'>" + value.nombre +
                            "</option>");
                    });
                });
    

   }
    // $(document).ready(function(){
    //     $("#id_tipo").change(function(){
    //         var id_tipo = $(this).val();
    //         if(id_tipo == 1){
    //             $("#precio").val(0);
    //             $("#precio").attr("hidden", true);
    //         }else{
    //             $("#precio").val("");
    //             $("#precio").attr("hidden", false);
    //         }
    //     });
    // });
  

  
</script>




@endsection