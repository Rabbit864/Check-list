<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'check_list_id',
        'status'
    ];

    public function checkList(){
        return $this->belongsTo(CheckList::class);
    }

    public function subParagraphs(){
        return $this->hasMany(SubParagraph::class);
    }
}
