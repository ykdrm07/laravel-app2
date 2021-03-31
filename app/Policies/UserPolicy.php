<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

use Auth; # 追加

class UserPolicy
{
   use HandlesAuthorization;

   /**
    * Determine whether the user can view the model.
    *
    * @param  \App\User  $user
    * @param  \App\User  $model
    * @return mixed
    */
   public function view(User $model, User $user)
   {
       return $model->id == $user->id;
   }

   /**
    * Determine whether the user can update the model.
    *
    * @param  \App\User  $user
    * @param  \App\User  $model
    * @return mixed
    */
   public function update(User $model, User $user)
   {
     return $model->id == $user->id;
   }
}