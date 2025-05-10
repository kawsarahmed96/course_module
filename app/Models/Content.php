<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = [
        "content_name",
        'module_id',
        "content_description",
    ];
}
