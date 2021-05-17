<?php /** @noinspection PhpUnused */


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymMember extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'birthdate', 'expire_date', 'profile_picture'];

    protected $casts = [
        'expire_date' => 'datetime:Y-m-d',
        'birthdate' => 'datetime:Y-m-d',
    ];

    public function getProfilePictureUrlAttribute() {
        if ($picture = $this->profile_picture)
            return asset('storage/' . $picture);

        return "https://www.w3schools.com/howto/img_avatar.png";
    }

}
