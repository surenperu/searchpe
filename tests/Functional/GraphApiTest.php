<?php


namespace Tests\Functional;

use Peru\Sunat\Company;

class GraphApiTest extends BaseTestCase
{
    public function testConsultGraph()
    {
        $q = <<<QL
query { 
    company(ruc: "20493919271") {
        ruc
        razonSocial
        nombreComercial
        telefonos
        tipo
        estado
        condicion
        direccion
        departamento
        provincia
        distrito
        fechaInscripcion
        sistEmsion
        sistContabilidad
        actExterior
        actEconomicas
        cpPago
        sistElectronica
        fechaEmisorFe
        cpeElectronico
        fechaPle
        padrones
        fechaBaja
        profesion
    }
}

QL;

        $response = $this->runApp('POST', '/api/graph', ['query' => $q]);

        $this->assertEquals(200, $response->getStatusCode());
        $obj = json_decode((string)$response->getBody());

        /**@var $company Company */
        $company = $obj->data->company;

        $this->assertFalse(isset($obj->errors));
        $this->assertContains('EMPRESA CONSTRUCTORA', $company->razonSocial);
        $this->assertEquals('NO HABIDO', $company->condicion);
        $this->assertEquals('SUSPENSION TEMPORAL', $company->estado);
        $this->assertNotEmpty($company->direccion);
        $this->assertNotEmpty($company->departamento);
        $this->assertNotEmpty($company->provincia);
        $this->assertNotEmpty($company->distrito);
        $this->assertNotEmpty($company->fechaInscripcion);
    }
}