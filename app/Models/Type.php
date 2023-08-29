<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug'
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }
}
