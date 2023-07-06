<?php

namespace App\Policies;

use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubcategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Consult subcategory') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Subcategory $subcategory): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Create subcategory') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Subcategory $subcategory): bool
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Update subcategory') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Subcategory $subcategory): bool
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Delete subcategory') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Subcategory $subcategory): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Subcategory $subcategory): bool
    {
        //
    }
}
