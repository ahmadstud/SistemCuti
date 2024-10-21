<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notas'; // Set the table name

    protected $fillable = [
        'title', 
        'content'
    ]; // Define fillable fields
}
