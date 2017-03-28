<?php

class ApiShippingRateControllerTest extends ApiTestCase
{
    public function test_indexSuccess()
    {
        $this->cachedRepos = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepos);
        $this->cachedRepos->expects($this->once())
            ->method('get')
            ->will($this->returnValue(0));

        $shippingRates = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'shipping_rate' => array(),
                    ),
                ),
            ),
        );
        $response = array(
            'code' => 0,
            'data' => $shippingRates,
        );
        $this->shippingRateRepos = $this->getMock('ShippingRateRepository');
        $this->app->instance('ShippingRateRepository', $this->shippingRateRepos);
        $this->shippingRateRepos->expects($this->once())
            ->method('get')
            ->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/shippingrate?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_indexSuccessWithCache()
    {
        $params = array('store_id' => 1);

        $shippingRates = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'shipping_rate' => array(),
                    ),
                ),
            ),
        );
        $this->cachedRepos = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepos);
        $this->cachedRepos->expects($this->once())
            ->method('get')
            ->will($this->returnValue($shippingRates));

        $crawler = $this->client->request('GET', 'api/shippingrate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_indexNoStoreId()
    {
        $crawler = $this->client->request('GET', 'api/shippingrate');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"message":"The store id field is required."', $json);
    }

    public function test_indexStoreIdLessThan1()
    {
        $crawler = $this->client->request('GET', 'api/shippingrate?store_id=0');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"message":"The store id must be at least 1."', $json);
    }

    public function test_indexInvalidStoreId()
    {
        $this->cachedRepos = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepos);
        $this->cachedRepos->expects($this->once())
            ->method('get')
            ->will($this->returnValue(0));

        $response = array(
            'code' => 1004,
            'data' => array(),
        );
        $this->shippingRateRepos = $this->getMock('ShippingRateRepository');
        $this->app->instance('ShippingRateRepository', $this->shippingRateRepos);
        $this->shippingRateRepos->expects($this->once())
            ->method('get')
            ->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/shippingrate?store_id=99999');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function test_storeSuccess()
    {
        $response = array(
            'code' => 0,
            'data' => array(),
        );
        $this->shippingRateRepos = $this->getMock('ShippingRateRepository');
        $this->app->instance('ShippingRateRepository', $this->shippingRateRepos);
        $this->shippingRateRepos->expects($this->once())
            ->method('store')
            ->will($this->returnValue($response));

        $this->cachedRepos = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepos);
        $this->cachedRepos->expects($this->any())
            ->method('clear')
            ->will($this->returnValue(true));

        $params = array(
            'store_id' => 1,
            'user_id' => 205,
            'name' => 'POST',
            'shipping_destination_id' => 66,
            'rate_type' => 'flat',
            'start_rate' => 1.00,
            'end_rate' => 2.00,
            'price' => 150.00,
            'status' => 'true',
        );
        $crawler = $this->client->request('POST', 'api/shippingrate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_storeInvalidInput()
    {
        $params = array(
            'store_id' => 0,
            'user_id' => 0,
            'name' => 'POST',
            'shipping_destination_id' => 66,
            'rate_type' => 'flat',
            'start_rate' => 1.00,
            'end_rate' => 2.00,
            'price' => 150.00,
            'status' => 'true',
        );
        $crawler = $this->client->request('POST', 'api/shippingrate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_updateSuccess()
    {
        $response = array(
            'code' => 0,
            'data' => array(),
        );
        $this->shippingRateRepos = $this->getMock('ShippingRateRepository');
        $this->app->instance('ShippingRateRepository', $this->shippingRateRepos);
        $this->shippingRateRepos->expects($this->once())
            ->method('update')
            ->will($this->returnValue($response));

        $this->cachedRepos = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepos);
        $this->cachedRepos->expects($this->any())
            ->method('clear')
            ->will($this->returnValue(true));

        $params = array(
            'id' => 111,
            'store_id' => 1,
            'user_id' => 205,
            'shipping_destination_id' => 66,
            'rate_type' => 'flat',
            'start_rate' => 1.00,
            'end_rate' => 2.00,
            'price' => 150.00,
            'status' => 'true',
        );
        $crawler = $this->client->request('PUT', 'api/shippingrate/111', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_updateInvalidInput()
    {
        $params = array(
            'id' => 0,
            'store_id' => 0,
            'user_id' => 205,
            'shipping_destination_id' => 66,
            'rate_type' => 'flat',
            'start_rate' => 1.00,
            'end_rate' => 2.00,
            'price' => 150.00,
            'status' => 'true',
        );
        $crawler = $this->client->request('PUT', 'api/shippingrate/111', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_destroySuccess()
    {
        $response = array(
            'code' => 0,
            'data' => array(
                'id' => 111,
                'affected' => array(),
            ),
        );
        $this->shippingRateRepos = $this->getMock('ShippingRateRepository');
        $this->app->instance('ShippingRateRepository', $this->shippingRateRepos);
        $this->shippingRateRepos->expects($this->once())
            ->method('destroy')
            ->will($this->returnValue($response));

        $this->cachedRepos = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepos);
        $this->cachedRepos->expects($this->any())
            ->method('clear')
            ->will($this->returnValue(true));

        $params = array(
            'id' => 111,
            'store_id' => 1,
        );
        $crawler = $this->client->request('DELETE', 'api/shippingrate/111', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_destroyInvalidInput()
    {
        $params = array(
            'id' => 0,
            'store_id' => 0,
        );
        $crawler = $this->client->request('DELETE', 'api/shippingrate/0', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"message":"The id must be at least 1."', $json);
    }
}
