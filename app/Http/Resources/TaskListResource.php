<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->resource->load("categories");

        return [
            "id" => $this->id,
            "title" => $this->title,
            "dueDate" => $this->dueDate,
            "complete" => $this->complete,
            "categories" => $this->categories->pluck("name"), // just return a list of tag names

        ];
    }
}
