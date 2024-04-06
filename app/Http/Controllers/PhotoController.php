<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::all();
        return response()->json($photos);
    }
    public function store(Request $request)
    {

        try {
            $request->validate([
                'image' => 'required|image|max:10240', // Tamaño máximo de 10 MB
                'title' => 'required|string|max:255',
            ]);
            
            $photo = new Photo();
            $photo->user_id = $request->user()->id;
            $photo->title = $request->input('title');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images'), $filename);
                $photo->src = $filename;
            }
            $photo->save();
            return '¡Imagen guardada exitosamente!';

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
