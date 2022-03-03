<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneratorRequest;
use Illuminate\Support\Facades\Artisan;
use App\Generators\{
    ControllerGenerator,
    ModelGenerator,
    MigrationGenerator,
    PermissionGenerator,
    RequestGenerator,
    RouteGenerator,
    ViewComposerGenerator
};
use App\Generators\Views\{
    ActionViewGenerator,
    CreateViewGenerator,
    EditViewGenerator,
    FormViewGenerator,
    IndexViewGenerator,
    ShowViewGenerator,
    SidebarViewGenerator
};
use Illuminate\Http\Request;

class GeneratorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('generators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGeneratorRequest $request)
    {
        if ($request->generate_type == 'all') {
            $this->generateAll($request->validated());
        } else {
            (new ModelGenerator)->execute($request->validated());

            (new MigrationGenerator)->execute($request->validated());
        }

        return redirect()
            ->route('generators.create')
            ->with('success', __('Module created successfully.'));
    }

    /**
     * Generate all modules.
     *
     * @param array $request
     * @return void
     */
    protected function generateAll(array $request)
    {
        (new ModelGenerator)->execute($request);
        (new MigrationGenerator)->execute($request);
        (new ControllerGenerator)->execute($request);
        (new RequestGenerator)->execute($request);

        (new IndexViewGenerator)->execute($request);
        (new CreateViewGenerator)->execute($request);
        (new ShowViewGenerator)->execute($request);
        (new EditViewGenerator)->execute($request);
        (new ActionViewGenerator)->execute($request);
        (new FormViewGenerator)->execute($request);
        (new SidebarViewGenerator)->execute($request);

        (new RouteGenerator)->execute($request);

        (new PermissionGenerator)->execute($request);

        if (in_array('foreignId', $request['data_types'])) {
            (new ViewComposerGenerator)->execute($request);
        }

        $this->clearCache();
        $this->migrateTable();
    }

    protected function migrateTable(): void
    {
        Artisan::call('migrate');
    }

    protected function clearCache(): void
    {
        Artisan::call('optimize:clear');
    }
}
