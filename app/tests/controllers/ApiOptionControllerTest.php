<?php

class ApiOptionControllerTest extends ApiTestCase
{

    public function test_Get_Success()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":2},"record":[{"id":7,"store_id":1,"user_id":205,"position":0,"code":"size","status":"true","created_at":{"date":"2014-10-31 15:27:19","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"},"title":{"th":"\u0e02\u0e19\u0e32\u0e14\u0e19\u0e30"},"option_value":[{"id":38,"position":1,"code":"","title":{"th":"S"},"description":{"th":"S"},"created_at":{"date":"2014-10-31 15:27:19","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":39,"position":2,"code":"","title":{"th":"M"},"description":{"th":"M"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":40,"position":3,"code":"","title":{"th":"L"},"description":{"th":"L"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":41,"position":4,"code":"","title":{"th":"XL"},"description":{"th":"XL"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}}]},{"id":1,"store_id":1,"user_id":205,"position":0,"code":"color","status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35"},"option_value":[{"id":1,"position":1,"code":"#ffffff","title":{"th":"\u0e02\u0e32\u0e27"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"code":"#ffffcc","title":{"th":"\u0e04\u0e23\u0e35\u0e21"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"code":"#ffff99","title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"code":"#ff9966","title":{"th":"\u0e2a\u0e49\u0e21"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"code":"#ffcccc","title":{"th":"\u0e0a\u0e21\u0e1e\u0e39"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"code":"#ff0000","title":{"th":"\u0e41\u0e14\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"code":"#000000","title":{"th":"\u0e14\u0e33"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"code":"#cccccc","title":{"th":"\u0e40\u0e17\u0e32"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"code":"#996633","title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"code":"#cc9933","title":{"th":"\u0e17\u0e2d\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"code":"#bdc3c7","title":{"th":"\u0e40\u0e07\u0e34\u0e19"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"code":"#f0c9b6","title":{"th":"\u0e19\u0e39\u0e49\u0e14"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"code":"#f5e1ca","title":{"th":"\u0e40\u0e1a\u0e08"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"code":"#65ba7f","title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"code":"#73c1dd","title":{"th":"\u0e1f\u0e49\u0e32"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"code":"#3e5798","title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"code":"#8f3faf","title":{"th":"\u0e21\u0e48\u0e27\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"code":"","title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"code":"","title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}}]}]},"code":0}';
        $mock = json_decode($mock, true);

        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $this->optionRepository->expects($this->any())->method('getOptionValuesByOpitonGroup')->will($this->returnValue(false));

        $mock = '[{"id":7,"store_id":1,"user_id":205,"code":"size","position":0,"status":1,"created_at":"2014-10-31 15:27:19","updated_at":"2014-11-03 15:06:30","languages":[{"option_id":7,"language_id":1,"title":"\u0e02\u0e19\u0e32\u0e14\u0e19\u0e30"}],"values":[{"id":38,"store_id":1,"user_id":205,"option_id":7,"code":"","position":1,"created_at":"2014-10-31 15:27:19","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":38,"language_id":1,"title":"S","description":"S"}]},{"id":39,"store_id":1,"user_id":205,"option_id":7,"code":"","position":2,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":39,"language_id":1,"title":"M","description":"M"}]},{"id":40,"store_id":1,"user_id":205,"option_id":7,"code":"","position":3,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":40,"language_id":1,"title":"L","description":"L"}]},{"id":41,"store_id":1,"user_id":205,"option_id":7,"code":"","position":4,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":41,"language_id":1,"title":"XL","description":"XL"}]}]},{"id":1,"store_id":1,"user_id":205,"code":"color","position":0,"status":1,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_id":1,"language_id":1,"title":"\u0e2a\u0e35"},{"option_id":1,"language_id":2,"title":""}],"values":[{"id":1,"store_id":1,"user_id":205,"option_id":1,"code":"#ffffff","position":1,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":1,"language_id":1,"title":"\u0e02\u0e32\u0e27","description":""},{"option_value_id":1,"language_id":2,"title":"","description":""}]},{"id":2,"store_id":1,"user_id":205,"option_id":1,"code":"#ffffcc","position":2,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":2,"language_id":1,"title":"\u0e04\u0e23\u0e35\u0e21","description":""},{"option_value_id":2,"language_id":2,"title":"","description":""}]},{"id":3,"store_id":1,"user_id":205,"option_id":1,"code":"#ffff99","position":3,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":3,"language_id":1,"title":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","description":""},{"option_value_id":3,"language_id":2,"title":"","description":""}]},{"id":4,"store_id":1,"user_id":205,"option_id":1,"code":"#ff9966","position":4,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":4,"language_id":1,"title":"\u0e2a\u0e49\u0e21","description":""},{"option_value_id":4,"language_id":2,"title":"","description":""}]},{"id":5,"store_id":1,"user_id":205,"option_id":1,"code":"#ffcccc","position":5,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":5,"language_id":1,"title":"\u0e0a\u0e21\u0e1e\u0e39","description":""},{"option_value_id":5,"language_id":2,"title":"","description":""}]},{"id":6,"store_id":1,"user_id":205,"option_id":1,"code":"#ff0000","position":6,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":6,"language_id":1,"title":"\u0e41\u0e14\u0e07","description":""},{"option_value_id":6,"language_id":2,"title":"","description":""}]},{"id":7,"store_id":1,"user_id":205,"option_id":1,"code":"#000000","position":7,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":7,"language_id":1,"title":"\u0e14\u0e33","description":""},{"option_value_id":7,"language_id":2,"title":"","description":""}]},{"id":8,"store_id":1,"user_id":205,"option_id":1,"code":"#cccccc","position":8,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":8,"language_id":1,"title":"\u0e40\u0e17\u0e32","description":""},{"option_value_id":8,"language_id":2,"title":"","description":""}]},{"id":9,"store_id":1,"user_id":205,"option_id":1,"code":"#996633","position":9,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":9,"language_id":1,"title":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","description":""},{"option_value_id":9,"language_id":2,"title":"","description":""}]},{"id":10,"store_id":1,"user_id":205,"option_id":1,"code":"#cc9933","position":10,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":10,"language_id":1,"title":"\u0e17\u0e2d\u0e07","description":""},{"option_value_id":10,"language_id":2,"title":"","description":""}]},{"id":11,"store_id":1,"user_id":205,"option_id":1,"code":"#bdc3c7","position":11,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":11,"language_id":1,"title":"\u0e40\u0e07\u0e34\u0e19","description":""},{"option_value_id":11,"language_id":2,"title":"","description":""}]},{"id":12,"store_id":1,"user_id":205,"option_id":1,"code":"#f0c9b6","position":12,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":12,"language_id":1,"title":"\u0e19\u0e39\u0e49\u0e14","description":""},{"option_value_id":12,"language_id":2,"title":"","description":""}]},{"id":13,"store_id":1,"user_id":205,"option_id":1,"code":"#f5e1ca","position":13,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":13,"language_id":1,"title":"\u0e40\u0e1a\u0e08","description":""},{"option_value_id":13,"language_id":2,"title":"","description":""}]},{"id":14,"store_id":1,"user_id":205,"option_id":1,"code":"#65ba7f","position":14,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":14,"language_id":1,"title":"\u0e40\u0e02\u0e35\u0e22\u0e27","description":""},{"option_value_id":14,"language_id":2,"title":"","description":""}]},{"id":15,"store_id":1,"user_id":205,"option_id":1,"code":"#73c1dd","position":15,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":15,"language_id":1,"title":"\u0e1f\u0e49\u0e32","description":""},{"option_value_id":15,"language_id":2,"title":"","description":""}]},{"id":16,"store_id":1,"user_id":205,"option_id":1,"code":"#3e5798","position":16,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":16,"language_id":1,"title":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","description":""},{"option_value_id":16,"language_id":2,"title":"","description":""}]},{"id":17,"store_id":1,"user_id":205,"option_id":1,"code":"#8f3faf","position":17,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":17,"language_id":1,"title":"\u0e21\u0e48\u0e27\u0e07","description":""},{"option_value_id":17,"language_id":2,"title":"","description":""}]},{"id":18,"store_id":1,"user_id":205,"option_id":1,"code":"","position":18,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":18,"language_id":1,"title":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","description":""},{"option_value_id":18,"language_id":2,"title":"","description":""}]},{"id":19,"store_id":1,"user_id":205,"option_id":1,"code":"","position":19,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":19,"language_id":1,"title":"\u0e2d\u0e37\u0e48\u0e19\u0e46","description":""},{"option_value_id":19,"language_id":2,"title":"","description":""}]}]}]';
        $mock = json_decode($mock);

        $this->optionRepository->expects($this->any())->method('getOptionGroup')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/option?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Get_Fitler_Other_StoreId_Success()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":2},"record":[{"id":7,"store_id":1,"user_id":205,"position":0,"code":"size","status":"true","created_at":{"date":"2014-10-31 15:27:19","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"},"title":{"th":"\u0e02\u0e19\u0e32\u0e14\u0e19\u0e30"},"option_value":[{"id":38,"position":1,"code":"","title":{"th":"S"},"description":{"th":"S"},"created_at":{"date":"2014-10-31 15:27:19","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":39,"position":2,"code":"","title":{"th":"M"},"description":{"th":"M"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":40,"position":3,"code":"","title":{"th":"L"},"description":{"th":"L"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":41,"position":4,"code":"","title":{"th":"XL"},"description":{"th":"XL"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}}]},{"id":1,"store_id":1,"user_id":205,"position":0,"code":"color","status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35"},"option_value":[{"id":1,"position":1,"code":"#ffffff","title":{"th":"\u0e02\u0e32\u0e27"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"code":"#ffffcc","title":{"th":"\u0e04\u0e23\u0e35\u0e21"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"code":"#ffff99","title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"code":"#ff9966","title":{"th":"\u0e2a\u0e49\u0e21"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"code":"#ffcccc","title":{"th":"\u0e0a\u0e21\u0e1e\u0e39"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"code":"#ff0000","title":{"th":"\u0e41\u0e14\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"code":"#000000","title":{"th":"\u0e14\u0e33"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"code":"#cccccc","title":{"th":"\u0e40\u0e17\u0e32"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"code":"#996633","title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"code":"#cc9933","title":{"th":"\u0e17\u0e2d\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"code":"#bdc3c7","title":{"th":"\u0e40\u0e07\u0e34\u0e19"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"code":"#f0c9b6","title":{"th":"\u0e19\u0e39\u0e49\u0e14"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"code":"#f5e1ca","title":{"th":"\u0e40\u0e1a\u0e08"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"code":"#65ba7f","title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"code":"#73c1dd","title":{"th":"\u0e1f\u0e49\u0e32"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"code":"#3e5798","title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"code":"#8f3faf","title":{"th":"\u0e21\u0e48\u0e27\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"code":"","title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"code":"","title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}}]}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $data = '{"option_id":[1],"values_id":[1,2,3,4]}';
        $data = json_decode($data, true);
        $this->optionRepository->expects($this->any())->method('getOptionValuesByOpitonGroup')->will($this->returnValue($data));

        $mock = '[{"id":7,"store_id":1,"user_id":205,"code":"size","position":0,"status":1,"created_at":"2014-10-31 15:27:19","updated_at":"2014-11-03 15:06:30","languages":[{"option_id":7,"language_id":1,"title":"\u0e02\u0e19\u0e32\u0e14\u0e19\u0e30"}],"values":[{"id":38,"store_id":1,"user_id":205,"option_id":7,"code":"","position":1,"created_at":"2014-10-31 15:27:19","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":38,"language_id":1,"title":"S","description":"S"}]},{"id":39,"store_id":1,"user_id":205,"option_id":7,"code":"","position":2,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":39,"language_id":1,"title":"M","description":"M"}]},{"id":40,"store_id":1,"user_id":205,"option_id":7,"code":"","position":3,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":40,"language_id":1,"title":"L","description":"L"}]},{"id":41,"store_id":1,"user_id":205,"option_id":7,"code":"","position":4,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":41,"language_id":1,"title":"XL","description":"XL"}]}]},{"id":1,"store_id":1,"user_id":205,"code":"color","position":0,"status":1,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_id":1,"language_id":1,"title":"\u0e2a\u0e35"},{"option_id":1,"language_id":2,"title":""}],"values":[{"id":1,"store_id":1,"user_id":205,"option_id":1,"code":"#ffffff","position":1,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":1,"language_id":1,"title":"\u0e02\u0e32\u0e27","description":""},{"option_value_id":1,"language_id":2,"title":"","description":""}]},{"id":2,"store_id":1,"user_id":205,"option_id":1,"code":"#ffffcc","position":2,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":2,"language_id":1,"title":"\u0e04\u0e23\u0e35\u0e21","description":""},{"option_value_id":2,"language_id":2,"title":"","description":""}]},{"id":3,"store_id":1,"user_id":205,"option_id":1,"code":"#ffff99","position":3,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":3,"language_id":1,"title":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","description":""},{"option_value_id":3,"language_id":2,"title":"","description":""}]},{"id":4,"store_id":1,"user_id":205,"option_id":1,"code":"#ff9966","position":4,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":4,"language_id":1,"title":"\u0e2a\u0e49\u0e21","description":""},{"option_value_id":4,"language_id":2,"title":"","description":""}]},{"id":5,"store_id":1,"user_id":205,"option_id":1,"code":"#ffcccc","position":5,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":5,"language_id":1,"title":"\u0e0a\u0e21\u0e1e\u0e39","description":""},{"option_value_id":5,"language_id":2,"title":"","description":""}]},{"id":6,"store_id":1,"user_id":205,"option_id":1,"code":"#ff0000","position":6,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":6,"language_id":1,"title":"\u0e41\u0e14\u0e07","description":""},{"option_value_id":6,"language_id":2,"title":"","description":""}]},{"id":7,"store_id":1,"user_id":205,"option_id":1,"code":"#000000","position":7,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":7,"language_id":1,"title":"\u0e14\u0e33","description":""},{"option_value_id":7,"language_id":2,"title":"","description":""}]},{"id":8,"store_id":1,"user_id":205,"option_id":1,"code":"#cccccc","position":8,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":8,"language_id":1,"title":"\u0e40\u0e17\u0e32","description":""},{"option_value_id":8,"language_id":2,"title":"","description":""}]},{"id":9,"store_id":1,"user_id":205,"option_id":1,"code":"#996633","position":9,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":9,"language_id":1,"title":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","description":""},{"option_value_id":9,"language_id":2,"title":"","description":""}]},{"id":10,"store_id":1,"user_id":205,"option_id":1,"code":"#cc9933","position":10,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":10,"language_id":1,"title":"\u0e17\u0e2d\u0e07","description":""},{"option_value_id":10,"language_id":2,"title":"","description":""}]},{"id":11,"store_id":1,"user_id":205,"option_id":1,"code":"#bdc3c7","position":11,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":11,"language_id":1,"title":"\u0e40\u0e07\u0e34\u0e19","description":""},{"option_value_id":11,"language_id":2,"title":"","description":""}]},{"id":12,"store_id":1,"user_id":205,"option_id":1,"code":"#f0c9b6","position":12,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":12,"language_id":1,"title":"\u0e19\u0e39\u0e49\u0e14","description":""},{"option_value_id":12,"language_id":2,"title":"","description":""}]},{"id":13,"store_id":1,"user_id":205,"option_id":1,"code":"#f5e1ca","position":13,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":13,"language_id":1,"title":"\u0e40\u0e1a\u0e08","description":""},{"option_value_id":13,"language_id":2,"title":"","description":""}]},{"id":14,"store_id":1,"user_id":205,"option_id":1,"code":"#65ba7f","position":14,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":14,"language_id":1,"title":"\u0e40\u0e02\u0e35\u0e22\u0e27","description":""},{"option_value_id":14,"language_id":2,"title":"","description":""}]},{"id":15,"store_id":1,"user_id":205,"option_id":1,"code":"#73c1dd","position":15,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":15,"language_id":1,"title":"\u0e1f\u0e49\u0e32","description":""},{"option_value_id":15,"language_id":2,"title":"","description":""}]},{"id":16,"store_id":1,"user_id":205,"option_id":1,"code":"#3e5798","position":16,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":16,"language_id":1,"title":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","description":""},{"option_value_id":16,"language_id":2,"title":"","description":""}]},{"id":17,"store_id":1,"user_id":205,"option_id":1,"code":"#8f3faf","position":17,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":17,"language_id":1,"title":"\u0e21\u0e48\u0e27\u0e07","description":""},{"option_value_id":17,"language_id":2,"title":"","description":""}]},{"id":18,"store_id":1,"user_id":205,"option_id":1,"code":"","position":18,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":18,"language_id":1,"title":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","description":""},{"option_value_id":18,"language_id":2,"title":"","description":""}]},{"id":19,"store_id":1,"user_id":205,"option_id":1,"code":"","position":19,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":19,"language_id":1,"title":"\u0e2d\u0e37\u0e48\u0e19\u0e46","description":""},{"option_value_id":19,"language_id":2,"title":"","description":""}]}]}]';
        $mock = json_decode($mock);

        $this->optionRepository->expects($this->any())->method('getOptionGroup')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/option?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Get_Not_Default_Success()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":2},"record":[{"id":7,"store_id":1,"user_id":205,"position":0,"code":"size","status":"true","created_at":{"date":"2014-10-31 15:27:19","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"},"title":{"th":"\u0e02\u0e19\u0e32\u0e14\u0e19\u0e30"},"option_value":[{"id":38,"position":1,"code":"","title":{"th":"S"},"description":{"th":"S"},"created_at":{"date":"2014-10-31 15:27:19","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":39,"position":2,"code":"","title":{"th":"M"},"description":{"th":"M"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":40,"position":3,"code":"","title":{"th":"L"},"description":{"th":"L"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":41,"position":4,"code":"","title":{"th":"XL"},"description":{"th":"XL"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}}]},{"id":1,"store_id":1,"user_id":205,"position":0,"code":"color","status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35"},"option_value":[{"id":1,"position":1,"code":"#ffffff","title":{"th":"\u0e02\u0e32\u0e27"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"code":"#ffffcc","title":{"th":"\u0e04\u0e23\u0e35\u0e21"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"code":"#ffff99","title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"code":"#ff9966","title":{"th":"\u0e2a\u0e49\u0e21"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"code":"#ffcccc","title":{"th":"\u0e0a\u0e21\u0e1e\u0e39"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"code":"#ff0000","title":{"th":"\u0e41\u0e14\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"code":"#000000","title":{"th":"\u0e14\u0e33"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"code":"#cccccc","title":{"th":"\u0e40\u0e17\u0e32"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"code":"#996633","title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"code":"#cc9933","title":{"th":"\u0e17\u0e2d\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"code":"#bdc3c7","title":{"th":"\u0e40\u0e07\u0e34\u0e19"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"code":"#f0c9b6","title":{"th":"\u0e19\u0e39\u0e49\u0e14"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"code":"#f5e1ca","title":{"th":"\u0e40\u0e1a\u0e08"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"code":"#65ba7f","title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"code":"#73c1dd","title":{"th":"\u0e1f\u0e49\u0e32"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"code":"#3e5798","title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"code":"#8f3faf","title":{"th":"\u0e21\u0e48\u0e27\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"code":"","title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"code":"","title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}}]}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $this->optionRepository->expects($this->any())->method('getOptionValuesByOpitonGroup')->will($this->returnValue(false));

        $mock = '[{"id":7,"store_id":1,"user_id":205,"code":"size","position":0,"status":1,"created_at":"2014-10-31 15:27:19","updated_at":"2014-11-03 15:06:30","languages":[{"option_id":7,"language_id":1,"title":"\u0e02\u0e19\u0e32\u0e14\u0e19\u0e30"}],"values":[{"id":38,"store_id":1,"user_id":205,"option_id":7,"code":"","position":1,"created_at":"2014-10-31 15:27:19","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":38,"language_id":1,"title":"S","description":"S"}]},{"id":39,"store_id":1,"user_id":205,"option_id":7,"code":"","position":2,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":39,"language_id":1,"title":"M","description":"M"}]},{"id":40,"store_id":1,"user_id":205,"option_id":7,"code":"","position":3,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":40,"language_id":1,"title":"L","description":"L"}]},{"id":41,"store_id":1,"user_id":205,"option_id":7,"code":"","position":4,"created_at":"2014-10-31 15:27:20","updated_at":"2014-11-03 15:06:30","languages":[{"option_value_id":41,"language_id":1,"title":"XL","description":"XL"}]}]},{"id":1,"store_id":1,"user_id":205,"code":"color","position":0,"status":1,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_id":1,"language_id":1,"title":"\u0e2a\u0e35"},{"option_id":1,"language_id":2,"title":""}],"values":[{"id":1,"store_id":1,"user_id":205,"option_id":1,"code":"#ffffff","position":1,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":1,"language_id":1,"title":"\u0e02\u0e32\u0e27","description":""},{"option_value_id":1,"language_id":2,"title":"","description":""}]},{"id":2,"store_id":1,"user_id":205,"option_id":1,"code":"#ffffcc","position":2,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":2,"language_id":1,"title":"\u0e04\u0e23\u0e35\u0e21","description":""},{"option_value_id":2,"language_id":2,"title":"","description":""}]},{"id":3,"store_id":1,"user_id":205,"option_id":1,"code":"#ffff99","position":3,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":3,"language_id":1,"title":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","description":""},{"option_value_id":3,"language_id":2,"title":"","description":""}]},{"id":4,"store_id":1,"user_id":205,"option_id":1,"code":"#ff9966","position":4,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":4,"language_id":1,"title":"\u0e2a\u0e49\u0e21","description":""},{"option_value_id":4,"language_id":2,"title":"","description":""}]},{"id":5,"store_id":1,"user_id":205,"option_id":1,"code":"#ffcccc","position":5,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":5,"language_id":1,"title":"\u0e0a\u0e21\u0e1e\u0e39","description":""},{"option_value_id":5,"language_id":2,"title":"","description":""}]},{"id":6,"store_id":1,"user_id":205,"option_id":1,"code":"#ff0000","position":6,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":6,"language_id":1,"title":"\u0e41\u0e14\u0e07","description":""},{"option_value_id":6,"language_id":2,"title":"","description":""}]},{"id":7,"store_id":1,"user_id":205,"option_id":1,"code":"#000000","position":7,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":7,"language_id":1,"title":"\u0e14\u0e33","description":""},{"option_value_id":7,"language_id":2,"title":"","description":""}]},{"id":8,"store_id":1,"user_id":205,"option_id":1,"code":"#cccccc","position":8,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":8,"language_id":1,"title":"\u0e40\u0e17\u0e32","description":""},{"option_value_id":8,"language_id":2,"title":"","description":""}]},{"id":9,"store_id":1,"user_id":205,"option_id":1,"code":"#996633","position":9,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":9,"language_id":1,"title":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","description":""},{"option_value_id":9,"language_id":2,"title":"","description":""}]},{"id":10,"store_id":1,"user_id":205,"option_id":1,"code":"#cc9933","position":10,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":10,"language_id":1,"title":"\u0e17\u0e2d\u0e07","description":""},{"option_value_id":10,"language_id":2,"title":"","description":""}]},{"id":11,"store_id":1,"user_id":205,"option_id":1,"code":"#bdc3c7","position":11,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":11,"language_id":1,"title":"\u0e40\u0e07\u0e34\u0e19","description":""},{"option_value_id":11,"language_id":2,"title":"","description":""}]},{"id":12,"store_id":1,"user_id":205,"option_id":1,"code":"#f0c9b6","position":12,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":12,"language_id":1,"title":"\u0e19\u0e39\u0e49\u0e14","description":""},{"option_value_id":12,"language_id":2,"title":"","description":""}]},{"id":13,"store_id":1,"user_id":205,"option_id":1,"code":"#f5e1ca","position":13,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":13,"language_id":1,"title":"\u0e40\u0e1a\u0e08","description":""},{"option_value_id":13,"language_id":2,"title":"","description":""}]},{"id":14,"store_id":1,"user_id":205,"option_id":1,"code":"#65ba7f","position":14,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":14,"language_id":1,"title":"\u0e40\u0e02\u0e35\u0e22\u0e27","description":""},{"option_value_id":14,"language_id":2,"title":"","description":""}]},{"id":15,"store_id":1,"user_id":205,"option_id":1,"code":"#73c1dd","position":15,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":15,"language_id":1,"title":"\u0e1f\u0e49\u0e32","description":""},{"option_value_id":15,"language_id":2,"title":"","description":""}]},{"id":16,"store_id":1,"user_id":205,"option_id":1,"code":"#3e5798","position":16,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":16,"language_id":1,"title":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","description":""},{"option_value_id":16,"language_id":2,"title":"","description":""}]},{"id":17,"store_id":1,"user_id":205,"option_id":1,"code":"#8f3faf","position":17,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":17,"language_id":1,"title":"\u0e21\u0e48\u0e27\u0e07","description":""},{"option_value_id":17,"language_id":2,"title":"","description":""}]},{"id":18,"store_id":1,"user_id":205,"option_id":1,"code":"","position":18,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":18,"language_id":1,"title":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","description":""},{"option_value_id":18,"language_id":2,"title":"","description":""}]},{"id":19,"store_id":1,"user_id":205,"option_id":1,"code":"","position":19,"created_at":"2014-08-05 05:22:26","updated_at":"2014-10-31 17:51:13","languages":[{"option_value_id":19,"language_id":1,"title":"\u0e2d\u0e37\u0e48\u0e19\u0e46","description":""},{"option_value_id":19,"language_id":2,"title":"","description":""}]}]}]';
        $mock = json_decode($mock);

        $this->optionRepository->expects($this->any())->method('getOptionGroup')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/option?store_id=111');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Get_Success_Cache()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":2},"record":[{"id":7,"store_id":1,"user_id":205,"position":0,"code":"size","status":"true","created_at":{"date":"2014-10-31 15:27:19","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"},"title":{"th":"\u0e02\u0e19\u0e32\u0e14\u0e19\u0e30"},"option_value":[{"id":38,"position":1,"code":"","title":{"th":"S"},"description":{"th":"S"},"created_at":{"date":"2014-10-31 15:27:19","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":39,"position":2,"code":"","title":{"th":"M"},"description":{"th":"M"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":40,"position":3,"code":"","title":{"th":"L"},"description":{"th":"L"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}},{"id":41,"position":4,"code":"","title":{"th":"XL"},"description":{"th":"XL"},"created_at":{"date":"2014-10-31 15:27:20","timeago":"2 days ago","format":"31 October 2014 3:27 PM"},"updated_at":{"date":"2014-11-03 15:06:30","timeago":"2 minutes ago","format":"3 November 2014 3:06 PM"}}]},{"id":1,"store_id":1,"user_id":205,"position":0,"code":"color","status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35"},"option_value":[{"id":1,"position":1,"code":"#ffffff","title":{"th":"\u0e02\u0e32\u0e27"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"code":"#ffffcc","title":{"th":"\u0e04\u0e23\u0e35\u0e21"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"code":"#ffff99","title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"code":"#ff9966","title":{"th":"\u0e2a\u0e49\u0e21"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"code":"#ffcccc","title":{"th":"\u0e0a\u0e21\u0e1e\u0e39"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"code":"#ff0000","title":{"th":"\u0e41\u0e14\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"code":"#000000","title":{"th":"\u0e14\u0e33"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"code":"#cccccc","title":{"th":"\u0e40\u0e17\u0e32"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"code":"#996633","title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"code":"#cc9933","title":{"th":"\u0e17\u0e2d\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"code":"#bdc3c7","title":{"th":"\u0e40\u0e07\u0e34\u0e19"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"code":"#f0c9b6","title":{"th":"\u0e19\u0e39\u0e49\u0e14"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"code":"#f5e1ca","title":{"th":"\u0e40\u0e1a\u0e08"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"code":"#65ba7f","title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"code":"#73c1dd","title":{"th":"\u0e1f\u0e49\u0e32"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"code":"#3e5798","title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"code":"#8f3faf","title":{"th":"\u0e21\u0e48\u0e27\u0e07"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"code":"","title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"code":"","title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46"},"description":{"th":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}}]}]},"code":0}';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/option?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Get_Fail_Parameter()
    {

        $crawler = $this->client->request('GET', 'api/option');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Get_Fail_Data()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":[],"code":1004}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $mock = array();
        $this->optionRepository->expects($this->any())->method('getOption')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/option?store_id=999');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

     public function test_Show_Fail_Parameter()
    {
        $crawler = $this->client->request('GET', 'api/option/1',array());
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

        $mock = '{"response":{"benchmark":"false","record":[{"id":1,"store_id":1,"user_id":205,"position":0,"code":"color","status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35","en":""},"option_value":[{"id":1,"position":1,"title":{"th":"\u0e02\u0e32\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"title":{"th":"\u0e04\u0e23\u0e35\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"title":{"th":"\u0e2a\u0e49\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"title":{"th":"\u0e0a\u0e21\u0e1e\u0e39","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"title":{"th":"\u0e41\u0e14\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"title":{"th":"\u0e14\u0e33","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"title":{"th":"\u0e40\u0e17\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"title":{"th":"\u0e17\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"title":{"th":"\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"title":{"th":"\u0e19\u0e39\u0e49\u0e14","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"title":{"th":"\u0e40\u0e1a\u0e08","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"title":{"th":"\u0e1f\u0e49\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"title":{"th":"\u0e21\u0e48\u0e27\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}}]}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $mock = '[{"id":1,"store_id":1,"user_id":205,"position":0,"code":"color","status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35","en":""},"option_value":[{"id":1,"position":1,"title":{"th":"\u0e02\u0e32\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"title":{"th":"\u0e04\u0e23\u0e35\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"title":{"th":"\u0e2a\u0e49\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"title":{"th":"\u0e0a\u0e21\u0e1e\u0e39","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"title":{"th":"\u0e41\u0e14\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"title":{"th":"\u0e14\u0e33","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"title":{"th":"\u0e40\u0e17\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"title":{"th":"\u0e17\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"title":{"th":"\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"title":{"th":"\u0e19\u0e39\u0e49\u0e14","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"title":{"th":"\u0e40\u0e1a\u0e08","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"title":{"th":"\u0e1f\u0e49\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"title":{"th":"\u0e21\u0e48\u0e27\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}}]}]';
        $mock = json_decode($mock,true);

        $this->optionRepository->expects($this->any())->method('getById')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
            'id' => '1',
        );

        $crawler = $this->client->request('GET', 'api/option/1',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Show_Success_Cache()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '{"response":{"benchmark":"false","record":[{"id":1,"store_id":1,"user_id":205,"position":0,"code":"color","status":"true","created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"},"title":{"th":"\u0e2a\u0e35","en":""},"option_value":[{"id":1,"position":1,"title":{"th":"\u0e02\u0e32\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":2,"position":2,"title":{"th":"\u0e04\u0e23\u0e35\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":3,"position":3,"title":{"th":"\u0e40\u0e2b\u0e25\u0e37\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":4,"position":4,"title":{"th":"\u0e2a\u0e49\u0e21","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":5,"position":5,"title":{"th":"\u0e0a\u0e21\u0e1e\u0e39","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":6,"position":6,"title":{"th":"\u0e41\u0e14\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:25","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":7,"position":7,"title":{"th":"\u0e14\u0e33","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":8,"position":8,"title":{"th":"\u0e40\u0e17\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":9,"position":9,"title":{"th":"\u0e19\u0e49\u0e33\u0e15\u0e32\u0e25","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":10,"position":10,"title":{"th":"\u0e17\u0e2d\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":11,"position":11,"title":{"th":"\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":12,"position":12,"title":{"th":"\u0e19\u0e39\u0e49\u0e14","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":13,"position":13,"title":{"th":"\u0e40\u0e1a\u0e08","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":14,"position":14,"title":{"th":"\u0e40\u0e02\u0e35\u0e22\u0e27","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":15,"position":15,"title":{"th":"\u0e1f\u0e49\u0e32","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":16,"position":16,"title":{"th":"\u0e19\u0e49\u0e33\u0e40\u0e07\u0e34\u0e19","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":17,"position":17,"title":{"th":"\u0e21\u0e48\u0e27\u0e07","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":18,"position":18,"title":{"th":"\u0e2b\u0e25\u0e32\u0e01\u0e2a\u0e35","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}},{"id":19,"position":19,"title":{"th":"\u0e2d\u0e37\u0e48\u0e19\u0e46","en":""},"description":{"th":"","en":""},"created_at":{"date":"2014-08-05 05:22:26","timeago":"3 months ago","format":"5 August 2014 5:22 AM"},"updated_at":{"date":"2014-10-31 17:51:13","timeago":"2 days ago","format":"31 October 2014 5:51 PM"}}]}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/option/1?store_id=1');
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

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $mock = array();
        $this->optionRepository->expects($this->any())->method('getById')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '9999',
            'id' => '9999',
        );

        $crawler = $this->client->request('GET', 'api/option/1',$param);
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
        $crawler = $this->client->request('POST', 'api/option',$parameter);
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

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);
        $mock = '{"store_id":"1","user_id":"205","title":"testtest","position":"1","code":"testcode","status":"true","option_value":[{"position":"1","title":"test","code":"testcode"}],"id":12}';
        $mock = json_decode($mock,true);
        $this->optionRepository->expects($this->once())->method('createOption')->will($this->returnValue($mock));

        $option_value = array(
            'position' => 1,
            'title' => array('th'=>'test'),
            'code' => 'testcode',
        );

        $parameter = array(
            'user_id' => '205',
            'store_id' => '1',
            'title' => array('th'=>'test'),
            'status' => 'true',
            'position' => 1,
            'code' => 'testcode',
            'option_value' => array()
        );

        array_push($parameter['option_value'],$option_value);

        $crawler = $this->client->request('POST', 'api/option',$parameter);
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

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $mock = '{"store_id":"1","user_id":"205","status":"true","position":"1","id":"1","title":"testtest","code":"testcode"}';
        $mock = json_decode($mock,true);
        $this->optionRepository->expects($this->once())->method('saveOption')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
            'user_id' => '205',
            'position' => '1',
            'title' => array('th'=>'test'),
            'code' => 'testcode'
        );

        $crawler = $this->client->request('PUT', 'api/option/1',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Update_Fail()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $mock = false;
        $mock = json_decode($mock,true);
        $this->optionRepository->expects($this->once())->method('saveOption')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '999',
            'user_id' => '205',
            'id' => '999',
            'status' => 'true',
            'code' => 'testcode',
            'title' => array('th'=>'test'),
            'position' => '1'
        );

        $crawler = $this->client->request('PUT', 'api/option/999',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
   }

    public function test_Update_Fail_Parameter()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $param = array(
            'id' => '1',
        );

        $crawler = $this->client->request('PUT', 'api/option/1',$param);
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

        $this->optionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->optionRepository);

        $mock = '{"result":true,"option":true}';
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
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

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

    public function test_Delete_Fail_Parameter()
    {

        $param = array(
            'user_id' => '205',
            'id' => '267',
        );

        $crawler = $this->client->request('DELETE', 'api/option/1',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }
}
