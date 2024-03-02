<?php

namespace App\Policies;

use App\Domains\Auth\Models\User;
use App\Models\Medication;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('MEDICATION_LIST');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Medication $medication)
    {
        return $user->can('MEDICATION_VIEW');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('MEDICATION_CREATE');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Medication $medication)
    {
        return $user->can('MEDICATION_EDIT');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Medication $medication)
    {
        return $user->can('MEDICATION_SOFT_DELETE');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Medication  $medication
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Medication $medication)
    {
        return $user->can('MEDICATION_HARD_DELETE');
    }
}
