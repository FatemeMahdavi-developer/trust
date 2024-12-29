<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Intervention\Image\Laravel\Facades\Image;

class make_resizeImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:resize_image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {


        $dir_no_images = 'site/img/no_image/';
        $no_images = resize_image();
        $image = Image::read(public_path($dir_no_images . "no_image.jpg"));
        foreach ($no_images as $no_image) {
//            foreach ($no_image as $key => $value) {
            foreach ($no_image as $value1) {
                foreach ($value1 as $key2 => $value2) {
                    foreach ($value2 as $key3 => $value3) {

                        $image_name = sprintf("no_image(%sx%s).jpg", $key3, $value3);
                        $no_image_name = public_path($dir_no_images . $image_name);
                        if (!file_exists($no_image_name)) {
                            $image->resize($key3, $value3);
                            $image->save($no_image_name);
                            dump([$key3 => $value3]);
                        }
                    }
                }
            }
        }
    }
}
