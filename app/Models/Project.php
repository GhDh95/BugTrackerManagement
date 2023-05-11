<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function developers(): BelongsToMany
    {
        return $this->belongsToMany(User::class,  'developer_project',  'project_id', 'developer_id');
    }

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search){
            $query->where('name', 'like', '%'.$search.'%');
        });
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
