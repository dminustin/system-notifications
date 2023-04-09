<?php

declare(strict_types=1);

namespace Dminustin\SystemNotifications\BaseClasses;

use Dminustin\SystemNotifications\Exceptions\BaseException;

class BaseDTO
{
    /**
     * @throws BaseException
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            } else {
                throw new BaseException('Property '. $key. ' does not exist');
            }
        }
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        $result = [];
        foreach (get_object_vars($this) as $key => $value) {
            if (!is_null($value)) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}
