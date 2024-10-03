<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'reason',
        'document_path',
        'status',
        'admin_approved',
        'officer_approved',
        'selected_officer_id',
        'direct_admin_approval',
        'leave_type',
    ];
     // Define the relationship with User
     public function user()
     {
        return $this->belongsTo(User::class, 'user_id', 'id');
     }


}

