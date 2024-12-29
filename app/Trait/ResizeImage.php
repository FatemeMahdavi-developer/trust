<?php

namespace App\Trait;

use Illuminate\Support\Facades\DB;
use Intervention\Image\Laravel\Facades\Image;

trait ResizeImage
{
    private $valid_extension = ['jpeg', 'png', 'jpg', 'gif', 'webp'];

    public function resize_pic(object $filed, string $module, string $field_name)
    {
        try {
            $resize_image = resize_image();
            $name = pathinfo($filed->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $filed->getClientOriginalExtension();
            $size_file = $filed->getSize();
            $file_name = time() . $name . "." . $extension;

            $filed->move(public_path("upload/" . $module . "/"), $file_name);
            $i = 1;
            $resizes_field_name = $resize_image[$module][$field_name] ?? [];
            if (!empty($resizes_field_name) && in_array($extension, $this->valid_extension)) {
                foreach ($resizes_field_name as $size) {
                    foreach ($size as $width => $height) {
                        $image = Image::read(public_path("upload/" . $module . "/") . $file_name);
                        $image->resize(width: $width, height: $height);
                        $path_public = public_path("upload/" . "thumb$i/" . $module . "/");
                        if (!file_exists($path_public)) {
                            mkdir($path_public, 0777, true);
                        }
                        $image->save($path_public . "/" . $file_name);
                    }
                    $i++;
                }
            }
            DB::table("upload")->insert([
                'file_name' => $module . "/" . $file_name,
                'module' => $module,
                'size' => formatSizeUnits($size_file),
                'format' => $extension
            ]);
            return $module . "/" . $file_name;
        } catch (\Exception $exception) {
            DB::rollBack();
        }
    }

    public function upload_file($module,$filed_name){
        $file = request()->$filed_name ?? '';
        if (is_object($file)) {
            $file = $this->resize_pic(request()->$filed_name, $module, $filed_name);
        }
        return $file;
    }

    public function upload_multiple_file($module, $filed_name,int $number=0)
    {
        $file = request()->$filed_name ?? '';
        if (is_array($file)) {
            $file = $this->resize_pic(request()->$filed_name[$number], $module, $filed_name);
        }
        return $file;
    }
}
