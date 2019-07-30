<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSkuAttribute extends Model
{
    protected $fillable = ['name'];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
