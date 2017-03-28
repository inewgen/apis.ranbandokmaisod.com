<?php

class ApiInventoryControllerTest extends ApiTestCase
{
    public function setUp()
    {
        parent::setUp();
        // instance Store
    }

    public function testUpdate_validateFail(){
        $param = ' {"store_id":"0","user_id":205,"inventories":{"sku":"aa-222","price":"300.0000","status":"false"}}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('PUT', 'api/product/233/inventories/466',$param);

        $json = $this->client->getResponse()->getContent();
        //alert($json);
         $this->assertTrue($this->client->getResponse()->isOk());
         $this->assertContains('"status_code":1003', $json);
    }

    public function testUpdate_validateInvFail(){
        $param = ' {"store_id":"0","user_id":205,"inventories":{"sku":"aa-222","price":"","status":"false"}}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('PUT', 'api/product/233/inventories/466',$param);

        $json = $this->client->getResponse()->getContent();
        //alert($json);
         $this->assertTrue($this->client->getResponse()->isOk());
         $this->assertContains('"status_code":1003', $json);
    }

    public function testUpdate_invNotArray(){
        $param = ' {"store_id":"0","user_id":205,"inventories":""}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('PUT', 'api/product/233/inventories/466',$param);

        $json = $this->client->getResponse()->getContent();
        //alert($json);
         $this->assertTrue($this->client->getResponse()->isOk());
         $this->assertContains('"status_code":1003', $json);
    }

    public function testUpdate_notFoundInv(){


        $this->InventoryRepository = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->InventoryRepository);
        $mock = '';
        $mock = json_decode($mock);
        $this->InventoryRepository->expects($this->at(0))
            ->method('findProductInventory')
            ->will($this->returnValue($mock));


        $param = ' {"store_id":"1","user_id":205,"inventories":{"sku":"aa-222","price":"300.0000","status":"false"}}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('PUT', 'api/product/233/inventories/466',$param);

