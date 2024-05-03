<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salones;
use Illuminate\Database\QueryException;

class SalonesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function updateSalon (Request $request,$id){ #para enviar y modificar el cosos
        try{
        #$data = $request ->all();
        $salon = Salones::findOrFail($id);
        //select all from olanes_estudio where id = $id
        $salon -> nombre_salon = $request->UpNombreSalon;
        $salon -> edificio_id = $request->UpEdificioIdSalon;
        //actaulizar
        $salon->save();
        //return $request; #regresa un token en xml
        return back() -> with("Correcto","salon modificado correctamente");
        }catch (QueryException $e){
            if($e ->errorInfo[1]==1062){
                return back() -> with("Error","Error, El SALON ya existe");
            }
            return back() -> with("Error","Error al modificar salon");
        }
    }
    public function createSalon(Request $request)
{
    try {
        $request->validate([
            'txtNombreSalon' => 'required|string',
            'txtEdificioIdSalon' => 'required|string',
        ]);

        // Crea un nuevo salon
        $salon = new Salones();
        $salon -> nombre_salon = $request->txtNombreSalon;
        $salon -> edificio_id = $request->txtEdificioIdSalon;
        $salon->save(); //Guardamos
                    
        return back()->with("Correcto", "salon agregado correctamente");
    
    } catch (QueryException $e) {
        if ($e->errorInfo[1] == 1062) {
            return back()->with("Error", "ERROR - Ese EDIFICIO ya existe");
        }
        // Cualquier Otro error
        return back()->with("Error", "Error al agregar el salon");
    }
}
public function deleteSalon($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $salon = Salones::findOrFail($id);
        // Se elimina
        $salon->delete();

        return back()->with("Correcto", "Se ha eliminado el salon correctamente");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al eliminar al salon");
    }
}
}