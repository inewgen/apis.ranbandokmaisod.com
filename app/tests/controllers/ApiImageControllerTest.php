<?php

class ApiImageControllerTest extends ApiTestCase
{


    public function test_Show_Fail_Parameter()
    {
        $crawler = $this->client->request('GET', 'api/product/256/images',array());
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Show_Success_Convert()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"images":[{"id":"5841473d57ee27cf448ab4b2b7c29525","user_id":205,"store_id":1,"album_id":253,"resource":"upload","name":"5841473d57ee27cf448ab4b2b7c29525","width":486,"height":724,"mime":"image\/jpeg","size":44773,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/1\/5841473d57ee27cf448ab4b2b7c29525.jpg","created_at":"2014-10-22 18:09:45","updated_at":"2014-10-22 18:09:45","deleted_at":null,"public_id":"5841473d57ee27cf448ab4b2b7c29525"},{"id":"373c54fb9c964cce023a838714bcda47","user_id":205,"store_id":1,"album_id":341,"resource":"upload","name":"373c54fb9c964cce023a838714bcda47","width":400,"height":493,"mime":"image\/gif","size":395718,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/1\/373c54fb9c964cce023a838714bcda47.gif","created_at":"2014-11-05 10:04:45","updated_at":"2014-11-05 10:04:45","deleted_at":null,"public_id":"373c54fb9c964cce023a838714bcda47"}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));


        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = '[{"id":"5841473d57ee27cf448ab4b2b7c29525","user_id":205,"store_id":1,"album_id":253,"resource":"upload","name":"5841473d57ee27cf448ab4b2b7c29525","width":486,"height":724,"mime":"image\/jpeg","size":44773,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/1\/5841473d57ee27cf448ab4b2b7c29525.jpg","created_at":"2014-10-22 18:09:45","updated_at":"2014-10-22 18:09:45","deleted_at":null,"public_id":"5841473d57ee27cf448ab4b2b7c29525"},{"id":"373c54fb9c964cce023a838714bcda47","user_id":205,"store_id":1,"album_id":341,"resource":"upload","name":"373c54fb9c964cce023a838714bcda47","width":400,"height":493,"mime":"image\/gif","size":395718,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/1\/373c54fb9c964cce023a838714bcda47.gif","created_at":"2014-11-05 10:04:45","updated_at":"2014-11-05 10:04:45","deleted_at":null,"public_id":"373c54fb9c964cce023a838714bcda47"}]';
        $mock = json_decode($mock,true);

