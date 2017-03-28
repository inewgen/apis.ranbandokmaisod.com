<?php

class ApiReportAchieveControllerTest extends ApiTestCase
{
    public function test_getSuccess()
    {
        //alert(1);
        $this->ReportAchieveRepository = $this->getMock('ReportAchieveRepository');
        $this->app->instance('ReportAchieveRepository', $this->ReportAchieveRepository);

        $response = '[{"_id":{"$id":"54f3dae2a9910fea1ebed75a"},"created_at":{"sec":1424822400,"usec":0},"store":{"youstore":{"new":{"all":0},"active":{"all":6763}},"westore":{"new":{"all":0},"active":{"all":46}}},"product":{"youstore":{"new":{"all":0},"active":{"all":116831}},"westore":{"new":{"all":0},"active":{"all":601}}}},{"_id":{"$id":"54f3db37a9910f701bbed75a"},"created_at":{"sec":1424883600,"usec":0},"store":{"youstore":{"new":{"all":0},"active":{"all":6761}},"westore":{"new":{"all":1},"active":{"all":38}}},"product":{"youstore":{"new":{"all":0},"active":{"all":708500}},"westore":{"new":{"all":7},"active":{"all":131}}}},{"_id":{"$id":"54f3db52a9910ff01ebed75a"},"created_at":{"sec":1424995200,"usec":0},"store":{"youstore":{"new":{"all":0},"active":{"all":6763}},"westore":{"new":{"all":0},"active":{"all":46}}},"product":{"youstore":{"new":{"all":0},"active":{"all":116831}},"westore":{"new":{"all":0},"active":{"all":601}}}},{"_id":{"$id":"54f3db5aa9910ffa1fbed75a"},"created_at":{"sec":1425081600,"usec":0},"store":{"youstore":{"new":{"all":0},"active":{"all":6763}},"westore":{"new":{"all":0},"active":{"all":46}}},"product":{"youstore":{"new":{"all":0},"active":{"all":116831}},"westore":{"new":{"all":0},"active":{"all":601}}}}]';
        $response = json_decode($response,true);
        $this->ReportAchieveRepository->expects($this->once())->method('getReportFromMongo')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/report/achieve?month=02&year=2015');
        $json = $this->client->getResponse()->getContent();
      //  alert($json);

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

   public function test_getSuccessByCatID()
    {
        $this->ReportAchieveRepository = $this->getMock('ReportAchieveRepository');
        $this->app->instance('ReportAchieveRepository', $this->ReportAchieveRepository);

        $response = '[{"_id":{"$id":"54f3dae2a9910fea1ebed75a"},"created_at":{"sec":1424822400,"usec":0},"store":{"youstore":{"new":{"category":[]},"active":{"category":{"10":1582}}},"westore":{"new":{"category":[]},"active":{"category":{"10":18}}}},"product":{"youstore":{"new":{"category":{"10":0}},"active":{"category":{"10":15898}}},"westore":{"new":{"category":{"10":0}},"active":{"category":{"10":61}}}}},{"_id":{"$id":"54f3db37a9910f701bbed75a"},"created_at":{"sec":1424908800,"usec":0},"store":{"youstore":{"new":{"category":[]},"active":{"category":{"10":1582}}},"westore":{"new":{"category":[]},"active":{"category":{"10":18}}}},"product":{"youstore":{"new":{"category":{"10":0}},"active":{"category":{"10":15890}}},"westore":{"new":{"category":{"10":0}},"active":{"category":{"10":63}}}}},{"_id":{"$id":"54f3db52a9910ff01ebed75a"},"created_at":{"sec":1424995200,"usec":0},"store":{"youstore":{"new":{"category":[]},"active":{"category":{"10":1582}}},"westore":{"new":{"category":[]},"active":{"category":{"10":18}}}},"product":{"youstore":{"new":{"category":{"10":0}},"active":{"category":{"10":15898}}},"westore":{"new":{"category":{"10":0}},"active":{"category":{"10":61}}}}},{"_id":{"$id":"54f3db5aa9910ffa1fbed75a"},"created_at":{"sec":1425081600,"usec":0},"store":{"youstore":{"new":{"category":[]},"active":{"category":{"10":1582}}},"westore":{"new":{"category":[]},"active":{"category":{"10":18}}}},"product":{"youstore":{"new":{"category":{"10":0}},"active":{"category":{"10":15898}}},"westore":{"new":{"category":{"10":0}},"active":{"category":{"10":61}}}}}]';
        $response = json_decode($response,true);

        $this->ReportAchieveRepository->expects($this->once())->method('getReportFromMongo')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/report/achieve?month=02&year=2015&&category_id=10');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_getSuccessByProvinceID()
    {
        $this->ReportAchieveRepository = $this->getMock('ReportAchieveRepository');
        $this->app->instance('ReportAchieveRepository', $this->ReportAchieveRepository);

        $response = '[{"_id":{"$id":"54f3dae2a9910fea1ebed75a"},"created_at":{"sec":1424822400,"usec":0},"store":{"youstore":{"new":{"province":[]},"active":{"province":[]}},"westore":{"new":{"province":[]},"active":{"province":[]}}},"product":{"youstore":{"new":{"province":[]},"active":[]},"westore":{"new":{"province":[]},"active":{"province":[]}}}},{"_id":{"$id":"54f3db37a9910f701bbed75a"},"created_at":{"sec":1424908800,"usec":0},"store":{"youstore":{"new":{"province":[]},"active":{"province":[]}},"westore":{"new":{"province":[]},"active":{"province":[]}}},"product":{"youstore":{"new":{"province":[]},"active":[]},"westore":{"new":{"province":{"10":0}},"active":{"province":{"10":0}}}}},{"_id":{"$id":"54f3db52a9910ff01ebed75a"},"created_at":{"sec":1424995200,"usec":0},"store":{"youstore":{"new":{"province":[]},"active":{"province":[]}},"westore":{"new":{"province":[]},"active":{"province":[]}}},"product":{"youstore":{"new":{"province":[]},"active":[]},"westore":{"new":{"province":[]},"active":{"province":[]}}}},{"_id":{"$id":"54f3db5aa9910ffa1fbed75a"},"created_at":{"sec":1425081600,"usec":0},"store":{"youstore":{"new":{"province":[]},"active":{"province":[]}},"westore":{"new":{"province":[]},"active":{"province":[]}}},"product":{"youstore":{"new":{"province":[]},"active":[]},"westore":{"new":{"province":[]},"active":{"province":[]}}}}]';
        //alert($response);die;
        $response = json_decode($response,true);

        $this->ReportAchieveRepository->expects($this->once())->method('getReportFromMongo')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/report/achieve?month=02&year=2015&province_id=10');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_getFail1003()
    {
        $this->ReportAchieveRepository = $this->getMock('ReportAchieveRepository');
        $this->app->instance('ReportAchieveRepository', $this->ReportAchieveRepository);

        $crawler = $this->client->request('GET', 'api/report/achieve?month=22&year=2015');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
    }

    public function test_getFail1004()
    {
        $this->ReportAchieveRepository = $this->getMock('ReportAchieveRepository');
        $this->app->instance('ReportAchieveRepository', $this->ReportAchieveRepository);

        $response = '';
        $this->ReportAchieveRepository->expects($this->once())->method('getReportFromMongo')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/report/achieve?month=12&year=2015');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
    }

  //  /save?date=2015-02-26

    public function test_saveSuccess()
    {
        $this->ReportAchieveRepository = $this->getMock('ReportAchieveRepository');
        $this->app->instance('ReportAchieveRepository', $this->ReportAchieveRepository);

        $response = '{"status_code":0,"status_txt":"OK","data":{"date":"2015-02-26","store":{"youstore":{"new":{"all":0,"category":[],"province":[]},"active":{"all":6761,"category":{"10":1581,"14":130,"804":169,"16":482,"735":1053,"12":206,"7":234,"8":87,"655":49,"3":210,"21":250,"17":261,"18":41,"4":95,"20":253,"15":483,"1550":8,"13":120,"2":109,"151":119,"9":32,"6":155,"1":49,"11":117,"19":24,"5":76,"1348":104,"0":55,"1514":78,"1461":10,"1351":24,"150":83,"152":11,"1542":3},"province":[6761]}},"westore":{"new":{"all":1,"category":{"10":1},"province":{"3":1}},"active":{"all":38,"category":{"0":1,"10":10,"14":2,"1348":1,"152":2,"11":3,"16":2,"1461":1,"5":1,"8":1,"1542":2,"150":1,"4":1,"15":1,"2":1,"6":2,"3":1,"1351":2,"13":1,"1":1,"151":1},"province":{"0":4,"1":14,"14":2,"7":1,"58":1,"10":3,"17":1,"6":1,"8":1,"9":1,"40":1,"13":1,"18":1,"69":1,"5":1,"3":1,"15":1,"71":1}}}}}}';
        $response = json_decode($response,true);

        $this->ReportAchieveRepository->expects($this->at(0))->method('getReport')->will($this->returnValue($response));
        $response = '{"status_code":0,"status_txt":"OK","data":{"date":"2015-02-26","product":{"youstore":{"new":{"all":0,"category":{"1641":0,"10":0,"150":0,"1351":0,"152":0,"1348":0,"151":0,"735":0,"16":0,"11":0,"5":0,"1":0,"1461":0,"6":0,"1514":0,"15":0,"8":0,"3":0,"14":0,"2":0,"18":0,"17":0,"20":0,"655":0,"13":0,"4":0,"1542":0,"19":0,"12":0,"9":0,"7":0,"1550":0,"21":0}},"active":{"all":708500,"category":{"1641":0,"10":149159,"150":41941,"1351":22875,"152":22249,"1348":48845,"151":44987,"735":72250,"16":40032,"11":10994,"5":5182,"1":2384,"1461":1405,"6":3049,"1514":14606,"15":7849,"8":27020,"3":41105,"14":30053,"2":5048,"18":4063,"17":12428,"20":26180,"655":6135,"13":3320,"4":3991,"1542":284,"19":76,"12":7701,"9":263,"7":929,"1550":4992,"21":12959,"0":34146}}},"westore":{"new":{"all":7,"category":{"1641":0,"10":5,"150":1,"1351":0,"152":0,"1348":0,"151":0,"735":0,"16":1,"11":0,"5":0,"1":0,"1461":0,"6":0,"1514":0,"15":0,"8":0,"3":0,"14":0,"2":0,"18":0,"17":0,"20":0,"655":0,"13":0,"4":0,"1542":0,"19":0,"12":0,"9":0,"7":0,"1550":0,"21":0}},"active":{"all":131,"category":{"1641":3,"10":97,"150":6,"1351":1,"152":0,"1348":5,"151":1,"735":0,"16":1,"11":0,"5":0,"1":1,"1461":1,"6":0,"1514":0,"15":2,"8":0,"3":1,"14":1,"2":6,"18":0,"17":0,"20":1,"655":0,"13":2,"4":0,"1542":0,"19":0,"12":0,"9":0,"7":0,"1550":0,"21":1,"0":1}}}}}}';
        $response = json_decode($response,true);

        $this->ReportAchieveRepository->expects($this->at(1))->method('getReport')->will($this->returnValue($response));
        $response = '{"status_code":0,"status_txt":"OK","data":{"date":"2015-02-26","product":{"youstore":{"new":{"all":0,"province":[]},"active":{"all":708500,"province":[708500]}},"westore":{"new":{"all":7,"province":{"1":1,"2":0,"3":3,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"12":0,"13":0,"14":3,"15":0,"17":0,"18":0,"27":0,"40":0,"58":0,"63":0,"69":0,"71":0}},"active":{"all":131,"province":{"1":59,"2":0,"3":3,"4":0,"5":0,"6":0,"7":0,"8":0,"9":0,"10":0,"12":0,"13":0,"14":57,"15":0,"17":0,"18":0,"27":0,"40":0,"58":0,"63":0,"69":0,"71":2,"0":10}}}}}}';
        $response = json_decode($response,true);

        $this->ReportAchieveRepository->expects($this->at(2))->method('getReport')->will($this->returnValue($response));
        $response = '1';
        $this->ReportAchieveRepository->expects($this->at(3))->method('saveReportToMongo')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/report/achieve/save?date=2015-02-26');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
    }

    public function test_saveFail1001()
    {
        $this->ReportAchieveRepository = $this->getMock('ReportAchieveRepository');
        $this->app->instance('ReportAchieveRepository', $this->ReportAchieveRepository);

        $response = '';
        $this->ReportAchieveRepository->expects($this->at(0))->method('getReport')->will($this->returnValue($response));
        $response = '';
        $this->ReportAchieveRepository->expects($this->at(1))->method('getReport')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/report/achieve/save?date=2015-02-26');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);
    }

}
