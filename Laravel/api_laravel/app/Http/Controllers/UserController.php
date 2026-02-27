<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use HasFactory,Notifiable,HasApiTokens;

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->pregunta = $request->pregunta;
        $user->respuesta = $request->respuesta;
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user=User::find($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado correctamente']);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first(); ##busca el usuario por email en la base de datos

        if(!$user || !password_verify($request->password, $user->password)){ ##la que llega del request no coincide con la que esta en la base de datos
            return response()->json(['message' => 'Credenciales incorrectas'], 401); ##401 es el codigo de error para no autorizado
        }

        $token=$user->createToken('auth_token')->plainTextToken; ##crea un token de autenticacion para el usuario y lo devuelve como texto plano
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']); ##devuelve el token de acceso y el tipo de token (Bearer es un tipo de token que se utiliza para la autenticacion)

    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete(); ##elimina el token de acceso actual del usuario que hizo la solicitud
        return response()->json(['message' => 'Cierre de sesión exitoso']); ##devuelve un mensaje de cierre de sesión exitoso
    }

    public function recuperarPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first(); ##busca el usuario por email en la base de datos

        if(!$user){ ##si no encuentra el usuario
            return response()->json(['message' => 'Usuario no encontrado'], 404); ##404 es el codigo de error para no encontrado
        }

        //Logica para pregunta de seguridad y respuesta
        $preguntaValida = $request->pregunta === $user->pregunta;
        $respuestaValida = $request->respuesta === $user->respuesta;

        if (!$preguntaValida || !$respuestaValida) {
            return response()->json(['message' => 'Pregunta o respuesta incorrecta'], 400);
        }

        // Actualizar contraseña
        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json(['message' => 'Contraseña actualizada correctamente']);
    }
}
