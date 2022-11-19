<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = DB::select("select  proyectos.* , usuario.nombre as cate from proyectos
        inner join usuario ON proyectos.id_usuario=usuario.id_usuario
        where proyectos.estado=1 order by proyectos.id_proyecto asc");
        return view("vistas/proyecto/index", compact("sql"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sql = DB::select("select * from usuario where estado=1");

        return view("vistas/proyecto/registrar", compact("sql"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $foto = file_get_contents($_FILES['foto']['tmp_name']);
        } catch (\Throwable $th) {
            $foto = "";
        }
        try {
            $sql2 =DB::insert("insert into cliente(nombre,apellido,telefono,direccion) values(?,?,?,?)",[
                $request->nombreC,
                $request->apellido,
                $request->telefono,
                $request->direccion,
              
            ]);
            //get id de cliente
            $id_cliente= DB::select("select max(id_cliente) as 'id' from cliente");
            $id_cliente=$id_cliente[0]->id;
            $sql = DB::insert("insert into proyectos(id_usuario,nombre,descripcion,id_cliente,fecha_inicio,fecha_final,foto,estado) values(?,?,?,?,?,?,?,1)", [
                $request->cate,
                $request->nombre,
                $request->descripcion,
                $id_cliente,
                $request->fecha_inicio,
                $request->fecha_final,
                $foto,
            ]);
        } catch (\Throwable $th) {
            $sql = 0;
            $sql2 = 0;
        }
        if ($sql == 1 && $sql2 == 1) {
            return back()->with("CORRECTO", "Proyecto registrado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al registrar");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sql = DB::select('SELECT proyectos.*, cliente.nombre as nombreC, cliente.apellido as apellido, cliente.telefono as telefono , cliente.direccion as direccion FROM proyectos INNER JOIN cliente ON proyectos.id_cliente = cliente.id_cliente WHERE proyectos.id_proyecto = ?', [$id]);
        $id_cliente = $sql[0]->id_cliente;
        $sql2 = DB::select("select * from usuario where estado=1");

        return view('vistas/proyecto/actualizar', compact('sql'))->with("cate", $sql2);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $foto= file_get_contents($_FILES['foto']['tmp_name']);
        } catch (\Throwable $th) {
            $foto = "";
        }
        try {
            $id_cliente= DB::select("select * from proyectos where id_proyecto=?",[$id]);
            $id_cliente=$id_cliente[0]->id_cliente;
            $updatecliente = DB::update("update cliente set nombre=?,apellido=?,telefono=?,direccion=? where id_cliente=?",[
                $request->nombreC,
                $request->apellido,
                $request->telefono,
                $request->direccion,
                $id_cliente
            ]);
           $updateProyecto= DB::update("update proyectos set id_usuario=?,nombre=?,descripcion=?,fecha_inicio=?,fecha_final=?,foto=? where id_proyecto=?",[
                $request->cate,
                $request->nombre,
                $request->descripcion,
                $request->fecha_inicio,
                $request->fecha_final,
                $foto,
                $id
            ]);
            if ($updateProyecto == 0) {
                $updateProyecto = 1;
            }
        } catch (\Throwable $th) {
            $updateProyecto = 0;
        }

        if ($updateProyecto == 1) {
            return back()->with("CORRECTO", "Proyecto actualizado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al actualizar");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $sql = DB::update("update proyectos set estado=0 where id_proyecto=?", [
                $id
            ]);
            if ($sql == 0) {
                $sql = 1;
            }
        } catch (\Throwable $th) {
            $sql = 0;
        }

        if ($sql == 1) {
            return back()->with("CORRECTO", "Proyecto eliminado correctamente");
        } else {
            return back()->with("INCORRECTO", "Error al eliminar");
        }
    }
}