<?php

namespace app\model;

class TaskConnect extends Model
{
    public function task(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TaskModel::class);
    }

}