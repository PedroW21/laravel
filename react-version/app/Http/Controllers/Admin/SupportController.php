<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupportController extends Controller
{
    public function index(Support $support) // elegant way, using dependency injection. Create a new instance of Support model and pass it to the index method
    {

        //$support = new Support(); # not elegant
        $supports = $support::all();
        // dd($supports); // var_dump and die

        // compact = ['supports' => $supports]
        return Inertia::render('Admin/Supports/Supports', compact('supports'));
    }

    public function show(string|int $id)
    {
        // dump($id);

        // posso usar where
        $support = Support::find($id); //chamo o a classe para executar um metodo seu
        if (!$support) {
            return redirect()->back(); // pega a ultima url que acessou e redireciona para ela
        }

        return Inertia::render('Admin/Supports/Show', compact('support'));
    }

    public function create()
    {
        return Inertia::render('Admin/Supports/Create');
    }
    // support não é recebimento de algo, mas sim a disponibilização de algo
    // support aqui é relacionado a instancia atual da chamada
    public function store(Request $request, Support $support)
    {
        $data = $request->all();
        $data['status'] = 'active';

        $support->create($data); // injetei a dependencia de Support no metodo index, agora posso usar o metodo create

        return redirect()->route('supports.index');
    }

    public function edit(string|int $id, Support $support)
    {
        // dump($id);
        $support = $support->where('id', '=', $id)->first(); // poderia deixar sem o parametro de '='
        if (!$support) return back();

        return Inertia::render('Admin/Supports/Edit', compact('support'));
    }

    public function update(Request $request, Support $support, string|int $id)
    {
        // dd($id); pass
        // dd($request);

        $support = $support->find($id);
        if (!$support) return back();

        // dd($request->only([ // only = apenas
        //     'subject', 'body'
        // ]));
        // se quisesse alterar todos os dados que viessem na request, era so por $request->all()
        // mas como quero alterar apenas alguns, uso o metodo only
        // poderia fazer da seguinte forma também:
        # $support->body = $request->body; // o bagulhete no banco é igual ao que veio na request        
        $support->update($request->only([
            'subject', 'body'
        ]));

        return redirect()->route('supports.index');
    }
}
