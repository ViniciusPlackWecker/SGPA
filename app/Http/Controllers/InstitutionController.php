<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\InstitutionRequest;
use App\Services\InstitutionService;

class InstitutionController extends Controller
{
    protected InstitutionService $institutionService;

    public function __construct(InstitutionService $institutionService)
    {
        $this->institutionService = $institutionService;
    }

    public function index()
    {
        $institutions = $this->institutionService->getAllInstitutions();
        return view('institution.index', compact('institutions'));
    }

    public function update(InstitutionRequest $request, $id)
    {
        $data = $request->validated();
        $institution = $this->institutionService->updateInstitution($id, $data);
        return redirect()->back()->with('success', 'Instituição atualizada com sucesso');
    }

    public function destroy($id)
    {
        $this->institutionService->deleteInstitution($id);
        return redirect()->back()->with('success', 'Instituição excluída com sucesso');
    }

    public function store(InstitutionRequest $request)
    {
        $data = $request->validated();
        $this->institutionService->createInstitution($data);
        return redirect()->back()->with('success', 'Instituição criada com sucesso');
    }
}