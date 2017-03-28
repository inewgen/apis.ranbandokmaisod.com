<?php

class ApiStockControllerTest extends ApiTestCase
{
    // public function testHold_success2()
    // {
    //     $param = array(
    //                         0 => array(
    //                             'id' => 584,
    //                             'product_id' => 291,
    //                             'quantity' => 1,
    //                             'store_id' => 1
    //                         )
    //                     );
    //    // $param =  $param = $this->param1();
    //     $crawler = $this->client->request('POST', 'api/stock/hold', $param);
    //     $json = $this->client->getResponse()->getContent();
    //     $this->assertTrue($this->client->getResponse()->isOk());
    //     $this->assertContains('"status_code":0', $json);
    //     alert($json);die;
    // }

    public function testReturn_success()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);

        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);
        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->ProductInventoryRepository->expects($this->at(1))->method('apiStockCheck_updateData')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->ProductInventoryRepository->expects($this->at(2))->method('apiStockCheck_updateData')->will($this->returnValue($mock));

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '';
        $this->CachedRepository->expects($this->at(0))->method('clear')->will($this->returnValue($mock));
        $this->CachedRepository->expects($this->at(1))->method('clear')->will($this->returnValue($mock));
        $this->CachedRepository->expects($this->at(2))->method('clear')->will($this->returnValue($mock));

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $mock = '';
        $this->ProductRepository->expects($this->at(0))->method('manageQueueSyncProduct')->will($this->returnValue($mock));

        $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/return', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
    }

    public function testReturn_InputInvalid()
    {
        $param = array(
            "stock" => array(
                0 => array(
                    'id' => '',
                    'product_id' => 1,
                    'quantity' => '',
                    'store_id' => 1
                ))
            );
        $crawler = $this->client->request('POST', 'api/stock/return', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function testReturn_InputInvalidArray()
    {
        $param =  array();
        $crawler = $this->client->request('POST', 'api/stock/return', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
    }

    public function testReturn_nullInv()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/return', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
    }

    public function testReturn_invalidProductID()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"999","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));


        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $mock = '';
        $this->ProductRepository->expects($this->at(0))->method('manageQueueSyncProduct')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/return', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1016', $json);
        $this->assertContains('"400":{"status":"false","stock":0,"message":"Invalid product_id or store_id"', $json);
    }

    public function testReturn_invalidStoreID()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"999"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $mock = '';
        $this->ProductRepository->expects($this->at(0))->method('manageQueueSyncProduct')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/return', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1016', $json);
        $this->assertContains('"400":{"status":"false","stock":0,"message":"Invalid product_id or store_id"', $json);
    }

    public function testReturn_InvalidInv()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $mock = '';
        $this->ProductRepository->expects($this->at(0))->method('manageQueueSyncProduct')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $param['stock'][] = array(
                        'id' => 401,
                        'product_id' => 189,
                        'quantity' => 1,
                        'store_id' => 130
                    );
        $crawler = $this->client->request('POST', 'api/stock/return', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1016', $json);
        $this->assertContains('"401":{"status":"false","stock":0,"message":"Invalid Inventory ID"}', $json);
    }

    public function testHold_success()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);

        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);
        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

         $mock = '';
         $mock = json_decode($mock,true);
         $this->ProductInventoryRepository->expects($this->at(1))->method('apiStockCheck_updateData')->will($this->returnValue($mock));

         $mock = '';
         $mock = json_decode($mock,true);
         $this->ProductInventoryRepository->expects($this->at(2))->method('apiStockCheck_updateData')->will($this->returnValue($mock));

         $this->CachedRepository = $this->getMock('CachedRepository');
         $this->app->instance('CachedRepository', $this->CachedRepository);
         $mock = '';
         $this->CachedRepository->expects($this->at(0))->method('clear')->will($this->returnValue($mock));
         $this->CachedRepository->expects($this->at(1))->method('clear')->will($this->returnValue($mock));
         $this->CachedRepository->expects($this->at(2))->method('clear')->will($this->returnValue($mock));

         $this->ProductRepository = $this->getMock('ProductRepository');
         $this->app->instance('ProductRepository', $this->ProductRepository);
         $mock = '';
         $this->ProductRepository->expects($this->at(0))->method('manageQueueSyncProduct')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
    }

    public function testHold_success_NotUseStock_usestockStatus1()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"0","emptystock":"1","quantity":"0","product_id":"189","store_id":"130"},{"id":"403","preorder":"1","usestock_status":"0","emptystock":"1","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);
        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));


        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '';
        $this->CachedRepository->expects($this->at(0))->method('clear')->will($this->returnValue($mock));
        $this->CachedRepository->expects($this->at(1))->method('clear')->will($this->returnValue($mock));
        $this->CachedRepository->expects($this->at(2))->method('clear')->will($this->returnValue($mock));

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $mock = '';
        $this->ProductRepository->expects($this->at(0))->method('manageQueueSyncProduct')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"stock":"Not use stock"', $json);
    }

    public function testHold_success_NotUseStock_usestockStatus0()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"1","quantity":"0","product_id":"189","store_id":"130"},{"id":"403","preorder":"1","usestock_status":"1","emptystock":"1","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);
        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->ProductInventoryRepository->expects($this->at(1))->method('apiStockCheck_updateData')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->ProductInventoryRepository->expects($this->at(2))->method('apiStockCheck_updateData')->will($this->returnValue($mock));

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '';
        $this->CachedRepository->expects($this->at(0))->method('clear')->will($this->returnValue($mock));
        $this->CachedRepository->expects($this->at(1))->method('clear')->will($this->returnValue($mock));
        $this->CachedRepository->expects($this->at(2))->method('clear')->will($this->returnValue($mock));

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $mock = '';
        $this->ProductRepository->expects($this->at(0))->method('manageQueueSyncProduct')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
    }

    public function testHold_InputInvalid()
    {
        $param = array(
            "stock" => array(
                0 => array(
                    'id' => '',
                    'product_id' => '',
                    'quantity' => '',
                    'store_id' => ''
                ))
            );
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function testHold_InputInvalidArray()
    {
        $param =  array();
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
    }

    public function testHold_nullInv()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
    }

    public function testHold_InvalidInv()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $param['stock'][] = array(
                        'id' => 401,
                        'product_id' => 189,
                        'quantity' => 1,
                        'store_id' => 130
                    );
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1015', $json);
        $this->assertContains('"401":{"status":"false","stock":0,"message":"Invalid Inventory ID"}', $json);
    }

    public function testHold_OutOfStock()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"0","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1015', $json);
        $this->assertContains('"status_txt":"Out of stock"', $json);
    }

    public function testHold_invalidProductID()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"999","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1015', $json);
        $this->assertContains('"400":{"status":"false","stock":0,"message":"Invalid product_id or store_id"', $json);
    }

    public function testHold_invalidStoreID()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"999"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/hold', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1015', $json);
        $this->assertContains('"400":{"status":"false","stock":0,"message":"Invalid product_id or store_id"', $json);
    }

    public function testCheck_success()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/check', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
    }

    public function testCheck_success_NotUseStock_usestockStatus1()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"1","quantity":"0","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/check', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
    }

    public function testCheck_success_NotUseStock_usestockStatus0()
    {
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $mock = '[{"id":"400","preorder":"1","usestock_status":"0","emptystock":"1","quantity":"0","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
        $mock = json_decode($mock,true);

        $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

        $param =  $param = $this->param1();
        $crawler = $this->client->request('POST', 'api/stock/check', $param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"stock":"Not use stock"', $json);
    }

   public function testCheck_InputInvalid()
   {
       $param = array(
            "stock" => array(
               0 => array(
                   'id' => '',
                   'product_id' => '',
                   'quantity' => '',
                   'store_id' => ''
               ))
           );
       $crawler = $this->client->request('POST', 'api/stock/check', $param);
       $json = $this->client->getResponse()->getContent();
       $this->assertTrue($this->client->getResponse()->isOk());
       $this->assertContains('"status_code":1003', $json);
       $this->assertContains('"status_txt":"Invalid parameter"', $json);
   }

   public function testCheck_InputInvalidArray()
   {
       $param =  array();
       $crawler = $this->client->request('POST', 'api/stock/check', $param);
       $json = $this->client->getResponse()->getContent();
       $this->assertTrue($this->client->getResponse()->isOk());
       $this->assertContains('"status_code":1003', $json);
   }

   public function testCheck_InvalidInv()
   {
       $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
       $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
       $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
       $mock = json_decode($mock,true);

       $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

       $param =  $param = $this->param1();
       $param['stock'][] = array(
                       'id' => 401,
                       'product_id' => 189,
                       'quantity' => 1,
                       'store_id' => 130
                   );
       $crawler = $this->client->request('POST', 'api/stock/check', $param);
       $json = $this->client->getResponse()->getContent();
       $this->assertTrue($this->client->getResponse()->isOk());
       $this->assertContains('"status_code":1015', $json);
       $this->assertContains('"401":{"status":"false","stock":0,"message":"Invalid Inventory ID"}', $json);
   }

   public function testCheck_OutOfStock()
   {
       $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
       $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
       $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"0","product_id":"189","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"0","product_id":"101","store_id":"78"}]';
       $mock = json_decode($mock,true);

       $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

       $param =  $param = $this->param1();
       $crawler = $this->client->request('POST', 'api/stock/check', $param);
       $json = $this->client->getResponse()->getContent();
       $this->assertTrue($this->client->getResponse()->isOk());
       $this->assertContains('"status_code":1015', $json);
       $this->assertContains('"status_txt":"Out of stock"', $json);
   }

   public function testCheck_invalidProductID()
   {
       $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
       $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
       $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"999","store_id":"130"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
       $mock = json_decode($mock,true);

       $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

       $param =  $param = $this->param1();
       $crawler = $this->client->request('POST', 'api/stock/check', $param);
       $json = $this->client->getResponse()->getContent();
       $this->assertTrue($this->client->getResponse()->isOk());
       $this->assertContains('"status_code":1015', $json);
       $this->assertContains('"400":{"status":"false","stock":0,"message":"Invalid product_id or store_id"', $json);
   }

   public function testCheck_invalidStoreID()
   {
       $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
       $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
       $mock = '[{"id":"400","preorder":"1","usestock_status":"1","emptystock":"0","quantity":"12","product_id":"189","store_id":"999"},{"id":"403","preorder":"0","usestock_status":"0","emptystock":"0","quantity":"999","product_id":"101","store_id":"78"}]';
       $mock = json_decode($mock,true);

       $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

       $param =  $param = $this->param1();
       $crawler = $this->client->request('POST', 'api/stock/check', $param);
       $json = $this->client->getResponse()->getContent();
       $this->assertTrue($this->client->getResponse()->isOk());
       $this->assertContains('"status_code":1015', $json);
       $this->assertContains('"400":{"status":"false","stock":0,"message":"Invalid product_id or store_id"', $json);
   }

   public function testCheck_nullInv()
   {
       $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
       $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
       $mock = '';
       $mock = json_decode($mock,true);

       $this->ProductInventoryRepository->expects($this->at(0))->method('apiStockCheck_getData')->will($this->returnValue($mock));

       $param =  $param = $this->param1();
       $crawler = $this->client->request('POST', 'api/stock/check', $param);
       $json = $this->client->getResponse()->getContent();
       $this->assertTrue($this->client->getResponse()->isOk());
       $this->assertContains('"status_code":1004', $json);
   }

    private function param1()
    {
        return $param = array(
                "stock" => array(
                    0 => array(
                        'id' => 400,
                        'product_id' => 189,
                        'quantity' => 1,
                        'store_id' => 130
                    ),
                    1 => array(
                        'id' => 403,
                        'product_id' => 101,
                        'quantity' => 1,
                        'store_id' => 78
                    ))
                );
    }

}
