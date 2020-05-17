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
}