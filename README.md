# API search-pe
 
API para consultar el DNI y RUC - Perú, empleando [peru-consult](https://github.com/surenperu/searchpe) package.

## Instalar

### Desde el código fuente

```
git clone https://github.com/surenperu/searchpe.git
cd searchpe
composer install
composer start
```

**Requerimientos**
- dom extension para Ruc class.
- dom extension para UserSol class.
- gd extension para Dni class.

### Desplegar en Heroku
Token por defecto: `wolsnut4`

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

## Ejemplos

### GraphQL
Implementando soporte para [graphql](http://graphql.org/) utilizar el endpoint `/api/graph`   

```
query {
    person(dni: "48004836") {
    	dni
    	nombres
    },
    company(ruc: "20131312955") {
    	ruc
    	razonSocial
    }
}
```
Respuesta:
```json
{
    "data": {
        "person": {
            "dni": "48004836",
            "nombres": "ROBERTO CARLOS"
        },
        "company": {
            "ruc": "20131312955",
            "razonSocial": "SUPERINTENDENCIA NACIONAL DE ADUANAS Y DE ADMINISTRACION TRIBUTARIA - SUNAT"
        }
    }
}
```

### DNI
Ejecutar usando Curl.
```bash
curl -H "Accept: application/json" http://localhost:8090/api/dni/48004836?token=wolsnut4
```

Respuesta:

```json
{
  "dni": "48004836",
  "nombres": "ROBERTO CARLOS",
  "apellidoPaterno": "SULCA",
  "apellidoMaterno": "BASILIO",
  "codVerifica": "4"
}
```

### RUC
Ejecutar usando Curl.
```bash
curl -H "Accept: application/json" http://localhost:8090/api/ruc/20131312955?token=wolsnut4
```

Respuesta:

```json
{
  "ruc": "20131312955",
  "razonSocial": "SUPERINTENDENCIA NACIONAL DE ADUANAS Y DE ADMINISTRACION TRIBUTARIA - SUNAT",
  "nombreComercial": "-",
  "telefonos": [
    "6343300",
    "999999999",
    "999999998"
  ],
  "tipo": "INSTITUCIONES PUBLICAS",
  "estado": "ACTIVO",
  "condicion": "HABIDO",
  "direccion": "AV. GARCILASO DE LA VEGA NRO. 1472",
  "departamento":"LIMA",
  "provincia":"LIMA",
  "distrito":"LIMA",
  "fechaInscripcion": "1993-05-04T00:00:00.000Z",
  "sistEmsion": "MANUAL/COMPUTARIZADO",
  "sistContabilidad": "COMPUTARIZADO",
  "actExterior": "SIN ACTIVIDAD",
  "actEconomicas": [
    "75113 - ACTIV. ADMINIST. PUBLICA EN GENERAL"
  ],
  "cpPago": [
    "FACTURA",
    "BOLETA DE VENTA",
    "NOTA DE CREDITO",
    "NOTA DE DEBITO",
    "GUIA DE REMISION - REMITENTE",
    "COMPROBANTE DE RETENCION",
    "POLIZA DE ADJUDICACION POR REMATE DE BIENES"
  ],
  "sistElectronica": [
    "FACTURA PORTAL                      DESDE 07/08/2013",
    "BOLETA PORTAL                       DESDE 01/04/2016"
  ],
  "fechaEmisorFe": "2013-08-07T00:00:00.000Z",
  "cpeElectronico": [
    "FACTURA (desde 07/08/2013)",
    "BOLETA (desde 01/04/2016)"
  ],
  "fechaPle": "2013-01-01T00:00:00.000Z",
  "padrones": [
    "Incorporado al Régimen de Agentes de Retención de IGV (R.S.037-2002) a partir del 01/06/2002"
  ]
}
```

### Consulta Validez Usuario SOL
Ejecutar usando Curl.
```bash
curl http://localhost:8090/api/user-sol/20000000001/GMABCI?token=wolsnut4
```

Respuesta:

```text
true
```