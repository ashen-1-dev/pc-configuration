<?php

namespace App\Http\Controllers;

use App\Models\Components\Attribute;
use App\Models\Components\Component;
use App\Models\Components\Type;
use Illuminate\Http\Request;

class ComponentController extends Controller
{

    public function index()
    {
        $components = Component::with('type')->get();
        return response()->view('component.index', compact('components'));
    }


    public function create()
    {
        $component_types = Type::all();
        return view('component.create', compact('component_types'));
    }


    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => ['required'],
                'type_id' => ['required'],
            ]
        );
        $component = Component::create($data);
        $component->save();
        if($request->has('attributes')) {
            $attributes = $request->input('attributes');
            foreach ($attributes as $attribute) {
                $newAttribute = Attribute::create(['name' => $attribute['name']]);
                $newAttribute->save();
                $component->attributes()->attach($newAttribute, ['value' => $attribute['value']]);
                // TODO: добавить валидацию аттрибутов и их значений
            }

        }
        return redirect()->route('components.index');
    }


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

    }


    public function destroy($id)
    {
        Component::find($id)->delete();
        return back();
    }
}
