<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

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
                        //Comprobar si el usuario existe
                        'email' => 'required|email|unique:users',
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
                $pwd = password_hash($params->password, PASSWORD_BCRYPT, ['cost' => 4]);

                //Crear el usuario    
                $user = new User();
                $user->name = $params_array['name'];
                $user->surname = $params_array['surname'];
                $user->email = $params_array['email'];
                $user->password = $pwd;
                $user->role = 'ROLE_USER';

                //Guarda en la base de datos
                $user->save();

                $data = array(
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'El usuario se a creado correctamente.',
                    'user'=>$user
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
        
        $jwtAuth = new JwtAuth();
        $jwtAuth->signUp();
        
        return "Accion de login";
    }

}
