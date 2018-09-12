<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false; // don't need timestamps
    protected $fillable = ["name"]; // name should be fillable

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
    // accepts the array of strings from the request
    public static function parse(array $categories)
    {
        // turns into a collection and maps over
        return collect($categories)->map(function ($category) {
        // remove any blank spaces either side
        $string = trim($category);
        return static::makeTag($string);
    });
}

private static function makeTag($string)
{
    // check if tag already exists
    $exists = Category::where("name", $string)->first();

    // if tag exists return it, otherwise create a new one
    return $exists ? $exists : Category::create(["name" => $string]);
}
}
