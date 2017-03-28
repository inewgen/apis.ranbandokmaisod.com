<?php

class ApiTranslateControllerTest extends ApiTestCase
{
    // Get Index
    public function testGetIndexSuccess()
    {
        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '["th"]';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('getSettingLangSystem')->will($this->returnValue($mock));

        $mock = '1212';
        $this->TranslateRepository->expects($this->once())->method('getCount')->will($this->returnValue($mock));

        $mock = array(
            0 => array(
                'id' => '5165',
                'key' => 'Cannot Create Category',
                'languages' => array(
                    'title' => array(
                        'translate_id' => '5162',
                        'language_id' => '1',
                        'title' => 'กกก',
                        'created_at' => '0000-00-00 00:00:00',
                        'updated_at' => '2014-10-22 14:35:30'
                    )
                ),
                'location' => '/dev-store/admin/product/create',
                'section' => 'stores',
                'created_at' => '2014-10-22 22:55:34',
                'updated_at' => '2014-10-22 22:55:34'
            )
        );

        $mock = json_encode($mock, JSON_FORCE_OBJECT);
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('getTranslate')->will($this->returnValue($mock));

        $mock = '["th"]';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('getLangList')->will($this->returnValue($mock));

        $mock = '"Asia\/Bangkok"';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->any())->method('getConfigTimezone')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/translate');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndex_DataNotFound()
    {
        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '["th"]';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('getSettingLangSystem')->will($this->returnValue($mock));

        $mock = '';
        $this->TranslateRepository->expects($this->once())->method('getCount')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('getTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/translate');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    // Post Store
    public function testPostStoreSuccess()
    {
        $params = array(
            'key' => 'Test',
            'section' => 'stores',
            'location' => '/dev-store/admin/translate'
        );

        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '[]';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('checkTranslate')->will($this->returnValue($mock));

        $mock = '{"key":"Test","section":"stores","location":"\/dev-store\/admin\/translate","updated_at":"2014-10-23 13:00:01","created_at":"2014-10-23 13:00:01","id":5168}';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('insertTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('POST', 'api/translate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testPostStore_NoKey()
    {
        $params = array(
            'section' => 'stores',
            'location' => '/dev-store/admin/translate'
        );

        $crawler = $this->client->request('POST', 'api/translate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The key field is required."', $json);
    }

    public function testPostStore_Error()
    {
        $params = array(
            'key' => 'Test',
            'section' => 'stores',
            'location' => '/dev-store/admin/translate'
        );

        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '[]';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('checkTranslate')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('insertTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('POST', 'api/translate', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);
        $this->assertContains('"status_txt":"Connection error"', $json);
    }

    // Get Show
    public function testGetShowSuccess()
    {
        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '["th"]';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('getSettingLangSystem')->will($this->returnValue($mock));

        $mock = array(
            0 => array(
                'id' => '5165',
                'key' => 'Cannot Create Category',
                'languages' => array(
                    'title' => array(
                        'translate_id' => '5162',
                        'language_id' => '1',
                        'title' => 'กกก',
                        'created_at' => '0000-00-00 00:00:00',
                        'updated_at' => '2014-10-22 14:35:30'
                    )
                ),
                'location' => '/dev-store/admin/product/create',
                'section' => 'stores',
                'created_at' => '2014-10-22 22:55:34',
                'updated_at' => '2014-10-22 22:55:34'
            )
        );

        $mock = json_encode($mock, JSON_FORCE_OBJECT);
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('findTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/translate/5169');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetShow_InvalidParameters()
    {
        $crawler = $this->client->request('GET', 'api/translate/0');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The id must be at least 1."', $json);
    }

    public function testGetShow_DataNotFound()
    {
        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('findTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/translate/5169');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    // Put Update
    public function testPutUpdateSuccess()
    {
        $params = array(
            'title' => array(
                'th' => 'Test update'
            )
        );

        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '{"id":5169,"key":"Test","location":"\/dev-store\/admin\/translate","section":"stores","created_at":"2014-10-23 13:15:00","updated_at":"2014-10-23 13:15:00","languages":[{"translate_id":5169,"language_id":1,"title":"Test update","created_at":"-0001-11-30 00:00:00","updated_at":"2014-10-23 14:41:45"}]}';
        $mock = json_decode($mock, true);
        $this->TranslateRepository->expects($this->once())->method('checkDupTranslate')->will($this->returnValue($mock));

        $mock = '["th"]';
        $mock = json_decode($mock, true);
        $this->TranslateRepository->expects($this->once())->method('getSystemLangSystem')->will($this->returnValue($mock));

        $mock = '1';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('updateTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/translate/5169', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testPutUpdate_NoTitle()
    {
        $params = array();

        $crawler = $this->client->request('PUT', 'api/translate/5169', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The title field is required."', $json);
    }

    public function testPutUpdate_Error()
    {
        $params = array(
            'title' => array(
                'th' => 'Test update'
            )
        );

        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->TranslateRepository->expects($this->once())->method('checkDupTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/translate/5169', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function testPutUpdate_CreateTranslate()
    {
        $params = array(
            'title' => array(
                'th' => 'Test update'
            )
        );

        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '["th"]';
        $mock = json_decode($mock, true);
        $this->TranslateRepository->expects($this->once())->method('getSystemLangSystem')->will($this->returnValue($mock));

        $mock = '{"id":5169,"key":"Test","location":"\/dev-store\/admin\/translate","section":"stores","created_at":"2014-10-23 13:15:00","updated_at":"2014-10-23 13:15:00","languages":[]}';
        $mock = json_decode($mock, true);
        $this->TranslateRepository->expects($this->once())->method('checkDupTranslate')->will($this->returnValue($mock));

        $mock = '{"key":"Test update","section":"stores","location":"\/dev-store\/admin\/translate","updated_at":"2014-10-23 13:00:01","created_at":"2014-10-23 13:00:01","id":5168}';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('createTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/translate/5169', $params);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    // Destroy
    public function testDestroySuccess()
    {
        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '{"id":5169,"key":"Test","location":"\/dev-store\/admin\/translate","section":"stores","created_at":"2014-10-23 13:15:00","updated_at":"2014-10-23 13:15:00"}';
        $mock = json_decode($mock, true);
        $this->TranslateRepository->expects($this->once())->method('checkHasTranslate')->will($this->returnValue($mock));

        $mock = '{"id":5169,"key":"Test","location":"\/dev-store\/admin\/translate","section":"stores","created_at":"2014-10-23 13:15:00","updated_at":"2014-10-23 13:15:00"}';
        $mock = json_decode($mock);
        $this->TranslateRepository->expects($this->once())->method('deleteTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('DELETE', 'api/translate/5169');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testDestroy_NoID()
    {
        $crawler = $this->client->request('DELETE', 'api/translate/0');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The id must be at least 1."', $json);
    }

    public function testDestroy_Error()
    {
        $this->TranslateRepository = $this->getMock('TranslateRepository');
        $this->app->instance('TranslateRepository', $this->TranslateRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->TranslateRepository->expects($this->once())->method('checkHasTranslate')->will($this->returnValue($mock));

        $crawler = $this->client->request('DELETE', 'api/translate/5169');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

}
