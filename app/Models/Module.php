<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'module_name', 'module_description', 'module_duration', 'course_id',
    ];
}
