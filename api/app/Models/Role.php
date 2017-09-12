<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    protected $fillable = ['name', 'description'];

	protected $dates = ['deleted_at'];

    public function users()
    {
      return $this->belongsToMany('App\Models\User');
    }


}
