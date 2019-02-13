<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ProvinceScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(!empty(session('tinhthanhquantam')))
            $builder->whereIn('province_id', session('tinhthanhquantam'));
        else if(!empty(auth()->user()->subcribes()->get()))
            $builder->whereIn('province_id', auth()->user()->subcribes()->get());
    }
}
