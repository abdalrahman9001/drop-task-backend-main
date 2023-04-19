<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChecklistItem;

class File extends Model
{
    use HasFactory;

    protected  $guarded = [] ;

    public function checklistItem()
    {
        return $this->belongsTo(ChecklistItem::class, 'item_id');
    }

}
