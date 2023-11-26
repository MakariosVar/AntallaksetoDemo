<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    const TYPE_POST = 'POST';
    const TYPE_PROFILE = 'PROFILE';


    protected $table = 'reports';

    protected $fillable = [
        'user_id',
        'object_type',
        'object_id',
        'report_category',
        'other_text',
        'deleted_at',
    ];

    public function softDelete()
    {
        $this->deleted_at = date('Y-m-d');
        if ($this->save()) {
            return true;
        }
        return false;
    }
}
