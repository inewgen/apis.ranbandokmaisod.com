<?php

class ApiCreditApprovedControllerTest extends ApiTestCase
{
    public function testStoreSuccess()
    {

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->tmnRepository = $this->getMock('TmnRepositoryInterface');
        $this->app->instance('TmnRepositoryInterface', $this->tmnRepository);

        $this->creditapprovedRepository = $this->getMock('CreditApprovedRepository');
        $this->app->instance('CreditApprovedRepository', $this->creditapprovedRepository);

        $data = json_decode('[{"id":111,"user_id":988,"first_name":"takkyoo3","last_name":"test","idcard":"1212121212121","slug":"takkyoo3","phone":"023111111","mobile":"0811111111","fax":"011111111","email":"takkynoo@mailinator.com","social":"{\"facebook\":\"https:\\\/\\\/www.facebook.com\\\/cheekacasestore2\"}","map_status":1,"lat":"13.792588506115877","long":"100.59829782568363","zone_id":209,"country_id":209,"category_id":10,"business_type":1,"status":0,"initial":0,"published_at":"0000-00-00 00:00:00","created_at":"2014-10-15 10:36:02","updated_at":"2014-11-20 17:14:09","deleted_at":"0000-00-00 00:00:00","doc_register_status":2,"doc_register_at":"2014-11-10 15:47:55","doc_register_verify_at":"2014-11-10 15:51:06","doc_cc_status":2,"doc_cc_at":"2014-11-06 14:12:45","doc_cc_verify_at":"2014-11-06 14:49:19","credit_status":2,"sync_at":"2014-11-20 11:48:17","sales_id":45,"true_id":19957896,"sync_status":null,"essential_status":0}]');
        $this->creditapprovedRepository->expects($this->once())->method('getStoreComplete')->will($this->returnValue($data));

        $data  = '{"request_id":"546dc5cba873d","result":{"response_code":"127","developer_message":"SHOP_CODE_ALREADY_ACTIVATION_CREDITCARD","user_message":"SHOP_CODE_ALREADY_ACTIVATION_CREDITCARD"},"result_id":"4048621"}';
        $data = json_decode($data, true);
        $this->tmnRepository->expects($this->once())->method('activateCreditCard')->will($this->returnValue($data));

        $this->creditapprovedRepository->expects($this->once())->method('updateCreditStatus')->will($this->returnValue(true));

        $this->creditapprovedRepository->expects($this->once())->method('setPaymentActiveCreditStatus')->will($this->returnValue(true));

        $this->cacheRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $crawler = $this->client->request('POST', 'api/creditcard/approved', array('store_id'=>111,'user_id'=>988));
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testStoreNotSuccess()
    {

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->tmnRepository = $this->getMock('TmnRepositoryInterface');
        $this->app->instance('TmnRepositoryInterface', $this->tmnRepository);

        $this->creditapprovedRepository = $this->getMock('CreditApprovedRepository');
        $this->app->instance('CreditApprovedRepository', $this->creditapprovedRepository);

        $data = json_decode('[{"id":111,"user_id":988,"first_name":"takkyoo3","last_name":"test","idcard":"1212121212121","slug":"takkyoo3","phone":"023111111","mobile":"0811111111","fax":"011111111","email":"takkynoo@mailinator.com","social":"{\"facebook\":\"https:\\\/\\\/www.facebook.com\\\/cheekacasestore2\"}","map_status":1,"lat":"13.792588506115877","long":"100.59829782568363","zone_id":209,"country_id":209,"category_id":10,"business_type":1,"status":0,"initial":0,"published_at":"0000-00-00 00:00:00","created_at":"2014-10-15 10:36:02","updated_at":"2014-11-20 17:14:09","deleted_at":"0000-00-00 00:00:00","doc_register_status":2,"doc_register_at":"2014-11-10 15:47:55","doc_register_verify_at":"2014-11-10 15:51:06","doc_cc_status":2,"doc_cc_at":"2014-11-06 14:12:45","doc_cc_verify_at":"2014-11-06 14:49:19","credit_status":2,"sync_at":"2014-11-20 11:48:17","sales_id":45,"true_id":19957896,"sync_status":null,"essential_status":0}]');
        $this->creditapprovedRepository->expects($this->once())->method('getStoreComplete')->will($this->returnValue($data));

        $data  = '{"request_id":"546dc5cba873d","result":{"response_code":"128","developer_message":"SHOP_CODE_AND_PARTNERID_NOT_REGISTERED","user_message":"SHOP_CODE_AND_PARTNERID_NOT_REGISTERED"},"result_id":"4048621"}';
        $data = json_decode($data, true);
        $this->tmnRepository->expects($this->once())->method('activateCreditCard')->will($this->returnValue($data));

        $crawler = $this->client->request('POST', 'api/creditcard/approved', array('store_id'=>111,'user_id'=>988));
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);

    }

    public function testStoreNotResponse()
    {

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->tmnRepository = $this->getMock('TmnRepositoryInterface');
        $this->app->instance('TmnRepositoryInterface', $this->tmnRepository);

        $this->creditapprovedRepository = $this->getMock('CreditApprovedRepository');
        $this->app->instance('CreditApprovedRepository', $this->creditapprovedRepository);

        $data = json_decode('[{"id":111,"user_id":988,"first_name":"takkyoo3","last_name":"test","idcard":"1212121212121","slug":"takkyoo3","phone":"023111111","mobile":"0811111111","fax":"011111111","email":"takkynoo@mailinator.com","social":"{\"facebook\":\"https:\\\/\\\/www.facebook.com\\\/cheekacasestore2\"}","map_status":1,"lat":"13.792588506115877","long":"100.59829782568363","zone_id":209,"country_id":209,"category_id":10,"business_type":1,"status":0,"initial":0,"published_at":"0000-00-00 00:00:00","created_at":"2014-10-15 10:36:02","updated_at":"2014-11-20 17:14:09","deleted_at":"0000-00-00 00:00:00","doc_register_status":2,"doc_register_at":"2014-11-10 15:47:55","doc_register_verify_at":"2014-11-10 15:51:06","doc_cc_status":2,"doc_cc_at":"2014-11-06 14:12:45","doc_cc_verify_at":"2014-11-06 14:49:19","credit_status":2,"sync_at":"2014-11-20 11:48:17","sales_id":45,"true_id":19957896,"sync_status":null,"essential_status":0}]');
        $this->creditapprovedRepository->expects($this->once())->method('getStoreComplete')->will($this->returnValue($data));

        $data = false;
        $this->tmnRepository->expects($this->once())->method('activateCreditCard')->will($this->returnValue($data));

        $crawler = $this->client->request('POST', 'api/creditcard/approved', array('store_id'=>111,'user_id'=>988));
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);

    }

    public function testStoreNotComplete()
    {

        $this->creditapprovedRepository = $this->getMock('CreditApprovedRepository');
        $this->app->instance('CreditApprovedRepository', $this->creditapprovedRepository);

        $data = null;
        $this->creditapprovedRepository->expects($this->once())->method('getStoreComplete')->will($this->returnValue($data));

        $crawler = $this->client->request('POST', 'api/creditcard/approved', array('store_id'=>111,'user_id'=>8));
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);

    }

    public function testStoreInvalidParameter()
    {
        $crawler = $this->client->request('POST', 'api/creditcard/approved');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);

    }

}
