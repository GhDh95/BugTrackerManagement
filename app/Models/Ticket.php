<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function developer(){
        return $this->belongsTo(User::class, 'developer_id');
    }

    public function scopeFilter($query, array $filters){
       $query->when($filters['search']?? false, function ($query, $search){
           return $query->where('name', 'like', '%'.$search.'%');
       });

    }
}
