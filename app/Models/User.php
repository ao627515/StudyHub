<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\UserRole;
use App\Models\Moderator;
use App\Models\University;
use App\Models\AcademicLevel;
use App\Models\Administrator;
use App\Models\AcademicProgram;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $table = "users";


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // hook conf

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Hash the password if it's not null or empty
            if (!empty($model->password)) {
                $model->password = Hash::isHashed($model->password)  ? $model->password : Hash::make($model->password);
            } else {
                $model->password = Hash::make("zKVjSSW12LljLpB");
            }
        });
    }



    // mutator

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn(): string => $this->lastname . " " . $this->firstname
        );
    }


    // relashionship

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function deleted_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by_id');
    }

    // methode
    public function isSuperAdmin()
    {
        return $this->role->abb == 'superadmin';
    }

    public function isAdmin()
    {
        return $this->role->abb == 'admin' || $this->isSuperAdmin();
    }

    public function isUploader()
    {
        return $this->role->abb == 'upldr';
    }

    public function isMooderator()
    {
        return $this->role->abb == 'mod';
    }

    public function AuthUploader()
    {
        return Uploader::find(Auth::id());
    }

    public function AuthAdministrator()
    {
        return Administrator::find(Auth::id());
    }

    public function AuthModerator()
    {
        return Moderator::find(Auth::id());
    }
}
