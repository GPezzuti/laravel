<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Método para login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $user_temp = User::where('email', $user->email)->first();
            $user_temp->last_login = now(); // Update the last_login field with the current timestamp
            $user_temp->save(); // Save the user model to update the last_login field in the database
    
            // Include the last_login field in the token response
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token, 'last_login' => $user->last_login]);
        }
    
        return response()->json(['message' => 'Las credenciales proporcionadas son incorrectas.'], 401);
    }
    

    // Metodo para registrar un nuevo usuario
    public function register(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    // Método para logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Sesión cerrada con éxito.'], 200);
    }
}

