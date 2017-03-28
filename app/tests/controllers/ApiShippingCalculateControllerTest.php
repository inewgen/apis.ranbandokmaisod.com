<?php

class ApiShippingCalculateControllerTest extends ApiTestCase
{
    public function test_ValidPostDataShouldSuccessOnFlat()
    {
        /// mock shipping return ///
        $shipping_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'shipping_rate' => array(
                            array(
                                'store_id' => 1,
                                'name' => 'POST',
                                'rate_type' => 'flat',
                                'start_rate' => 0.00,
                                'end_rate' => 0.00,
                                'price' => 500.00,
                                'status' => true,
                            ),
                            array(
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
                ),
            ),
        );
        $this->shipping = $this->getMock('ShippingRepository');
        $this->app->instance('ShippingRepository', $this->shipping);
        $this->shipping->expects($this->once())
            ->method('api_get')
            ->will($this->returnValue($shipping_mock));

        /// mock inventory return ///
        $inventory_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'id' => 1,
                        'store_id' => 1,
                        'price' => '100.00',
                        'weight' => '1.50',
                    ),
                ),
            ),
        );
        $this->inventory = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->inventory);
        $this->inventory->expects($this->any())
            ->method('api_get')
            ->will($this->returnValue($inventory_mock));

        $json = '{"data":[{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1},{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"type":"EMS"', $json);
        $this->assertContains('"type":"POST"', $json);
        $this->assertContains('"sub_type":"flat"', $json);
    }

    public function test_ValidPostDataShouldSuccessOnWeight()
    {
        /// mock shipping return ///
        $shipping_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'shipping_rate' => array(
                            array(
                                'store_id' => 1,
                                'name' => 'POST',
                                'rate_type' => 'weight',
                                'start_rate' => 0.00,
                                'end_rate' => 9999.9999,
                                'price' => 500.00,
                                'status' => true,
                            ),
                            array(
                                'store_id' => 1,
                                'name' => 'EMS',
                                'rate_type' => 'weight',
                                'start_rate' => 0.00,
                                'end_rate' => 9999.9999,
                                'price' => 500.00,
                                'status' => true,
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->shipping = $this->getMock('ShippingRepository');
        $this->app->instance('ShippingRepository', $this->shipping);
        $this->shipping->expects($this->once())
            ->method('api_get')
            ->will($this->returnValue($shipping_mock));

        /// mock inventory return ///
        $inventory_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'id' => 1,
                        'store_id' => 1,
                        'price' => '100.00',
                        'weight' => '1.50',
                    ),
                ),
            ),
        );
        $this->inventory = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->inventory);
        $this->inventory->expects($this->any())
            ->method('api_get')
            ->will($this->returnValue($inventory_mock));

        $json = '{"data":[{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1},{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"type":"EMS"', $json);
        $this->assertContains('"type":"POST"', $json);
        $this->assertContains('"sub_type":"weight"', $json);
    }

    public function test_ValidPostDataShouldSuccessOnPrice()
    {
        /// mock shipping return ///
        $shipping_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'shipping_rate' => array(
                            array(
                                'store_id' => 1,
                                'name' => 'POST',
                                'rate_type' => 'price',
                                'start_rate' => 0.00,
                                'end_rate' => 9999.9999,
                                'price' => 500.00,
                                'status' => true,
                            ),
                            array(
                                'store_id' => 1,
                                'name' => 'EMS',
                                'rate_type' => 'price',
                                'start_rate' => 0.00,
                                'end_rate' => 9999.9999,
                                'price' => 500.00,
                                'status' => true,
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->shipping = $this->getMock('ShippingRepository');
        $this->app->instance('ShippingRepository', $this->shipping);
        $this->shipping->expects($this->once())
            ->method('api_get')
            ->will($this->returnValue($shipping_mock));

        /// mock inventory return ///
        $inventory_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'id' => 1,
                        'store_id' => 1,
                        'price' => '100.00',
                        'weight' => '1.50',
                    ),
                ),
            ),
        );
        $this->inventory = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->inventory);
        $this->inventory->expects($this->any())
            ->method('api_get')
            ->will($this->returnValue($inventory_mock));

        $json = '{"data":[{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1},{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"type":"EMS"', $json);
        $this->assertContains('"type":"POST"', $json);
        $this->assertContains('"sub_type":"price"', $json);
    }

    public function test_ValidPostDataShouldSuccessOnAmount()
    {
        /// mock shipping return ///
        $shipping_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'shipping_rate' => array(
                            array(
                                'store_id' => 1,
                                'name' => 'POST',
                                'rate_type' => 'amount',
                                'start_rate' => 1.00,
                                'end_rate' => 9999.9999,
                                'price' => 500.00,
                                'status' => true,
                            ),
                            array(
                                'store_id' => 1,
                                'name' => 'EMS',
                                'rate_type' => 'amount',
                                'start_rate' => 1.00,
                                'end_rate' => 9999.9999,
                                'price' => 500.00,
                                'status' => true,
                            ),
                        ),
                    ),
                ),
            ),
        );
        $this->shipping = $this->getMock('ShippingRepository');
        $this->app->instance('ShippingRepository', $this->shipping);
        $this->shipping->expects($this->once())
            ->method('api_get')
            ->will($this->returnValue($shipping_mock));

        /// mock inventory return ///
        $inventory_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'id' => 1,
                        'store_id' => 1,
                        'price' => '100.00',
                        'weight' => '1.50',
                    ),
                ),
            ),
        );
        $this->inventory = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->inventory);
        $this->inventory->expects($this->any())
            ->method('api_get')
            ->will($this->returnValue($inventory_mock));

        $json = '{"data":[{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1},{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"type":"EMS"', $json);
        $this->assertContains('"type":"POST"', $json);
        $this->assertContains('"sub_type":"amount"', $json);
    }

    public function test_EmptyPostDataShouldFail()
    {
        $params = array(
            'json' => '',
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_NoStoreIdParameterShouldFail()
    {
        //$data = '{"data":[{"store_id":1,"product_id":10,"inventory_id":10,"quantity":1}]}';
        $json = '{"data":[{"product_id":10,"inventory_id":10,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_NoProductIdParameterShouldFail()
    {
        //$data = '{"data":[{"store_id":1,"product_id":10,"inventory_id":10,"quantity":1}]}';
        $json = '{"data":[{"store_id":1,"inventory_id":10,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_NoInventoryIdParameterShouldFail()
    {
        //$data = '{"data":[{"store_id":1,"product_id":10,"inventory_id":10,"quantity":1}]}';
        $json = '{"data":[{"store_id":1,"product_id":10,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_NoQuantityParameterShouldFail()
    {
        //$data = '{"data":[{"store_id":1,"product_id":10,"inventory_id":10,"quantity":1}]}';
        $json = '{"data":[{"store_id":1,"product_id":10,"inventory_id":10}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_InvalidInventoryReturnShouldFail()
    {
        /// mock inventory ///
        $inventory_mock = '{"status_code":1004,"status_txt":"Data not found","data":[]}';
        $inventory_mock = json_decode($inventory_mock, true);

        $this->inventory = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->inventory);
        $this->inventory->expects($this->any())
            ->method('api_get')
            ->will($this->returnValue($inventory_mock));

        /// mock post data ///
        $json = '{"data":[{"store_id":1,"product_id":10,"inventory_id":10,"quantity":1},{"store_id":1,"product_id":11,"inventory_id":11,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function test_InvalidShippingReturnShouldFail()
    {
        /// mock inventory return ///
        $inventory_mock = array(
            'status_code' => 0,
            'data' => array(
                'record' => array(
                    array(
                        'id' => 1,
                        'store_id' => 1,
                        'price' => '100.00',
                        'weight' => '1.50',
                    ),
                ),
            ),
        );
        $this->inventory = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->inventory);
        $this->inventory->expects($this->any())
            ->method('api_get')
            ->will($this->returnValue($inventory_mock));

        /// mock shipping ///
        $shipping_mock = '{"status_code":1004,"status_txt":"Data not found","data":[]}';
        $shipping_mock = json_decode($shipping_mock, true);

        $this->shipping = $this->getMock('ShippingRepository');
        $this->app->instance('ShippingRepository', $this->shipping);
        $this->shipping->expects($this->once())
            ->method('api_get')
            ->will($this->returnValue($shipping_mock));

        /// mock post data ///
        $json = '{"data":[{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1},{"store_id":1,"product_id":1,"inventory_id":1,"quantity":1}]}';
        $params = array(
            'json' => $json,
        );
        $crawler = $this->client->request('POST', 'api/shippingcalculate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }
}
