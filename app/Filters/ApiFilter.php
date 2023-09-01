<?php

namespace App\Filters;

use Illuminate\Http\Request;
use function PHPUnit\Framework\isEmpty;

class ApiFilter {
    protected  $allowedParams = [];

    protected $columnMap = [];

    protected $operatorsMap = [];

    public function transform(Request $request) {
        $eloQuery = [];

        foreach ($this->allowedParams as $param => $operators) {
            $query = $request->query($param);

            if(!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$param] ?? $param;

            foreach ($operators as $operator) {
                if(isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorsMap[$operator], $query[$operator]];
                }
            }
        }
        return $eloQuery;
    }
}
