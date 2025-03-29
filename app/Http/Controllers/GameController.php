<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $games = Game::all();
        return view('games.index', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('games.create');
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'levels' => 'required|numeric',
            'release' => 'required|date',
            'image' => 'required|image',
        ],[
            'name.required' => 'El nombre del juego es obligatorio.',
            'levels.required' => 'El número de niveles es obligatorio.',
            'levels.numeric' => 'El número de niveles debe ser un número.',
            'release.required' => 'La fecha de lanzamiento es obligatoria.',
            'release.date' => 'La fecha de lanzamiento debe ser una fecha válida.',
            'image.required' => 'La imagen del juego es obligatoria.',
            'image.image' => 'El archivo subido debe ser una imagen.',
        ]);

        try {
            // Primero, crea el registro sin la imagen para obtener el ID
            $game = Game::create([
                'name' => $request->name,
                'levels' => $request->levels,
                'release' => $request->release,
                'image' => '', // Temporalmente vacío
            ]);

            // Renombra la imagen con el ID del registro
            $imageName = $game->id . '.' . $request->file('image')->extension();

            // Guarda la imagen en la carpeta 'img' dentro de 'public/storage'
            $imagePath = $request->file('image')->storeAs('img', $imageName, 'public');

            // Actualiza el registro con la ruta de la imagen
            $game->update([
                'image' => $imagePath,
            ]);

            return redirect()->route('games.index')->with('success', 'Game created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al guardar el juego: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Game $game)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        return view('Games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game){
        $request->validate([
            'name' => 'required',
            'levels' => 'required|numeric',
            'release' => 'required|date',
            'image' => 'nullable|image',
        ]);

        try {
            // Actualiza los datos básicos
            $game->update([
                'name' => $request->name,
                'levels' => $request->levels,
                'release' => $request->release,
            ]);

            // Si se proporciona una nueva imagen
            if ($request->hasFile('image')) {
                // Elimina la imagen anterior si existe
                if ($game->image && Storage::disk('public')->exists($game->image)) {
                    Storage::disk('public')->delete($game->image);
                }

                // Renombra la nueva imagen con el ID del registro
                $imageName = $game->id . '.' . $request->file('image')->extension();

                // Guarda la nueva imagen en la carpeta 'img' dentro de 'public/storage'
                $imagePath = $request->file('image')->storeAs('img', $imageName, 'public');

                // Actualiza el registro con la nueva ruta de la imagen
                $game->update([
                    'image' => $imagePath,
                ]);
            }

            return redirect()->route('games.index')->with('success', 'Game updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Error al actualizar el juego: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        Storage::disk('public')->delete($game->image);
        $game->delete();
        return redirect()->route('games.index')->with('success', 'Game deleted successfully.');
    }
}
