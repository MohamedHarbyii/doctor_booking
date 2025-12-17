<?php
namespace App\Services\ImageServices;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ImageServiece
{
    public static function upload(Model $model,$model_name,$request_name='image') {
        $model->addMediaFromRequest($request_name)->toMediaCollection($model_name);
    }
    public static function update(Model $model,$model_name) {
        $model->clearMediaCollection('users');
        $$model->addMediaFromRequest('image')->toMediaCollection($model_name);
    }
    public static function delete(Model $model,$model_name) {
        $model->clearMediaCollection($model_name);
    }
}