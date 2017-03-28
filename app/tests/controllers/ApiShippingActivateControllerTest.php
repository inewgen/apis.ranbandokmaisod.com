<?php

class ApiShippingActivateControllerTest extends ApiTestCase
{
    public function test_getIndexSuccess()
    {
        /// mock cache ///
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);
        $this->cachedRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue(null));

        /// mock shipping destination ///
        $destination = array(
            'id' => 1,
        );
        $this->shippingRepository = $this->getMock('ShippingRepository');
        $this->app->instance('ShippingRepository', $this->shippingRepository);
        $this->shippingRepository->expects($this->once())
            ->method('getDestination')
            ->will($this->returnValue($destination));

        /// mock shipping rates ///
        $shippingRates = array(
            'code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'id' => 100,
                        'store_id' => 1,
                        'name' => 'POST',
                        'rate_type' => 'flat',
                        'start_rate' => 0.00,
                        'end_rate' => 0.00,
                        'price' => 500.00,
                        'status' => true,
                    ),
                    array(
                        'id' => 200,
                        'store_id' => 1,
                        'name' => 'EMS',
                        'rate_type' => 'flat',
                        'start_rate' => 0.00,
                        'end_rate' => 0.00,
                        'price' => 500.00,
                        'status' => true,
                    ),
                ),
            ),
        );
        $this->shippingRateRepository = $this->getMock('ShippingRateRepository');
        $this->app->instance('ShippingRateRepository', $this->shippingRateRepository);
        $this->shippingRateRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue($shippingRates));

        $params = array(
            'store_id' => '1',
            'shipping_id' => '55',
        );
        $crawler = $this->client->request('GET', 'api/shippingactivate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"EMS"', $json);
        $this->assertContains('"POST"', $json);
        $this->assertContains('"flat"', $json);
    }

    public function test_getIndexSuccessWithCache()
    {
        /// mock cache ///
        $cached = array(
            'code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'id' => 100,
                        'store_id' => 1,
                        'name' => 'POST',
                        'rate_type' => 'flat',
                        'start_rate' => 0.00,
                        'end_rate' => 0.00,
                        'price' => 500.00,
                        'status' => true,
                    ),
                    array(
                        'id' => 200,
                        'store_id' => 1,
                        'name' => 'EMS',
                        'rate_type' => 'flat',
                        'start_rate' => 0.00,
                        'end_rate' => 0.00,
                        'price' => 500.00,
                        'status' => true,
                    ),
                ),
            ),
        );
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);
        $this->cachedRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue($cached));

        $params = array(
            'store_id' => '1',
            'shipping_id' => '55',
        );
        $crawler = $this->client->request('GET', 'api/shippingactivate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"EMS"', $json);
        $this->assertContains('"POST"', $json);
        $this->assertContains('"flat"', $json);
    }

    public function test_getIndexInvalidParameters()
    {
        $crawler = $this->client->request('GET', 'api/shippingactivate', array());
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
    }

    public function test_getIndexNotFoundDestination()
    {
        /// mock cache ///
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);
        $this->cachedRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue(null));

        $this->shippingRepository = $this->getMock('ShippingRepository');
        $this->app->instance('ShippingRepository', $this->shippingRepository);
        $this->shippingRepository->expects($this->once())
            ->method('getDestination')
            ->will($this->returnValue(array()));

        $params = array(
            'store_id' => '1',
            'shipping_id' => '55',
        );
        $crawler = $this->client->request('GET', 'api/shippingactivate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function test_getIndexNotFoundShippingRate()
    {
        /// mock cache ///
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);
        $this->cachedRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue(null));

        /// mock shipping destination ///
        $destination = array(
            'id' => 1,
        );
        $this->shippingRepository = $this->getMock('ShippingRepository');
        $this->app->instance('ShippingRepository', $this->shippingRepository);
        $this->shippingRepository->expects($this->once())
            ->method('getDestination')
            ->will($this->returnValue($destination));

        /// mock shipping rates ///
        $shippingRates = array(
            'code' => 1004,
            'data' => array(),
        );
        $this->shippingRateRepository = $this->getMock('ShippingRateRepository');
        $this->app->instance('ShippingRateRepository', $this->shippingRateRepository);
        $this->shippingRateRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue($shippingRates));

        $params = array(
            'store_id' => '1',
            'shipping_id' => '55',
        );
        $crawler = $this->client->request('GET', 'api/shippingactivate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
    }
}
