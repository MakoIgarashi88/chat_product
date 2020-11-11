<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\User;

class Image extends Model
{
    public static function store($data = null)
    {
        if (!$data) return null;

        $mime_type = mime_content_type($data);
        $data = str_replace('data:'.$mime_type.';base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $fileData = base64_decode($data);
        $file_name = 'images/' . Str::random(16) . '.png';
        Storage::disk('public')->put($file_name, $fileData);

        $image = new Image;
        $image->name = 'storage/' . $file_name;
        $image->save();

        return $image->id;
    }


    public static function destroy($bool)
    {
        $image_ids = User::whereNotNUll('image_id')->pluck('image_id');
        $images = Image::whereNotIn('id', $image_ids)->get();
        
        foreach ($images as $image) {
            $name = $image->name;
            // 画像を消す処理
            if(strpos($name,'storage/') !== false){
                $name = str_replace('storage/', '', $name);
                Storage::disk('public')->delete($name);
            }
            // レコードを消す処理
            $image->delete();
        }
    }
}
