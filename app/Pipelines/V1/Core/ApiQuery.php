<?php

namespace App\Pipelines\V1\Core;

use Illuminate\Http\Request;

/**
 * ApiFilter
 */
abstract class ApiQuery
{
    /**
     * parseQuery
     *
     * @param  Request $request
     * @return array
     */
    abstract public function parseQuery(Request $request): array;
}
