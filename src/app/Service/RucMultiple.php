<?php
/**
 * Created by PhpStorm.
 * User: 
 * Date: 28/12/2017
 * Time: 21:17.
 */

declare(strict_types=1);

namespace Peru\Api\Service;

use Peru\Sunat\Async\Ruc;
use function React\Promise\all;
use React\Promise\PromiseInterface;

class RucMultiple
{
    /**
     * @var Ruc
     */
    private $service;

    /**
     * RucMultiple constructor.
     *
     * @param Ruc $service
     */
    public function __construct(Ruc $service)
    {
        $this->service = $service;
    }

    /**
     * @param array $rucs
     *
     * @return PromiseInterface
     */
    public function get(array $rucs): PromiseInterface
    {
        $all = [];
        foreach ($rucs as $ruc) {
            $promise = $this->service->get($ruc);

            $all[] = $promise;
        }

        return all($all);
    }
}
