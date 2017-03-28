<?php

class ApiReportStoreControllerTest extends ApiTestCase
{
    public function testGetSuccess()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->ReportStoreRepository = $this->getMock('ReportStoreRepository');
        $this->app->instance('ReportStoreRepository', $this->ReportStoreRepository);

        $response = '[{"created_at":"2015-02-27","total_register":1,"total_wait":0,"total_process":1,"total_approved":0,"total_reject":0,"shop_open":0,"shop_close":0,"storeinfo":0,"product":1,"shipping":1,"wallet":0,"opened":0},{"created_at":"2015-02-17","total_register":8,"total_wait":8,"total_process":0,"total_approved":0,"total_reject":0,"shop_open":0,"shop_close":0,"storeinfo":0,"product":0,"shipping":0,"wallet":0,"opened":0},{"created_at":"2015-02-16","total_register":2,"total_wait":1,"total_process":0,"total_approved":1,"total_reject":0,"shop_open":0,"shop_close":1,"storeinfo":1,"product":0,"shipping":0,"wallet":0,"opened":0},{"created_at":"2015-02-11","total_register":1,"total_wait":0,"total_process":0,"total_approved":1,"total_reject":0,"shop_open":1,"shop_close":0,"storeinfo":1,"product":1,"shipping":1,"wallet":1,"opened":1},{"created_at":"2015-02-03","total_register":1,"total_wait":0,"total_process":0,"total_approved":1,"total_reject":0,"shop_open":1,"shop_close":0,"storeinfo":1,"product":1,"shipping":1,"wallet":1,"opened":1}]';
        $response = json_decode($response);
        $this->ReportStoreRepository->expects($this->once())->method('getStoreStatusReport')->will($this->returnValue($response));

        $parameter['year'] = '2015';
        $parameter['month'] = '02';
        $crawler = $this->client->request('GET', 'api/report/store', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

     public function testGetNotFound()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->ReportStoreRepository = $this->getMock('ReportStoreRepository');
        $this->app->instance('ReportStoreRepository', $this->ReportStoreRepository);

        $this->ReportStoreRepository->expects($this->once())->method('getStoreStatusReport')->will($this->returnValue(false));

        $parameter['year'] = '2015';
        $parameter['month'] = '02';
        $crawler = $this->client->request('GET', 'api/report/store', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
    }

    public function testGetCacheSuccess()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $data = '
{"status_code":0,"status_txt":"Success","data":{"27":{"created_at":"2015-02-27","total_register":1,"total_wait":0,"total_process":1,"total_approved":0,"total_reject":0,"shop_open":0,"shop_close":0,"storeinfo":0,"product":1,"shipping":1,"wallet":0,"opened":0},"17":{"created_at":"2015-02-17","total_register":8,"total_wait":8,"total_process":0,"total_approved":0,"total_reject":0,"shop_open":0,"shop_close":0,"storeinfo":0,"product":0,"shipping":0,"wallet":0,"opened":0},"16":{"created_at":"2015-02-16","total_register":2,"total_wait":1,"total_process":0,"total_approved":1,"total_reject":0,"shop_open":0,"shop_close":1,"storeinfo":1,"product":0,"shipping":0,"wallet":0,"opened":0},"11":{"created_at":"2015-02-11","total_register":1,"total_wait":0,"total_process":0,"total_approved":1,"total_reject":0,"shop_open":1,"shop_close":0,"storeinfo":1,"product":1,"shipping":1,"wallet":1,"opened":1},"3":{"created_at":"2015-02-03","total_register":1,"total_wait":0,"total_process":0,"total_approved":1,"total_reject":0,"shop_open":1,"shop_close":0,"storeinfo":1,"product":1,"shipping":1,"wallet":1,"opened":1},"cached":"2015-03-05 15:48:37"}}';

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $parameter['year'] = '2015';
        $parameter['month'] = '02';
        $crawler = $this->client->request('GET', 'api/report/store', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetInvalidFormat()
    {
        $param = array('year'=>'xxx', 'month'=>'02' );
        $crawler = $this->client->request('GET', 'api/report/store',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }
}
