<?php

namespace Domains\Services\Medication;

use App\Models\Medication;
use App\Traits\Api\ApiHelper;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

/**
 * MedicationService
 * */
class MedicationService
{
    use ApiHelper;
    protected $medication;

    public function __construct()
    {
        $this->medication = new Medication();
    }

    /**
     * Get all medication
     *
     * @return Collection
     */
    public function all(): ?Collection
    {
        return $this->medication->all();
    }

    /**
     * Get medication By Id
     *
     * @param  int $customer_id
     * @return Medication
     */
    public function get(int $id): ?Medication
    {
        return $this->medication->find($id);
    }
    /**
     * Create Medication
     *
     * @param  array $Medication
     * @return Medication
     */
    public function create($request): Medication
    {
        return $this->medication->create($request);
    }

    /**
     * update
     *
     * @param  Medication $medication
     * @param  array    $data
     *
     * @return void
     */
    public function update(Medication $medication, array $data): void
    {
        $medication->update($this->edit($medication, $data));
    }
    /**
     * edit
     *
     * @param  Medication $Medication
     * @param  array    $data
     *
     * @return array
     */
    protected function edit(Medication $medication, array $data): array
    {
        return array_merge($medication->toArray(), $data);
    }
    /**
     * delete
     *
     * @param  Medication $medication
     *
     * @return void
     */
    public function delete(Medication $medication): void
    {
        $medication->delete();
    }
    /**
     * full_delete
     *
     * @param  Medication $medication
     *
     * @return void
     */
    public function full_delete(Medication $medication): void
    {
        $medication->forceDelete();
    }
}
