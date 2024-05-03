<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class DocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function getDocentes(){ #jala de la base de datos y lo almacena en planes
        $docentes=Docente::all();;
        return view('escolares.docente',compact('docentes'));
    }
    public function updateDocente (Request $request,$id){ #para enviar y modificar el cosos
        try{
        #$data = $request ->all();
        $docente = Docente::findOrFail($id);
        //select all from olanes_estudio where id = $id
        $docente -> rfc = $request->UpRFCDocente;
        $docente -> nombre = $request->UpNombreDocente;
        $docente -> ap_paterno = $request->UpApPaternoDocente;
        $docente -> ap_materno = $request->UpApMaternoDocente;
        $docente -> curp = $request->UpCurpDocente;
        $docente -> email = $request->UpEmailDocente;
        //actaulizar
        $docente->save();
        //return $request; #regresa un token en xml
        return back() -> with("Correcto","Docente modificado correctamente");
        }catch (QueryException $e){
            if($e ->errorInfo[1]==1062){
                return back() -> with("Error","Error, El RFC ya existe");
            }
            return back() -> with("Error","Error al modificar docente");
        }
    }
    public function createDocente(Request $request)
{
    try {

        // Crea un nuevo docente
        $fecha_nacimiento= substr(str_replace(' ','',$request->txtCURPDoc),4,6);

        $usuario= User::create([
            'name' => $request->txtNombreDoc.' '.$request->txtApPaternoDoc.' '.$request->txtApMaternoDoc,
            'email'=>$request->txtEmailDoc,
            'password' => Hash::make('Tecsj+'.$fecha_nacimiento)
            
        ]);
        $usuario->assignRole('docente');

        $request->validate([
            'txtRFCDoc' => 'required|string',
            'txtNombreDoc' => 'required|string',
            'txtApPaternoDoc' => 'required|string',
            'txtApMaternoDoc' => 'required|string',
            'txtCURPDoc' => 'required|string',
            'txtEmailDoc' => 'required|email',
        ]);


        $docente = new Docente();
        $docente -> rfc = $request->txtRFCDoc;
        $docente -> nombre = $request->txtNombreDoc;
        $docente -> ap_paterno = $request->txtApPaternoDoc;
        $docente -> ap_materno = $request->txtApMaternoDoc;
        $docente -> curp = $request->txtCURPDoc;
        $docente -> email = $request->txtEmailDoc;
        $docente -> user_id = $usuario ->id;
        $docente->save(); //Guardamos


        //registrar docente
        

        
                    
        return back()->with("Correcto", "Docente agregado correctamente");
    
    } catch (QueryException $e) {
        if ($e->errorInfo[1] == 1062) {
            return back()->with("Error", "ERROR - Ese RFC ya existe");
        }
        // Cualquier Otro error
        return back()->with("Error", "$e");
    }
}
public function deleteDocente($id)
{
//Hay que recibir como parametro el id del registro a eliminar

    try {
		    // Buscamos el plan de estudio
        $docente = Docente::findOrFail($id);
        // Se elimina
        $docente->delete();

        return back()->with("Correcto", "Se ha eliminado el Docente correctamente");
    } catch (QueryException $e) {
        // Cualquier  error
        return back()->with("Incorrecto", "Error al eliminar al Docente");
    }
}
}
