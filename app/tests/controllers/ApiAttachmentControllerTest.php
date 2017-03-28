<?php

class ApiAttachmentControllerTest extends ApiTestCase
{
    // Get Index


    public function test_Get_Success()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":7},"record":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","album_id":1,"name":"15c74770fcd2dbc28cff7b87dd1f4ed6","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","width":526,"height":384,"size":{"bytes":36394,"format":"35.54 KB"},"created_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"}},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","album_id":1,"name":"9b2d8c30c8c5b74cef3917c481153cc4","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","width":994,"height":532,"size":{"bytes":232514,"format":"227.06 KB"},"created_at":{"date":"2014-10-14 11:37:23","timeago":"1 week ago","format":"14 October 2014 11:37 AM"},"updated_at":{"date":"2014-10-14 11:37:23","timeago":"1 week ago","format":"14 October 2014 11:37 AM"}},{"id":"4ca3755bcb2e90dc278a0b7485fc240d","album_id":1,"name":"4ca3755bcb2e90dc278a0b7485fc240d","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ca3755bcb2e90dc278a0b7485fc240d.png","width":1407,"height":778,"size":{"bytes":248606,"format":"242.78 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","album_id":1,"name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","width":409,"height":241,"size":{"bytes":40006,"format":"39.07 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"523483406240aeda9bf6e8c90113bb7a","album_id":1,"name":"523483406240aeda9bf6e8c90113bb7a","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/523483406240aeda9bf6e8c90113bb7a.png","width":1287,"height":649,"size":{"bytes":501290,"format":"489.54 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"ad6c284c6771f8d11e9d5f740d234f99","album_id":1,"name":"ad6c284c6771f8d11e9d5f740d234f99","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","width":994,"height":532,"size":{"bytes":232514,"format":"227.06 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"b09e5842a245c09dccec4783de4014b7","album_id":1,"name":"\u0e2b\u0e2b\u0e2b\u0e2b\u0e2b","mime":"image\/png","extension":"png","url":"\/uploads\/1\/b09e5842a245c09dccec4783de4014b7.png","width":200,"height":200,"size":{"bytes":42427,"format":"41.43 KB"},"created_at":{"date":"2014-10-09 23:03:24","timeago":"2 weeks ago","format":"9 October 2014 11:03 PM"},"updated_at":{"date":"2014-10-13 11:24:38","timeago":"2 weeks ago","format":"13 October 2014 11:24 AM"}}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = '{"result":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","user_id":205,"store_id":1,"album_id":1,"resource":"upload","name":"15c74770fcd2dbc28cff7b87dd1f4ed6","width":526,"height":384,"mime":"image\/jpeg","size":36394,"url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","created_at":"2014-10-20 17:36:27","updated_at":"2014-10-20 17:36:27","deleted_at":null,"public_id":"15c74770fcd2dbc28cff7b87dd1f4ed6"},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","user_id":205,"store_id":1,"album_id":1,"resource":"upload","name":"9b2d8c30c8c5b74cef3917c481153cc4","width":994,"height":532,"mime":"image\/png","size":232514,"url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","created_at":"2014-10-14 11:37:23","updated_at":"2014-10-14 11:37:23","deleted_at":null,"public_id":"9b2d8c30c8c5b74cef3917c481153cc4"},{"id":"4ca3755bcb2e90dc278a0b7485fc240d","user_id":205,"store_id":1,"album_id":1,"resource":"upload","name":"4ca3755bcb2e90dc278a0b7485fc240d","width":1407,"height":778,"mime":"image\/png","size":248606,"url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ca3755bcb2e90dc278a0b7485fc240d.png","created_at":"2014-10-14 11:34:39","updated_at":"2014-10-14 11:34:39","deleted_at":null,"public_id":"4ca3755bcb2e90dc278a0b7485fc240d"},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","user_id":205,"store_id":1,"album_id":1,"resource":"upload","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","width":409,"height":241,"mime":"image\/png","size":40006,"url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","created_at":"2014-10-14 11:34:39","updated_at":"2014-10-14 11:34:39","deleted_at":null,"public_id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa"},{"id":"523483406240aeda9bf6e8c90113bb7a","user_id":205,"store_id":1,"album_id":1,"resource":"upload","name":"523483406240aeda9bf6e8c90113bb7a","width":1287,"height":649,"mime":"image\/png","size":501290,"url":"http:\/\/store.weloveshopping.in\/uploads\/1\/523483406240aeda9bf6e8c90113bb7a.png","created_at":"2014-10-14 11:34:39","updated_at":"2014-10-14 11:34:39","deleted_at":null,"public_id":"523483406240aeda9bf6e8c90113bb7a"},{"id":"ad6c284c6771f8d11e9d5f740d234f99","user_id":205,"store_id":1,"album_id":1,"resource":"upload","name":"ad6c284c6771f8d11e9d5f740d234f99","width":994,"height":532,"mime":"image\/png","size":232514,"url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","created_at":"2014-10-14 11:34:39","updated_at":"2014-10-14 11:34:39","deleted_at":null,"public_id":"ad6c284c6771f8d11e9d5f740d234f99"},{"id":"b09e5842a245c09dccec4783de4014b7","user_id":205,"store_id":1,"album_id":1,"resource":"upload","name":"\u0e2b\u0e2b\u0e2b\u0e2b\u0e2b","width":200,"height":200,"mime":"image\/png","size":42427,"url":"\/uploads\/1\/b09e5842a245c09dccec4783de4014b7.png","created_at":"2014-10-09 23:03:24","updated_at":"2014-10-13 11:24:38","deleted_at":null,"public_id":"b09e5842a245c09dccec4783de4014b7"}],"count":7}';
        $mock = json_decode($mock);
        $this->attachmentRepository->expects($this->once())->method('getList')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/attachment?store_id=1&user_id=205&album_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Get_Fail_Connection()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":7},"record":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","album_id":1,"name":"15c74770fcd2dbc28cff7b87dd1f4ed6","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","width":526,"height":384,"size":{"bytes":36394,"format":"35.54 KB"},"created_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"}},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","album_id":1,"name":"9b2d8c30c8c5b74cef3917c481153cc4","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","width":994,"height":532,"size":{"bytes":232514,"format":"227.06 KB"},"created_at":{"date":"2014-10-14 11:37:23","timeago":"1 week ago","format":"14 October 2014 11:37 AM"},"updated_at":{"date":"2014-10-14 11:37:23","timeago":"1 week ago","format":"14 October 2014 11:37 AM"}},{"id":"4ca3755bcb2e90dc278a0b7485fc240d","album_id":1,"name":"4ca3755bcb2e90dc278a0b7485fc240d","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ca3755bcb2e90dc278a0b7485fc240d.png","width":1407,"height":778,"size":{"bytes":248606,"format":"242.78 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","album_id":1,"name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","width":409,"height":241,"size":{"bytes":40006,"format":"39.07 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"523483406240aeda9bf6e8c90113bb7a","album_id":1,"name":"523483406240aeda9bf6e8c90113bb7a","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/523483406240aeda9bf6e8c90113bb7a.png","width":1287,"height":649,"size":{"bytes":501290,"format":"489.54 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"ad6c284c6771f8d11e9d5f740d234f99","album_id":1,"name":"ad6c284c6771f8d11e9d5f740d234f99","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","width":994,"height":532,"size":{"bytes":232514,"format":"227.06 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"b09e5842a245c09dccec4783de4014b7","album_id":1,"name":"\u0e2b\u0e2b\u0e2b\u0e2b\u0e2b","mime":"image\/png","extension":"png","url":"\/uploads\/1\/b09e5842a245c09dccec4783de4014b7.png","width":200,"height":200,"size":{"bytes":42427,"format":"41.43 KB"},"created_at":{"date":"2014-10-09 23:03:24","timeago":"2 weeks ago","format":"9 October 2014 11:03 PM"},"updated_at":{"date":"2014-10-13 11:24:38","timeago":"2 weeks ago","format":"13 October 2014 11:24 AM"}}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = '{"result":[],"count":7}';
        $mock = json_decode($mock);
        $this->attachmentRepository->expects($this->once())->method('getList')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/attachment?store_id=1&user_id=205&album_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);
        $this->assertContains('"status_txt":"Connection error"', $json);
    }

    public function test_Get_Success_Cache()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        //$this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":7},"record":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","album_id":1,"name":"15c74770fcd2dbc28cff7b87dd1f4ed6","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","width":526,"height":384,"size":{"bytes":36394,"format":"35.54 KB"},"created_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"}},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","album_id":1,"name":"9b2d8c30c8c5b74cef3917c481153cc4","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","width":994,"height":532,"size":{"bytes":232514,"format":"227.06 KB"},"created_at":{"date":"2014-10-14 11:37:23","timeago":"1 week ago","format":"14 October 2014 11:37 AM"},"updated_at":{"date":"2014-10-14 11:37:23","timeago":"1 week ago","format":"14 October 2014 11:37 AM"}},{"id":"4ca3755bcb2e90dc278a0b7485fc240d","album_id":1,"name":"4ca3755bcb2e90dc278a0b7485fc240d","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ca3755bcb2e90dc278a0b7485fc240d.png","width":1407,"height":778,"size":{"bytes":248606,"format":"242.78 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","album_id":1,"name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","width":409,"height":241,"size":{"bytes":40006,"format":"39.07 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"523483406240aeda9bf6e8c90113bb7a","album_id":1,"name":"523483406240aeda9bf6e8c90113bb7a","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/523483406240aeda9bf6e8c90113bb7a.png","width":1287,"height":649,"size":{"bytes":501290,"format":"489.54 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"ad6c284c6771f8d11e9d5f740d234f99","album_id":1,"name":"ad6c284c6771f8d11e9d5f740d234f99","mime":"image\/png","extension":"png","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","width":994,"height":532,"size":{"bytes":232514,"format":"227.06 KB"},"created_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"},"updated_at":{"date":"2014-10-14 11:34:39","timeago":"1 week ago","format":"14 October 2014 11:34 AM"}},{"id":"b09e5842a245c09dccec4783de4014b7","album_id":1,"name":"\u0e2b\u0e2b\u0e2b\u0e2b\u0e2b","mime":"image\/png","extension":"png","url":"\/uploads\/1\/b09e5842a245c09dccec4783de4014b7.png","width":200,"height":200,"size":{"bytes":42427,"format":"41.43 KB"},"created_at":{"date":"2014-10-09 23:03:24","timeago":"2 weeks ago","format":"9 October 2014 11:03 PM"},"updated_at":{"date":"2014-10-13 11:24:38","timeago":"2 weeks ago","format":"13 October 2014 11:24 AM"}}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/attachment?store_id=1&user_id=205&album_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Get_Fail_Parameter()
    {

        $crawler = $this->client->request('GET', 'api/attachment?&user_id=205&album_id=1');
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Get_Fail()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":[],"code":1004}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = '{"result":[],"count":0}';
        $mock = json_decode($mock);
        $this->attachmentRepository->expects($this->once())->method('getList')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/attachment?store_id=1&user_id=205&album_id=999');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function testPostStoreFailParameter()
    {
        $parameter = array();
        $crawler = $this->client->request('POST', 'api/attachment',$parameter);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function testPostStoreFailInsert()
    {

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);
        $mock = false;
        //$mock = json_decode($mock);
        $this->attachmentRepository->expects($this->once())->method('createAttachment')->will($this->returnValue($mock));

        $parameter = array(
            'id' => '3e63fba594094b233085490d79a00f60',
            'album_id' => 261,
            'user_id' => 205,
            'store_id' => 1,
            'resource' => 'upload',
            'width' => 300,
            'height' => 400,
            'name' => '3e63fba594094b233085490d79a00f60',
            'size' => 20000,
            'mime' => 'image/jpeg',
            'url' => '/upload/gallery/1/3e63fba594094b233085490d79a00f60.jpg',
        );

        $crawler = $this->client->request('POST', 'api/attachment',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1005', $json);
        $this->assertContains('"status_txt":"Insert data error"', $json);
    }

    public function testPostStoreSuccessInsert()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $name = Str::random();
        $name = md5($name);

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);
        $mock = '{"id":"'.$name.'","album_id":249,"user_id":"205","store_id":"1","resource":"upload","width":"0","height":"0","name":"'.$name.'.jpg","size":"0","mime":"image\/jpeg","url":"\/upload\/gallery\/1\/'.$name.'.jpg"}';
        $mock = json_decode($mock);
        $this->attachmentRepository->expects($this->once())->method('createAttachment')->will($this->returnValue($mock));

        $parameter = array(
            'id' => $name,
            'album_id' => 249,
            'user_id' => 205,
            'store_id' => 1,
            'resource' => 'upload',
            'width' => 300,
            'height' => 400,
            'name' => $name,
            'size' => 20000,
            'mime' => 'image/jpeg',
            'url' => '/upload/gallery/1/'.$name.'.jpg',
        );

        $crawler = $this->client->request('POST', 'api/attachment',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Show_Fail_Parameter()
    {

        $crawler = $this->client->request('GET', 'api/attachment/3e63fba594094b233085490d79a00f60');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Show_Success()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","album_id":1,"name":"15c74770fcd2dbc28cff7b87dd1f4ed6","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","width":526,"height":384,"size":{"bytes":36394,"format":"35.54 KB"},"created_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"}},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = '{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","user_id":205,"store_id":1,"album_id":1,"resource":"upload","name":"15c74770fcd2dbc28cff7b87dd1f4ed6","width":526,"height":384,"mime":"image\/jpeg","size":36394,"url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","created_at":"2014-10-20 17:36:27","updated_at":"2014-10-20 17:36:27","deleted_at":null,"public_id":"15c74770fcd2dbc28cff7b87dd1f4ed6"}';

        $mock = json_decode($mock);

        $this->attachmentRepository->expects($this->any())->method('getAttachment')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1
        );

        $crawler = $this->client->request('GET', 'api/attachment/15c74770fcd2dbc28cff7b87dd1f4ed6',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Show_Success_Cache()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $mock = '{"response":{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","album_id":1,"name":"15c74770fcd2dbc28cff7b87dd1f4ed6","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","width":526,"height":384,"size":{"bytes":36394,"format":"35.54 KB"},"created_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"6 days ago","format":"20 October 2014 5:36 PM"}},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
        );

        $crawler = $this->client->request('GET', 'api/attachment/5de10fae0bdc33fc56dc46389230f9f3',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

     public function test_Show_Fail()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":[],"code":1004}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = null;
        $mock = json_decode($mock);
        $this->attachmentRepository->expects($this->any())->method('getAttachment')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
        );

        $crawler = $this->client->request('GET', 'api/attachment/1234567890',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

     public function test_Update_Success()
    {

         $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = '{"id": "206bd196d02ab33700f65ccf572fd01c","user_id":205,"store_id":1,"album_id":"267","resource":"upload","name":"test-update","mime":"image\/png","size":86278,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/1\/206bd196d02ab33700f65ccf572fd01c.png","deleted_at":null,"public_id":"206bd196d02ab33700f65ccf572fd01c"}';
        $mock = json_decode($mock);
        $this->attachmentRepository->expects($this->any())->method('saveAttachment')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'id' => '206bd196d02ab33700f65ccf572fd01c',
            'album_id' => 267,
            'name' => 'test-update'
        );

        $crawler = $this->client->request('PUT', 'api/attachment/206bd196d02ab33700f65ccf572fd01c',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Update_Fail()
    {

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = false;
        $mock = json_decode($mock);
        $this->attachmentRepository->expects($this->any())->method('saveAttachment')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'id' => '206bd196d02ab33700f65ccf572fd01c2',
            'album_id' => 267,
            'name' => 'test-update'
        );

        $crawler = $this->client->request('PUT', 'api/attachment/206bd196d02ab33700f65ccf572fd012',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function test_Update_Fail_Parameter()
    {
        $param = array(
            'id' => '206bd196d02ab33700f65ccf572fd01c',
        );

        $crawler = $this->client->request('PUT', 'api/attachment/206bd196d02ab33700f65ccf572fd01',$param);
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

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = '{"result":true,"attachment":true}';
        $mock = json_decode($mock,true);
        $this->attachmentRepository->expects($this->once())->method('deleteAttachment')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'id' => '0b0b4c200058c325883f5caae81b6b72',
        );

        $crawler = $this->client->request('DELETE', 'api/attachment/0b0b4c200058c325883f5caae81b6b72',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Delete_Fail()
    {

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = '{"result": false,"code" : 1004}';
        $mock = json_decode($mock,true);
        $this->attachmentRepository->expects($this->once())->method('deleteAttachment')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'id' => '206bd196d02ab33700f65ccf572fd01c2',
            'album_id' => 267,
            'name' => 'test-update'
        );

        $crawler = $this->client->request('DELETE', 'api/attachment/206bd196d02ab33700f65ccf572fd012',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function test_Delete_Fail_InUse()
    {

        $this->attachmentRepository = $this->getMock('AttachmentRepository');
        $this->app->instance('AttachmentRepository', $this->attachmentRepository);

        $mock = '{"result": false,"code" : 1007}';
        $mock = json_decode($mock,true);
        $this->attachmentRepository->expects($this->once())->method('deleteAttachment')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'id' => '75b7485e48bb510668317dde6bc60aa6',
        );

        $crawler = $this->client->request('DELETE', 'api/attachment/75b7485e48bb510668317dde6bc60aa6',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1007', $json);
        $this->assertContains('"status_txt":"Delete data error"', $json);
    }

    public function test_Delete_Fail_Parameter()
    {
        $param = array(
            'id' => '75b7485e48bb510668317dde6bc60aa6',
        );

        $crawler = $this->client->request('DELETE', 'api/attachment/75b7485e48bb510668317dde6bc60aa6',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

}
