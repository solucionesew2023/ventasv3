<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Consult product') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Create product') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Update product') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        if( $user->hasRole( ['Administrador'] ) || $user->hasPermissionTo('Delete product') ){
            return true;
            }
            return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        //
    }
}
