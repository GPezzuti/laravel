<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Mostrar lista de usuarios
    public function index()
    {
        $users = User::with('photos')->get();
        return response()->json($users);
    }

    // Almacenar un nuevo usuario
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El nombre no debe ser mayor a 255 caracteres.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico no es un correo válido.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ];

        try {
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ], $messages);

            $user = User::create($validatedData);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }


    // Mostrar un usuario específico
    public function show(User $user)
    {
        return response()->json($user->load('photos'));
    }

    // Actualizar un usuario existente
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|min:6',
        ]);

        $user->update($validatedData);
        return response()->json($user);
    }

    // Eliminar un usuario
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json('usuario eliminado');
    }
}
