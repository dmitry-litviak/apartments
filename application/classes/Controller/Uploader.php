<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Uploader extends My_Layout_User_Logged_Controller  {

    static $validate_array = array("jpg", "jpeg", "png", "gif");

    public function action_temp() {

        if (!empty($_FILES)) {
            $uploaddir = Kohana::$config->load('config')->get('temp_dir');
            if (!is_dir($uploaddir))
                mkdir($uploaddir, 0777);

            $file = $_FILES['file'];
            $info = pathinfo($file['name']);
            $name = md5(time()) . '.' . $info['extension'];
            if (in_array($info['extension'], self::$validate_array) && exif_imagetype($_FILES['file']['tmp_name']) != '') {
                $uploadfile = $uploaddir . $name;
                $image_small = Image::factory($file['tmp_name'])->resize(NULL, 600);
                $image_small->save($uploadfile);
                chmod($uploadfile, 0777);
                Helper_Jsonresponse::render_json('success', null, $uploadfile);
            } else {
                Helper_Jsonresponse::render_json('error', null, null);
            }
        }
    }
    public function action_remove() {
        if ($this->request->post('url')) {
            unlink($this->request->post('url'));
            Helper_Jsonresponse::render_json('success', null, null);
        } else {
            Helper_Jsonresponse::render_json('error', null, "File doesn't exist" );
        }
    }
    
    public function action_remove_existed() {
        if ($this->request->post('id')) {
            $image = ORM::factory('Image', $this->request->post('id'));
            unlink(Kohana::$config->load('config')->get('apartments_files') . $image->apartment_id . '/photos/' . $image->name);
            $image->delete();
            Helper_Jsonresponse::render_json('success', null, null);
        } else {
            Helper_Jsonresponse::render_json('error', null, "File doesn't exist" );
        }
    }

}