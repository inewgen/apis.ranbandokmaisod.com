<?php

class ApiStoreTutorialControllerTest extends ApiTestCase
{
    // Get Index
    public function testGetIndexSuccess()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '[{"id":194,"store_id":2,"service":"knowledge","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":195,"store_id":2,"service":"setting","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 16:46:42"},{"id":196,"store_id":2,"service":"category","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":197,"store_id":2,"service":"open","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 14:56:48"},{"id":221,"store_id":2,"service":"store","status":1,"created_at":"2014-09-15 16:36:25","updated_at":"2014-09-15 17:02:31"},{"id":222,"store_id":2,"service":"payment","status":1,"created_at":"2014-09-15 16:36:53","updated_at":"2014-09-15 16:36:53"},{"id":223,"store_id":2,"service":"product","status":1,"created_at":"2014-09-15 16:37:00","updated_at":"2014-09-15 16:37:00"},{"id":224,"store_id":2,"service":"shipping","status":1,"created_at":"2014-09-15 16:37:05","updated_at":"2014-09-15 16:37:05"}]';
        $mock = json_decode($mock);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorial')->will($this->returnValue($mock));

        $mock = '{"knowledge":{"name":"Knowledge","path_script":"tutorial","prev_step":"","next_step_name":"Shop Information","next_step":"store","desc":"Knowledge description tooltips","icon":"icon-file-alt white icon-2x","img":"sign-tutorial.png"},"setting":{"name":"Shop Information","path_script":"store","prev_step":"knowledge","next_step_name":"Add product","next_step":"product\/create","desc":"Shop Information description tooltips","icon":"icon-list-alt white icon-2x","img":"sign-shopinfo.png"},"category":{"name":"Category","path_script":"category\/create","prev_step":"setting","next_step_name":"Add product","next_step":"product\/create","desc":"Category description tooltips","icon":"icon-sitemap white icon-2x","img":"sign-category.png"},"open":{"name":"Open shop","path_script":"setting","prev_step":"shipping","next_step_name":"","next_step":"","desc":"Open shop description tooltips","icon":"icon-home white icon-2x","img":"sign-openshop.png"},"store":{"name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"payment":{"name":"Register truemoney account","path_script":"admin\/payment","prev_step":"store","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"product":{"name":"Manage product","path_script":"admin\/product\/create","prev_step":"payment","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"shipping":{"name":"Shipping setting","path_script":"admin\/shipping","prev_step":"product","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""}}';
        $mock = json_decode($mock, true);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorialConfig')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/tutorial?store_id=2');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndexWithMultiIDSuccess()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '[{"id":194,"store_id":2,"service":"knowledge","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":195,"store_id":2,"service":"setting","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 16:46:42"},{"id":196,"store_id":2,"service":"category","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":197,"store_id":2,"service":"open","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 14:56:48"},{"id":221,"store_id":2,"service":"store","status":1,"created_at":"2014-09-15 16:36:25","updated_at":"2014-09-15 17:02:31"},{"id":222,"store_id":2,"service":"payment","status":1,"created_at":"2014-09-15 16:36:53","updated_at":"2014-09-15 16:36:53"},{"id":223,"store_id":2,"service":"product","status":1,"created_at":"2014-09-15 16:37:00","updated_at":"2014-09-15 16:37:00"},{"id":224,"store_id":2,"service":"shipping","status":1,"created_at":"2014-09-15 16:37:05","updated_at":"2014-09-15 16:37:05"}]';
        $mock = json_decode($mock);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorial')->will($this->returnValue($mock));

        $mock = '{"knowledge":{"name":"Knowledge","path_script":"tutorial","prev_step":"","next_step_name":"Shop Information","next_step":"store","desc":"Knowledge description tooltips","icon":"icon-file-alt white icon-2x","img":"sign-tutorial.png"},"setting":{"name":"Shop Information","path_script":"store","prev_step":"knowledge","next_step_name":"Add product","next_step":"product\/create","desc":"Shop Information description tooltips","icon":"icon-list-alt white icon-2x","img":"sign-shopinfo.png"},"category":{"name":"Category","path_script":"category\/create","prev_step":"setting","next_step_name":"Add product","next_step":"product\/create","desc":"Category description tooltips","icon":"icon-sitemap white icon-2x","img":"sign-category.png"},"open":{"name":"Open shop","path_script":"setting","prev_step":"shipping","next_step_name":"","next_step":"","desc":"Open shop description tooltips","icon":"icon-home white icon-2x","img":"sign-openshop.png"},"store":{"name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"payment":{"name":"Register truemoney account","path_script":"admin\/payment","prev_step":"store","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"product":{"name":"Manage product","path_script":"admin\/product\/create","prev_step":"payment","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"shipping":{"name":"Shipping setting","path_script":"admin\/shipping","prev_step":"product","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""}}';
        $mock = json_decode($mock, true);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorialConfig')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/tutorial?multi_store_id=1,2&status=0');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndexWithMultiIDAndActiveStatusSuccess()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '[{"id":194,"store_id":2,"service":"knowledge","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":195,"store_id":2,"service":"setting","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 16:46:42"},{"id":196,"store_id":2,"service":"category","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":197,"store_id":2,"service":"open","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 14:56:48"},{"id":221,"store_id":2,"service":"storexxx","status":1,"created_at":"2014-09-15 16:36:25","updated_at":"2014-09-15 17:02:31"},{"id":222,"store_id":2,"service":"payment","status":1,"created_at":"2014-09-15 16:36:53","updated_at":"2014-09-15 16:36:53"},{"id":223,"store_id":2,"service":"product","status":1,"created_at":"2014-09-15 16:37:00","updated_at":"2014-09-15 16:37:00"},{"id":224,"store_id":2,"service":"shipping","status":1,"created_at":"2014-09-15 16:37:05","updated_at":"2014-09-15 16:37:05"}]';
        $mock = json_decode($mock);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorial')->will($this->returnValue($mock));

        $mock = '{"knowledge":{"name":"Knowledge","path_script":"tutorial","prev_step":"","next_step_name":"Shop Information","next_step":"store","desc":"Knowledge description tooltips","icon":"icon-file-alt white icon-2x","img":"sign-tutorial.png"},"setting":{"name":"Shop Information","path_script":"store","prev_step":"knowledge","next_step_name":"Add product","next_step":"product\/create","desc":"Shop Information description tooltips","icon":"icon-list-alt white icon-2x","img":"sign-shopinfo.png"},"category":{"name":"Category","path_script":"category\/create","prev_step":"setting","next_step_name":"Add product","next_step":"product\/create","desc":"Category description tooltips","icon":"icon-sitemap white icon-2x","img":"sign-category.png"},"open":{"name":"Open shop","path_script":"setting","prev_step":"shipping","next_step_name":"","next_step":"","desc":"Open shop description tooltips","icon":"icon-home white icon-2x","img":"sign-openshop.png"},"store":{"name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"payment":{"name":"Register truemoney account","path_script":"admin\/payment","prev_step":"store","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"product":{"name":"Manage product","path_script":"admin\/product\/create","prev_step":"payment","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"shipping":{"name":"Shipping setting","path_script":"admin\/shipping","prev_step":"product","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""}}';
        $mock = json_decode($mock, true);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorialConfig')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/tutorial?multi_store_id=1,2&status=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndexWithMultiIDAndNoneActiveStatusSuccess()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '[{"id":194,"store_id":2,"service":"knowledge","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":195,"store_id":2,"service":"setting","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 16:46:42"},{"id":196,"store_id":2,"service":"category","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":197,"store_id":2,"service":"open","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 14:56:48"},{"id":221,"store_id":2,"service":"storexxx","status":1,"created_at":"2014-09-15 16:36:25","updated_at":"2014-09-15 17:02:31"},{"id":222,"store_id":2,"service":"payment","status":1,"created_at":"2014-09-15 16:36:53","updated_at":"2014-09-15 16:36:53"},{"id":223,"store_id":2,"service":"product","status":1,"created_at":"2014-09-15 16:37:00","updated_at":"2014-09-15 16:37:00"},{"id":224,"store_id":2,"service":"shipping","status":1,"created_at":"2014-09-15 16:37:05","updated_at":"2014-09-15 16:37:05"}]';
        $mock = json_decode($mock);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorial')->will($this->returnValue($mock));

        $mock = '{"knowledge":{"name":"Knowledge","path_script":"tutorial","prev_step":"","next_step_name":"Shop Information","next_step":"store","desc":"Knowledge description tooltips","icon":"icon-file-alt white icon-2x","img":"sign-tutorial.png"},"setting":{"name":"Shop Information","path_script":"store","prev_step":"knowledge","next_step_name":"Add product","next_step":"product\/create","desc":"Shop Information description tooltips","icon":"icon-list-alt white icon-2x","img":"sign-shopinfo.png"},"category":{"name":"Category","path_script":"category\/create","prev_step":"setting","next_step_name":"Add product","next_step":"product\/create","desc":"Category description tooltips","icon":"icon-sitemap white icon-2x","img":"sign-category.png"},"open":{"name":"Open shop","path_script":"setting","prev_step":"shipping","next_step_name":"","next_step":"","desc":"Open shop description tooltips","icon":"icon-home white icon-2x","img":"sign-openshop.png"},"store":{"name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"payment":{"name":"Register truemoney account","path_script":"admin\/payment","prev_step":"store","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"product":{"name":"Manage product","path_script":"admin\/product\/create","prev_step":"payment","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"shipping":{"name":"Shipping setting","path_script":"admin\/shipping","prev_step":"product","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""}}';
        $mock = json_decode($mock, true);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorialConfig')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/tutorial?multi_store_id=1,2&status=0');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndexWithStatusAndServiceSuccess()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '[{"id":194,"store_id":2,"service":"knowledge","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":195,"store_id":2,"service":"setting","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 16:46:42"},{"id":196,"store_id":2,"service":"category","status":0,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 08:44:14"},{"id":197,"store_id":2,"service":"open","status":1,"created_at":"2014-09-15 08:44:14","updated_at":"2014-09-15 14:56:48"},{"id":221,"store_id":2,"service":"store","status":1,"created_at":"2014-09-15 16:36:25","updated_at":"2014-09-15 17:02:31"},{"id":222,"store_id":2,"service":"payment","status":1,"created_at":"2014-09-15 16:36:53","updated_at":"2014-09-15 16:36:53"},{"id":223,"store_id":2,"service":"product","status":1,"created_at":"2014-09-15 16:37:00","updated_at":"2014-09-15 16:37:00"},{"id":224,"store_id":2,"service":"shipping","status":1,"created_at":"2014-09-15 16:37:05","updated_at":"2014-09-15 16:37:05"}]';
        $mock = json_decode($mock);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorial')->will($this->returnValue($mock));

        $mock = '{"knowledge":{"name":"Knowledge","path_script":"tutorial","prev_step":"","next_step_name":"Shop Information","next_step":"store","desc":"Knowledge description tooltips","icon":"icon-file-alt white icon-2x","img":"sign-tutorial.png"},"setting":{"name":"Shop Information","path_script":"store","prev_step":"knowledge","next_step_name":"Add product","next_step":"product\/create","desc":"Shop Information description tooltips","icon":"icon-list-alt white icon-2x","img":"sign-shopinfo.png"},"category":{"name":"Category","path_script":"category\/create","prev_step":"setting","next_step_name":"Add product","next_step":"product\/create","desc":"Category description tooltips","icon":"icon-sitemap white icon-2x","img":"sign-category.png"},"open":{"name":"Open shop","path_script":"setting","prev_step":"shipping","next_step_name":"","next_step":"","desc":"Open shop description tooltips","icon":"icon-home white icon-2x","img":"sign-openshop.png"},"store":{"name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"payment":{"name":"Register truemoney account","path_script":"admin\/payment","prev_step":"store","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"product":{"name":"Manage product","path_script":"admin\/product\/create","prev_step":"payment","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"shipping":{"name":"Shipping setting","path_script":"admin\/shipping","prev_step":"product","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""}}';
        $mock = json_decode($mock, true);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorialConfig')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/tutorial?store_id=2&status=0&service=store');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndexNoStoreID()
    {
        $crawler = $this->client->request('GET', 'api/store/tutorial');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function testGetIndexNoData()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->at(0))->method('getTutorial')->will($this->returnValue($mock));

        $mock = '{"knowledge":{"name":"Knowledge","path_script":"tutorial","prev_step":"","next_step_name":"Shop Information","next_step":"store","desc":"Knowledge description tooltips","icon":"icon-file-alt white icon-2x","img":"sign-tutorial.png"},"setting":{"name":"Shop Information","path_script":"store","prev_step":"knowledge","next_step_name":"Add product","next_step":"product\/create","desc":"Shop Information description tooltips","icon":"icon-list-alt white icon-2x","img":"sign-shopinfo.png"},"category":{"name":"Category","path_script":"category\/create","prev_step":"setting","next_step_name":"Add product","next_step":"product\/create","desc":"Category description tooltips","icon":"icon-sitemap white icon-2x","img":"sign-category.png"},"open":{"name":"Open shop","path_script":"setting","prev_step":"shipping","next_step_name":"","next_step":"","desc":"Open shop description tooltips","icon":"icon-home white icon-2x","img":"sign-openshop.png"},"store":{"name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"payment":{"name":"Register truemoney account","path_script":"admin\/payment","prev_step":"store","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"product":{"name":"Manage product","path_script":"admin\/product\/create","prev_step":"payment","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"shipping":{"name":"Shipping setting","path_script":"admin\/shipping","prev_step":"product","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""}}';
        $mock = json_decode($mock, true);
        $this->storeTutorialRepository->expects($this->once())->method('getTutorialConfig')->will($this->returnValue($mock));

        $mock = '1';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->any())->method('createTutorial')->will($this->returnValue($mock));

        $mock = '{"status_code":0,"status_txt":"Success","data":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":4},"record":[{"id":181,"store_id":2,"service":{"id":"store","name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"status":0,"created_at":{"date":"2014-09-15 05:27:34.000000","timezone_type":3,"timezone":"UTC"},"updated_at":{"date":"2014-09-15 05:27:34.000000","timezone_type":3,"timezone":"UTC"}},{"id":182,"store_id":2,"service":{"id":"payment","name":"Register truemoney account","path_script":"admin\/payment","prev_step":"\/admin\/dashboard","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"status":0,"created_at":{"date":"2014-09-15 05:27:34.000000","timezone_type":3,"timezone":"UTC"},"updated_at":{"date":"2014-09-15 05:27:34.000000","timezone_type":3,"timezone":"UTC"}},{"id":183,"store_id":2,"service":{"id":"product","name":"Manage product","path_script":"admin\/product\/create","prev_step":"\/admin\/dashboard","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"status":0,"created_at":{"date":"2014-09-15 05:27:34.000000","timezone_type":3,"timezone":"UTC"},"updated_at":{"date":"2014-09-15 05:27:34.000000","timezone_type":3,"timezone":"UTC"}},{"id":184,"store_id":2,"service":{"id":"shipping","name":"Shipping setting","path_script":"admin\/shipping","prev_step":"\/admin\/dashboard","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""},"status":0,"created_at":{"date":"2014-09-15 05:27:34.000000","timezone_type":3,"timezone":"UTC"},"updated_at":{"date":"2014-09-15 05:27:34.000000","timezone_type":3,"timezone":"UTC"}}]}}';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->at(1))->method('getTutorial')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/tutorial?store_id=2');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    // Post Update
    public function testUpdateTutorialSuccess()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '1';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->any())->method('updateTutorial')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '2',
            'service' => 'store',
            'status' => '1'
        );
        $crawler = $this->client->request('PUT', 'api/store/tutorial', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testUpdateTutorialNoStoreID()
    {
        $param = array(
            'service' => 'store',
            'status' => '1'
        );
        $crawler = $this->client->request('PUT', 'api/store/tutorial', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        // $this->assertContains('"message":"The store id field is required."', $json);
    }

    public function testUpdateTutorialNoData()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '0';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->any())->method('updateTutorial')->will($this->returnValue($mock));

        $mock = '{"store":{"name":"Knowledge","path_script":"tutorial","prev_step":"","next_step_name":"Shop Information","next_step":"store","desc":"Knowledge description tooltips","icon":"icon-file-alt white icon-2x","img":"sign-tutorial.png"},"setting":{"name":"Shop Information","path_script":"store","prev_step":"knowledge","next_step_name":"Add product","next_step":"product\/create","desc":"Shop Information description tooltips","icon":"icon-list-alt white icon-2x","img":"sign-shopinfo.png"},"category":{"name":"Category","path_script":"category\/create","prev_step":"setting","next_step_name":"Add product","next_step":"product\/create","desc":"Category description tooltips","icon":"icon-sitemap white icon-2x","img":"sign-category.png"},"open":{"name":"Open shop","path_script":"setting","prev_step":"shipping","next_step_name":"","next_step":"","desc":"Open shop description tooltips","icon":"icon-home white icon-2x","img":"sign-openshop.png"},"store":{"name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"payment":{"name":"Register truemoney account","path_script":"admin\/payment","prev_step":"store","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"product":{"name":"Manage product","path_script":"admin\/product\/create","prev_step":"payment","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"shipping":{"name":"Shipping setting","path_script":"admin\/shipping","prev_step":"product","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""}}';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->any())->method('getTutorialConfig')->will($this->returnValue($mock));

        $mock = '1';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->any())->method('createTutorial')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '2',
            'service' => 'store',
            'status' => '1'
        );
        $crawler = $this->client->request('PUT', 'api/store/tutorial', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testUpdateTutorialErrorCreate()
    {
        $this->storeTutorialRepository = $this->getMock('StoreTutorialRepository');
        $this->app->instance('StoreTutorialRepository', $this->storeTutorialRepository);

        $mock = '0';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->any())->method('updateTutorial')->will($this->returnValue($mock));

        $mock = '{"store":{"name":"Knowledge","path_script":"tutorial","prev_step":"","next_step_name":"Shop Information","next_step":"store","desc":"Knowledge description tooltips","icon":"icon-file-alt white icon-2x","img":"sign-tutorial.png"},"setting":{"name":"Shop Information","path_script":"store","prev_step":"knowledge","next_step_name":"Add product","next_step":"product\/create","desc":"Shop Information description tooltips","icon":"icon-list-alt white icon-2x","img":"sign-shopinfo.png"},"category":{"name":"Category","path_script":"category\/create","prev_step":"setting","next_step_name":"Add product","next_step":"product\/create","desc":"Category description tooltips","icon":"icon-sitemap white icon-2x","img":"sign-category.png"},"open":{"name":"Open shop","path_script":"setting","prev_step":"shipping","next_step_name":"","next_step":"","desc":"Open shop description tooltips","icon":"icon-home white icon-2x","img":"sign-openshop.png"},"store":{"name":"Manage shop information","path_script":"admin\/store","prev_step":"","next_step_name":"Register truemoney account","next_step":"admin\/payment","desc":"Manage shop information description tooltips","class":"step1","icon":""},"payment":{"name":"Register truemoney account","path_script":"admin\/payment","prev_step":"store","next_step_name":"Manage product","next_step":"admin\/product\/create","desc":"Register truemoney account description tooltips","class":"step2","icon":""},"product":{"name":"Manage product","path_script":"admin\/product\/create","prev_step":"payment","next_step_name":"Shipping setting","next_step":"shipping","desc":"Manage product description tooltips","class":"step3","icon":""},"shipping":{"name":"Shipping setting","path_script":"admin\/shipping","prev_step":"product","next_step_name":"","next_step":"","desc":"Shipping setting description tooltips","class":"step4","icon":""}}';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->any())->method('getTutorialConfig')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock,true);
        $this->storeTutorialRepository->expects($this->any())->method('createTutorial')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '2',
            'service' => 'store',
            'status' => '1'
        );
        $crawler = $this->client->request('PUT', 'api/store/tutorial', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);
        $this->assertContains('"status_txt":"Connection error"', $json);
    }

}
