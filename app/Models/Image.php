<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['announcement_id', 'path'];

    protected $casts = [
        'labels' => 'array'
    ];

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public static function getUrlByFilePath($filePath, $w = null, $h = null)
    {
        if (!$w && !$h) {
            return Storage::url($filePath);
        }
        $path = dirname($filePath);
        $filename = basename($filePath);
        $file = "{$path}/crop_{$w}x{$h}_{$filename}";

        return Storage::url($file);
    }

    public function getUrl($w = null, $h = null)
    {
        return Image::getUrlByFilePath($this->path, $w, $h);
    }
}
