<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'imported_post_id',
        'publishedAt'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    /**
     * Date to human readable form
     */
    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) =>  Carbon::createFromTimeStamp(strtotime($value))->diffForHumans(),
        );
    }

}
