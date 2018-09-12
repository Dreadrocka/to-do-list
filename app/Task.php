<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Task extends Model
{
    protected $fillable = ["title", "notes", "dueDate", "complete"];

public function categories()
{
    return $this->belongsToMany(Category::class);
}

public function setCategories(Collection $categories)
{
    // update the pivot table with tag IDs
    $this->categories()->sync($categories->pluck("id")->all());
    return $this;
}

}