<?php 
namespace Core;

trait Upload 
{
    private function fileName($name){
        return  sha1(mt_rand(1, 9999).$name.uniqid()).time();
    }


    private function upload($data, $path=''){
        if(!empty($data)){
            $fileName = $this->fileName($data['name']);
            if(move_uploaded_file($data['tmp_name'], STORAGE.'/'.$path.$fileName)){
                return "http://".$_SERVER['HTTP_HOST'].'/storage/'.$path.$fileName;
            }
        }
        return false;
    }
}