<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Publisher;
use App\Models\Subject;
use App\Models\File;
use DB;

class Book extends Model
{
    use HasFactory;

    

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


    public function files()
    {
        return $this->hasMany(File::class);
    }


    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }


    public static function getSelectOptions()
    {
        $options = DB::table('books')->select('id','name as text')->get();
        $selectOption = [];
        foreach ($options as $option){
            $selectOption[$option->id] = $option->text;
        }
        return $selectOption;
    }


}
