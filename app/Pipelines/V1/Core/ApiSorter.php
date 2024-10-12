<?php

namespace App\Pipelines\V1\Core;

use Illuminate\Http\Request;

/**
 * ApiSorter
 */
class ApiSorter extends ApiQuery
{
    /**
     * {@inheritdoc}
     */
    protected array $allowedParams = [];

    /**
     * {@inheritdoc}
     */
    protected array $allowedOperators = [
        'asc',
        'desc',
    ];

    /**
     * {@inheritdoc}
     */
    public function parseQuery(Request $request): array
    {
        $query = $request->query("order");

        if (!$query) {
            return [];
        }

        $orderWay = 'asc';
        $regexSearch = implode('|', $this->allowedOperators);

        if (preg_match("/\[({$regexSearch})\]/", $query, $queryWay)) {
            $orderWay = end($queryWay);
            $orderBy = str_replace($queryWay, '', $query);
        } else {
            $orderBy = preg_replace('/\[.+\]/', '', $query);
        }

        if (!in_array($orderBy, $this->allowedParams)) {
            return [];
        }

        return [$orderBy, $orderWay];
    }
}
