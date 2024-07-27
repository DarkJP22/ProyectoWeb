<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Movie;

class MoviesPolicy
{
    /**
     * Determine whether the user can view any movies.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return true; // Permite a todos los usuarios ver la lista de películas
    }

    /**
     * Determine whether the user can view the movie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     * @return bool
     */
    public function view(User $user, Movie $movie)
    {
        return true; // Permite a todos los usuarios ver una película
    }

    /**
     * Determine whether the user can create movies.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->is_admin; // Solo los usuarios administradores pueden crear películas
    }

    /**
     * Determine whether the user can update the movie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     * @return bool
     */
    public function update(User $user, Movie $movie)
    {
        return $user->is_admin; // Solo los usuarios administradores pueden editar películas
    }

    /**
     * Determine whether the user can delete the movie.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Movie  $movie
     * @return bool
     */
    public function delete(User $user, Movie $movie)
    {
        return $user->is_admin; // Solo los usuarios administradores pueden eliminar películas
    }
}
