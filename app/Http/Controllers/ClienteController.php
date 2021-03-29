<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    
    public function index()
    {
        $data = Cliente::latest()->paginate(5);
    
        return view('clientes.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'nome' => 'required',
            'apelido' => 'required',
            'email' => 'required',
            'numero' => 'required',
        ]);
    
        Cliente::create($request->all());
     
        return redirect()->route('clientes.index')
                        ->with('success','Cliente Cadastrado com Sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        return view('clientes.show',compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit',compact('cliente'));
    }

    

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required',
            'apelido' => 'required',
            'email' => 'required',
            'numero' => 'required',
        ]);
    
        $cliente->update($request->all());
    
        return redirect()->route('posts.index')
                        ->with('success','Cliente Actualizado com Sucesso!');
    }


    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
    
        return redirect()->route('clientes.index')
                        ->with('success','Cliente Apagado!');
    }
}
