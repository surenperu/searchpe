<?php


declare(strict_types=1);

namespace Peru\Api\Service;

class ArrayConverter
{
    /**
     * @param mixed $value
     *
     * @return array
     */
    public function convert($value)
    {
        if (is_array($value)) {
            $arr = [];
            foreach ($value as $item) {
                $arr[] = get_object_vars($item);
            }

            return $arr;
        }

        return get_object_vars($value);
    }
}
