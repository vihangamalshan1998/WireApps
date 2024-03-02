<?php

namespace App\Policies;

use App\Domains\Auth\Models\User;
use App\Models\Invoice;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
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
        return $user->can('INVOICE_LIST');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Invoice  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Invoice $book)
    {
        return $user->can('INVOICE_VIEW');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('INVOICE_CREATE');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Invoice  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Invoice $book)
    {
        return $user->can('INVOICE_EDIT');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Invoice  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Invoice $book)
    {
        return $user->can('INVOICE_DELETE');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Invoice  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Invoice $book)
    {
        return $user->can('INVOICE_EDIT');
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Domains\Auth\Models\User  $user
     * @param  \App\Models\Invoice  $book
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Invoice $book)
    {
        return $user->can('INVOICE_DELETE');
    }
}
