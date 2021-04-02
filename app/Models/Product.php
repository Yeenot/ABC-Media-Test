<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ExtendedModel;

class Product extends Model
{
    use ExtendedModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'name', 'price', 'quantity', 'description'];
}
