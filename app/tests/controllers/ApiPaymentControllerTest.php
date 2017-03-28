<?php

class ApiPaymentControllerTest extends ApiTestCase
{
    public function testGetPayment_Success_OnCache()
    {
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);

        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $response = '{"payment_channel":[{"company":"ewallet","sof":[{"sof_code":"ATM","sof_text":"ATM"},{"sof_code":"BANKTRANS","sof_text":"Bank Tranfer"},{"sof_code":"IBANK","sof_text":"I Banking"},{"sof_code":"CCW","sof_text":"Credit Card"}]}]}';
        $response = json_decode($response, true);
        $this->cachedRepository->expects($this->once())->method('get')->will($this->returnValue($response));

        $parameter = array(
                'store_id' => '1',
                'apikey'   => '467f27e1d63'
            );

        $crawler = $this->client->request('GET', 'api/payment', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $sof         = $response['data']['payment_channel']['0']['sof'];

        $countSOF = count($sof);

        $this->assertEquals('0', $status_code);
        $this->assertGreaterThan(2, $countSOF);
    }

    public function testGetPayment_Success_NoCache()
    {
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);

        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $mock = '';
        $this->cachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $response = '[{"id":3,"store_id":1,"user_id":205,"resource":"ewallet","metafield":"{\"sof\":[{\"sof_code\":\"ATM\",\"sof_text\":\"ATM\",\"sof_status\":\"true\"},{\"sof_code\":\"BANKTRANS\",\"sof_text\":\"Bank Tranfer\",\"sof_status\":\"true\"},{\"sof_code\":\"IBANK\",\"sof_text\":\"I Banking\",\"sof_status\":\"true\"},{\"sof_code\":\"CCW\",\"sof_text\":\"Credit Card\",\"sof_status\":\"false\"}]}","position":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-09-11 07:39:25","updated_at":"2014-09-12 06:22:45","storeconnect":[{"id":23,"service":"ewallet","store_id":1,"uid":19,"account":"19befc1e9d613cea5e5fa799ecf6bdab1b191f04","created_at":"2014-09-08 09:20:03","updated_at":"2014-09-08 09:20:03"}]},{"id":"4","store_id":"1","user_id":"205","resource":"ewallet","metafield":"","position":"0","status":"1","created_by":"0","updated_by":"0","created_at":"2014-09-08 07:39:25","updated_at":"2014-09-09 06:22:45","storeconnect":[{"id":"25","service":"paypal","store_id":"1","uid":"20","account":"","created_at":"2014-09-08 09:22:03","updated_at":"2014-09-08 09:42:03"}]}]';
        $this->paymentRepository->expects($this->once())->method('getStoreConnect')->will($this->returnValue($response));

        $parameter = array(
                'store_id' => '1',
                'apikey'   => '467f27e1d63'
            );

        $crawler = $this->client->request('GET', 'api/payment', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $sof         = $response['data']['payment_channel']['0']['sof'];

        $countSOF = count($sof);

        $this->assertEquals('0', $status_code);
        $this->assertGreaterThan(2, $countSOF);
    }

    public function testGetPayment_Success_NoData()
    {
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);

        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $mock = '';
        $this->cachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $response = '[]';
        $this->paymentRepository->expects($this->once())->method('getStoreConnect')->will($this->returnValue($response));

        $parameter = array(
                'store_id' => '1',
                'apikey'   => '467f27e1d63'
            );

        $crawler = $this->client->request('GET', 'api/payment', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];

