<?php

class ApiCompareInitialStoreControllerTest extends ApiTestCase
{
    public function testCompareSuccess()
    {

        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('createDefaultData')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/compareinitialstore/compare?store_id=111&user_id=988');

        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
    }

    public function testCompareError()
    {

        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = false;
        $this->storeRegisterRepository->expects($this->once())->method('createDefaultData')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/compareinitialstore/compare?store_id=111&user_id=988');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);
    }

    public function testInvalidStoreID()
    {

        $crawler = $this->client->request('GET', 'api/compareinitialstore/compare');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('The store id field is required.', $json);
    }
}
