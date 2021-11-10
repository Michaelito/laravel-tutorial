<?php


namespace App\Traits;


trait Uuid
{
    public static function bootUuid()
    {
        static::creating(function($model){
            if (! is_string($model->uuid)) {
                $model->uuid = \Ramsey\Uuid\Uuid::uuid4();
            }
        });
    }
}
