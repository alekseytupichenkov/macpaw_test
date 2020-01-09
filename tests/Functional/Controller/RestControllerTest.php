<?php

namespace Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RestControllerTest extends WebTestCase
{
    /**
     * @var FrameworkBundle\KernelBrowser
     */
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testGetAirplaneModels()
    {
        $this->client->request('GET', '/api/airplanes_models');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('["Aeroprakt A-24","Boeing 747","Curtiss NC-4"]', $this->client->getResponse()->getContent());
        // todo better to deserialize json and assert arrays/objects instead text
    }

    public function testGetAirplane()
    {
        $this->client->request('GET', '/api/airplane/1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"id":1,"model":"Aeroprakt A-24","title":"AeropraktA24_1","hangar":{"id":1,"title":"Aeroprakt","lands":["RUNWAY","WATER"]},"status":"landed"}', $this->client->getResponse()->getContent());
    }

    public function testGetHangar()
    {
        $this->client->request('GET', '/api/hangar/1');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"id":1,"title":"Aeroprakt","lands":["RUNWAY","WATER"]}', $this->client->getResponse()->getContent());
    }

    public function testGetHangarAirplanes()
    {
        $this->client->request('GET', '/api/hangar/1/airplanes');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('[{"id":1,"model":"Aeroprakt A-24","title":"AeropraktA24_1","status":"landed"},{"id":2,"model":"Aeroprakt A-24","title":"AeropraktA24_2","status":"landed"},{"id":3,"model":"Aeroprakt A-24","title":"AeropraktA24_3","status":"landed"},{"id":4,"model":"Aeroprakt A-24","title":"AeropraktA24_4","status":"landed"},{"id":5,"model":"Aeroprakt A-24","title":"AeropraktA24_5","status":"landed"},{"id":6,"model":"Curtiss NC-4","title":"CurtissNC4_1","status":"landed"},{"id":7,"model":"Curtiss NC-4","title":"CurtissNC4_2","status":"landed"},{"id":8,"model":"Curtiss NC-4","title":"CurtissNC4_3","status":"landed"},{"id":9,"model":"Boeing 747","title":"Boeing747_1","status":"landed"},{"id":10,"model":"Boeing 747","title":"Boeing747_2","status":"landed"}]', $this->client->getResponse()->getContent());
    }

    public function testAirplaneTakeoff()
    {
        $this->client->request('POST', '/api/airplane/1/takeoff');

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"id":1,"model":"Aeroprakt A-24","title":"AeropraktA24_1","hangar":null,"status":"fly"}', $this->client->getResponse()->getContent());
    }


    public function testAirplaneLand()
    {
        $this->client->request('POST', '/api/airplane/1/land', ['hangar_id' => 1]);

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertEquals('{"id":1,"model":"Aeroprakt A-24","title":"AeropraktA24_1","hangar":{"id":1,"title":"Aeroprakt","lands":["RUNWAY","WATER"]},"status":"landed"}', $this->client->getResponse()->getContent());
    }
}
