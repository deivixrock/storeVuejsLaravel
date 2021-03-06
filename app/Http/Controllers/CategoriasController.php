<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //segurity request only ajax
        if(!$request->ajax()) return redirect('/');
        //si no se cumple le ejecuta lo siguiente
        $buscar = $request->buscar;
        $criterio = $request->criterio;     
       if($buscar ==""){
            $categorias = Categoria::orderBy('id', 'desc')->paginate(3);
        }else{                
            $categorias = Categoria::where($criterio, 'like', '%'.$buscar.'%')->orderBy('id', 'desc')->paginate(3);
        }
        
        return[
            'pagination' => [
             'total'         => $categorias->total(),
             'current_page'  => $categorias->currentPage(),
             'per_page'      => $categorias->perPage(),
             'last_page'     => $categorias->lastPage(),
             'from'          => $categorias->firstItem(),
             'to'            => $categorias->lastItem(),
            ],
        'categorias' => $categorias      
        ];
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //segurity request only ajax
       if(!$request->ajax()) return redirect('/');

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       //segurity request only ajax
        if(!$request->ajax()) return redirect('/');
        //return $request;
        $categoria = Categoria::findOrFail($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;
        $categoria->condicion = '1';
        $categoria->save();
        
        
    }

    public function desactivar(Request $request)
    {  
        //segurity request only ajax
        if(!$request->ajax()) return redirect('/');

        $categoria = Categoria::findOrFail($request->id);        
        $categoria->condicion = '0';
        $categoria->save();
    }

    public function activar(Request $request)
    {
       //segurity request only ajax
       if(!$request->ajax()) return redirect('/');

        $categoria = Categoria::findOrFail($request->id);        
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function selectCategoria(Request $request){

        if(!$request->ajax()) return redirect('/');

        $categorias  = Categoria::where('condicion', '=', '1')
        ->select('id', 'nombre')->orderBy('nombre', 'asc')->get();

        return ['categorias' => $categorias];

    }

   
}
