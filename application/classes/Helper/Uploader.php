<?php

class Helper_Uploader {

    static public function createTempIfNotExist() {
        $dir = Kohana::$config->load('config')->get('files_dir');
        if (!is_dir($dir))
            mkdir($dir, 0777);
    }

    static public function save_gallery_images($apartment, $images) {
        foreach ($images as $key => $value) {
            $place_upload_dir = Kohana::$config->load('config')->get('apartments_files') . $apartment->id . '/photos/';
            if (!is_dir($place_upload_dir))
                mkdir($place_upload_dir, 0777, true);
            $name = basename(md5($value)) . '.' . pathinfo($value, PATHINFO_EXTENSION);
            $target = $place_upload_dir . $name;
            $image_small = Image::factory($value);
            $image_small->save($target);
            chmod($target, 0777);
            unlink($value);
            $model = ORM::factory("Image");
            $model->name = $name;
            $model->apartment_id = $apartment->id;
            $model->save();
        }
    }

}