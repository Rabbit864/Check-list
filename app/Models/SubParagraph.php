<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubParagraph extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'paragraph_id',
        'status'
    ];

    public function paragraph(){
        return $this->belongsTo(Paragraph::class);
    }
}
