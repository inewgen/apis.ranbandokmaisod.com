<?php

class ApiProductShareControllerTest extends ApiTestCase
{

    public function testGetIndexSuccess()
    {

        $this->facebookRepository = $this->getMock('FacebookRepository');
        $this->app->instance('FacebookRepository', $this->facebookRepository);

        $response = '[{"id":11,"store_id":111,"product_id":512,"status":0,"meta":"","lasted_share":null,"created_at":"2015-02-15 15:45:20","updated_at":"2015-02-15 15:45:24"}]';
        $response = json_decode($response);
        $this->facebookRepository->expects($this->once())->method('getData')->will($this->returnValue($response));

        $store_connect = '{"id":99,"service":"facebook","store_id":111,"uid":"100000110687047","account":"wilasinee45@gmail.com","access_token":"CAAUK5ddtZAeQBAF7q7QZCacTiOT0vRZAXUZAi9yzZAMXmWZAHilcw5K4uQ3PiOi1P9hzriOymWy2XIaPHn7eOLRC84Ha9s2nm2jODhn8qWJK1izqyeTzAZAQmCTnp2G73TV2JQFt77377KKN0Idsd4VEndMY0UjAIvP3uXjMHVisS2F7zP281v0VoF5oDvIQH7YPpshyGbbNw0DqOfn5HnyMbRqdppvLkUZD","option":"a:6:{s:4:\"page\";a:3:{i:0;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:33:\"Apps Test + Page Manage Community\";s:2:\"id\";s:15:\"201198380010381\";}i:1;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:14:\"SaveShopOnline\";s:2:\"id\";s:12:\"379409101856\";}i:2;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:9:\"HOME SHOP\";s:2:\"id\";s:15:\"366920876724892\";}}s:12:\"display_name\";s:12:\"Wilasinee Na\";s:10:\"first_name\";s:9:\"Wilasinee\";s:9:\"last_name\";s:2:\"Na\";s:4:\"link\";s:39:\"http:\/\/www.facebook.com\/100000110687047\";s:8:\"share_to\";s:8:\"timeline\";}","status":1,"created_at":"2015-02-15 15:49:41","updated_at":"2015-02-15 16:00:41"}';
        $store_connect = json_decode($store_connect);
        $this->facebookRepository->expects($this->once())->method('getConnectFbProfile')->will($this->returnValue($store_connect));

        $parameter['store_id'] = 111;
        $parameter['product_id'] = 512;
        $crawler = $this->client->request('GET', 'api/productshare', $parameter);

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);

    }

    public function testGetIndexinCaseGetConnection()
    {

        $this->facebookRepository = $this->getMock('FacebookRepository');
        $this->app->instance('FacebookRepository', $this->facebookRepository);

        $store_connect = '{"id":99,"service":"facebook","store_id":111,"uid":"100000110687047","account":"wilasinee45@gmail.com","access_token":"CAAUK5ddtZAeQBAF7q7QZCacTiOT0vRZAXUZAi9yzZAMXmWZAHilcw5K4uQ3PiOi1P9hzriOymWy2XIaPHn7eOLRC84Ha9s2nm2jODhn8qWJK1izqyeTzAZAQmCTnp2G73TV2JQFt77377KKN0Idsd4VEndMY0UjAIvP3uXjMHVisS2F7zP281v0VoF5oDvIQH7YPpshyGbbNw0DqOfn5HnyMbRqdppvLkUZD","option":"a:6:{s:4:\"page\";a:3:{i:0;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:33:\"Apps Test + Page Manage Community\";s:2:\"id\";s:15:\"201198380010381\";}i:1;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:14:\"SaveShopOnline\";s:2:\"id\";s:12:\"379409101856\";}i:2;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:9:\"HOME SHOP\";s:2:\"id\";s:15:\"366920876724892\";}}s:12:\"display_name\";s:12:\"Wilasinee Na\";s:10:\"first_name\";s:9:\"Wilasinee\";s:9:\"last_name\";s:2:\"Na\";s:4:\"link\";s:39:\"http:\/\/www.facebook.com\/100000110687047\";s:8:\"share_to\";s:8:\"timeline\";}","status":1,"created_at":"2015-02-15 15:49:41","updated_at":"2015-02-15 16:00:41"}';
        $store_connect = json_decode($store_connect);
        $this->facebookRepository->expects($this->once())->method('getConnectFbProfile')->will($this->returnValue($store_connect));

        $parameter['store_id'] = 111;
        $crawler = $this->client->request('GET', 'api/productshare', $parameter);

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);

    }

    public function testGetIndexinCaseNoHaveShareTo()
    {

        $this->facebookRepository = $this->getMock('FacebookRepository');
        $this->app->instance('FacebookRepository', $this->facebookRepository);

        $store_connect = '{"id":99,"service":"facebook","store_id":111,"uid":"100000110687047","account":"wilasinee45@gmail.com","access_token":"CAAUK5ddtZAeQBAF7q7QZCacTiOT0vRZAXUZAi9yzZAMXmWZAHilcw5K4uQ3PiOi1P9hzriOymWy2XIaPHn7eOLRC84Ha9s2nm2jODhn8qWJK1izqyeTzAZAQmCTnp2G73TV2JQFt77377KKN0Idsd4VEndMY0UjAIvP3uXjMHVisS2F7zP281v0VoF5oDvIQH7YPpshyGbbNw0DqOfn5HnyMbRqdppvLkUZD","option":"a:6:{s:4:\"page\";a:3:{i:0;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:33:\"Apps Test + Page Manage Community\";s:2:\"id\";s:15:\"201198380010381\";}i:1;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:14:\"SaveShopOnline\";s:2:\"id\";s:12:\"379409101856\";}i:2;O:8:\"stdClass\":3:{s:8:\"can_post\";b:1;s:4:\"name\";s:9:\"HOME SHOP\";s:2:\"id\";s:15:\"366920876724892\";}}s:12:\"display_name\";s:12:\"Wilasinee Na\";s:10:\"first_name\";s:9:\"Wilasinee\";s:9:\"last_name\";s:2:\"Na\";s:4:\"link\";s:39:\"http:\/\/www.facebook.com\/100000110687047\";s:8:\"share_to\";s:8:\"timeline\";}","status":0,"created_at":"2015-02-15 15:49:41","updated_at":"2015-02-15 16:00:41"}';
        $store_connect = json_decode($store_connect);
        $this->facebookRepository->expects($this->once())->method('getConnectFbProfile')->will($this->returnValue($store_connect));

        $parameter['store_id'] = 111;
        $crawler = $this->client->request('GET', 'api/productshare', $parameter);

        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);

    }

    public function testInvalidStoreID()
    {

        $parameter['store_id'] = 'x';
        $crawler = $this->client->request('GET', 'api/productshare', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('The store id must be an integer.', $json);
    }
}
