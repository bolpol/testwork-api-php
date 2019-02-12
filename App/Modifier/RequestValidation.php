<?php
/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/12/2019
 * Time: 10:46 AM
 */

namespace App\Modifier;


use Gridonic\JsonResponse\ErrorJsonResponse;

/**
 * Class RequestValidation
 * @package App
 */
class RequestValidation
{
    private $data;

    /**
     * RequestValidation constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $field
     */
    public function require(string $field):void
    {
        $this->check($field);
    }

    /**
     * @param $field
     */
    private function check($field):void
    {
        ($field);
        ($this->data);
        if(!empty($this->data)) {
            foreach ((object) $this->data as $key=>$value) {
                if($key === $field AND empty($value)) {
                    (new ErrorJsonResponse([], 'Required field is not found', 'Error title', 500, 'Bed request', []))->send();
                    exit;
                }
            }
        }
        else {
            (new ErrorJsonResponse([], 'Required field is not found', 'Error title', 500, 'Bed request', []))->send();
            exit;
        }
    }
}
