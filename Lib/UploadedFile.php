<?php
namespace Lib;

class UploadedFile
{
    const UPL_DIR = ROOT.'uploaded'.DS;

    public function upload(){
        if( isset($_FILES['myFile']) ){
            if( !$_FILES['myFile']['error'] ){
                move_uploaded_file($_FILES['myFile']['tmp_name'],
                    self::UPL_DIR.$_FILES['myFile']['name']);
                Session::setFlash('Файл успешно загружен');
            } else {
                Session::setFlash('Ошибка. Файл не был отправлен');
            }
        }
    }
}