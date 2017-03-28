<?php

class ApiStoreQuotaControllerTest extends ApiTestCase
{

    public function test_Get_Success()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","record":{"language":{"quota":"20","use":1,"percent":5},"pages":{"quota":"200","use":16,"percent":8},"collection":{"quota":"200","use":0,"percent":0},"product_sku":{"quota":"500","use":33,"percent":6.6},"promotion":{"quota":"200","use":16,"percent":8},"blogs":{"quota":"200","use":0,"percent":0},"storage":{"quota":5368709120,"use":"34068502","percent":0.63457529991865},"category":{"quota":"200","use":16,"percent":8}}},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->quotaRepository = $this->getMock('QuotaRepository');
        $this->app->instance('QuotaRepository', $this->quotaRepository);

        $mock = '{"language":"20","pages":"200","collection":"200","product_sku":"500","promotion":"200","blogs":"200","storage":5368709120,"category":"200"}';
        $mock = json_decode($mock);
        $this->quotaRepository->expects($this->any())->method('getQuota')->will($this->returnValue($mock));

        $mock = 16;
        //$mock = json_decode($mock,true);
        $this->quotaRepository->expects($this->any())->method('getPage')->will($this->returnValue($mock));

        $mock = 33;
        //$mock = json_decode($mock);
        $this->quotaRepository->expects($this->any())->method('getProductInventory')->will($this->returnValue($mock));

        $mock = 16;
        //$mock = json_decode($mock);
        $this->quotaRepository->expects($this->any())->method('getCategory')->will($this->returnValue($mock));

        $mock = 16;
        //$mock = json_decode($mock);
        $this->quotaRepository->expects($this->any())->method('getPromotion')->will($this->returnValue($mock));

        $mock = 0;
        //$mock = json_decode($mock);
        $this->quotaRepository->expects($this->any())->method('getBlog')->will($this->returnValue($mock));

        $mock = 0;
        //$mock = json_decode($mock);
        $this->quotaRepository->expects($this->any())->method('getCollection')->will($this->returnValue($mock));

        $mock = 34068502;
        //$mock = json_decode($mock);
        $this->quotaRepository->expects($this->any())->method('getAttachment')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/quota?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"record":{"language":{"quota"', $json);
    }

     public function test_Get_Success_Cache()
    {

        $mock = '{"response":{"benchmark":"false","record":{"language":{"quota":"20","use":1,"percent":5},"pages":{"quota":"200","use":16,"percent":8},"collection":{"quota":"200","use":0,"percent":0},"product_sku":{"quota":"500","use":33,"percent":6.6},"promotion":{"quota":"200","use":16,"percent":8},"blogs":{"quota":"200","use":0,"percent":0},"storage":{"quota":5368709120,"use":"34068502","percent":0.63457529991865},"category":{"quota":"200","use":16,"percent":8}}},"code":0}';
        $mock = json_decode($mock,true);

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/quota?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('"record":{"language":{"quota"', $json);
    }

    public function test_Get_Fail_Parameter()
    {

        $crawler = $this->client->request('GET', 'api/store/quota');
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

        $this->quotaRepository = $this->getMock('QuotaRepository');
        $this->app->instance('QuotaRepository', $this->quotaRepository);

        $mock = false;
        $this->quotaRepository->expects($this->any())->method('getQuota')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store/quota?store_id=999999999999');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
        $this->assertContains('"data":[]', $json);

    }
}
