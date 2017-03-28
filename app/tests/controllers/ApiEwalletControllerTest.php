<?php

class ApiEwalletControllerTest extends ApiTestCase
{
    public function testGetEwallet_Success()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = '[{"id":68,"service":"ewallet","store_id":50013,"uid":"8b3b87b8c6b06579456e2fb474763bd96cb37e0a","account":"8b3b87b8c6b06579456e2fb474763bd96cb37e0a","created_at":"2014-10-30 10:55:46","updated_at":"2014-10-30 10:55:46"}]';
        $response = json_decode($response, true);
        $this->ewalletRepository->expects($this->once())->method('getEwallet')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/ewallet/L1');

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];

        $store_id    = $response['data']['store_id'];
        $email       = $response['data']['email'];
        $wallettoken = $response['data']['wallettoken'];

        $this->assertEquals('0', $status_code);
        $this->assertNotNull($store_id);
        $this->assertNotNull($email);
        $this->assertNotNull($wallettoken);
    }


    public function testGetEwallet_NotFound()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = '[]';
        $response = json_decode($response, true);
        $this->ewalletRepository->expects($this->once())->method('getEwallet')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/ewallet/L1');

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];

        $store_id    = $response['data']['store_id'];
        $email       = $response['data']['email'];
        $wallettoken = $response['data']['wallettoken'];

        $this->assertEquals('1004', $status_code);
        $this->assertNotNull($store_id);
    }

    public function testGetEwallet_NoStore_id()
    {
        $crawler = $this->client->request('GET', 'api/ewallet');

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];

        $this->assertEquals('1003', $status_code);
    }

    public function testGetEwallet_TRXIDSuccess()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = '[{"id":83,"service":"ewallet","store_id":50013,"uid":"8b3b87b8c6b06579456e2fb474763bd96cb37e0a","account":"testalpha05@mailinator.com","created_at":"2014-12-02 13:42:32","updated_at":"2014-12-02 13:42:32"}]';
        $response = json_decode($response, true);
        $this->ewalletRepository->expects($this->once())->method('getEwalletTrxId')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/ewallet/trx_id/L111');

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];

        $trxid  = $response['data']['trxid'];
        $secret = $response['data']['secret'];

        $this->assertEquals('0', $status_code);
        $this->assertNotNull($trxid);
        $this->assertNotNull($secret);
    }

    public function testGetEwallet_TRXIDNotFound()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = '[]';
        $response = json_decode($response, true);
        $this->ewalletRepository->expects($this->once())->method('getEwalletTrxId')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/ewallet/trx_id/L111');

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];

        $this->assertEquals('1004', $status_code);
    }

    public function testGetEwallet_TRXIDNoStore_id()
    {
        $crawler = $this->client->request('GET', 'api/ewallet/trx_id');

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response,true);

        $status_code = $response['status_code'];

        $this->assertEquals('1003', $status_code);
    }

    public function testSaveEwallet_Success()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = 'true';
        $this->ewalletRepository->expects($this->once())->method('LogSave')->will($this->returnValue($response));

        $parameter = array(
                'TrxId'      => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'Secret'     => '298d7218bbb4ac7b0f2debba6432cc4f38fc5ec6',
                'Reference1' => 'L33',
                'Email'      => 'testmail@mail.com',
                'Address'    => 'หน้าบ้านมีเซเว่น 123 ปงน้อย ดอยหลวง',
                'WalletType' => 'BUSINESS',
                'GrantType'  => 'RECEIVE MONEY'
                );

        $crawler = $this->client->request('POST', 'api/ewallet', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('true', $response);
    }

    public function testSaveEwallet_NoData()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $parameter = array(
                'TrxId'      => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'Secret'     => '298d7218bbb4ac7b0f2debba6432cc4f38fc5ec6',
                'Address'    => 'หน้าบ้านมีเซเว่น 123 ปงน้อย ดอยหลวง',
                'WalletType' => 'BUSINESS',
                'GrantType'  => 'RECEIVE MONEY'
                );

        $crawler = $this->client->request('POST', 'api/ewallet', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

    public function testSaveEwallet_LogSaveFail()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = 'false';
        $this->ewalletRepository->expects($this->once())->method('LogSave')->will($this->returnValue($response));

        $parameter = array(
                'TrxId'      => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'Secret'     => '298d7218bbb4ac7b0f2debba6432cc4f38fc5ec6',
                'Reference1' => 'L33',
                'Email'      => 'testmail@mail.com',
                'Address'    => 'หน้าบ้านมีเซเว่น 123 ปงน้อย ดอยหลวง',
                'WalletType' => 'BUSINESS',
                'GrantType'  => 'RECEIVE MONEY'
                );

        $crawler = $this->client->request('POST', 'api/ewallet', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

    public function testReceiveEwallet_NoData()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $parameter = array();

        $crawler = $this->client->request('POST', 'api/ewallet/receive', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

    public function testReceiveEwallet_NoShopId()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $parameter = array(
                'ResponseCode' => '0',
                'TrxId'        => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A'
                );

        $crawler = $this->client->request('POST', 'api/ewallet/receive', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

    public function testReceiveEwallet_NoShopName()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);


        $parameter = array(
                'ResponseCode' => '0',
                'TrxId'        => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'ShopId'       => 'L1',
                );

        $crawler = $this->client->request('POST', 'api/ewallet/receive', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

    public function testReceiveEwallet_NoWalletToken()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);


        $parameter = array(
                'ResponseCode' => '0',
                'TrxId'        => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'ShopId'       => 'L1',
                'ShopName'     => 'Test store by B',
                );

        $crawler = $this->client->request('POST', 'api/ewallet/receive', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

    public function testReceiveEwallet_NoWalletEmail()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $parameter = array(
                'ResponseCode' => '0',
                'TrxId'        => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'ShopId'       => 'L1',
                'ShopName'     => 'Test store by B',
                'Reference3'   => 'REF_3',
                'WalletToken'  => 'f06f1ce26fcc3441dcdb6b96f071a3f9a1ae3d38',
                );

        $crawler = $this->client->request('POST', 'api/ewallet/receive', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

    public function testReceiveEwallet_Success()
    {
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);

        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = 'true';
        $this->ewalletRepository->expects($this->once())->method('LogSave')->will($this->returnValue($response));
        $this->ewalletRepository->expects($this->once())->method('saveStoreConnect')->will($this->returnValue($response));

        $response = 'true';
        $this->cachedRepository->expects($this->any())->method('clear')->will($this->returnValue($response));


        $parameter = array(
                'ResponseCode'       => '0',
                'TrxId'              => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'ShopId'             => 'L1',
                'ShopName'           => 'Test store by B',
                'Reference3'         => 'REF_3',
                'WalletToken'        => 'f06f1ce26fcc3441dcdb6b96f071a3f9a1ae3d38',
                'WalletEmail'        => 'mymail@mail.com',
                'WalletMobileNumber' => '0822233445',
                'ResponseTimestamp'  => '03-11-2014 17:32:52',
                'Message'            => 'Success',
                'Secret'             => '4b462046cba07cbe38144e3ba10e5376326276d9'
                );

        $crawler = $this->client->request('POST', 'api/ewallet/receive', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('true', $response);
    }

    public function testReceiveEwallet_ShopidNotInt()
    {
        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = 'true';
        $this->ewalletRepository->expects($this->once())->method('LogSave')->will($this->returnValue($response));

        $parameter = array(
                'ResponseCode'       => '0',
                'TrxId'              => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'ShopId'             => '1',
                'ShopName'           => 'Test store by B',
                'Reference3'         => 'REF_3',
                'WalletToken'        => 'f06f1ce26fcc3441dcdb6b96f071a3f9a1ae3d38',
                'WalletEmail'        => 'mymail@mail.com',
                'WalletMobileNumber' => '0822233445',
                'ResponseTimestamp'  => '03-11-2014 17:32:52',
                'Message'            => 'Success',
                'Secret'             => '4b462046cba07cbe38144e3ba10e5376326276d9'
                );

        $crawler = $this->client->request('POST', 'api/ewallet/receive', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

    public function testReceiveEwallet_Fail()
    {
        $this->cachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cachedRepository);

        $this->ewalletRepository = $this->getMock('EwalletRepository');
        $this->app->instance('EwalletRepository', $this->ewalletRepository);

        $response = 'false';
        $this->ewalletRepository->expects($this->once())->method('LogSave')->will($this->returnValue($response));

        $response = 'true';
        $this->cachedRepository->expects($this->any())->method('clear')->will($this->returnValue($response));


        $parameter = array(
                'ResponseCode'       => '0',
                'TrxId'              => '20140909112808-83409E0E-C048-996A-B994-C259122EE30A',
                'ShopId'             => 'L1',
                'ShopName'           => 'Test store by B',
                'Reference3'         => 'REF_3',
                'WalletToken'        => 'f06f1ce26fcc3441dcdb6b96f071a3f9a1ae3d38',
                'WalletEmail'        => 'mymail@mail.com',
                'WalletMobileNumber' => '0822233445',
                'ResponseTimestamp'  => '03-11-2014 17:32:52',
                'Message'            => 'Success',
                'Secret'             => '4b462046cba07cbe38144e3ba10e5376326276d9'
                );

        $crawler = $this->client->request('POST', 'api/ewallet/receive', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $this->assertEquals('false', $response);
    }

}
