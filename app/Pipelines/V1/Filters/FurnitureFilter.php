<?php

namespace App\Pipelines\V1\Filters;

use App\Pipelines\V1\Core\ApiFilter;
use App\Pipelines\PiplineHandlerInterface;
use Illuminate\Database\Eloquent\Builder;
use Closure;

/**
 * FurnitureFilter
 */
final class FurnitureFilter extends ApiFilter implements PiplineHandlerInterface
{
    /**
     * {@inheritdoc}
     */
    protected array $allowedParams = [
        'name'        => ['eq', 'lk'],
        'description' => ['eq', 'lk'],
        'available'   => ['eq'],
        'price'       => ['eq', 'gt', 'lt'],
    ];

    /**
     * {@inheritdoc}
     */
    public function handle(Builder $builder, Closure $next): Builder
    {
        $conditions = $this->parseQuery(request());

        foreach ($conditions as $condition) {
            $builder->where(...$condition);
        }

        return $next($builder);
    }
}
