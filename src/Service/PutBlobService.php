<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\Request;


final class PutBlobService
{
    public function putData(Request $request, string $fileName = null){

        $raw = $request->getContent();
        $delimiter = "multipart/form-data; boundary=";
        $boundary = "--" . explode($delimiter, $request->headers->get("content-type"))[1];
        $elements = str_replace([$boundary, "Content-Disposition: form-data;", "name="], "", $raw);
        $elementsTab = explode("\r\n\r\n", $elements);
        $data = [];
        for ($i = 0; isset($elementsTab[$i + 1]); $i += 2) {
            $key = str_replace(["\r\n", ' "', '"'], '', $elementsTab[$i]);
            if (strchr($key, $fileName)) {
                $stream = fopen('php://memory', 'r+');
                fwrite($stream, base64_encode($elementsTab[$i + 1]));
                rewind($stream);
                $data[$fileName] =  $stream;
                // echo "<img src='data:image;base64," . $data[$fileName] . "'>";
            } else {
                $val = str_replace(["\r\n", "--"], '', $elementsTab[$i + 1]);
                $data[$key] =  $val;
            }
        }
        return $data;
    }
}