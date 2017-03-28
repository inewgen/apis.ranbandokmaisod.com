<?php

class ApiStatControllerTest extends ApiTestCase
{
    public function test_getSuccess()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->statRepository = $this->getMock('StatRepository');
        $this->app->instance('StatRepository', $this->statRepository);

        $response = false;
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue($response));
        $this->cacheRepository->expects($this->once())->method('put')->will($this->returnValue($response));

        $response = '{"store_id":"1","total_product":58}';
        $response = json_decode($response, true);
        $this->statRepository->expects($this->once())->method('countProduct')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/stat/product?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"data":{"store_id":"1","total_product":58}', $json);
    }

    public function test_getOnCacheSuccess()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $response = '{"store_id":"1","total_product":59}';
        $response = json_decode($response, true);
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/stat/product?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"data":{"store_id":"1","total_product":59}', $json);
    }

    public function test_noStoreID()
    {
        $crawler = $this->client->request('GET', 'api/stat/product');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('The store id field is required.', $json);
    }

    public function test_invalidStoreID()
    {
        $crawler = $this->client->request('GET', 'api/stat/product?store_id=L1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('The store id must be an integer.', $json);
    }
}
