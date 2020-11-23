<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;


final class UploadService
{
    public function upload($string, $request){
        $avatar = $request->files->get($string);
        $requestContent[$string] = fopen($avatar->getRealPath(), 'rb');
        return $avatar;
    }
}