<?php

class ApiSyncPortalControllerTest extends ApiTestCase
{

    public function testGetStoreSuccess()
    {

        $this->managequeueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->managequeueRepository);

        $response = '[6,111,50031]';
        $response = json_decode($response);

        $this->managequeueRepository->expects($this->once())->method('compareSyncStore')->will($this->returnValue($response));

 
        $crawler = $this->client->request('GET', 'api/syncportal/store', array());

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);

    }

    public function testGetProductSuccess()
    {

        $this->managequeueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->managequeueRepository);

        $response = '[6,111,50031]';
        $response = json_decode($response);

        $this->managequeueRepository->expects($this->once())->method('compareSyncProduct')->will($this->returnValue($response));

 
        $crawler = $this->client->request('GET', 'api/syncportal/product', array());

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);

    }

    public function testGetStatSuccess()
    {

        $this->managequeueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->managequeueRepository);

        $response = '[{"store_id":1}]';
        $response = json_decode($response);

        $this->managequeueRepository->expects($this->once())->method('getStatQueue')->will($this->returnValue($response));
        $this->managequeueRepository->expects($this->any())->method('syncStat')->will($this->returnValue(true));

 
        $crawler = $this->client->request('GET', 'api/syncportal/stat', array());

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);

    }

    public function testPutUpdateProductSuccess()
    {

        $this->facebookRepository = $this->getMock('FacebookRepository');
        $this->app->instance('FacebookRepository', $this->facebookRepository);

        $this->productRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->productRepository);

        
        $mock = '{"id":"513","store_id":"111","user_id":"988","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"1","viewed":"0","price_min":"50.0000","price_max":"50.0000","prepare_shipping":"7","created_by":"205","updated_by":"205","created_at":"2014-10-24 15:03:41","updated_at":"2014-10-27 19:17:41","deleted_at":null,"monitor_status":"3","monitor_at":"2014-10-27 19:17:41","sync_status":2,"sync_at":"2014-10-27 19:17:41","remark":""}';
        $mock = json_decode($mock);

        $this->productRepository->expects($this->once())->method('apiProductFindProduct')->will($this->returnValue($mock));
        
        $data = '[{"status":1}]';
        $data = json_decode($data, true);

        $this->facebookRepository->expects($this->once())->method('getCategoryStatus')->will($this->returnValue($data));
  
        $this->facebookRepository->expects($this->once())->method('getProductShare')->will($this->returnValue(2));
        
        $profile = '{"id":99,"service":"facebook","store_id":111,"uid":"100000110687047","account":"wilasinee45@gmail.com","access_token":"CAAUK5ddtZAeQBAF7q7QZCacTiOT0vRZAXUZAi9yzZAMXmWZAHilcw5K4uQ3PiOi1P9hzriOymWy2XIaPHn7eOLRC84Ha9s2nm2jODhn8qWJK1izqyeTzAZAQmCTnp2G73TV2JQFt77377KKN0Idsd4VEndMY0UjAIvP3uXjMHVisS2F7zP281v0VoF5oDvIQH7YPpshyGbbNw0DqOfn5HnyMbRqdppvLkUZD","option":"a:6:{s:4:\"page\";a:3:{i:0;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:33:\"Apps Test + Page Manage Community\";s:2:\"id\";s:15:\"201198380010381\";}i:1;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:14:\"SaveShopOnline\";s:2:\"id\";s:12:\"379409101856\";}i:2;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:9:\"HOME SHOP\";s:2:\"id\";s:15:\"366920876724892\";}}s:12:\"display_name\";s:12:\"Wilasinee Na\";s:10:\"first_name\";s:9:\"Wilasinee\";s:9:\"last_name\";s:2:\"Na\";s:4:\"link\";s:39:\"http:\/\/www.facebook.com\/100000110687047\";s:8:\"share_to\";s:8:\"timeline\";}","status":1,"created_at":"2015-02-15 15:49:41","updated_at":"2015-02-15 16:00:41"}';
        $profile = json_decode($profile);
        $this->facebookRepository->expects($this->once())->method('getConnectFbProfile')->will($this->returnValue($profile));
 
        $share = '{"status":true,"code":{"id":"100000110687047_1072151996131813"}}';
        $share = json_decode($share, true);
        $this->facebookRepository->expects($this->once())->method('share')->will($this->returnValue($share));
 
        
        $this->productRepository->expects($this->once())->method('saveProduct')->will($this->returnValue(true));
       

        $this->facebookRepository->expects($this->once())->method('updateShare')->will($this->returnValue(true));
        
        $parameter['store_id'] = 111;
        $parameter['type'] = 'product';
        $parameter['sync_status'] = 2;
 
        $crawler = $this->client->request('PUT', 'api/syncportal/513', $parameter);

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);

    }

    public function testPutUpdateProductNoSuccess()
    {

        $this->facebookRepository = $this->getMock('FacebookRepository');
        $this->app->instance('FacebookRepository', $this->facebookRepository);

        $this->productRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->productRepository);

        
        $mock = '{"id":"513","store_id":"111","user_id":"988","handle":"","type":"1","position":"0","price_status":"1","status":"1","use_options":"1","viewed":"0","price_min":"50.0000","price_max":"50.0000","prepare_shipping":"7","created_by":"205","updated_by":"205","created_at":"2014-10-24 15:03:41","updated_at":"2014-10-27 19:17:41","deleted_at":null,"monitor_status":"3","monitor_at":"2014-10-27 19:17:41","sync_status":2,"sync_at":"2014-10-27 19:17:41","remark":""}';
        $mock = json_decode($mock);

        $this->productRepository->expects($this->once())->method('apiProductFindProduct')->will($this->returnValue($mock));
        
 
        
        $this->productRepository->expects($this->once())->method('saveProduct')->will($this->returnValue(false));
       
        $parameter['store_id'] = 111;
        $parameter['type'] = 'product';
        $parameter['sync_status'] = 2;
 
        $crawler = $this->client->request('PUT', 'api/syncportal/513', $parameter);

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1009', $json);

    }

    public function testPutUpdateStoreSuccess()
    {

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store.json');
        $data = json_decode($data);
        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue($data));
      
        $this->storeRepository->expects($this->once())->method('saveStore')->will($this->returnValue(true));
       
        $parameter['store_id'] = 111;
        $parameter['type'] = 'store';
        $parameter['sync_status'] = 2;
 
        $crawler = $this->client->request('PUT', 'api/syncportal/111', $parameter);

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);

    }


    public function testPutUpdateProductNotFound()
    {

        $this->productRepository = $this->getMock('ProductRepository');
        $this->app->instance('ProductRepository', $this->productRepository);

        $this->productRepository->expects($this->once())->method('apiProductFindProduct')->will($this->returnValue(null));
       
        $parameter['product_id'] = 111111;
        $parameter['type'] = 'product';
        $parameter['sync_status'] = 2;
 
        $crawler = $this->client->request('PUT', 'api/syncportal/111111', $parameter);

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());        
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);

    }

    public function testPutUpdateStoreNotFound()
    {

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue(null));
       
        $parameter['store_id'] = 111111;
        $parameter['type'] = 'store';
        $parameter['sync_status'] = 2;
 
        $crawler = $this->client->request('PUT', 'api/syncportal/111111', $parameter);

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());        
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);

    }



    public function testPutUpdateInvalidID()
    {

        $crawler = $this->client->request('PUT', 'api/syncportal/x');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('The id must be an integer.', $json);
    }





}
