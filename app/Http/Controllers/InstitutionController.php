<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Institution;

class InstitutionController extends Controller
{
    public function index() {
        $institutions = Institution::all();
        return view('institution.index', compact('institutions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $existingInstitution = Institution::where('name', $request->name)->where('id', '!=', $id)->first();
        if ($existingInstitution) {
            return redirect()->back()->withErrors(['name' => 'Essa instituição já existe.'])->withInput();
        }

        $institution = Institution::findOrFail($id);
        $institution->name = $request->name;
        $institution->save();

        return redirect()->back()->with('success', 'Instituição atualizada com sucesso');
    }

    public function destroy($id)
    {
        $institution = Institution::findOrFail($id);
        $institution->delete();

        return redirect()->back()->with('success', 'Instituição excluída com sucesso');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        $existingInstitution = Institution::where('name', $request->name)->first();
        if ($existingInstitution) {
            return redirect()->back()->withErrors(['name' => 'Essa Instituição já existe.'])->withInput();
        }

        Institution::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Instituição adicionada com sucesso');
    }
}
