<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActualizarProductoRequest;
use App\Http\Requests\RegistrarProductoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{

    public function index()
    {

        $sql = DB::select("select producto.* , categoria.nombre as cate , tipo_producto.nombre as cate2 from producto
        inner join categoria ON producto.id_categoria=categoria.id_categoria inner join tipo_producto ON producto.id_tipo=tipo_producto.id_tipo
where producto.estado=1
order by producto.id_producto asc");

        return view("vistas/producto/producto", compact("sql"));
    }
    public function create()
    {
        // $sql = DB::select("select * from categoria where estado=1");
        $sql2 = DB::select("select * from tipo_producto");

        return view("vistas/producto/registrar", compact("sql2"));
    }

    public function store(RegistrarProductoRequest $request)
    {

        if($request->id_tipo == 1){
            $precio = 0.50;
            try {
                $sql = DB::insert("insert into producto(id_categoria,id_tipo,nombre,descripcion,precio,stock,estado) values(?,?,?,?,?,?,1)", [
                    $request->cate,
                    $request->id_tipo,
                    $request->nombre,
                    $request->descripcion,
                    $precio,
                   $request->stock
                ]);
            } catch (\Throwable $th) {
                $sql = 0;
            }
        }
        try {
            $sql = DB::insert("insert into producto(id_categoria,id_tipo,nombre,descripcion,precio,stock,estado) values(?,?,?,?,?,?,1)", [
                $request->cate,
                $request->id_tipo,
                $request->nombre,
                $request->descripcion,
                $request->precio,
               $request->stock
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
        }

      
        if ($sql == 1) {
            return back()->with("CORRECTO", "Producto registrado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }
    public function edit($id)
    {
        $sql = DB::select("select * from producto where id_producto=? and estado=1", [
            $id
        ]);

        // $sql2 = DB::select("select * from categoria where estado=1");
        $sql3 = DB::select("select * from tipo_producto");

        return view('vistas/producto/actualizar', compact('sql'))->with("cate")->with("sql3", $sql3);
    }

    public function update(ActualizarProductoRequest $request, $id)
    {
        try {
            $sql = DB::update("update producto set id_categoria=?, id_tipo=?, nombre=?, descripcion=?, precio=?, stock=?
         where id_producto=?", [
                $request->cate,
                $request->id_tipo,
                $request->nombre,
                $request->descripcion,
                $request->precio,
               $request->stock,
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Producto actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }

    public function agregarElemento($id){
        $sql = DB::select("select * from categoria where estado =1 and id_tipo=? ", [
            $id
        ]);
        return response()->json($sql);
        
    }


    public function destroy($id)
    {
        try {
            $sql = DB::update("update producto set estado=0 where id_producto=?", [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Producto eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}
