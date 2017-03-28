<?php

class ApiStoreRegisterControllerTest extends ApiTestCase
{
    public function testPostStoreRegister_noData()
    {
        $parameter = array();

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The userid field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noTrueid()
    {
        $parameter = array(
                'userid' => '114679'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The trueid field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noEmail()
    {
        $parameter = array(
                'userid' => '114679',
                'trueid' => '205'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The email field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_EmailNotExist_OldEmail()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = false;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid' => '114679',
                'trueid' => '205',
                'email'  => 'testmail@mail.com'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'validation.olduser_must_exist';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_EmailExist()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid' => '114679',
                'trueid' => '205',
                'email'  => 'wlsstore2014@gmail.com'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The first name field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noLastName()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'     => '114679',
                'trueid'     => '205',
                'email'      => 'wlsstore2014@gmail.com',
                'first_name' => 'name first'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The last name field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noDisplayName()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'     => '114679',
                'trueid'     => '205',
                'email'      => 'wlsstore2014@gmail.com',
                'first_name' => 'name first',
                'last_name'  => 'name last',
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The display name field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noPhone()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The phone field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noIDcard()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The idcard field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_LessThanIDcard()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '12121212'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'validation.idcard';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_MoreThanIDcard()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '1212121222211212'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'validation.idcard';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_notValidIDcard()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2165311121123'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'validation.idcard';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noIP()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The ip field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSlug()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The slug field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_SlugReserved()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1',
                'slug'         => 'www'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'validation.slug_not_allowed';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_SlugsExist()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 1;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1',
                'slug'         => 'nameshop'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'validation.slug_must_not_exist';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSName()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1',
                'slug'         => 'nameshop'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s name field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSCategory()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1',
                'slug'         => 'nameshop',
                's_name'       => 'Name Shop'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s category field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSCategoryText()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1',
                'slug'         => 'nameshop',
                's_name'       => 'Name Shop',
                's_category'   => 'Name Category',
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s category must be a number.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSAddress1()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1',
                'slug'         => 'nameshop',
                's_name'       => 'Name Shop',
                's_category'   => 10,
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s address1 field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSDistrict()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1',
                'slug'         => 'nameshop',
                's_name'       => 'Name Shop',
                's_category'   => 10,
                's_address1'   => 'near road'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s district field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSDistrict_id()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'       => '114679',
                'trueid'       => '205',
                'email'        => 'wlsstore2014@gmail.com',
                'first_name'   => 'name first',
                'last_name'    => 'name last',
                'display_name' => 'name display',
                'phone'        => '028917822',
                'idcard'       => '2065300127457',
                'ip'           => '192.0.0.1',
                'slug'         => 'nameshop',
                's_name'       => 'Name Shop',
                's_category'   => 10,
                's_address1'   => 'near road',
                's_district'   => 'on road'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s district id field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSCity()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s city field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSCity_id()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s city id field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSProvince()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s province field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSProvince_id()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s province id field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSPostcode()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                's_province_id' => 16,
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s postcode field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSEmail()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                's_province_id' => 16,
                's_postcode'    => 10123,
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s email field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSPhone()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                's_province_id' => 16,
                's_postcode'    => 10123,
                's_email'       => 'aaa@aaa.com'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s phone field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSCountry()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                's_province_id' => 16,
                's_postcode'    => 10123,
                's_email'       => 'aaa@aaa.com',
                's_phone'       => '025523451'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s country field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_noSCountry_text()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                's_province_id' => 16,
                's_postcode'    => 10123,
                's_email'       => 'aaa@aaa.com',
                's_phone'       => '025523451',
                's_country'     => 'in world'
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The s country must be a number.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }


    public function testPostStoreRegister_Fail_haveStoreAlready()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $response = '{"status_code":0,"status_txt":"Success","data":{"display_name":"name display","first_name":"name first","last_name":"name last","phone":"0812223333","idcard":"1212121212121","id":"114679"}}';
        $this->storeRegisterRepository->expects($this->once())->method('updateAccount')->will($this->returnValue($response));

        $response = 1;
        $this->storeRegisterRepository->expects($this->once())->method('checkHaveStore')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                's_province_id' => 16,
                's_postcode'    => 10123,
                's_email'       => 'aaa@aaa.com',
                's_phone'       => '025523451',
                's_country'     => 18
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['status_txt'];

        $msgShouldBe = 'Duplicate data';

        $this->assertEquals('1010', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_Fail_RegisterStore()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $response = '{"status_code":0,"status_txt":"Success","data":{"display_name":"name display","first_name":"name first","last_name":"name last","phone":"0812223333","idcard":"1212121212121","id":"114679"}}';
        $this->storeRegisterRepository->expects($this->once())->method('updateAccount')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkHaveStore')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('registerStore')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                's_province_id' => 16,
                's_postcode'    => 10123,
                's_email'       => 'aaa@aaa.com',
                's_phone'       => '025523451',
                's_country'     => 18
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['status_txt'];

        $msgShouldBe = 'Error Register store';

        $this->assertEquals('1013', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testPostStoreRegister_Success()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('checkOldEmailMustExist')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkSlugExist')->will($this->returnValue($response));

        $response = '{"status_code":0,"status_txt":"Success","data":{"display_name":"name display","first_name":"name first","last_name":"name last","phone":"0812223333","idcard":"1212121212121","id":"114679"}}';
        $this->storeRegisterRepository->expects($this->once())->method('updateAccount')->will($this->returnValue($response));

        $response = 0;
        $this->storeRegisterRepository->expects($this->once())->method('checkHaveStore')->will($this->returnValue($response));

        $response = 2;
        $this->storeRegisterRepository->expects($this->once())->method('registerStore')->will($this->returnValue($response));

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('registerStoreAddress')->will($this->returnValue($response));

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('bindUserStore')->will($this->returnValue($response));

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('addConnect')->will($this->returnValue($response));

        $response = true;
        $this->storeRegisterRepository->expects($this->once())->method('createDefaultData')->will($this->returnValue($response));

        $parameter = array(
                'userid'        => '114679',
                'trueid'        => '205',
                'email'         => 'wlsstore2014@gmail.com',
                'first_name'    => 'name first',
                'last_name'     => 'name last',
                'display_name'  => 'name display',
                'phone'         => '028917822',
                'idcard'        => '2065300127457',
                'ip'            => '192.0.0.1',
                'slug'          => 'nameshop',
                's_name'        => 'Name Shop',
                's_category'    => 10,
                's_address1'    => 'near road',
                's_district'    => 'on road',
                's_district_id' => 12,
                's_city'        => 'near river',
                's_city_id'     => 14,
                's_province'    => 'on earth',
                's_province_id' => 16,
                's_postcode'    => 10123,
                's_email'       => 'aaa@aaa.com',
                's_phone'       => '025523451',
                's_country'     => 18
                );

        $crawler = $this->client->request('POST', 'api/store/register', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['status_txt'];
        $dataStoreID = $response['data']['store']['store_id'];

        $msgShouldBe = 'Success';

        $this->assertEquals('0', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
        $this->assertGreaterThan(0, $dataStoreID);
    }

    public function testGetProvince_Success()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = '[{"id":1,"country_id":209,"name":"\u0e01\u0e23\u0e38\u0e07\u0e40\u0e17\u0e1e\u0e21\u0e2b\u0e32\u0e19\u0e04\u0e23","name_1":"Bangkok"},{"id":2,"country_id":209,"name":"\u0e01\u0e23\u0e30\u0e1a\u0e35\u0e48","name_1":"Krabi"},{"id":3,"country_id":209,"name":"\u0e01\u0e32\u0e0d\u0e08\u0e19\u0e1a\u0e38\u0e23\u0e35","name_1":"Kanchanaburi"},{"id":4,"country_id":209,"name":"\u0e01\u0e32\u0e2c\u0e2a\u0e34\u0e19\u0e18\u0e38\u0e4c","name_1":"Kalasin"},{"id":5,"country_id":209,"name":"\u0e01\u0e33\u0e41\u0e1e\u0e07\u0e40\u0e1e\u0e0a\u0e23","name_1":"Kamphaeng Phet"},{"id":6,"country_id":209,"name":"\u0e02\u0e2d\u0e19\u0e41\u0e01\u0e48\u0e19","name_1":"Khon Kaen"},{"id":7,"country_id":209,"name":"\u0e08\u0e31\u0e19\u0e17\u0e1a\u0e38\u0e23\u0e35","name_1":"Chanthaburi"},{"id":8,"country_id":209,"name":"\u0e09\u0e30\u0e40\u0e0a\u0e34\u0e07\u0e40\u0e17\u0e23\u0e32","name_1":"Chachoengsao"},{"id":9,"country_id":209,"name":"\u0e0a\u0e31\u0e22\u0e19\u0e32\u0e17","name_1":"Chai Nat"},{"id":10,"country_id":209,"name":"\u0e0a\u0e31\u0e22\u0e20\u0e39\u0e21\u0e34","name_1":"Chaiyaphum"},{"id":11,"country_id":209,"name":"\u0e0a\u0e38\u0e21\u0e1e\u0e23","name_1":"Chumphon"},{"id":12,"country_id":209,"name":"\u0e0a\u0e25\u0e1a\u0e38\u0e23\u0e35","name_1":"Chon Buri"},{"id":13,"country_id":209,"name":"\u0e40\u0e0a\u0e35\u0e22\u0e07\u0e43\u0e2b\u0e21\u0e48","name_1":"Chiang Mai"},{"id":14,"country_id":209,"name":"\u0e40\u0e0a\u0e35\u0e22\u0e07\u0e23\u0e32\u0e22","name_1":"Chiang Rai"},{"id":15,"country_id":209,"name":"\u0e15\u0e23\u0e31\u0e07","name_1":"Trang"},{"id":16,"country_id":209,"name":"\u0e15\u0e23\u0e32\u0e14","name_1":"Trat"},{"id":17,"country_id":209,"name":"\u0e15\u0e32\u0e01","name_1":"Tak"},{"id":18,"country_id":209,"name":"\u0e19\u0e04\u0e23\u0e19\u0e32\u0e22\u0e01","name_1":"Nakhon Nayok"},{"id":19,"country_id":209,"name":"\u0e19\u0e04\u0e23\u0e1b\u0e10\u0e21","name_1":"Nakhon Pathom"},{"id":20,"country_id":209,"name":"\u0e19\u0e04\u0e23\u0e1e\u0e19\u0e21","name_1":"Nakhon Phanom"},{"id":21,"country_id":209,"name":"\u0e19\u0e04\u0e23\u0e23\u0e32\u0e0a\u0e2a\u0e35\u0e21\u0e32","name_1":"Nakhon Ratchasima"},{"id":22,"country_id":209,"name":"\u0e19\u0e04\u0e23\u0e28\u0e23\u0e35\u0e18\u0e23\u0e23\u0e21\u0e23\u0e32\u0e0a","name_1":"Nakhon Si Thammarat"},{"id":23,"country_id":209,"name":"\u0e19\u0e04\u0e23\u0e2a\u0e27\u0e23\u0e23\u0e04\u0e4c","name_1":"Nakhon Sawan"},{"id":24,"country_id":209,"name":"\u0e19\u0e23\u0e32\u0e18\u0e34\u0e27\u0e32\u0e2a","name_1":"Narathiwat"},{"id":25,"country_id":209,"name":"\u0e19\u0e48\u0e32\u0e19","name_1":"Nan"},{"id":26,"country_id":209,"name":"\u0e19\u0e19\u0e17\u0e1a\u0e38\u0e23\u0e35","name_1":"Nonthaburi"},{"id":27,"country_id":209,"name":"\u0e1a\u0e38\u0e23\u0e35\u0e23\u0e31\u0e21\u0e22\u0e4c","name_1":"Buri Ram"},{"id":28,"country_id":209,"name":"\u0e1b\u0e23\u0e30\u0e08\u0e27\u0e1a\u0e04\u0e35\u0e23\u0e35\u0e02\u0e31\u0e19\u0e18\u0e4c","name_1":"Prachuap Khiri Khan"},{"id":29,"country_id":209,"name":"\u0e1b\u0e17\u0e38\u0e21\u0e18\u0e32\u0e19\u0e35","name_1":"Pathum Thani"},{"id":30,"country_id":209,"name":"\u0e1b\u0e23\u0e32\u0e08\u0e35\u0e19\u0e1a\u0e38\u0e23\u0e35","name_1":"Prachin Buri"},{"id":31,"country_id":209,"name":"\u0e1b\u0e31\u0e15\u0e15\u0e32\u0e19\u0e35","name_1":"Pattani"},{"id":32,"country_id":209,"name":"\u0e1e\u0e30\u0e40\u0e22\u0e32","name_1":"Phayao"},{"id":33,"country_id":209,"name":"\u0e1e\u0e31\u0e07\u0e07\u0e32","name_1":"Phang\u2013nga"},{"id":34,"country_id":209,"name":"\u0e1e\u0e34\u0e08\u0e34\u0e15\u0e23","name_1":"Phichit"},{"id":35,"country_id":209,"name":"\u0e1e\u0e34\u0e29\u0e13\u0e38\u0e42\u0e25\u0e01","name_1":"Phitsanulok"},{"id":36,"country_id":209,"name":"\u0e40\u0e1e\u0e0a\u0e23\u0e1a\u0e38\u0e23\u0e35","name_1":"Phetchaburi"},{"id":37,"country_id":209,"name":"\u0e40\u0e1e\u0e0a\u0e23\u0e1a\u0e39\u0e23\u0e13\u0e4c","name_1":"Phetchabun"},{"id":38,"country_id":209,"name":"\u0e41\u0e1e\u0e23\u0e48","name_1":"Phrae"},{"id":39,"country_id":209,"name":"\u0e1e\u0e31\u0e17\u0e25\u0e38\u0e07","name_1":"Phatthalung"},{"id":40,"country_id":209,"name":"\u0e20\u0e39\u0e40\u0e01\u0e47\u0e15","name_1":"Phuket"},{"id":41,"country_id":209,"name":"\u0e21\u0e2b\u0e32\u0e2a\u0e32\u0e23\u0e04\u0e32\u0e21","name_1":"Maha Sarakham"},{"id":42,"country_id":209,"name":"\u0e21\u0e38\u0e01\u0e14\u0e32\u0e2b\u0e32\u0e23","name_1":"Mukdahan"},{"id":43,"country_id":209,"name":"\u0e41\u0e21\u0e48\u0e2e\u0e48\u0e2d\u0e07\u0e2a\u0e2d\u0e19","name_1":"Mae Hong Son"},{"id":44,"country_id":209,"name":"\u0e22\u0e42\u0e2a\u0e18\u0e23","name_1":"Yasothon"},{"id":45,"country_id":209,"name":"\u0e22\u0e30\u0e25\u0e32","name_1":"Yala"},{"id":46,"country_id":209,"name":"\u0e23\u0e49\u0e2d\u0e22\u0e40\u0e2d\u0e47\u0e14","name_1":"Roi Et"},{"id":47,"country_id":209,"name":"\u0e23\u0e30\u0e19\u0e2d\u0e07","name_1":"Ranong"},{"id":48,"country_id":209,"name":"\u0e23\u0e30\u0e22\u0e2d\u0e07","name_1":"Rayong"},{"id":49,"country_id":209,"name":"\u0e23\u0e32\u0e0a\u0e1a\u0e38\u0e23\u0e35","name_1":"Ratchaburi"},{"id":50,"country_id":209,"name":"\u0e25\u0e1e\u0e1a\u0e38\u0e23\u0e35","name_1":"Lop Buri"},{"id":51,"country_id":209,"name":"\u0e25\u0e33\u0e1b\u0e32\u0e07","name_1":"Lampang"},{"id":52,"country_id":209,"name":"\u0e25\u0e33\u0e1e\u0e39\u0e19","name_1":"Lamphun"},{"id":53,"country_id":209,"name":"\u0e40\u0e25\u0e22","name_1":"Loei"},{"id":54,"country_id":209,"name":"\u0e28\u0e23\u0e35\u0e2a\u0e30\u0e40\u0e01\u0e29","name_1":"Si Sa Ket"},{"id":55,"country_id":209,"name":"\u0e2a\u0e01\u0e25\u0e19\u0e04\u0e23","name_1":"Sakon Nakhon"},{"id":56,"country_id":209,"name":"\u0e2a\u0e07\u0e02\u0e25\u0e32","name_1":"Songkhla"},{"id":57,"country_id":209,"name":"\u0e2a\u0e21\u0e38\u0e17\u0e23\u0e2a\u0e32\u0e04\u0e23","name_1":"Samut Sakhon"},{"id":58,"country_id":209,"name":"\u0e2a\u0e21\u0e38\u0e17\u0e23\u0e1b\u0e23\u0e32\u0e01\u0e32\u0e23","name_1":"Samut Prakan"},{"id":59,"country_id":209,"name":"\u0e2a\u0e21\u0e38\u0e17\u0e23\u0e2a\u0e07\u0e04\u0e23\u0e32\u0e21","name_1":"Samut Songkhram"},{"id":60,"country_id":209,"name":"\u0e2a\u0e23\u0e30\u0e41\u0e01\u0e49\u0e27","name_1":"Sa Kaeo"},{"id":61,"country_id":209,"name":"\u0e2a\u0e23\u0e30\u0e1a\u0e38\u0e23\u0e35","name_1":"Saraburi"},{"id":62,"country_id":209,"name":"\u0e2a\u0e34\u0e07\u0e2b\u0e4c\u0e1a\u0e38\u0e23\u0e35","name_1":"Sing Buri"},{"id":63,"country_id":209,"name":"\u0e2a\u0e38\u0e42\u0e02\u0e17\u0e31\u0e22","name_1":"Sukhothai"},{"id":64,"country_id":209,"name":"\u0e2a\u0e38\u0e1e\u0e23\u0e23\u0e13\u0e1a\u0e38\u0e23\u0e35","name_1":"Suphan Buri"},{"id":65,"country_id":209,"name":"\u0e2a\u0e38\u0e23\u0e32\u0e29\u0e0e\u0e23\u0e4c\u0e18\u0e32\u0e19\u0e35","name_1":"Surat Thani"},{"id":66,"country_id":209,"name":"\u0e2a\u0e38\u0e23\u0e34\u0e19\u0e17\u0e23\u0e4c","name_1":"Surin"},{"id":67,"country_id":209,"name":"\u0e2a\u0e15\u0e39\u0e25","name_1":"Satun"},{"id":68,"country_id":209,"name":"\u0e2b\u0e19\u0e2d\u0e07\u0e04\u0e32\u0e22","name_1":"Nong Khai"},{"id":69,"country_id":209,"name":"\u0e2b\u0e19\u0e2d\u0e07\u0e1a\u0e31\u0e27\u0e25\u0e33\u0e20\u0e39","name_1":"Nong Bua Lam Phu"},{"id":70,"country_id":209,"name":"\u0e2d\u0e33\u0e19\u0e32\u0e08\u0e40\u0e08\u0e23\u0e34\u0e0d","name_1":"Amnat Charoen"},{"id":71,"country_id":209,"name":"\u0e2d\u0e38\u0e14\u0e23\u0e18\u0e32\u0e19\u0e35","name_1":"Udon Thani"},{"id":72,"country_id":209,"name":"\u0e2d\u0e38\u0e15\u0e23\u0e14\u0e34\u0e15\u0e16\u0e4c","name_1":"Uttaradit"},{"id":73,"country_id":209,"name":"\u0e2d\u0e38\u0e17\u0e31\u0e22\u0e18\u0e32\u0e19\u0e35","name_1":"Uthai Thani"},{"id":74,"country_id":209,"name":"\u0e2d\u0e38\u0e1a\u0e25\u0e23\u0e32\u0e0a\u0e18\u0e32\u0e19\u0e35","name_1":"Ubon Ratchathani"},{"id":75,"country_id":209,"name":"\u0e1e\u0e23\u0e30\u0e19\u0e04\u0e23\u0e28\u0e23\u0e35\u0e2d\u0e22\u0e38\u0e18\u0e22\u0e32","name_1":"Phra Nakhon Si Ayutthaya"},{"id":76,"country_id":209,"name":"\u0e2d\u0e48\u0e32\u0e07\u0e17\u0e2d\u0e07","name_1":"Ang Thong"},{"id":77,"country_id":209,"name":"\u0e1a\u0e36\u0e07\u0e01\u0e32\u0e2c","name_1":"Bueng Kan"}]';
        $response = json_decode($response, true);
        $this->storeRegisterRepository->expects($this->once())->method('getProvince')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/store/register/province');

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $record      = $response['data']['record'];

        $total = count($record);

        $this->assertEquals('0', $status_code);
        $this->assertEquals(77, $total);
    }

    public function testCheckIdCard_noData()
    {
        $parameter = array();

        $crawler = $this->client->request('POST', 'api/store/register/checkcard', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The id field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testCheckIdCard_LessThan13()
    {
        $parameter = array(
                'id' => '1212'
                );

        $crawler = $this->client->request('POST', 'api/store/register/checkcard', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The id card must be 13 characters.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testCheckIdCard_MoreThan13()
    {
        $parameter = array(
                'id' => '121212121212121212'
                );

        $crawler = $this->client->request('POST', 'api/store/register/checkcard', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The id card must be 13 characters.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testCheckIdCard_String()
    {
        $parameter = array(
                'id' => 'idcard'
                );

        $crawler = $this->client->request('POST', 'api/store/register/checkcard', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The id must be a number.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testCheckIdCard_notMatch()
    {
        $parameter = array(
                'id' => '2165311121123'
                );

        $crawler = $this->client->request('POST', 'api/store/register/checkcard', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);


        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The id card Fail';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testCheckIdCard_Success()
    {
        $parameter = array(
                'id' => '2065300127457'
                );

        $crawler = $this->client->request('POST', 'api/store/register/checkcard', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['text']['message'];

        $msgShouldBe = 'The id card OK';

        $this->assertEquals('0', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testCheckStore_noData()
    {
        $parameter = array();

        $crawler = $this->client->request('POST', 'api/store/register/checkname', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The name field is required.';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testCheckStore_haveAlready()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = '1';
        $response = json_decode($response, true);
        $this->storeRegisterRepository->expects($this->once())->method('checkStoreName')->will($this->returnValue($response));

        $parameter = array(
            'name' => 'dev-store'
            );

        $crawler = $this->client->request('POST', 'api/store/register/checkname', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();

        $response = json_decode($response, true);

        $status_code = $response['status_code'];
        $msg         = $response['data']['errors']['message'];

        $msgShouldBe = 'The Store name already use';

        $this->assertEquals('1003', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }

    public function testCheckStore_CanUse()
    {
        $this->storeRegisterRepository = $this->getMock('StoreRegisterRepository');
        $this->app->instance('StoreRegisterRepository', $this->storeRegisterRepository);

        $response = 0;
        $response = json_decode($response, true);
        $this->storeRegisterRepository->expects($this->once())->method('checkStoreName')->will($this->returnValue($response));

        $parameter = array(
            'name' => 'dev12'
            );

        $crawler = $this->client->request('POST', 'api/store/register/checkname', $parameter);

        $this->assertTrue($this->client->getResponse()->isOk());

        $response = $this->client->getResponse()->getContent();


        $response = json_decode($response, true);
        $status_code = $response['status_code'];
        $msg         = $response['data']['text']['message'];

        $msgShouldBe = 'Can use This Store name';

        $this->assertEquals('0', $status_code);
        $this->assertEquals($msgShouldBe, $msg);
    }


}
