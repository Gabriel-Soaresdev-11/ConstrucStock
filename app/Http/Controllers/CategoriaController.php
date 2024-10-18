<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        // $categorias = Categoria::all();
        $categorias = Categoria::where('user_id', Auth::id())->get();

        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required'
        ]);

        // Categoria::create($request->all());
        Categoria::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'user_id' => Auth::id(),  // Adiciona o user_id automaticamente
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria adicionada com sucesso');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::find($id);

        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::where('user_id', Auth::id())->find($id);
        
        return view('categorias.edit', compact('categoria'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required'
        ]);

        $categoria = Categoria::find($id);
        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria Atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);
        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoria excluida com sucesso');
    }
}
