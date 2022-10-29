<?php

namespace App\Http\Controllers\Component;

use App\Http\Controllers\Component\dto\CreateComponentDto;
use App\Http\Controllers\Controller;
use App\Models\Components\Attribute;
use App\Models\Components\Component;
use App\Models\Components\Type;
use App\Services\Component\ComponentService;
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    private readonly ComponentService $componentService;

    public function __construct(ComponentService $componentService)
    {
        $this->componentService = $componentService;
    }

    public function index()
    {
        return response()->json($this->componentService->getComponents());
    }

    public function destroy(int $id)
    {
        return $this->componentService->deleteComponent($id);
    }

    public function store(Request $request)
    {
        return $this->componentService->createComponent(CreateComponentDto::from($request));
    }


//    public function store(Request $request)
//    {
//        $data = $request->validate(
//            [
//                'name' => ['required'],
//                'type_id' => ['required'],
//            ]
//        );
//        $component = Component::create($data);
//        $component->save();
//        if ($request->has('attributes')) {
//            $attributes = $request->input('attributes');
//            foreach ($attributes as $attribute) {
//                $newAttribute = Attribute::create(['name' => $attribute['name']]);
//                $newAttribute->save();
//                $component->attributes()->attach($newAttribute, ['value' => $attribute['value']]);
//                // TODO: добавить валидацию аттрибутов и их значений
//            }
//        }
//        return redirect()->route('components.index');
//    }


    public function show($id)
    {
        $component = Component::with('attributes')
            ->find($id);
        return view('component.show', compact('component'));
    }


    public function edit($id)
    {
        $component_types = Type::all();
        $component = Component::find($id);
        return view('component.edit', compact('component', 'component_types'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
                'name' => ['required'],
                'type_id' => ['required'],
            ]
        );
        $component = Component::find($id);
        $component->name = $data['name'];
        $component->type_id = $data['type_id'];
        $component->save();
        if ($request->has('attributes')) {
            $component->attributes()->delete(); // deleting old atr and insert new one
            $attributes = $request->input('attributes');
            foreach ($attributes as $attribute) {
                $newAttribute = Attribute::create(['name' => $attribute['name']]);
                $newAttribute->save();
                $component->attributes()->attach($newAttribute, ['value' => $attribute['value']]);
                // TODO: добавить валидацию аттрибутов и их значений
            }
        }
        return view('component.show', compact('component'));
    }


}
