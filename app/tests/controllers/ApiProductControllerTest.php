<?php

class ApiProductControllerTest extends ApiTestCase
{
    public function setUp()
    {
        parent::setUp();
        // instance Store
    }

    // public function testStore_validateFail2()
    // {
    //     //$this->setExpectedException('Exception');

    //     $this->ProductRepository = $this->getMock('ProductRepository');
    //     $this->app->instance('ProductRepository', $this->ProductRepository);
    //     $this->ProductRepository->expects($this->at(0))
    //         ->method('apiBeginTransaction')
    //         ->will($this->returnValue(''));

    //     $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_store.json');
    //     $param = json_decode($param,true);
    //     $param['title'] = '';
    //     $crawler = $this->client->request('POST', 'api/product',$param);
    //     $json = $this->client->getResponse()->getContent();
    //     $this->assertContains('"status_code":1003', $json);
    //     $this->assertContains('"status_txt":"Invalid parameter"', $json);
    // }

    public function testIndex_catRelateCountFail(){
        StashCache::clear("path/api/90/product/index");

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $mock = array();
        $this->ProductRepository->expects($this->at(0))
            ->method('apiProductGetRelateCategory')
            ->will($this->returnValue($mock));
        $param = '{"store_id":"90","monitor_status":"approved","category_id":"941"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);

    }

    public function testIndex_productCountFail(){
        StashCache::clear("path/api/90/product/index");

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $mock = '[{"id":"941","store_id":"90","user_id":"948","parent_id":"0","handle":"","sort_order":"manual","position":"22","product_count":"22","disable_product_count":"2","reject_count":"0","product_offline":"14","status":"1","created_by":"0","updated_by":"0","created_at":"2014-09-29 03:44:12","updated_at":"2014-11-07 14:23:08","deleted_at":null}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiProductGetRelateCategory')
            ->will($this->returnValue($mock));


        $mock = file_get_contents(app_path().'/tests/data/ApiProductController/product_apiProductGetIndex.json');;
        $mock = json_decode($mock);
        $mock[0] = 0;
        $this->ProductRepository->expects($this->at(1))
            ->method('apiProductGetIndex')
            ->will($this->returnValue($mock));

