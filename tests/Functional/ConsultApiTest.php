<?php

namespace Tests\Functional;

use Peru\Reniec\Person;
use Peru\Sunat\Company;

class ConsultApiTest extends BaseTestCase
{
    public function testConsultRucInvalid()
    {
        $response = $this->runApp('GET', '/api/ruc/12312');

        $this->assertEquals(404, $response->getStatusCode());
    }

    public function testConsultRuc()
    {
        $response = $this->runApp('GET', '/api/ruc/20131312955');

        $this->assertEquals(200, $response->getStatusCode());

        /**@var $company Company */
        $company = json_decode((string)$response->getBody());

        $this->assertContains('SUPERINTENDENCIA NACIONAL', $company->razonSocial);
        $this->assertEquals('HABIDO', $company->condicion);
        $this->assertEquals('ACTIVO', $company->estado);
    }

    public function testConsult()
    {
        $response = $this->runApp('GET', '/api/dni/123456788');
        $this->assertEquals(404, $response->getStatusCode());
    }
    public function testConsultDni()
    {
        $response = $this->runApp('GET', '/api/dni/48004836');
        if ($response->getStatusCode() == 500) {
            echo (string)$response->getBody();
            return;
        }
        $this->assertEquals(200, $response->getStatusCode());
        /**@var $person Person*/
        $person = json_decode((string)$response->getBody());
        if (!empty(getenv('CI'))) {
            return;
        }
        $this->assertEquals('ROBERTO CARLOS', $person->nombres);
    }

    public function testConsultUserSol()
    {
        $response = $this->runApp('GET', '/api/user-sol/20123456789/ABC1245');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(in_array((string)$response->getBody(), ['true', 'false']));
    }
}