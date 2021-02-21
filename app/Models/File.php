<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Catalog;
use Storage;


class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
    ];

    protected $casts = [
        'path' => 'json',
    ];

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // dd($model->path);
            // $model->name = basename($model->path);
            // $model->size = Storage::size($model->path);
        });
        
        self::created(function($model){
        });

        self::updating(function($model){
        });
        
        self::updated(function($model){
        });

        self::deleting(function($model){
            // ... code here
        });

        self::deleted(function($model){
            // ... code here
        });
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Get the user that owns the File
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalog()
    {
        return $this->belongsTo(Catalog::class);
    }

    public static function getSelectOptions()
    {
        $options = DB::table('files')->select('id','name as text')->get();
        $selectOption = [];
        foreach ($options as $option){
            $selectOption[$option->id] = $option->text;
        }
        return $selectOption;
    }

}