        $param = '{"store_id":"90","monitor_status":"approved","category_id":"941"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);

    }


    public function testIndex_successAjaxTotal(){
        StashCache::clear("path/api/90/product/index");

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $mock = '[{"id":"941","store_id":"90","user_id":"948","parent_id":"0","handle":"","sort_order":"manual","position":"22","product_count":"22","disable_product_count":"2","reject_count":"0","product_offline":"14","status":"1","created_by":"0","updated_by":"0","created_at":"2014-09-29 03:44:12","updated_at":"2014-11-07 14:23:08","deleted_at":null}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiProductGetRelateCategory')
            ->will($this->returnValue($mock));

        $mock = 1;
        $this->ProductRepository->expects($this->at(1))
            ->method('apiProductGetTotal')
            ->will($this->returnValue($mock));
        $mock = 11;
        $this->ProductRepository->expects($this->at(2))
            ->method('apiProductGetTotal')
            ->will($this->returnValue($mock));
        $mock = 111;
        $this->ProductRepository->expects($this->at(3))
            ->method('apiProductGetTotal')
            ->will($this->returnValue($mock));
        $mock = 1111;
        $this->ProductRepository->expects($this->at(4))
            ->method('apiProductGetTotal')
            ->will($this->returnValue($mock));
        $mock = 11111;
        $this->ProductRepository->expects($this->at(5))
            ->method('apiProductGetTotal')
            ->will($this->returnValue($mock));


        $param = '{"store_id":"1","type":"all,emptystock,approved,pending,reject","mode":"total","title":"1","category_id":941}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
       $this->assertContains('"data":{"all":1,"emptystock":11,"approved":111,"pending":1111,"reject":11111}}', $json);
    }

    public function testIndex_errorAjaxTotal(){
        StashCache::clear("path/api/90/product/index");

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $mock = '[{"id":"941","store_id":"90","user_id":"948","parent_id":"0","handle":"","sort_order":"manual","position":"22","product_count":"22","disable_product_count":"2","reject_count":"0","product_offline":"14","status":"1","created_by":"0","updated_by":"0","created_at":"2014-09-29 03:44:12","updated_at":"2014-11-07 14:23:08","deleted_at":null}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiProductGetRelateCategory')
            ->will($this->returnValue($mock));


        $param = '{"store_id":"1","type":"all,emptystock,approved,pending,reject","mode":"total","title":"1","category_id":10}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }


    public function testIndex_success(){
        StashCache::clear("path/api/90/product/index");

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue($mock));

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);


        $mock = '[{"id":"941","store_id":"90","user_id":"948","parent_id":"0","handle":"","sort_order":"manual","position":"22","product_count":"22","disable_product_count":"2","reject_count":"0","product_offline":"14","status":"1","created_by":"0","updated_by":"0","created_at":"2014-09-29 03:44:12","updated_at":"2014-11-07 14:23:08","deleted_at":null}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiProductGetRelateCategory')
            ->will($this->returnValue($mock));


        $mock = file_get_contents(app_path().'/tests/data/ApiProductController/product_apiProductGetIndex.json');;
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(1))
            ->method('apiProductGetIndex')
            ->will($this->returnValue($mock));

        $this->BlockWordRepository = $this->getMock('BlockWordRepository');
        $this->app->instance('BlockWordRepository', $this->BlockWordRepository);

        $mock = '"\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01******"';
        $this->BlockWordRepository->expects($this->at(0))
             ->method('check')
             ->will($this->returnValue($mock));
        $mock = '"\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01"';
        $this->BlockWordRepository->expects($this->at(1))
             ->method('check')
             ->will($this->returnValue($mock));
        $mock = '"\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01"';
        $this->BlockWordRepository->expects($this->at(2))
             ->method('check')
             ->will($this->returnValue($mock));
        $mock = '"<p>\r\n\t <span style=\"background-color: initial;\">\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01 <\/span><span style=\"background-color: initial;\">\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01<\/span>\r\n<\/p>"';
        $this->BlockWordRepository->expects($this->at(3))
             ->method('check')
             ->will($this->returnValue($mock));

        $mock =  '[{"id":"941","store_id":"90","user_id":"948","parent_id":"0","handle":"","sort_order":"manual","position":"22","product_count":"22","disable_product_count":"2","reject_count":"0","product_offline":"14","status":"1","created_by":"0","updated_by":"0","created_at":"2014-09-29 03:44:12","updated_at":"2014-11-07 14:23:08","deleted_at":null,"pivot":{"product_id":"129","category_id":"941"},"languages":[]}]';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(2))
             ->method('apiProductGetCat')
             ->will($this->returnValue($mock));


        $mock =  '[{"category_id":"941","language_id":"1","title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e22\u0e37\u0e14","body_html":"","seo_title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e22\u0e37\u0e14","seo_description":""}]';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(3))
             ->method('apiProductGetCatLang')
             ->will($this->returnValue($mock));

        $mock =  '[{"id":"057505879a7f5d6759ddfd0a2615881a","user_id":"948","store_id":"90","album_id":"71","resource":"upload","name":"057505879a7f5d6759ddfd0a2615881a.jpg","width":"430","height":"430","mime":"image\/jpeg","size":"32611","url":"\/uploads\/90\/057505879a7f5d6759ddfd0a2615881a.jpg","created_at":"2014-09-23 10:18:15","updated_at":"2014-09-23 10:18:15","deleted_at":null,"public_id":"057505879a7f5d6759ddfd0a2615881a"}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(4))
             ->method('apiProductGetAllAttachment')
             ->will($this->returnValue($mock));

        $mock = '{"id":"057505879a7f5d6759ddfd0a2615881a","name":"057505879a7f5d6759ddfd0a2615881a.jpg","mime":"image\/jpeg","extension":"jpg","url":"\/uploads\/90\/057505879a7f5d6759ddfd0a2615881a.jpg","position":"1"}';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(5))
             ->method('apiProductGetAttachment')
             ->will($this->returnValue($mock));

        $mock = file_get_contents(app_path().'/tests/data/ApiProductController/product_apiProductGetProductInventory.json');;
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(6))
            ->method('apiProductGetProductInventory')
            ->will($this->returnValue($mock));

        $mock = '[""]';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(7))
            ->method('apiProductGetProductTag')
            ->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->at(1))
            ->method('put')
            ->will($this->returnValue($mock));

        $param = '{"store_id":"90","monitor_status":"approved","category_id":"941"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"id":"129"', $json);
        $this->assertContains('"store_id":"90"', $json);
        $this->assertContains('"user_id":"948"', $json);
        //alert($json);

    }

    /**
    * @group qq
    */
    public function testIndex_successCached(){
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '{"benchmark":"false","pagination":{"current":1,"limit":20,"total":1},"record":[{"id":"129","store_id":"90","user_id":"948","type":"new","position":"0","viewed":"0","prepare_shipping":"0","price_status":"true","status":"true","monitor_status":"approved","remark":[""],"created_at":{"date":"2014-09-23 10:18:43","timeago":"5 months ago","format":"23 September 2014 10:18 AM"},"updated_at":{"date":"2015-02-15 19:58:59","timeago":"3 weeks ago","format":"15 February 2015 7:58 PM"},"title":{"th":"\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01aaabbb"},"body_html":{"th":"<p>\r\n\t <span style=\"background-color: initial;\">\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01 <\/span><span style=\"background-color: initial;\">\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01<\/span>\r\n<\/p>"},"seo":{"title":{"th":"\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01"},"description":{"th":"\u200b\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01\u00a0\u0e2b\u0e21\u0e2d\u0e19\u0e19\u0e48\u0e32\u0e23\u0e31\u0e01"}},"use_options":"1","category":[{"id":"941","parent_id":"0","status":"true","title":{"th":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e22\u0e37\u0e14"}}],"plaza_category":[{"id":"10","parent_id":"0","title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","name":{"th":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32"}},{"id":"155","parent_id":"10","title":"\u0e2d\u0e37\u0e48\u0e19\u0e46","name":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46"}}],"images":[{"id":"057505879a7f5d6759ddfd0a2615881a","name":"057505879a7f5d6759ddfd0a2615881a.jpg","mime":"image\/jpeg","width":"430","height":"430","extension":"jpg","url":"\/uploads\/90\/057505879a7f5d6759ddfd0a2615881a.jpg","position":"1"}],"price":"980.00","price_min":980,"price_max":980,"compare_at_price_min":1900,"compare_at_price_max":1900,"inventories":[{"id":"277","store_id":"90","user_id":"948","barcode":"","product_id":"129","sku":"SKU01-1","cost_price":"0.0000","price":"980.0000","compare_at_price":"1900.0000","price_status":"false","points":"0","weight":"0.8900","preorder":"true","preorder_period":"2","shipping_period":"0","usestock_status":"1","emptystock":"0","management":"0","policy":"0","quantity":"3","shipping":"0","shipping_price":"0.0000","taxable":"0","position":"0","status":"true","created_by":"0","updated_by":"0","published":"1","published_at":"0000-00-00 00:00:00","created_at":"2014-09-23 10:18:43","updated_at":"2014-09-25 04:08:23","deleted_at":null,"options":[{"id":"1","store_id":"1","user_id":"205","code":"color","position":"0","status":"1","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","title":{"th":"\u0e2a\u0e35"},"values":{"id":"2","store_id":"1","user_id":"205","option_id":"1","code":"#ffffcc","position":"2","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","title":{"th":"\u0e04\u0e23\u0e35\u0e21"},"pivot":{"product_inventory_id":"277","option_value_id":"2"}},"pivot":{"product_inventory_id":"277","option_id":"1"}}]}],"tags":[""]}]}';
        $mock = json_decode($mock,true);
        //alert($mock);die;
        $this->CachedRepository->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue($mock));

        $param = '{"store_id":"90","monitor_status":"approved","category_id":"941"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"id":"129"', $json);
        $this->assertContains('"store_id":"90"', $json);
        $this->assertContains('"user_id":"948"', $json);
    }

    /*
    * @group xx
    */
    public function testIndex_validateFail()
    {
        $param = '{"store_id":"0","monitor_status":"xxx"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    /*
    * @group xx
    */
    public function testShow_validateFail()
    {
        $param = '{"store_id":"0","monitor_status":"xxx"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product/400',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }


    public function testStore_validateFail()
    {

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_store.json');
        $param = json_decode($param,true);
        $param['title'] = '';
        $crawler = $this->client->request('POST', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }



    public function testStore_invValidateFail()
    {
        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_store.json');
        $param = json_decode($param,true);
        $param['inventories'][0]['sku'] = '';
        $crawler = $this->client->request('POST', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertContains('"status_code":1003', $json);
    }

    public function testStore_optionValidateFail()
    {
        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_store.json');
        $param = json_decode($param,true);
        $param['inventories'][0]['options'][0]['option_id'] = '';
        $crawler = $this->client->request('POST', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertContains('"status_code":1004', $json);
    }

    public function testUpdate_validateFail()
    {
        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_update.json');
        $param = json_decode($param,true);
        $param['user_id'] = 0;
        $crawler = $this->client->request('PUT', 'api/product/400',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function testDelete_validateFail()
    {

        $param = '{"store_id":"0"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('DELETE', 'api/product/400',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

        public function testDelete_findProductFail()
        {

            $this->ProductRepository = $this->getMock('ProductRepository');
            $this->app->instance('ProductRepository', $this->ProductRepository);

            $mock = '{"id":"247","store_id":"10","user_id":"205","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"1","viewed":"0","price_min":"50.0000","price_max":"50.0000","prepare_shipping":"7","created_by":"205","updated_by":"205","created_at":"2014-10-24 15:03:41","updated_at":"2014-10-27 19:17:41","deleted_at":null,"monitor_status":"3","monitor_at":"2014-10-27 19:17:41","sync_status":null,"sync_at":null,"remark":""}';
            $mock = json_decode($mock);
            $this->ProductRepository->expects($this->at(0))
                ->method('apiProductFindProduct')
                ->will($this->returnValue($mock));


            $param = '{"store_id":"1"}';
            $param = json_decode($param,true);
            $crawler = $this->client->request("DELETE", 'api/product/247',$param);
            $json = $this->client->getResponse()->getContent();
            $this->assertContains('"status_code":1004', $json);
           // alert($json);
    }

    public function testDelete_success()
    {

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $mock = '{"id":"247","store_id":"1","user_id":"205","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"1","viewed":"0","price_min":"50.0000","price_max":"50.0000","prepare_shipping":"7","created_by":"205","updated_by":"205","created_at":"2014-10-24 15:03:41","updated_at":"2014-10-27 19:17:41","deleted_at":null,"monitor_status":"3","monitor_at":"2014-10-27 19:17:41","sync_status":null,"sync_at":null,"remark":""}';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiProductFindProduct')
            ->will($this->returnValue($mock));

        $mock = '["203"]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(1))
            ->method('apiProductDeleteRelate')
            ->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(2))
            ->method('apiProductDeleteCat')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(3))
            ->method('manageQueueSyncProduct')
            ->will($this->returnValue($mock));
        $mock = '';
        $this->ProductRepository->expects($this->at(4))
            ->method('manageQueueSyncMonitorProduct')
            ->will($this->returnValue($mock));

        $param = '{"store_id":"1"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request("DELETE", 'api/product/247',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

       // alert($json);

}

public function testUpdate_findProductFail()
{
    $this->ProductRepository = $this->getMock('ProductRepository');
    $this->app->instance('ProductRepository', $this->ProductRepository);

    $mock = '{"id":"400","store_id":"10","user_id":"205","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"1","viewed":"0","price_min":"1.0000","price_max":"1.0000","prepare_shipping":"7","created_by":"205","updated_by":"205","created_at":"2014-11-03 17:26:33","updated_at":"2014-11-04 18:34:29","deleted_at":null,"monitor_status":"1","monitor_at":"2014-11-04 14:40:31","sync_status":"1","sync_at":"2014-11-03 23:57:57","remark":""}';
    $mock = json_decode($mock);
    $this->ProductRepository->expects($this->at(0))
        ->method('apiProductFindProduct')
        ->will($this->returnValue($mock));


    $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_update.json');
    $param = json_decode($param,true);
    $crawler = $this->client->request('PUT', 'api/product/400',$param);
    $json = $this->client->getResponse()->getContent();
    $this->assertContains('"status_code":1004', $json);

    //alert($json);

}

    /**
    * @group xx
    */
    public function testUpdate_success()
    {

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));


        $mock = '{"id":"400","store_id":"1","user_id":"205","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"1","viewed":"0","price_min":"1.0000","price_max":"1.0000","prepare_shipping":"7","created_by":"205","updated_by":"205","created_at":"2014-11-03 17:26:33","updated_at":"2014-11-04 18:34:29","deleted_at":null,"monitor_status":"1","monitor_at":"2014-11-04 14:40:31","sync_status":"1","sync_at":"2014-11-03 23:57:57","remark":""}';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(1))
            ->method('apiProductFindProduct')
            ->will($this->returnValue($mock));

        $mock = 1;
        $this->ProductRepository->expects($this->at(2))
            ->method('apiProductUpdateProduct')
            ->will($this->returnValue($mock));

        $mock = '["324"]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(3))
            ->method('apiProductUpdateCatByStatus')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(4))
            ->method('apiProductUpdateCatDetach')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(5))
            ->method('apiProductUpdateCatDecrease')
            ->will($this->returnValue($mock));

        $mock = '{"id":"324","store_id":"1","user_id":"205","parent_id":"0","handle":"","sort_order":"manual","position":"7","product_count":"12","disable_product_count":"0","reject_count":"-1","product_offline":"1","status":"1","created_by":"0","updated_by":"0","created_at":"2014-10-27 17:02:49","updated_at":"2014-11-04 18:37:31","deleted_at":null}';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(6))
            ->method('apiProductStoreFindCat')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(7))
            ->method('apiProductUpdateCatAttach')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(8))
            ->method('apiProductUpdateCatCount')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(9))
            ->method('apiProductUpdatePlazacatDetach')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(10))
            ->method('apiProductUpdatePlazacatAttach')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(11))
            ->method('apiProductDeleteTag')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(12))
            ->method('apiProductStoreInsertTag')
            ->will($this->returnValue($mock));


        $mock = '[{"product_id":"400","language_id":"1","title":"test2","seo_title":"test2","seo_description":"test2","deleted_at":null}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(13))
            ->method('apiProductGetLang')
            ->will($this->returnValue($mock));

        $mock = 0;
        $this->ProductRepository->expects($this->at(14))
            ->method('apiProductUpdateLang')
            ->will($this->returnValue($mock));

        $mock = '[{"product_id":"400","language_id":"1","body_html":"test2","deleted_at":null}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(15))
            ->method('apiProductGetHtml')
            ->will($this->returnValue($mock));

        $mock = 0;
        $this->ProductRepository->expects($this->at(16))
            ->method('apiProductUpdateHtml')
            ->will($this->returnValue($mock));

        $mock = 2;
        $this->ProductRepository->expects($this->at(17))
            ->method('apiProductUpdateOptionDelete')
            ->will($this->returnValue($mock));

        $mock = '{"id":876,"store_id":"1","user_id":205,"sku":"1-1","barcode":"","compare_at_price":"","management":0,"policy":0,"price_status":0,"preorder":0,"preorder_period":"7","status":1,"usestock_status":0,"emptystock":0,"weight":"","cost_price":0,"price":"1","points":0,"quantity":" 1","product_id":"400","updated_at":"2014-11-04 18:48:31","created_at":"2014-11-04 18:48:31"}';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(18))
            ->method('apiProductUpdateOptionInsert')
            ->will($this->returnValue($mock));


        $mock = 0;
        $this->ProductRepository->expects($this->at(19))
            ->method('apiProductUpdateOptionNew')
            ->will($this->returnValue($mock));

        $mock = '{"id":555,"store_id":"1","user_id":205,"sku":"1-1","barcode":"","compare_at_price":"","management":0,"policy":0,"price_status":0,"preorder":0,"preorder_period":"7","status":1,"usestock_status":0,"emptystock":0,"weight":"","cost_price":0,"price":"1","points":0,"quantity":" 1","product_id":"400","updated_at":"2014-11-04 18:48:31","created_at":"2014-11-04 18:48:31"}';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(20))
            ->method('apiProductUpdateOptionUpdate')
            ->will($this->returnValue($mock));

        $mock = 0;
        $this->ProductRepository->expects($this->at(21))
            ->method('apiProductUpdateOptionNew')
            ->will($this->returnValue($mock));


        $mock = 0;
        $this->ProductRepository->expects($this->at(22))
            ->method('apiProductUpdateInvDelete')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(23))
            ->method('apiProductUpdateAttachRelateDelete')
            ->will($this->returnValue($mock));


        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->at(0))
            ->method('put')
            ->will($this->returnValue($mock));

        //manageQueueSyncMonitorProduct
        $mock = '';
        $this->ProductRepository->expects($this->at(24))
            ->method('manageQueueSyncMonitorProduct')
            ->will($this->returnValue($mock));

        $this->ProductRepository->expects($this->at(25))
                ->method('apiCommit')
                ->will($this->returnValue(''));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_update.json');
        $param = json_decode($param,true);
        $crawler = $this->client->request('PUT', 'api/product/400',$param);
        $json = $this->client->getResponse()->getContent();
        //alert($json);

    }

    public function testUpdate_successLangChange()
    {
        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));


        $mock = '{"id":"400","store_id":"1","user_id":"205","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"1","viewed":"0","price_min":"1.0000","price_max":"1.0000","prepare_shipping":"7","created_by":"205","updated_by":"205","created_at":"2014-11-03 17:26:33","updated_at":"2014-11-04 18:34:29","deleted_at":null,"monitor_status":"1","monitor_at":"2014-11-04 14:40:31","sync_status":"1","sync_at":"2014-11-03 23:57:57","remark":""}';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(1))
            ->method('apiProductFindProduct')
            ->will($this->returnValue($mock));

        $mock = 1;
        $this->ProductRepository->expects($this->at(2))
            ->method('apiProductUpdateProduct')
            ->will($this->returnValue($mock));

        $mock = '["324"]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(3))
            ->method('apiProductUpdateCatByStatus')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(4))
            ->method('apiProductUpdateCatDetach')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(5))
            ->method('apiProductUpdateCatDecrease')
            ->will($this->returnValue($mock));

        $mock = '{"id":"324","store_id":"1","user_id":"205","parent_id":"0","handle":"","sort_order":"manual","position":"7","product_count":"12","disable_product_count":"0","reject_count":"-1","product_offline":"1","status":"1","created_by":"0","updated_by":"0","created_at":"2014-10-27 17:02:49","updated_at":"2014-11-04 18:37:31","deleted_at":null}';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(6))
            ->method('apiProductStoreFindCat')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(7))
            ->method('apiProductUpdateCatAttach')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(8))
            ->method('apiProductUpdateCatCount')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(9))
            ->method('apiProductUpdatePlazacatDetach')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(10))
            ->method('apiProductUpdatePlazacatAttach')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(11))
            ->method('apiProductDeleteTag')
            ->will($this->returnValue($mock));
        $this->ProductRepository->expects($this->at(12))
            ->method('apiProductStoreInsertTag')
            ->will($this->returnValue($mock));


        $mock = '[{"product_id":"400","language_id":"2","title":"test2","seo_title":"test2","seo_description":"test2","deleted_at":null}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(13))
            ->method('apiProductGetLang')
            ->will($this->returnValue($mock));

        $mock = 0;
        $this->ProductRepository->expects($this->at(14))
            ->method('apiProductInsertLang')
            ->will($this->returnValue($mock));

        $mock = '[{"product_id":"400","language_id":"2","body_html":"test2","deleted_at":null}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(15))
            ->method('apiProductGetHtml')
            ->will($this->returnValue($mock));

        $mock = 0;
        $this->ProductRepository->expects($this->at(16))
            ->method('apiProductInsertHtml')
            ->will($this->returnValue($mock));

        $mock = 2;
        $this->ProductRepository->expects($this->at(17))
            ->method('apiProductUpdateOptionDelete')
            ->will($this->returnValue($mock));

        $mock = '{"id":876,"store_id":"1","user_id":205,"sku":"1-1","barcode":"","compare_at_price":"","management":0,"policy":0,"price_status":0,"preorder":0,"preorder_period":"7","status":1,"usestock_status":0,"emptystock":0,"weight":"","cost_price":0,"price":"1","points":0,"quantity":" 1","product_id":"400","updated_at":"2014-11-04 18:48:31","created_at":"2014-11-04 18:48:31"}';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(18))
            ->method('apiProductUpdateOptionInsert')
            ->will($this->returnValue($mock));


        $mock = 0;
        $this->ProductRepository->expects($this->at(19))
            ->method('apiProductUpdateOptionNew')
            ->will($this->returnValue($mock));

        $mock = '{"id":555,"store_id":"1","user_id":205,"sku":"1-1","barcode":"","compare_at_price":"","management":0,"policy":0,"price_status":0,"preorder":0,"preorder_period":"7","status":1,"usestock_status":0,"emptystock":0,"weight":"","cost_price":0,"price":"1","points":0,"quantity":" 1","product_id":"400","updated_at":"2014-11-04 18:48:31","created_at":"2014-11-04 18:48:31"}';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(20))
            ->method('apiProductUpdateOptionUpdate')
            ->will($this->returnValue($mock));

        $mock = 0;
        $this->ProductRepository->expects($this->at(21))
            ->method('apiProductUpdateOptionNew')
            ->will($this->returnValue($mock));


        $mock = 0;
        $this->ProductRepository->expects($this->at(22))
            ->method('apiProductUpdateInvDelete')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(23))
            ->method('apiProductUpdateAttachRelateDelete')
            ->will($this->returnValue($mock));


        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->at(0))
            ->method('put')
            ->will($this->returnValue($mock));

        //manageQueueSyncMonitorProduct
        $mock = '';
        $this->ProductRepository->expects($this->at(24))
            ->method('manageQueueSyncMonitorProduct')
            ->will($this->returnValue($mock));

            $this->ProductRepository->expects($this->at(25))
                ->method('apiCommit')
                ->will($this->returnValue(''));


        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_update.json');
        $param = json_decode($param,true);
        $crawler = $this->client->request('PUT', 'api/product/400',$param);
        $json = $this->client->getResponse()->getContent();
        //alert($json);

    }


    public function testStore_notArrayInventories()
    {
        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_store.json');
        $param = json_decode($param,true);
        $param['inventories'] = 'xd';
        $crawler = $this->client->request('POST', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertContains('"status_code":1003', $json);

    }

    public function testStore_quotaLimit()
    {
        $mock = 1000;
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);
        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));

        $this->ProductInventoryRepository->expects($this->at(0))
            ->method('countByStoreID')
            ->will($this->returnValue($mock));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_store.json');
        $param = json_decode($param,true);
        $crawler = $this->client->request('POST', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertContains('"status_code":1008', $json);

    }

    public function testStore_InsertProductFail()
    {

        $mock = 8;
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $this->ProductInventoryRepository->expects($this->at(0))
            ->method('countByStoreID')
            ->will($this->returnValue($mock));


        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));

        $mock = false;
        $this->ProductRepository->expects($this->at(1))
            ->method('apiProductStoreInsert')
            ->will($this->returnValue($mock));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_store.json');
        $param = json_decode($param,true);
        $crawler = $this->client->request('POST', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertContains('"status_code":1005', $json);
    }


    /**
    * @group qq1
    */
    public function testStore_success()
    {

        $mock = 8;
        $this->ProductInventoryRepository = $this->getMock('ProductInventoryRepository');
        $this->app->instance('ProductInventoryRepository', $this->ProductInventoryRepository);
        $this->ProductInventoryRepository->expects($this->at(0))
            ->method('countByStoreID')
            ->will($this->returnValue($mock));


        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $this->ProductRepository->expects($this->at(0))
            ->method('apiBeginTransaction')
            ->will($this->returnValue(''));

        $mock = 'true';
        $this->ProductRepository->expects($this->at(1))
            ->method('apiProductStoreInsert')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(2))
            ->method('apiProductStoreInsertLanguages')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(3))
            ->method('apiProductStoreInsertBodyhtml')
            ->will($this->returnValue($mock));

        $mock = '{"store_id":"1","user_id":205,"sku":"3-1","barcode":"","compare_at_price":"333","management":1,"policy":0,"price_status":1,"preorder":0,"preorder_period":"7","status":1,"usestock_status":0,"emptystock":0,"weight":"33","cost_price":0,"price":"33","points":0,"quantity":"3 ","product_id":271,"updated_at":"2014-10-28 17:17:32","created_at":"2014-10-28 17:17:32","id":545}';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(4))
            ->method('apiProductStoreInsertInventory')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(5))
            ->method('apiProductStoreInsertOption')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(6))
            ->method('apiProductStoreInsertTag')
            ->will($this->returnValue($mock));

        $mock = '{"id":"324","store_id":"1","user_id":"205","parent_id":"0","handle":"","sort_order":"manual","position":"7","product_count":"12","disable_product_count":"0","reject_count":"-1","product_offline":"1","status":"1","created_by":"0","updated_by":"0","created_at":"2014-10-27 17:02:49","updated_at":"2014-11-04 18:37:31","deleted_at":null}';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(7))
            ->method('apiProductStoreFindCat')
            ->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(8))
            ->method('apiProductStoreAttachCat')
            ->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(9))
            ->method('apiProductStoreInsertCat')
            ->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(10))
            ->method('apiProductStoreInsertPlazacategory')
            ->will($this->returnValue($mock));

        $mock = '';
        $this->ProductRepository->expects($this->at(11))
            ->method('manageQueueSyncMonitorProduct')
            ->will($this->returnValue($mock));

            $this->ProductRepository->expects($this->at(12))
                ->method('apiCommit')
                ->will($this->returnValue(''));

        $param = file_get_contents(app_path().'/tests/data/ApiProductController/product_store.json');
        $param = json_decode($param,true);
        $crawler = $this->client->request('POST', 'api/product',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        //alert($json);
    }
    public function testShow_productCountFail()
    {
        StashCache::clear("path/api/1/product/267");

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $mock = array();
        $this->ProductRepository->expects($this->at(0))
             ->method('apiProductGetShow')
             ->will($this->returnValue($mock));

         $param = '{"store_id":"1","monitor_status":"approved"}';
         $param = json_decode($param,true);
         $crawler = $this->client->request('GET', 'api/product/267',$param);
         $json = $this->client->getResponse()->getContent();
         $this->assertTrue($this->client->getResponse()->isOk());
         $this->assertContains('"status_code":1004', $json);

    }

    /**
    * @group qq
    */
    public function testShow_success()
    {
        StashCache::clear("path/api/1/product/267");

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue($mock));

        $this->ProductRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->ProductRepository);

        $mock = file_get_contents(app_path().'/tests/data/ApiProductController/product_show.json');
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(0))
             ->method('apiProductGetShow')
             ->will($this->returnValue($mock));

        $this->BlockWordRepository = $this->getMock('BlockWordRepository');
        $this->app->instance('BlockWordRepository', $this->BlockWordRepository);

        $mock = 'test2';
        $this->BlockWordRepository->expects($this->at(0))
             ->method('check')
             ->will($this->returnValue($mock));
        $this->BlockWordRepository->expects($this->at(1))
             ->method('check')
             ->will($this->returnValue($mock));
        $this->BlockWordRepository->expects($this->at(2))
             ->method('check')
             ->will($this->returnValue($mock));
        $this->BlockWordRepository->expects($this->at(3))
             ->method('check')
             ->will($this->returnValue($mock));

        $mock =  '[{"id":"941","store_id":"90","user_id":"948","parent_id":"0","handle":"","sort_order":"manual","position":"22","product_count":"22","disable_product_count":"2","reject_count":"0","product_offline":"14","status":"1","created_by":"0","updated_by":"0","created_at":"2014-09-29 03:44:12","updated_at":"2014-11-07 14:23:08","deleted_at":null,"pivot":{"product_id":"129","category_id":"941"},"languages":[]}]';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(1))
             ->method('apiProductGetCat')
             ->will($this->returnValue($mock));

        $mock =  '[{"category_id":"941","language_id":"1","title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e22\u0e37\u0e14","body_html":"","seo_title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e22\u0e37\u0e14","seo_description":""}]';
        $mock = json_decode($mock);
        $this->ProductRepository->expects($this->at(2))
             ->method('apiProductGetCatLang')
             ->will($this->returnValue($mock));

        $mock =  '[{"id":"75b7485e48bb510668317dde6bc60aa6","user_id":"205","store_id":"1","album_id":"251","resource":"upload","name":"75b7485e48bb510668317dde6bc60aa6","width":"366","height":"602","mime":"image\/jpeg","size":"74409","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/1\/75b7485e48bb510668317dde6bc60aa6.jpg","created_at":"2014-10-17 15:11:57","updated_at":"2014-10-17 15:11:57","deleted_at":null,"public_id":"75b7485e48bb510668317dde6bc60aa6"}]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(3))
             ->method('apiProductGetAllAttachment')
             ->will($this->returnValue($mock));

        $mock = '{"id":"efbc7e91e0bec96aecd506cb7151b724","name":"efbc7e91e0bec96aecd506cb7151b724","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/efbc7e91e0bec96aecd506cb7151b724.jpg","position":"1"}';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(4))
             ->method('apiProductGetAttachment')
             ->will($this->returnValue($mock));

         $mock = '[{"id":"553","store_id":"1","user_id":"205","barcode":"","product_id":"267","sku":"JEANq","cost_price":"0.0000","price":"500.0000","compare_at_price":"0.0000","price_status":"1","points":"0","weight":"1.0000","preorder":"0","preorder_period":"7","shipping_period":"0","usestock_status":"0","emptystock":"0","management":"1","policy":"0","quantity":"99","shipping":"0","shipping_price":"0.0000","taxable":"0","position":"0","status":"1","created_by":"0","updated_by":"0","published":"1","published_at":"0000-00-00 00:00:00","created_at":"2014-10-27 17:30:11","updated_at":"2014-10-27 17:30:11","deleted_at":null,"options":[{"id":"1","store_id":"1","user_id":"205","code":"color","position":"0","status":"1","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1028","option_id":"1"},"languages":[{"option_id":"1","language_id":"1","title":"\u0e2a\u0e35"},{"option_id":"1","language_id":"2","title":""}]}],"values":[{"id":"2","store_id":"1","user_id":"205","option_id":"1","code":"#ffffcc","position":"2","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1028","option_value_id":"2"},"languages":[{"option_value_id":"2","language_id":"1","title":"\u0e04\u0e23\u0e35\u0e21","description":""},{"option_value_id":"2","language_id":"2","title":"","description":""}]}]}]';
         $mock = json_decode($mock,true);
         //jsn($mock);
         $this->ProductRepository->expects($this->at(5))
              ->method('apiProductGetProductInventory')
              ->will($this->returnValue($mock));

        $mock = '["55","fgdfg"]';
        $mock = json_decode($mock,true);
        $this->ProductRepository->expects($this->at(6))
             ->method('apiProductGetProductTag')
             ->will($this->returnValue($mock));

         $mock = '';
         $mock = json_decode($mock,true);
         $this->CachedRepository->expects($this->at(1))
             ->method('put')
             ->will($this->returnValue($mock));

        $param = '{"store_id":"1","monitor_status":"approved"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product/267',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"id":"267"', $json);
        $this->assertContains('"images":[{"id":"efbc7e91e0bec96aecd506cb7151b724","name":"efbc7e91e0bec96aecd506cb7151b724"', $json);
        $this->assertContains('"tags":["55","fgdfg"]}]', $json);
        $this->assertContains('"plaza_category":[{"id":"10","parent_id":"0","title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","name":{"th":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32"}},{"id":"155","parent_id":"10","title":"\u0e2d\u0e37\u0e48\u0e19\u0e46","name":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46"}}]', $json);

        //alert($json);

    }

    /**
    * @group qq
    */
    public function testShow_successCached(){
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '{"status_code":0,"status_txt":"Success","data":{"benchmark":"false","record":[{"id":"267","store_id":"1","user_id":"205","type":"new","position":"0","viewed":"0","prepare_shipping":"7","use_options":"1","option_position":"","price_status":"true","status":"true","created_at":{"date":"2014-10-28 16:18:20","timeago":"4 months ago","format":"28 October 2014 4:18 PM"},"updated_at":{"date":"2014-10-28 17:43:44","timeago":"4 months ago","format":"28 October 2014 5:43 PM"},"title":{"th":"test2"},"seo":{"title":{"th":"test2"},"description":{"th":"test2"}},"body_html":{"th":"test2"},"category":[{"id":"941","parent_id":"0","status":"true","title":{"th":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e22\u0e37\u0e14"}}],"plaza_category":[{"id":"10","parent_id":"0","title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","name":{"th":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32"}},{"id":"155","parent_id":"10","title":"\u0e2d\u0e37\u0e48\u0e19\u0e46","name":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46"}}],"images":[{"id":"efbc7e91e0bec96aecd506cb7151b724","name":"efbc7e91e0bec96aecd506cb7151b724","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/efbc7e91e0bec96aecd506cb7151b724.jpg","position":"1"}],"price":"500.00","price_min":500,"price_max":500,"compare_at_price_min":0,"compare_at_price_max":0,"inventories":[{"id":"553","store_id":"1","user_id":"205","barcode":"","product_id":"267","sku":"JEANq","cost_price":"0.0000","price":"500.0000","compare_at_price":"0.0000","price_status":"true","points":"0","weight":"1.0000","preorder":"false","preorder_period":"7","shipping_period":"0","usestock_status":"0","emptystock":"0","management":"1","policy":"0","quantity":"99","shipping":"false","shipping_price":"0.0000","taxable":"0","position":"0","status":"true","created_by":"0","updated_by":"0","published":"1","published_at":"0000-00-00 00:00:00","created_at":"2014-10-27 17:30:11","updated_at":"2014-10-27 17:30:11","deleted_at":null,"options":[{"id":"1","store_id":"1","user_id":"205","code":"color","position":"0","status":"1","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1028","option_id":"1"},"title":{"th":"\u0e2a\u0e35"},"values":{"id":"2","store_id":"1","user_id":"205","option_id":"1","code":"#ffffcc","position":"2","created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","pivot":{"product_inventory_id":"1028","option_value_id":"2"},"title":{"th":"\u0e04\u0e23\u0e35\u0e21"}}}]}],"monitor_status":"pendding","remark":[],"tags":["55","fgdfg"]}]}}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->at(0))
            ->method('get')
            ->will($this->returnValue($mock));

        $param = '{"store_id":"1","monitor_status":"approved"}';
        $param = json_decode($param,true);
        $crawler = $this->client->request('GET', 'api/product/267',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"id":"267"', $json);
        $this->assertContains('"images":[{"id":"efbc7e91e0bec96aecd506cb7151b724","name":"efbc7e91e0bec96aecd506cb7151b724"', $json);
        $this->assertContains('"tags":["55","fgdfg"]}]', $json);
        $this->assertContains('"plaza_category":[{"id":"10","parent_id":"0","title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","name":{"th":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32"}},{"id":"155","parent_id":"10","title":"\u0e2d\u0e37\u0e48\u0e19\u0e46","name":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46"}}]', $json);
    }



}
