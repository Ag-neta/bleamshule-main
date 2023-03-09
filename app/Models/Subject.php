<?php

namespace App\Models;

use App\User;
use Eloquent;
use App\Section;

class Subject extends Eloquent
{
    protected $fillable = ['name', 'my_class_id', 'teacher_id', 'slug', 'section_id'];

    public function my_class()
    {
        return $this->belongsTo(MyClass::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
