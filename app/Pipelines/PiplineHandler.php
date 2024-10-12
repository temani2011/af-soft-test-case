<?php

namespace App\Pipelines;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Pipeline;

class PiplineHandler
{
    /**
     * pipes
     *
     * @var array
     */
    protected array $pipes = [];

    /**
     * __construct
     *
     * @param  array $pipes
     * @return void
     */
    public function __construct(array $pipes)
    {
        $this->pipes = $pipes;
    }

    /**
     * apply
     *
     * @param  mixed $builder
     * @return Builder
     */
    public function apply(Builder $builder): Builder
    {
        return Pipeline::send($builder)
            ->through($this->pipes)
            ->then(fn(Builder $builder) => $builder);
    }
}
