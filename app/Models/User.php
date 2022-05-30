<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, Billable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'trial_ends_at', 'email_verified_at', 'auth_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'trial_ends_at' => 'datetime',
    ];

    protected function photo(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => is_null($value) ? url('/img/default.png') : Storage::url('images/users/'.$value),
        );
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function announcements(){

        return $this->belongsToMany(Announcement::class);
    }

    public function hasUnreadAnnouncements(){
        $totalAnnouncements = Announcement::count();

        $userAnnouncements = $this->announcements()->count();

        if($totalAnnouncements > $userAnnouncements){
            return true;
        }
        return false;
    }

    public function unreadAnnouncements(){
        $announcements = Announcement::orderBy('created_at', 'DESC')->get();
        $unreadAnnouncements = [];
        foreach($announcements as $announcement){
            if( !$this->announcements()->where('id', $announcement->id)->exists() ){
                array_push($unreadAnnouncements, $announcement);
            }
        }
        return $unreadAnnouncements;
    }

    public function courses(){
        return $this->hasMany(Course::class);
    }


}
