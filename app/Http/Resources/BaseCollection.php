<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

class BaseCollection
{
    /**
     * @param \Illuminate\Http\Resources\Json\ResourceCollection $collection
     * @var mixed $result
     */
    protected $collection, $result;

    /**
     * @param \Illuminate\Http\Resources\Json\ResourceCollection $collection
     * @param mixed $result
     */
    public function __construct($collection, $result)
    {
        $this->collection = $collection;
        $this->result = $result;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        $additional = [];
        if (array_key_exists('data', $this->result)) {
            $additional = Arr::except($this->result, 'data');
            $this->result = $this->result['data'];
        }
        return (new $this->collection($this->result))
            ->additional($additional);
    }
}
