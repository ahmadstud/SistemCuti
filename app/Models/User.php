<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',           // Add this
        'ic',             // Add this
        'phone_number',   // Add this
        'address',
        'city',
        'postcode',
        'state',
       'total_mc_days',  // Ensure this is fillable
       'total_annual',
       'total_others',
       'job_status',
       'profile_image',
       'selected_officer_id',
       'fullname'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    public function getFillable()
    {
        // Fetch all column names from the users table dynamically
        $columns = Schema::getColumnListing($this->table);

        return $columns;
    }

    protected function casts(): array
    {
        return [];
    }
    // Define the relationship with McApplication
    public function mcApplications()
    {
        return $this->hasMany(McApplication::class);
    }

    public function officer()
{
    return $this->belongsTo(User::class, 'selected_officer_id');
}


}
