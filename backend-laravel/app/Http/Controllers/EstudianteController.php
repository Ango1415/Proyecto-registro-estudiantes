<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

//Common Resource Routes:
    // index    -   Show all listings
    // show     -   Show single listening
    // create   -   Show form to create new listing
    // store    -   Store new listing
    // edit     -   Show form to edit listing
    // update   -   Update listing
    // destroy  -   Delete listing


class EstudianteController extends Controller
{
    public function index(){
        return Estudiante::all();
    }

    public function show($id){
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            return response()->json([
                'data'=>$estudiante,
                'message' => 'Record with id '.$id.' found successfully.',
            ]);
        }
        else
            return response()->json([
                'error' => true,
                'message' => 'Record with id '.$id.' not found.',
            ]);
    }

    public function store(Request $request){
        $inputs = $request->input();
        $respuesta = Estudiante::create($inputs);
        if(isset($respuesta)){
            return response()->json([
                'data'=> $respuesta,
                'message'=> 'Estudiante succesfuly updated!!',
            ]);
        } else{
            return response()->json([
                'error'=> true,
                'message'=> 'It was impossible to create, try again',
            ]);
        }
    }

    public function update(Request $request, $id){
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            $estudiante->nombre = $request->nombre;
            $estudiante->apellido = $request->apellido;
            $estudiante->foto = $request->foto;
            if($estudiante->save()){
                return response()->json([
                    'data'=> $estudiante,
                    'message'=> 'Estudiante succesfuly updated!!',
                ]);
            } else{
                return response()->json([
                    'error'=> true,
                    'message'=> 'The register was found but It was impossible to update, try again',
                ]);
            }
        }
        else{
            return response()->json([
                'error'=> true,
                'message'=> 'There is no estudiante with that id',
            ]);
        }
    }

    public function destroy($id){
        $estudiante = Estudiante::find($id);
        if(isset($estudiante)){
            $response = Estudiante::destroy($id);
            if(isset($response)){
                return response()->json([
                    'data' => $estudiante,
                    'message' => 'Record with id '.$id.' successfully deleted.',
                ]);
            } else{
                return response()->json([
                    'error' => true,
                    'message' => 'There was an error in the deletion process'
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'message' => 'Record with id '.$id.' not found.',
            ]);
        }
    }
}
