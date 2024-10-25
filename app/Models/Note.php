<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes'; // Set the table name

    protected $fillable = [
        'title',
        'id',
        'content'
    ]; // Define fillable fields
}
