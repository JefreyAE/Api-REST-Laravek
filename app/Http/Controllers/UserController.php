<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller {

    public function pruebas(Request $request) {
        return "Accion de pruebas UserController";
    }

    public function register(Request $request) {

        //Recoger los datos del usuario por POST
        $json = $request->input('json', null);

        $params = json_decode($json);
        $params_array = json_decode($json, true);

        //Limipiar datos
        $params_array = array_map('trim', $params_array);

        if (!empty($params) && !empty($params_array)) {
            //Validar lo datos
            $validate = \Validator::make($params_array, [
                        'name' => 'required|alpha',
                        'surname' => 'required|alpha',
                        'email' => 'required|email',
                        'password' => 'required'
            ]);

            if ($validate->fails()) {
                //Validación fallida
                $data = array(
                    'status' => 'error',
                    'code' => 404,
                    'message' => 'El usuario no se ha creado.',
                    'errors' => $validate->errors()
                );
            } else {
                //Si la validación es correcta.
                //Cifrar la contraseña
                //Comprobar si el usuario existe
                //Crear el usuario                             
                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario se a creado correctamente.'
                );
            }
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'message' => 'Los datos enviados no son correctos.'
            );
        }
        return response()->json($data, $data['code']);
    }

    public function login(Request $request) {
        return "Accion de login";
    }

}
