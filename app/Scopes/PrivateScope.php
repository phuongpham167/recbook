<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PrivateScope implements Scope
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
        $builder->where(function($q){
            $q->where('is_private', '<>', 2);
            if(auth()->check())
                $q = $q->where(function ($q){
                    $q->where('is_private','<>',1)->orWhere('posted_by', auth()->user()->id);
                });
        });
    }
}