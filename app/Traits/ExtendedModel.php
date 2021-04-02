<?php

namespace App\Traits;

trait ExtendedModel
{
    /**
     * Search
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $columns)
    {
        $value = request()->query('search');
        return $query->when(isset($value), function($query) use ($columns, $value) {
            return $query->where(function($query) use ($columns, $value) {
                foreach ($columns as $column) {
                    $query = $query->when(!empty($value), function($query) use ($column, $value) {
                        return $query->orWhere($column, 'LIKE', '%'.$value.'%');
                    });
                }
                return $query;
            });
        });
    }

    /**
     * Standard pagination
     *
     * @param array $columns
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function scopeGetPaginate($query, $columns = ['*'])
    {
        if (!request()->hasAny(['page', 'limit']))
            return $query->get($columns);
        
        $page = intval(request()->query('page', 1));
        $limit = intval(request()->query('limit', 10));
        $offset = ($page - 1) * $limit;
        $queryMethod = ($query instanceof Relation) ? 'getBaseQuery' : 'getQuery';
        $total = $query->{$queryMethod}()->getCountForPagination();
        return [
            'total' => $total,
            'page' => $page,
            'limit' => $limit,
            'data' => $query->when($limit > 0, function($query) use ($limit, $offset) {
                    return $query->limit($limit)
                        ->offset($offset);
                })->get($columns)
        ];
    }
}