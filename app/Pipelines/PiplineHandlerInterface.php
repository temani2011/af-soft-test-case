<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;
use Closure;

interface PiplineHandlerInterface
{
    /**
     * handle
     *
     * @param  Builder $builder
     * @param  Closure $next
     * @return Builder
     */
    public function handle(Builder $builder, Closure $next): Builder;
}
