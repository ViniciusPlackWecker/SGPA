<?php

namespace App\DAOs;

use App\Models\Institution;
use App\DTOs\InstitutionDTO;
use Illuminate\Support\Collection;

class InstitutionDAO
{
    public function getAllInstitutions(): Collection
    {
        $institutions = Institution::all();
        
        return $institutions->map(function ($institution) {
            return new InstitutionDTO(
                $institution->id,
                $institution->name
            );
        });
    }

    public function findInstitutionById(int $id)
    {
        return Institution::findOrFail($id);
    }

    public function createInstitution(array $data)
    {
        return Institution::create($data);
    }

    public function updateInstitution(Institution $institution, array $data)
    {
        $institution->update($data);
    }

    public function deleteInstitution(Institution $institution)
    {
        $institution->delete();
    }
}