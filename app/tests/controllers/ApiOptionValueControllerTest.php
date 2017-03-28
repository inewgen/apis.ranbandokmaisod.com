<?php

class ApiOptionValueControllerTest extends ApiTestCase
{

     public function test_Show_Fail_Parameter()
    {
        $crawler = $this->client->request('GET', 'api/option/1/value',array());
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

        $mock = '{"response":{"record":[{"id":1,"store_id":1,"user_id":205,"position":0,"status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35","en":""},"option_value":[{"id":1,"position":1,"title":{"th":"\u0e02\u0e32\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"title":{"th":"\u0e04\u0e23\u0e35\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"title":{"th":"\u0e2a\u0e49\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"title":{"th":"\u0e0a\u0e21\u0e1e\u0e39","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"title":{"th":"\u0e41\u0e14\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"title":{"th":"\u0e14\u0e33","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"title":{"th":"\u0e40\u0e17\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"title":{"th":"\u0e17\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"title":{"th":"\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"title":{"th":"\u0e19\u0e39\u0e49\u0e14","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"title":{"th":"\u0e40\u0e1a\u0e08","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"title":{"th":"\u0e1f\u0e49\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"title":{"th":"\u0e21\u0e48\u0e27\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}}]}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));


        $this->optionValueRepository = $this->getMock('OptionValueRepository');
        $this->app->instance('OptionValueRepository', $this->optionValueRepository);

        $mock = '[{"id":1,"store_id":1,"user_id":205,"position":0,"status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35","en":""},"option_value":[{"id":1,"position":1,"title":{"th":"\u0e02\u0e32\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"title":{"th":"\u0e04\u0e23\u0e35\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"title":{"th":"\u0e2a\u0e49\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"title":{"th":"\u0e0a\u0e21\u0e1e\u0e39","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"title":{"th":"\u0e41\u0e14\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"title":{"th":"\u0e14\u0e33","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"title":{"th":"\u0e40\u0e17\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"title":{"th":"\u0e17\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"title":{"th":"\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"title":{"th":"\u0e19\u0e39\u0e49\u0e14","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"title":{"th":"\u0e40\u0e1a\u0e08","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"title":{"th":"\u0e1f\u0e49\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"title":{"th":"\u0e21\u0e48\u0e27\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}}]}]';
        $mock = json_decode($mock,true);

        $this->optionValueRepository->expects($this->any())->method('getOptionValue')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
            'id' => '1',
        );

        $crawler = $this->client->request('GET', 'api/option/1/value',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }


    public function test_Show_Success_Cache()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '{"response":{"record":[{"id":1,"store_id":1,"user_id":205,"position":0,"status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35","en":""},"option_value":[{"id":1,"position":1,"title":{"th":"\u0e02\u0e32\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"title":{"th":"\u0e04\u0e23\u0e35\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"title":{"th":"\u0e2a\u0e49\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"title":{"th":"\u0e0a\u0e21\u0e1e\u0e39","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"title":{"th":"\u0e41\u0e14\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"title":{"th":"\u0e14\u0e33","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"title":{"th":"\u0e40\u0e17\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"title":{"th":"\u0e17\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"title":{"th":"\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"title":{"th":"\u0e19\u0e39\u0e49\u0e14","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"title":{"th":"\u0e40\u0e1a\u0e08","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"title":{"th":"\u0e1f\u0e49\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"title":{"th":"\u0e21\u0e48\u0e27\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"3 days ago","format":"31 October 2014 5:51 PM"}}]}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/option/1/value?store_id=1');
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

        $this->optionValueRepository = $this->getMock('OptionValueRepository');
        $this->app->instance('OptionValueRepository', $this->optionValueRepository);

        $mock = false;
        $this->optionValueRepository->expects($this->any())->method('getOptionValue')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '9999',
            'id' => '9999',
        );

        $crawler = $this->client->request('GET', 'api/option/9999/value',$param);
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
        $crawler = $this->client->request('POST', 'api/option/7/value',$parameter);
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


        $this->optionValueRepository = $this->getMock('OptionValueRepository');
        $this->app->instance('OptionValueRepository', $this->optionValueRepository);
        $mock = '{"option_value_id":50}';
        $mock = json_decode($mock,true);
        $this->optionValueRepository->expects($this->once())->method('createOptionValue')->will($this->returnValue($mock));


        $parameter = array(
            'user_id' => 205,
            'store_id' => 1,
            'option_id' => 7,
            'option_value' => array(
                0 => array(
                    'position' => 0,
                    'code' => 'test',
                    'title' => 'test',
                    'description' => 'test'
                )
            ),
            'language' => array('th')
        );


        $crawler = $this->client->request('POST', 'api/option/7/value',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Post_Fail()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->optionValueRepository = $this->getMock('OptionValueRepository');
        $this->app->instance('OptionValueRepository', $this->optionValueRepository);
        $mock = false;
        //$mock = json_decode($mock,true);
        $this->optionValueRepository->expects($this->once())->method('createOptionValue')->will($this->returnValue($mock));


        $parameter = array(
            'user_id' => 205,
            'store_id' => 999,
            'option_id' => 999,
            'option_value' => array(
                0 => array(
                    'position' => 0,
                    'code' => 'test',
                    'title' => 'test',
                    'description' => 'test'
                )
            ),
            'language' => array('th')
        );


        $crawler = $this->client->request('POST', 'api/option/999/value',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function test_Update_Success()
    {
        $param = array();
        $crawler = $this->client->request('PUT', 'api/option/7/value/38',$param);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }
    

    public function test_Delete_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->optionValueRepository = $this->getMock('OptionValueRepository');
        $this->app->instance('OptionValueRepository', $this->optionValueRepository);

        $mock = '{"response":{"id":"57","affected":true},"code":0}';
        $mock = json_decode($mock,true);
        $this->optionValueRepository->expects($this->once())->method('deleteOptionValue')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
            'user_id' => '205',
            'option_id' => '7',
            'id' => '57',
        );

        $crawler = $this->client->request('DELETE', 'api/option/7/value/57',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }
/*

    public function test_Delete_Fail_Data()
    {
        
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $mock = '{"result":false,"code":1004}';
        $mock = json_decode($mock,true);
        $this->optionRepository->expects($this->once())->method('deleteOption')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
            'user_id' => '205',
            'id' => '1',
        );

        $crawler = $this->client->request('DELETE', 'api/option/1',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found', $json);
    }

    public function test_Delete_Fail_InUse()
    {
        
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $mock = '{"result":false,"code":1007}';
        $mock = json_decode($mock,true);
        $this->optionRepository->expects($this->once())->method('deleteOption')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
            'user_id' => '205',
            'id' => '1',
        );

        $crawler = $this->client->request('DELETE', 'api/option/1',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1007', $json);
        $this->assertContains('"status_txt":"Delete data error"', $json);
    }
*/
    public function test_Delete_Fail_Parameter()
    {

        $param = array(
            'user_id' => '205',
            'id' => '267',
        );

        $crawler = $this->client->request('DELETE', 'api/option/7/value/57',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

}
