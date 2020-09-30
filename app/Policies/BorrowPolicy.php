<?php

namespace App\Policies;

use App\Borrow;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class BorrowPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Borrow  $borrow
     * @return mixed
     */
    public function view(User $user, Borrow $borrow)
    {
        if ($user->hasRole()->role_name == 'admin') {
            return true;
        }
        return $user->id === $borrow->user_id ? Response::allow() : Response::deny('You do not own this Borrow.');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Borrow  $borrow
     * @return mixed
     */
    public function update(User $user, Borrow $borrow)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Borrow  $borrow
     * @return mixed
     */
    public function delete(User $user, Borrow $borrow)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Borrow  $borrow
     * @return mixed
     */
    public function restore(User $user, Borrow $borrow)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Borrow  $borrow
     * @return mixed
     */
    public function forceDelete(User $user, Borrow $borrow)
    {
        //
    }
}
