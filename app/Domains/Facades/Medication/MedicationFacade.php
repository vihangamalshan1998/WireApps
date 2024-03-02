<?php

namespace Domains\Facades\Medication;

use Illuminate\Support\Facades\Facade;
use Domains\Services\Medication\MedicationService;


/**
 * Medication Facade
 * @category Facade
 * */

class MedicationFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MedicationService::class;
    }
}
