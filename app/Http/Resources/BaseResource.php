<?php

namespace App\Http\Resources;

use Illuminate\Database\Eloquent\Collection;

class BaseResource
{
    /**
     * @param \Illuminate\Http\Resources\Json\JsonResource $resource
     * @var mixed $data
     */
    protected $resource, $data;

    /**
     * @param \Illuminate\Http\Resources\Json\JsonResource $resource
     * @param mixed $data
     */
    public function __construct($resource, $data)
    {
        $this->resource = $resource;
        $this->data = $data;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function get()
    {
        if (empty($this->data))
            return response()->json(['data' => $this->data]);
        return (new $this->resource($this->data));
    }
}