        $json = $this->client->getResponse()->getContent();
        //alert($json);
         $this->assertTrue($this->client->getResponse()->isOk());
         $this->assertContains('"status_code":1004', $json);
    }

    public function testUpdate_success(){


        $this->InventoryRepository = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->InventoryRepository);
        $mock = '{"id":"466","store_id":"1","user_id":"205","barcode":"","product_id":"233","sku":"TV0023","cost_price":"0.0000","price":"50.0000","compare_at_price":"0.0000","price_status":"1","points":"0","weight":"0.0000","preorder":"0","preorder_period":"2","shipping_period":"0","usestock_status":"0","emptystock":"0","management":"1","policy":"0","quantity":"5","shipping":"0","shipping_price":"0.0000","taxable":"0","position":"0","status":"1","created_by":"0","updated_by":"0","published":"1","published_at":"0000-00-00 00:00:00","created_at":"2014-10-24 14:58:48","updated_at":"2014-10-24 14:58:48","deleted_at":null}';
        $mock = json_decode($mock);
        $this->InventoryRepository->expects($this->at(0))
            ->method('findProductInventory')
            ->will($this->returnValue($mock));

        $mock = '1';
        $mock = json_decode($mock,true);
        $this->InventoryRepository->expects($this->at(1))
            ->method('updateProductInventory')
            ->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->InventoryRepository->expects($this->at(2))
            ->method('mongoQueueCreate')
            ->will($this->returnValue($mock));

        $param = ' {"store_id":"1","user_id":205,"inventories":{"sku":"aa-222","price":"300.0000","status":"false"}}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('PUT', 'api/product/233/inventories/466',$param);

        $json = $this->client->getResponse()->getContent();
        //alert($json);
         $this->assertTrue($this->client->getResponse()->isOk());
         $this->assertContains('"status_code":0', $json);
         $this->assertContains('"status_txt":"Success"', $json);
         $this->assertContains('"sku":"aa-222"', $json);
    }

    public function testShow_validateFail(){

        $param = '{"store_id":"0"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product/401/inventories',$param);
        $json = $this->client->getResponse()->getContent();
        //alert($json);
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        //alert($json);
    }

    public function testShow_notFoundProduct(){


        $this->InventoryRepository = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->InventoryRepository);
        $mock = '';
        $this->InventoryRepository->expects($this->at(0))
            ->method('findProduct')
            ->will($this->returnValue($mock));

        $param = '{"store_id":"1"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product/401/inventories',$param);
        $json = $this->client->getResponse()->getContent();
        //alert($json);
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        //alert($json);
    }


    public function testShow_notFoundInv(){
       // StashCache::clear("path/api/90/product/index");

        $this->InventoryRepository = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->InventoryRepository);
        $mock = '{"id":"401","store_id":"1","user_id":"205","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"0","viewed":"0","price_min":"444.0000","price_max":"444.0000","prepare_shipping":"1","created_by":"205","updated_by":"0","created_at":"2014-11-04 16:13:08","updated_at":"2014-11-04 16:13:08","deleted_at":null,"monitor_status":"0","monitor_at":null,"sync_status":null,"sync_at":null,"remark":null}';
        $mock = json_decode($mock,true);
        $this->InventoryRepository->expects($this->at(0))
            ->method('findProduct')
            ->will($this->returnValue($mock));

        $mock = '[0,[]]';
        $mock = json_decode($mock,true);
        $this->InventoryRepository->expects($this->at(1))
            ->method('apiInventoryShowGet')
            ->will($this->returnValue($mock));

            $param = '{"store_id":"1"}';
            $param = json_decode($param,true);
            $crawler = $this->client->request('GET', 'api/product/401/inventories',$param);
            $json = $this->client->getResponse()->getContent();
            //alert($json);
            $this->assertTrue($this->client->getResponse()->isOk());
            $this->assertContains('"status_code":1004', $json);
            //alert($json);
        }


    public function testShow_success(){
       // StashCache::clear("path/api/90/product/index");

        $this->InventoryRepository = $this->getMock('InventoryRepository');
        $this->app->instance('InventoryRepository', $this->InventoryRepository);
        $mock = '{"id":"401","store_id":"1","user_id":"205","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"0","viewed":"0","price_min":"444.0000","price_max":"444.0000","prepare_shipping":"1","created_by":"205","updated_by":"0","created_at":"2014-11-04 16:13:08","updated_at":"2014-11-04 16:13:08","deleted_at":null,"monitor_status":"0","monitor_at":null,"sync_status":null,"sync_at":null,"remark":null}';
        $mock = json_decode($mock,true);
        $this->InventoryRepository->expects($this->at(0))
            ->method('findProduct')
            ->will($this->returnValue($mock));

        $mock = '[3,[{"id":"1146","store_id":"1","user_id":"205","barcode":"","product_id":"401","sku":"SKU-3","cost_price":"0.0000","price":"5.0000","compare_at_price":"45.0000","price_status":"0","points":"0","weight":"5.0000","preorder":"0","preorder_period":"1","shipping_period":"0","usestock_status":"0","emptystock":"0","management":"0","policy":"0","quantity":"45","shipping":"0","shipping_price":"0.0000","taxable":"0","position":"0","status":"1","created_by":"0","updated_by":"0","published":"1","published_at":"0000-00-00 00:00:00","created_at":"2014-11-12 12:09:47","updated_at":"2014-11-13 16:03:39","deleted_at":null,"options":[{"id":"22","store_id":"1","user_id":"205","code":"package","position":"0","status":"1","created_at":"2014-11-06 18:17:56","updated_at":"2014-11-07 17:38:25","pivot":{"product_inventory_id":"1146","option_id":"22"},"languages":[{"option_id":"22","language_id":"1","title":"\u0e41\u0e1e\u0e04\u0e40\u0e01\u0e47\u0e08"}]},{"id":"7","store_id":"1","user_id":"205","code":"size","position":"0","status":"1","created_at":"2014-10-31 15:27:19","updated_at":"2014-11-06 15:38:34","pivot":{"product_inventory_id":"1146","option_id":"7"},"languages":[{"option_id":"7","language_id":"1","title":"\u0e02\u0e19\u0e32\u0e14"}]},{"id":"1","store_id":"1","user_id":"205","code":"color","position":"0","status":"1","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1146","option_id":"1"},"languages":[{"option_id":"1","language_id":"1","title":"\u0e2a\u0e35"},{"option_id":"1","language_id":"2","title":""}]}],"values":[{"id":"82","store_id":"1","user_id":"205","option_id":"22","code":"","position":"1","created_at":"2014-11-06 18:17:56","updated_at":"2014-11-07 17:38:25","pivot":{"product_inventory_id":"1146","option_value_id":"82"},"languages":[{"option_value_id":"82","language_id":"1","title":"\u0e01\u0e25\u0e48\u0e2d\u0e07","description":"\u0e01\u0e25\u0e48\u0e2d\u0e07"}]},{"id":"38","store_id":"1","user_id":"205","option_id":"7","code":"","position":"1","created_at":"2014-10-31 15:27:19","updated_at":"2014-11-06 15:38:34","pivot":{"product_inventory_id":"1146","option_value_id":"38"},"languages":[{"option_value_id":"38","language_id":"1","title":"S","description":"S"}]},{"id":"3","store_id":"1","user_id":"205","option_id":"1","code":"#ffff99","position":"3","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1146","option_value_id":"3"},"languages":[{"option_value_id":"3","language_id":"1","title":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","description":""},{"option_value_id":"3","language_id":"2","title":"","description":""}]}]},{"id":"1145","store_id":"1","user_id":"205","barcode":"","product_id":"401","sku":"SKU-2","cost_price":"0.0000","price":"5.0000","compare_at_price":"45.0000","price_status":"0","points":"0","weight":"5.0000","preorder":"0","preorder_period":"1","shipping_period":"0","usestock_status":"0","emptystock":"0","management":"0","policy":"0","quantity":"45","shipping":"0","shipping_price":"0.0000","taxable":"0","position":"0","status":"1","created_by":"0","updated_by":"0","published":"1","published_at":"0000-00-00 00:00:00","created_at":"2014-11-12 12:09:47","updated_at":"2014-11-13 16:03:39","deleted_at":null,"options":[{"id":"22","store_id":"1","user_id":"205","code":"package","position":"0","status":"1","created_at":"2014-11-06 18:17:56","updated_at":"2014-11-07 17:38:25","pivot":{"product_inventory_id":"1145","option_id":"22"},"languages":[{"option_id":"22","language_id":"1","title":"\u0e41\u0e1e\u0e04\u0e40\u0e01\u0e47\u0e08"}]},{"id":"7","store_id":"1","user_id":"205","code":"size","position":"0","status":"1","created_at":"2014-10-31 15:27:19","updated_at":"2014-11-06 15:38:34","pivot":{"product_inventory_id":"1145","option_id":"7"},"languages":[{"option_id":"7","language_id":"1","title":"\u0e02\u0e19\u0e32\u0e14"}]},{"id":"1","store_id":"1","user_id":"205","code":"color","position":"0","status":"1","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1145","option_id":"1"},"languages":[{"option_id":"1","language_id":"1","title":"\u0e2a\u0e35"},{"option_id":"1","language_id":"2","title":""}]}],"values":[{"id":"82","store_id":"1","user_id":"205","option_id":"22","code":"","position":"1","created_at":"2014-11-06 18:17:56","updated_at":"2014-11-07 17:38:25","pivot":{"product_inventory_id":"1145","option_value_id":"82"},"languages":[{"option_value_id":"82","language_id":"1","title":"\u0e01\u0e25\u0e48\u0e2d\u0e07","description":"\u0e01\u0e25\u0e48\u0e2d\u0e07"}]},{"id":"38","store_id":"1","user_id":"205","option_id":"7","code":"","position":"1","created_at":"2014-10-31 15:27:19","updated_at":"2014-11-06 15:38:34","pivot":{"product_inventory_id":"1145","option_value_id":"38"},"languages":[{"option_value_id":"38","language_id":"1","title":"S","description":"S"}]},{"id":"2","store_id":"1","user_id":"205","option_id":"1","code":"#ffffcc","position":"2","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1145","option_value_id":"2"},"languages":[{"option_value_id":"2","language_id":"1","title":"\u0e04\u0e23\u0e35\u0e21","description":""},{"option_value_id":"2","language_id":"2","title":"","description":""}]}]},{"id":"1144","store_id":"1","user_id":"205","barcode":"","product_id":"401","sku":"SKU-1","cost_price":"0.0000","price":"5.0000","compare_at_price":"45.0000","price_status":"0","points":"0","weight":"5.0000","preorder":"0","preorder_period":"1","shipping_period":"0","usestock_status":"0","emptystock":"0","management":"0","policy":"0","quantity":"45","shipping":"0","shipping_price":"0.0000","taxable":"0","position":"0","status":"1","created_by":"0","updated_by":"0","published":"1","published_at":"0000-00-00 00:00:00","created_at":"2014-11-12 12:09:47","updated_at":"2014-11-13 16:03:38","deleted_at":null,"options":[{"id":"22","store_id":"1","user_id":"205","code":"package","position":"0","status":"1","created_at":"2014-11-06 18:17:56","updated_at":"2014-11-07 17:38:25","pivot":{"product_inventory_id":"1144","option_id":"22"},"languages":[{"option_id":"22","language_id":"1","title":"\u0e41\u0e1e\u0e04\u0e40\u0e01\u0e47\u0e08"}]},{"id":"7","store_id":"1","user_id":"205","code":"size","position":"0","status":"1","created_at":"2014-10-31 15:27:19","updated_at":"2014-11-06 15:38:34","pivot":{"product_inventory_id":"1144","option_id":"7"},"languages":[{"option_id":"7","language_id":"1","title":"\u0e02\u0e19\u0e32\u0e14"}]},{"id":"1","store_id":"1","user_id":"205","code":"color","position":"0","status":"1","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1144","option_id":"1"},"languages":[{"option_id":"1","language_id":"1","title":"\u0e2a\u0e35"},{"option_id":"1","language_id":"2","title":""}]}],"values":[{"id":"82","store_id":"1","user_id":"205","option_id":"22","code":"","position":"1","created_at":"2014-11-06 18:17:56","updated_at":"2014-11-07 17:38:25","pivot":{"product_inventory_id":"1144","option_value_id":"82"},"languages":[{"option_value_id":"82","language_id":"1","title":"\u0e01\u0e25\u0e48\u0e2d\u0e07","description":"\u0e01\u0e25\u0e48\u0e2d\u0e07"}]},{"id":"38","store_id":"1","user_id":"205","option_id":"7","code":"","position":"1","created_at":"2014-10-31 15:27:19","updated_at":"2014-11-06 15:38:34","pivot":{"product_inventory_id":"1144","option_value_id":"38"},"languages":[{"option_value_id":"38","language_id":"1","title":"S","description":"S"}]},{"id":"1","store_id":"1","user_id":"205","option_id":"1","code":"#ffffff","position":"1","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1144","option_value_id":"1"},"languages":[{"option_value_id":"1","language_id":"1","title":"\u0e02\u0e32\u0e27","description":""},{"option_value_id":"1","language_id":"2","title":"","description":""}]}]}]]';
        $mock = json_decode($mock,true);
        $this->InventoryRepository->expects($this->at(1))
            ->method('apiInventoryShowGet')
            ->will($this->returnValue($mock));



        $param = '{"store_id":"1"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product/401/inventories',$param);
        $json = $this->client->getResponse()->getContent();
        //alert($json);
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"store_id":"1"', $json);
        $this->assertContains('"user_id":"205"', $json);
        $this->assertContains('"product_id":"401"', $json);
        //alert($json);
    }
}
