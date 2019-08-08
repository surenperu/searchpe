<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 28/12/2017
 * Time: 20:53.
 */

declare(strict_types=1);

namespace Peru\Api\Controller;

use Peru\Api\Service\ArrayConverter;
use Peru\Jne\Dni;
use Peru\Sunat\Ruc;
use Peru\Sunat\UserValidator;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ConsultController
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * ConsultController constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function ruc($request, $response, array $args)
    {
        $ruc = $args['ruc'];
        $service = $this->container->get(Ruc::class);
        $company = $service->get($ruc);
        if ($company === false) {
            $this->getLogger()->error($service->getError());
            $response->getBody()->write($service->getError());

            return $response->withStatus(400);
        }

        return $response->withJson($this->container->get(ArrayConverter::class)->convert($company));
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function userSol($request, $response, array $args)
    {
        $ruc = $args['ruc'];
        $user = strtoupper($args['user']);

        $service = $this->container->get(UserValidator::class);
        $valid = $service->valid($ruc, $user);

        return $response->withJson($valid);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function dni($request, $response, array $args)
    {
        $dni = $args['dni'];
        $service = $this->container->get(Dni::class);
        $person = $service->get($dni);
        if ($person === false) {
            $this->getLogger()->error($service->getError());
            $response->getBody()->write($service->getError());

            return $response->withStatus(400);
        }

        return $response->withJson($this->container->get(ArrayConverter::class)->convert($person));
    }

    /**
     * @return LoggerInterface
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    private function getLogger()
    {
        return $this->container->get('logger');
    }
}
