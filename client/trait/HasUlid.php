<?php

namespace Trait;

use Illuminate\Database\Eloquent\Model;
use Rorecek\Ulid\Facades\Ulid;

trait HasUlid
{
    protected static function bootHasUlid()
    {
        static::creating(function (Model $model) {
            if (! $model->getKey()) {
                $model->setAttribute($model->getKeyName(), Ulid::generate());
            }
        });

        static::saving(function (Model $model) {
            $originalUlid = $model->getOriginal($model->getKeyName());
            if ($originalUlid !== $model->getKey()) {
                $model->setAttribute($model->getKeyName(), $originalUlid);
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
