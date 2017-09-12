<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel 
{
    protected function castAttribute($key, $value)
    {
        if (is_null($value)) return $value; 

        switch ($this->getCastType($key)) {
            case 'date_only':
                return (new \DateTime($value))->format('d/m/Y');
            default:
                return parent::castAttribute($key, $value);
        }
    }
}