<?php

namespace app\model;

class TaskModel extends Model
{
    public function adminUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(AdminUser::class);
    }



}