        $this->assertEquals('1004', $status_code);
    }

    public function testGetPayment_noStoreID()
    {
        $crawler = $this->client->request('GET', 'api/payment');

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['message'];

        $msgShouldBe = 'The store id field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testGetPayment_noUserId()
    {
        $parameter = array(
                'store_id' => '1'
            );

        $crawler = $this->client->request('GET', 'api/payment', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['message'];

        $msgShouldBe = 'The user id field is required when apikey is not present.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testGetPayment_wrongAPIkey()
    {
        $parameter = array(
                'store_id' => '1',
                'apikey'   => '123'
            );

        $crawler = $this->client->request('GET', 'api/payment', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['message'];

        $msgShouldBe = 'api not match';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostPayment_noData()
    {
        $parameter = array();

        $crawler = $this->client->request('POST', 'api/payment', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The store id field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostPayment_noUserID()
    {
        $parameter = array(
                    'store_id'  => '1',
                );

        $crawler = $this->client->request('POST', 'api/payment/', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The user id field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostPayment_noResource()
    {
        $parameter = array(
                    'store_id' => '1',
                    'user_id'  => '205',
                );

        $crawler = $this->client->request('POST', 'api/payment/', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The resource field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostPayment_wrongResource()
    {
        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $response = '[]';
        $this->paymentRepository->expects($this->once())->method('getDataPayment')->will($this->returnValue($response));

        $parameter = array(
                    'store_id' => '1',
                    'user_id'  => '205',
                    'resource' => 'paypal'
                );

        $crawler = $this->client->request('POST', 'api/payment/', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['status_txt'];

        $msgShouldBe = 'Insert data error';

        $this->assertEquals('1005', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostPayment_Success()
    {
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);

        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $this->managequeueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->managequeueRepository);

        $response = '[]';
        $this->paymentRepository->expects($this->once())->method('getDataPayment')->will($this->returnValue($response));

        $response = '33';
        $this->paymentRepository->expects($this->once())->method('insertDataPayment')->will($this->returnValue($response));

        $response = true;
        $this->cachedRepository->expects($this->once())->method('clear')->will($this->returnValue($response));

        $response = true;
        $this->managequeueRepository->expects($this->once())->method('syncShop')->will($this->returnValue($response));

        $parameter = array(
                    'store_id' => '1',
                    'user_id'  => '205',
                    'resource' => 'ewallet'
                );

        $crawler = $this->client->request('POST', 'api/payment/', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $payment_id  = $response['data']['payment_id'];

        $this->assertEquals('0', $status_code);
        $this->assertEquals('33', $payment_id);
    }

    public function testPostPayment_Duplicate_data()
    {
        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $response = '[{"id":3,"store_id":1,"user_id":205,"resource":"ewallet","metafield":"{\"sof\":[{\"sof_code\":\"ATM\",\"sof_text\":\"ATM\",\"sof_status\":\"true\"},{\"sof_code\":\"BANKTRANS\",\"sof_text\":\"Bank Tranfer\",\"sof_status\":\"true\"},{\"sof_code\":\"IBANK\",\"sof_text\":\"I Banking\",\"sof_status\":\"true\"},{\"sof_code\":\"CCW\",\"sof_text\":\"Credit Card\",\"sof_status\":\"false\"}]}","position":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-09-11 07:39:25","updated_at":"2014-10-30 15:56:05"}]';
        $this->paymentRepository->expects($this->once())->method('getDataPayment')->will($this->returnValue($response));

        $parameter = array(
                    'store_id' => '1',
                    'user_id'  => '205',
                    'resource' => 'ewallet'
                );

        $crawler = $this->client->request('POST', 'api/payment/', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['status_txt'];

        $msgShouldBe = 'Duplicate data';

        $this->assertEquals('1010', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPutPayment_NoParameter()
    {
        $parameter = array();

        $crawler = $this->client->request('PUT', 'api/payment/1', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The user id field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPutPayment_NoResoure()
    {
        $parameter = array(
                'user_id'  => '205',
            );

        $crawler = $this->client->request('PUT', 'api/payment/1', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The resource field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPutPayment_NoSof_code()
    {
        $parameter = array(
                'user_id'  => '205',
                'resource' => 'ewallet',
            );

        $crawler = $this->client->request('PUT', 'api/payment/1', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The sof code field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPutPayment_NoStatus()
    {
        $parameter = array(
                'user_id'  => '205',
                'resource' => 'ewallet',
                'sof_code' => 'CCW',
            );

        $crawler = $this->client->request('PUT', 'api/payment/1', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The status field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPutPayment_Success()
    {
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);

        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $this->managequeueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->managequeueRepository);

        $response = '[{"id":3,"store_id":1,"user_id":205,"resource":"ewallet","metafield":"{\"sof\":[{\"sof_code\":\"ATM\",\"sof_text\":\"ATM\",\"sof_status\":\"true\"},{\"sof_code\":\"BANKTRANS\",\"sof_text\":\"Bank Tranfer\",\"sof_status\":\"true\"},{\"sof_code\":\"IBANK\",\"sof_text\":\"I Banking\",\"sof_status\":\"true\"},{\"sof_code\":\"CCW\",\"sof_text\":\"Credit Card\",\"sof_status\":\"false\"}]}","position":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-09-11 07:39:25","updated_at":"2014-10-30 15:56:05"}]';
        $this->paymentRepository->expects($this->once())->method('getDataPayment')->will($this->returnValue($response));

        $response = '';
        $this->paymentRepository->expects($this->once())->method('updateDataPayment')->will($this->returnValue($response));

        $response = '';
        $this->cachedRepository->expects($this->once())->method('clear')->will($this->returnValue($response));

        $response = true;
        $this->managequeueRepository->expects($this->once())->method('syncShop')->will($this->returnValue($response));

        $parameter = array(
                'user_id'  => '205',
                'resource' => 'ewallet',
                'sof_code' => 'CCW',
                'status'   => 'false'
            );

        $crawler = $this->client->request('PUT', 'api/payment/1', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];

        $this->assertEquals('0', $status_code);
    }

    public function testPutPayment_NoData()
    {
        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $response = '[]';
        $this->paymentRepository->expects($this->once())->method('getDataPayment')->will($this->returnValue($response));

        $parameter = array(
                'user_id'  => '2052',
                'resource' => 'ewallet',
                'sof_code' => 'CCW',
                'status'   => 'false'
            );

        $crawler = $this->client->request('PUT', 'api/payment/1', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['status_txt'];

        $msgShouldBe = 'Data not found';

        $this->assertEquals('1004', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPutPayment_noIDPayment()
    {
        $this->paymentRepository = $this->getMock('PaymentRepository');
        $this->app->instance('PaymentRepository', $this->paymentRepository);

        $response = '[{"id":0,"store_id":1,"user_id":205,"resource":"ewallet","metafield":"{\"sof\":[{\"sof_code\":\"ATM\",\"sof_text\":\"ATM\",\"sof_status\":\"true\"},{\"sof_code\":\"BANKTRANS\",\"sof_text\":\"Bank Tranfer\",\"sof_status\":\"true\"},{\"sof_code\":\"IBANK\",\"sof_text\":\"I Banking\",\"sof_status\":\"true\"},{\"sof_code\":\"CCW\",\"sof_text\":\"Credit Card\",\"sof_status\":\"false\"}]}","position":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-09-11 07:39:25","updated_at":"2014-10-30 15:56:05"}]';
        $this->paymentRepository->expects($this->once())->method('getDataPayment')->will($this->returnValue($response));

        $parameter = array(
                'user_id'  => '205',
                'resource' => 'ewallet',
                'sof_code' => 'CCW',
                'status'   => 'false'
            );

        $crawler = $this->client->request('PUT', 'api/payment/1', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];
        $msg         = $response['status_txt'];

        $msgShouldBe = 'Update data error';

        $this->assertEquals('1006', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

}
