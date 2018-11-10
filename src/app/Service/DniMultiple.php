<?php

namespace Peru\Api\Service;

use Peru\Jne\Dni;

class DniMultiple
{
    /**
     * @var Dni
     */
    private $service;

    /**
     * DniMultiple constructor.
     *
     * @param Dni $service
     */
    public function __construct(Dni $service)
    {
        $this->service = $service;
    }

    /**
     * @param array $dnis
     *
     * @return array
     */
    public function get(array $dnis)
    {
        $all = [];
        foreach ($dnis as $dni) {
            $person = $this->service->get($dni);
            if ($person === false) {
                continue;
            }

            $all[] = $person;
        }

        return $all;
    }
}
