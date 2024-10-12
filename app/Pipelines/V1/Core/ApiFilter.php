<?php

namespace App\Pipelines\V1\Core;

use Illuminate\Http\Request;

/**
 * ApiFilter
 */
class ApiFilter extends ApiQuery
{
    /**
     * {@inheritdoc}
     */
    protected array $allowedParams = [];

    /**
     * {@inheritdoc}
     */
    protected array $allowedOperators = [
        'eq'   => '=',
        'ne'   => '!=',
        'lte'  => '<=',
        'le'   => '<',
        'gt'   => '>',
        'gte'  => '>=',
        'lk'   => 'like',
    ];

    /**
     * {@inheritdoc}
     */
    public function parseQuery(Request $request): array
    {
        $conditions = [];

        foreach ($this->allowedParams as $param => $operators) {
            $query = $request->query($param);

            if (!isset($query)) {
                continue;
            }

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $conditions[] = [
                        $param,
                        $this->allowedOperators[$operator],
                        $operator === 'lk' ? "%{$query[$operator]}%" : $query[$operator]
                    ];
                }
            }
        }

        return $conditions;
    }
}
