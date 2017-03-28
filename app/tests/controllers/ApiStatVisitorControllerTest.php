<?php

class ApiStatVisitorControllerTest extends ApiTestCase
{
    public function test_indexSuccess()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue(0));

        $response = array(
            array(
                'store_id' => 1,
                'value' => 3,
            ),
        );
        $response = json_encode($response);

        $this->statVisitorRepository = $this->getMock('StatRepository');
        $this->app->instance('StatRepository', $this->statVisitorRepository);
        $this->statVisitorRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/stat/visitor?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"total_visitor":3', $json);
    }

    public function test_indexSuccessWithCache()
    {
        $response = array(
            'status_code' => 0,
            'status_txt' => 'Success',
            'data' => array(
                'total_visitor' => 3,
            ),
        );
        $response = json_encode($response);

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())
            ->method('get')
            ->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/stat/visitor?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"total_visitor":3', $json);
    }

    public function test_indexFailNoStoreId()
    {
        $crawler = $this->client->request('GET', 'api/stat/visitor');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_storeSuccessNewVisitor()
    {
        /// mock cache repos ///
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())
            ->method('clear')
            ->will($this->returnValue(0));

        /// mock stat visitor repos ///
        $this->statVisitorRepository = $this->getMock('StatVisitorRepository');
        $this->app->instance('StatVisitorRepository', $this->statVisitorRepository);
        $this->statVisitorRepository->expects($this->once())
            ->method('exist')
            ->will($this->returnValue(false));
        $this->statVisitorRepository->expects($this->once())
            ->method('createVisitor')
            ->will($this->returnValue(true));

        /// mock stat repos ///
        $this->statRepository = $this->getMock('StatRepository');
        $this->app->instance('StatRepository', $this->statRepository);
        $this->statRepository->expects($this->once())
            ->method('exist')
            ->will($this->returnValue(false));
        $this->statRepository->expects($this->once())
            ->method('createStat')
            ->will($this->returnValue(true));

        $parameters = array(
            'store_id' => 1,
            'visitor_id' => '1234',
        );

        $crawler = $this->client->request('POST', 'api/stat/visitor', $parameters);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"message":"updated"', $json);
    }

    public function test_storeSuccessExistingVisitor()
    {
        /// mock cache repos ///
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())
            ->method('clear')
            ->will($this->returnValue(0));

        /// mock stat visitor repos ///
        $this->statVisitorRepository = $this->getMock('StatVisitorRepository');
        $this->app->instance('StatVisitorRepository', $this->statVisitorRepository);
        $this->statVisitorRepository->expects($this->once())
            ->method('exist')
            ->will($this->returnValue(false));
        $this->statVisitorRepository->expects($this->once())
            ->method('createVisitor')
            ->will($this->returnValue(true));

        /// mock stat repos ///
        $this->statRepository = $this->getMock('StatRepository');
        $this->app->instance('StatRepository', $this->statRepository);
        $this->statRepository->expects($this->once())
            ->method('exist')
            ->will($this->returnValue(true));
        $this->statRepository->expects($this->once())
            ->method('incrementStat')
            ->will($this->returnValue(true));

        $parameters = array(
            'store_id' => 1,
            'visitor_id' => '1234',
        );

        $crawler = $this->client->request('POST', 'api/stat/visitor', $parameters);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"message":"updated"', $json);
    }

    public function test_storeFailNoStoreId()
    {
        $crawler = $this->client->request('POST', 'api/stat/visitor');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }
}
