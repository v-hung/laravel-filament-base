<?php

namespace App\Models\Media;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class MediaFolder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'path',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function medias()
    {
        return $this->hasMany(
            Media::class,
            'folder_id'
        );
    }
}
