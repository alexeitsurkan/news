<?php namespace api\return_data;

/**
 * Класс возвращаемых данных
 */
class ReturnData
{
    public $status;
    public $data;
    public $errorMessage;

    public function __construct($status, $data, $errorMessage = "")
    {
        $this->status = $status;
        $this->data = $data;
        $this->errorMessage = $errorMessage;
    }
}
