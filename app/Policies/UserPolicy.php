<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Consult user') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user)
    {
       //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Create user')){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Update user')){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Delete user')){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user): bool
    {
        return $user->hasRole(['Administrador']);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user): bool
    {
        return $user->hasRole(['Administrador']);
    }
}
