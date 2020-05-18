<?php
namespace app\helpers\file;

class FileHelpers
{

    /**
     * подсчет максимального значения для валидации данных
     * @param $val
     * @return float|int|string
     */
    public static function ReturnBytes($val)
    {
        $val = trim($val);
        $last = strtolower($val[strlen($val) - 1]);
        switch ($last) {
            case 'g':
                $val = (float)$val * 1024;
            case 'm':
                $val = (float)$val * 1024;
            case 'k':
                $val = (float)$val * 1024;
        }
        return $val;
    }

    /**
     * изменяет размер фото
     * @param $file_name - абсолютное имя файла
     * @param $new_w - ширина изображения
     * @param $quality - качество
     */
    public static function ImageResize($file_name, $new_w, $quality)
    {
        try {
            $old_avatar = imagecreatefrompng($file_name);
        } catch (\Exception $e) {
            $old_avatar = imagecreatefromjpeg($file_name);
        }
        $old_w = imagesx($old_avatar);
        $old_h = imagesy($old_avatar);
        $min_l = ($old_w > $old_h) ? $old_h : $old_w;
        $k = $new_w / $min_l;

        $w = intval($old_w * $k);
        $h = intval($old_h * $k);

        $new_p1 = imagecreatetruecolor($w, $h);
        imagecopyresampled($new_p1, $old_avatar, 0, 0, 0, 0, $w, $h, $old_w, $old_h);

        $im2 = imagecrop($new_p1, ['x' => 0, 'y' => 0, 'width' => $new_w, 'height' => $new_w]);
        try {
            imagejpeg($im2, $file_name, $quality);//создаем новый
        } catch (\Exception $e) {
            imagepng($im2, $file_name, $quality);//создаем новый
        }
        imagedestroy($old_avatar);
        imagedestroy($new_p1);
        imagedestroy($im2);
    }
}