<?php

namespace App\Pipelines\V1\Sorters;

use App\Pipelines\V1\Core\ApiSorter;
use App\Pipelines\PiplineHandlerInterface;
use Illuminate\Database\Eloquent\Builder;
use Closure;

/**
 * FurnitureSorter
 */
final class FurnitureSorter extends ApiSorter implements PiplineHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    protected array $allowedParams = [
        'name',
        'description',
        'available',
        'price',
    ];

    /**
     * {@inheritdoc}
     */
    public function handle(Builder $builder, Closure $next): Builder
    {
        $condition = $this->parseQuery(request());

        if (is_array($condition) && $condition) {
            $builder->orderBy(...$condition);
        }

        return $next($builder);
    }
}
