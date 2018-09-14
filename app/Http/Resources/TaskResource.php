<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // make sure tags are up to date
         $this->resource->load("categories");


        return [
            "id" => $this->id,
            "title" => $this->title,
            "notes" => $this->notes,
            "dueDate" => $this->dueDate,
            "complete" => $this->complete,
            "categories" => $this->categories->pluck("name"), // just return a list of tag names
        ];
    }
}
