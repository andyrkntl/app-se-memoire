<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'nom_docs',
        'type_docs',
        'projet_id',
        'file_path',
    ];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'projet_id');
    }
}
