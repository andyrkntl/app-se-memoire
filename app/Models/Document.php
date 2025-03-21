<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $table = 'documents';

    protected $fillable = [
        'document_id',
        'Nom_fichier',
        'Type_fichier',
        'Lien',
        ];
}
