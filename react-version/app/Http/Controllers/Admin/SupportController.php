<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SupportController extends Controller
{

    public function __construct(protected SupportService $service)
    {
    }

    public function index(Request $request) // elegant way, using dependency injection. Create a new instance of Support model and pass it to the index method
    {

        //$support = new Support(); # not elegant
        // $supports = $support::all(); we will use the service instead
        // $supports = $this->service->getAll($request->filter);
        $supports = $this->service->paginate(
            page: $request->get('page', 1),
            itemsPerPage: $request->get('itemsPerPage', 15),
            filter: $request->filter
        );

        // dd($supports); // var_dump and die

        // compact = ['supports' => $supports]
        return Inertia::render('Admin/Supports/Supports', compact('supports'));
    }

    public function show(string $id)
    {
        // dump($id);

        // posso usar where
        // $support = Support::find($id); //chamo o a classe para executar um metodo seu
        $support = $this->service->findOne($id);
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
    public function store(StoreUpdateSupport $request, Support $support)
    {
        // $data = $request->validated();
        // $data['status'] = 'active';

        // $support->create($data); // injetei a dependencia de Support no metodo index, agora posso usar o metodo create

        // $this->service->new(new CreateSupportDTO(...args)); # poderia fazer assim, mas fica repetitivo

        $this->service->new(CreateSupportDTO::makeFromRequest($request));

        return redirect()->route('supports.index');
    }

    public function edit(string $id)
    {
        // dump($id);
        // $support = $support->where('id', '=', $id)->first(); // poderia deixar sem o parametro de '='
        $support = $this->service->findOne($id);
        if (!$support) return back();

        return Inertia::render('Admin/Supports/Edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request)
    {
        // dd($id); pass
        // dd($request);

        // $support = $support->find($id);
        // if (!$support) return back();

        // dd($request->only([ // only = apenas
        //     'subject', 'body'
        // ]));
        // se quisesse alterar todos os dados que viessem na request, era so por $request->all()
        // mas como quero alterar apenas alguns, uso o metodo only
        // poderia fazer da seguinte forma também:
        # $support->body = $request->body; // o bagulhete no banco é igual ao que veio na request        
        // $support->update($request->only([
        //     'subject', 'body'
        // ]));

        # just another way to do the line 77
        // $support->update($request->validated());
        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request));
        if (!$support) return back();

        return redirect()->route('supports.index');
    }

    public function destroy(string $id)
    {

        // $support = $support->find($id);

        $this->service->delete($id);

        return redirect()->route('supports.index');
    }
}
