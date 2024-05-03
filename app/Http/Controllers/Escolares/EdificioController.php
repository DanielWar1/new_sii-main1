<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Edificio;
use Illuminate\Database\QueryException;
use App\Models\Salones;
class EdificioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getEdificios()
    {
        $salones = Salones::all();
        $edificios = Edificio::all();
        return view('escolares.edificio', compact('edificios', 'salones'));
    }
    
    public function updateEdificio(Request $request, $id)
    {
        try {
            $edificio = Edificio::findOrFail($id);
            $edificio->nombre_edificio = $request->UpNombre;
            $edificio->descripcion = $request->UpDescripcion;
            $edificio->save();
            return back()->with("Correcto", "Edificio modificado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Error", "Error, Edificio duplicado");
            }
            return back()->with("Error", "Error al modificar Edificio");
        }
    }
    
    public function createEdificio(Request $request)
    {
        try {
            $request->validate([
                'txtEdificio' => 'required|string',
                'txtDescripcion' => 'required|string',
            ]);

            $edificio = new Edificio();
            $edificio->nombre_edificio = $request->txtEdificio;
            $edificio->descripcion = $request->txtDescripcion;
            $edificio->save();
            
            return back()->with("Correcto", "Edificio agregado correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Error", "Error - Ese Edificio ya existe");
            }
            return back()->with("Error", "Error al agregar el Edificio");
        }
    }
    
    public function deleteEdificio($id)
    {
        try {
            $edificio = Edificio::findOrFail($id);
            $edificio->delete();
            return back()->with("Correcto", "Se ha eliminado el Edificio correctamente");
        } catch (QueryException $e) {
            return back()->with("Incorrecto", "Error al eliminar el Edificio");
        }
    }
}
