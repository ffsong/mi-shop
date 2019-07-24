<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSkuAttribute extends Model
{
    protected $fillable = ['name'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