        $this->imagesRepository->expects($this->any())->method('getImages')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
        );

        $crawler = $this->client->request('GET', 'api/forumtopics/256/images',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Show_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"images":[{"id":"5841473d57ee27cf448ab4b2b7c29525","user_id":205,"store_id":1,"album_id":253,"resource":"upload","name":"5841473d57ee27cf448ab4b2b7c29525","width":486,"height":724,"mime":"image\/jpeg","size":44773,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/1\/5841473d57ee27cf448ab4b2b7c29525.jpg","created_at":"2014-10-22 18:09:45","updated_at":"2014-10-22 18:09:45","deleted_at":null,"public_id":"5841473d57ee27cf448ab4b2b7c29525"},{"id":"373c54fb9c964cce023a838714bcda47","user_id":205,"store_id":1,"album_id":341,"resource":"upload","name":"373c54fb9c964cce023a838714bcda47","width":400,"height":493,"mime":"image\/gif","size":395718,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/1\/373c54fb9c964cce023a838714bcda47.gif","created_at":"2014-11-05 10:04:45","updated_at":"2014-11-05 10:04:45","deleted_at":null,"public_id":"373c54fb9c964cce023a838714bcda47"}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));


        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = '[{"id":"5841473d57ee27cf448ab4b2b7c29525","user_id":205,"store_id":1,"album_id":253,"resource":"upload","name":"5841473d57ee27cf448ab4b2b7c29525","width":486,"height":724,"mime":"image\/jpeg","size":44773,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/1\/5841473d57ee27cf448ab4b2b7c29525.jpg","created_at":"2014-10-22 18:09:45","updated_at":"2014-10-22 18:09:45","deleted_at":null,"public_id":"5841473d57ee27cf448ab4b2b7c29525"},{"id":"373c54fb9c964cce023a838714bcda47","user_id":205,"store_id":1,"album_id":341,"resource":"upload","name":"373c54fb9c964cce023a838714bcda47","width":400,"height":493,"mime":"image\/gif","size":395718,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/1\/373c54fb9c964cce023a838714bcda47.gif","created_at":"2014-11-05 10:04:45","updated_at":"2014-11-05 10:04:45","deleted_at":null,"public_id":"373c54fb9c964cce023a838714bcda47"}]';
        $mock = json_decode($mock,true);

        $this->imagesRepository->expects($this->any())->method('getImages')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
        );

        $crawler = $this->client->request('GET', 'api/product/256/images',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }


    public function test_Show_Success_Cache()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '{"response":{"images":[{"id":"5841473d57ee27cf448ab4b2b7c29525","user_id":205,"store_id":1,"album_id":253,"resource":"upload","name":"5841473d57ee27cf448ab4b2b7c29525","width":486,"height":724,"mime":"image\/jpeg","size":44773,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/1\/5841473d57ee27cf448ab4b2b7c29525.jpg","created_at":"2014-10-22 18:09:45","updated_at":"2014-10-22 18:09:45","deleted_at":null,"public_id":"5841473d57ee27cf448ab4b2b7c29525"},{"id":"373c54fb9c964cce023a838714bcda47","user_id":205,"store_id":1,"album_id":341,"resource":"upload","name":"373c54fb9c964cce023a838714bcda47","width":400,"height":493,"mime":"image\/gif","size":395718,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/1\/373c54fb9c964cce023a838714bcda47.gif","created_at":"2014-11-05 10:04:45","updated_at":"2014-11-05 10:04:45","deleted_at":null,"public_id":"373c54fb9c964cce023a838714bcda47"}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/product/256/images?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Show_Fail_Data()
    {
    
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":[],"code":1004}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));


        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = false;
        $this->imagesRepository->expects($this->any())->method('getImages')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '999',
        );

        $crawler = $this->client->request('GET', 'api/option/256/images',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function test_Post_Fail_Parameter()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $parameter = array();
        $crawler = $this->client->request('POST', 'api/product/256/images',$parameter);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Post_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = '{"result":true,"response":{"affected":1,"attachment":[{"attachment_id":"373c54fb9c964cce023a838714bcda47","position":"3"}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->imagesRepository->expects($this->once())->method('createImages')->will($this->returnValue($mock));

        $parameter = array(
            'store_id' => '1',
            'id' => '256',
            'attachment' => array(
                0 => array(
                    'attachment_id' => '373c54fb9c964cce023a838714bcda47',
                    'position' => 3
                )
            )
        );


        $crawler = $this->client->request('POST', 'api/option/256/images',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Post_Success_Convert()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = '{"result":true,"response":{"affected":1,"attachment":[{"attachment_id":"373c54fb9c964cce023a838714bcda47","position":"3"}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->imagesRepository->expects($this->once())->method('createImages')->will($this->returnValue($mock));

        $parameter = array(
            'store_id' => '1',
            'id' => '256',
            'attachment' => array(
                0 => array(
                    'attachment_id' => '373c54fb9c964cce023a838714bcda47',
                    'position' => 3
                )
            )
        );


        $crawler = $this->client->request('POST', 'api/forumtopics/256/images',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Update_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = '{"result":true,"response":{"affected":1,"attachment":[{"attachment_id":"373c54fb9c964cce023a838714bcda47","position":"3"}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->imagesRepository->expects($this->once())->method('saveImages')->will($this->returnValue($mock));

        $parameter = array(
            'store_id' => '1',
            'mid' => '256',
            'id' => '373c54fb9c964cce023a838714bcda47',
            'position' => 3
        );

        $crawler = $this->client->request('PUT', 'api/product/256/images/373c54fb9c964cce023a838714bcda47',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Update_Success_Convert()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = '{"result":true,"response":{"affected":1,"attachment":[{"attachment_id":"373c54fb9c964cce023a838714bcda47","position":"3"}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->imagesRepository->expects($this->once())->method('saveImages')->will($this->returnValue($mock));

        $parameter = array(
            'store_id' => '1',
            'mid' => '256',
            'id' => '373c54fb9c964cce023a838714bcda47',
            'position' => 3
        );

        $crawler = $this->client->request('PUT', 'api/forumtopics/256/images/373c54fb9c964cce023a838714bcda47',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }


    public function test_Update_Fail_Parameter()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $param = array(
            'id' => '1',
        );

        $crawler = $this->client->request('PUT', 'api/product/256/images/373c54fb9c964cce023a838714bcda47',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Delete_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = '{"result":true,"response":{"id":"ecea143a72bdf58b3a84de0a68f8573a"},"code":0}';
        $mock = json_decode($mock,true);
        $this->imagesRepository->expects($this->once())->method('deleteImages')->will($this->returnValue($mock));

        $parameter = array(
            'store_id' => '1',
            'mid' => '256',
            'id' => '373c54fb9c964cce023a838714bcda47'
        );

        $crawler = $this->client->request('DELETE', 'api/product/256/images/373c54fb9c964cce023a838714bcda47',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Delete_Success_Convert()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->imagesRepository = $this->getMock('ImagesRepository');
        $this->app->instance('ImagesRepository', $this->imagesRepository);

        $mock = '{"result":true,"response":{"id":"ecea143a72bdf58b3a84de0a68f8573a"},"code":0}';
        $mock = json_decode($mock,true);
        $this->imagesRepository->expects($this->once())->method('deleteImages')->will($this->returnValue($mock));

        $parameter = array(
            'store_id' => '1',
            'mid' => '256',
            'id' => '373c54fb9c964cce023a838714bcda47'
        );

        $crawler = $this->client->request('DELETE', 'api/forumtopics/256/images/373c54fb9c964cce023a838714bcda47',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }


    public function test_Delete_Fail_Parameter()
    {

        $param = array(
            'user_id' => '205',
            'id' => '267',
        );

        $crawler = $this->client->request('DELETE', 'api/product/256/images/373c54fb9c964cce023a838714bcda47',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

}
