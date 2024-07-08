<?php

namespace App\Services;

use App\DAO\InstitutionDAO;
use App\DTO\InstitutionDTO;
use Illuminate\Support\Collection;

class InstitutionService
{
    protected InstitutionDAO $institutionDAO;

    public function __construct(InstitutionDAO $institutionDAO)
    {
        $this->institutionDAO = $institutionDAO;
    }

    public function getAllInstitutions(): Collection
    {
        return $this->institutionDAO->getAllInstitutions();
    }

    public function createInstitution(array $data): InstitutionDTO
    {
        $institution = $this->institutionDAO->createInstitution($data);
        return new InstitutionDTO($institution->id, $institution->name);
    }

    public function updateInstitution(int $id, array $data): InstitutionDTO
    {
        $institution = $this->institutionDAO->findInstitutionById($id);
        $this->institutionDAO->updateInstitution($institution, $data);
        return new InstitutionDTO($institution->id, $institution->name);
    }

    public function deleteInstitution(int $id): void
    {
        $institution = $this->institutionDAO->findInstitutionById($id);
        $this->institutionDAO->deleteInstitution($institution);
    }
}