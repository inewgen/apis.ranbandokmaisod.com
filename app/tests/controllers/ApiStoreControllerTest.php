<?php

class ApiStoreControllerTest extends ApiTestCase
{
    public function testGetIndexSuccess()
    {

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_list.json');

        $data = json_decode($data);
        $data = (array) $data;
        $this->storeRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $mock = '[{"store_id":50023,"language_id":1,"title":"testalpha11","description":"","street":"12132124","district":"\u0e1a\u0e32\u0e07\u0e25\u0e36\u0e01","district_id":1086,"city":"\u0e40\u0e21\u0e37\u0e2d\u0e07\u0e0a\u0e38\u0e21\u0e1e\u0e23","city_id":172,"province":"\u0e0a\u0e38\u0e21\u0e1e\u0e23","province_id":11,"zipcode":"21393","country_id":209,"created_at":"2014-11-06 19:22:03","updated_at":"2014-11-06 19:22:03"}]';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getLanguage')->will($this->returnValue($mock));

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock, true);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store?domain=xxx');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndex_DomainNotfound()
    {

        $crawler = $this->client->request('GET', 'api/store?domain=');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function testGetIndexSuccess_WithPlazaCate()
    {

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_list.json');
        
        $data = json_decode($data);
        $data = (array) $data;
        $this->storeRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $crawler = $this->client->request('GET', 'api/store?fields=id,slug,sales_id,essential_status,plaza_category');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndexSortTitleSuccess()
    {

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_list.json');
        $data = json_decode($data);
        $data = (array) $data;
        $this->storeRepository->expects($this->once())->method('getConditionSort')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $mock = '[{"store_id":50023,"language_id":1,"title":"testalpha11","description":"","street":"12132124","district":"\u0e1a\u0e32\u0e07\u0e25\u0e36\u0e01","district_id":1086,"city":"\u0e40\u0e21\u0e37\u0e2d\u0e07\u0e0a\u0e38\u0e21\u0e1e\u0e23","city_id":172,"province":"\u0e0a\u0e38\u0e21\u0e1e\u0e23","province_id":11,"zipcode":"21393","country_id":209,"created_at":"2014-11-06 19:22:03","updated_at":"2014-11-06 19:22:03"}]';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getLanguage')->will($this->returnValue($mock));

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock, true);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $parameter['order'] = 'title';
        $parameter['sort'] = 'asc';
        $crawler = $this->client->request('GET', 'api/store', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndexSuccessCache()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_cache.json');
        $data = json_decode($data, true);
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $crawler = $this->client->request('GET', 'api/store');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndexSuccessInCasefilterDocumentRegisterStatus()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/document_approved.json');
        $data = json_decode($data, true);
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $crawler = $this->client->request('GET', 'api/store?doc_register_status=approved');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"doc_register_status":"approved"', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndexDocumentStatusInCorrected()
    {
        $crawler = $this->client->request('GET', 'api/store?doc_register_status=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);

    }

    public function testGetIndexMultiStoreId()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_list.json');
        $data = json_decode($data);
        $data = (array) $data;
        $this->storeRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $mock = '[{"store_id":50023,"language_id":1,"title":"testalpha11","description":"","street":"12132124","district":"\u0e1a\u0e32\u0e07\u0e25\u0e36\u0e01","district_id":1086,"city":"\u0e40\u0e21\u0e37\u0e2d\u0e07\u0e0a\u0e38\u0e21\u0e1e\u0e23","city_id":172,"province":"\u0e0a\u0e38\u0e21\u0e1e\u0e23","province_id":11,"zipcode":"21393","country_id":209,"created_at":"2014-11-06 19:22:03","updated_at":"2014-11-06 19:22:03"}]';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getLanguage')->will($this->returnValue($mock));

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock, true);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store?multi_store_id=90,85');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndexWithFilterId()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_list.json');
        $data = json_decode($data);
        $data = (array) $data;
        $this->storeRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $mock = '[{"store_id":50023,"language_id":1,"title":"testalpha11","description":"","street":"12132124","district":"\u0e1a\u0e32\u0e07\u0e25\u0e36\u0e01","district_id":1086,"city":"\u0e40\u0e21\u0e37\u0e2d\u0e07\u0e0a\u0e38\u0e21\u0e1e\u0e23","city_id":172,"province":"\u0e0a\u0e38\u0e21\u0e1e\u0e23","province_id":11,"zipcode":"21393","country_id":209,"created_at":"2014-11-06 19:22:03","updated_at":"2014-11-06 19:22:03"}]';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getLanguage')->will($this->returnValue($mock));

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock, true);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/store?id=90');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndexWithFilters()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_filters_content.json');
        $data = json_decode($data);
        $data = (array) $data;

        $this->storeRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $mock = '[{"store_id":50023,"language_id":1,"title":"testalpha11","description":"","street":"12132124","district":"\u0e1a\u0e32\u0e07\u0e25\u0e36\u0e01","district_id":1086,"city":"\u0e40\u0e21\u0e37\u0e2d\u0e07\u0e0a\u0e38\u0e21\u0e1e\u0e23","city_id":172,"province":"\u0e0a\u0e38\u0e21\u0e1e\u0e23","province_id":11,"zipcode":"21393","country_id":209,"created_at":"2014-11-06 19:22:03","updated_at":"2014-11-06 19:22:03"}]';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getLanguage')->will($this->returnValue($mock));

        $parameter['title'] = 'tak';
        $parameter['doc_register_status'] = 'waiting';
        $parameter['doc_cc_status'] = 'waiting';
        $parameter['business_type'] = 'individual';
        $parameter['mobile'] = '0811111111';
        $parameter['phone'] = '0211111111';
        $parameter['email'] = 'takky-dev@mailinator.com';
        $parameter['logo'] = 'true';
        $parameter['fields'] = 'address,avatar,connect';
        $crawler = $this->client->request('GET', 'api/store', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndexWithFiltersName()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_filters_content.json');
        $data = json_decode($data);
        $data = (array) $data;

        $this->storeRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $mock = '[{"store_id":50023,"language_id":1,"title":"testalpha11","description":"","street":"12132124","district":"\u0e1a\u0e32\u0e07\u0e25\u0e36\u0e01","district_id":1086,"city":"\u0e40\u0e21\u0e37\u0e2d\u0e07\u0e0a\u0e38\u0e21\u0e1e\u0e23","city_id":172,"province":"\u0e0a\u0e38\u0e21\u0e1e\u0e23","province_id":11,"zipcode":"21393","country_id":209,"created_at":"2014-11-06 19:22:03","updated_at":"2014-11-06 19:22:03"}]';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getLanguage')->will($this->returnValue($mock));

        $parameter['first_name'] = 'tak';
        $parameter['doc_register_at'] = '2014-11-09 00:00:00,2014-11-09 23:59:59';
        $parameter['doc_cc_at'] = '2014-11-09 00:00:00,2014-11-09 23:59:59';
        $parameter['created_at'] = '2014-11-09 00:00:00,2014-11-09 23:59:59';
        $parameter['order'] = 'first_name';
        $parameter['fields'] = 'first_name,last_name,idcard,address,avatar,connect';
        $crawler = $this->client->request('GET', 'api/store', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    public function testGetIndexNotFound()
    {

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = '{status_code: 1004,status_txt: "Data not found",data: [ ]}';
        $data = json_decode($data);
        $this->storeRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $crawler = $this->client->request('GET', 'api/store?title=xxxxxxxx');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);

    }

    // Store
    public function testPostStoreSuccess()
    {

        $crawler = $this->client->request('POST', 'api/store', array());
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    // put
    public function testPutStoreSuccess()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $this->managequeueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->managequeueRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store.json');
        $data = json_decode($data);
        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue($data));

        $mock = '[1,2,3]';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getStoreLangeuage')->will($this->returnValue($mock));

        $mock = array('en','fr');
        $this->storeRepository->expects($this->once())->method('language_default')->will($this->returnValue($mock));

        $mock = true;
        $this->storeRepository->expects($this->once())->method('update')->will($this->returnValue($mock));

        $mock = true;
        $this->storeRepository->expects($this->any())->method('insertStoreLanguage')->will($this->returnValue($mock));

        $mock = true;
        $this->storeRepository->expects($this->any())->method('updateStoreLanguage')->will($this->returnValue($mock));

        $mock = true;
        $this->managequeueRepository->expects($this->once())->method('syncShop')->will($this->returnValue($mock));

        $this->cacheRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $store_id = 111;

        $parameter['user_id'] = 988;
        $parameter['category'] = '10';
        $parameter['phone'] = '02111111';
        $parameter['mobile'] = '081111111';
        $parameter['fax'] = '02111111';
        $parameter['email'] = 'takky0002@igetproject.com';
        $parameter['social']['facebook'] = 'https://www.facebook.com/cheekacasestore2';
        $parameter['map']['status'] = 'true';
        $parameter['map']['lat']= '13.790587959026597';
        $parameter['map']['long']= '3100.5145270737305';
        $parameter['country_id'] = '209';
        $parameter['status'] = 'true';
        $parameter['doc_register_status'] = 'processing';
        $parameter['doc_register_verify_at'] = '2014-10-09 10:00:00';
        $parameter['doc_cc_status'] = 'processing';
        $parameter['doc_cc_verify_at'] = '2014-10-09 10:00:00';
        $parameter['sales_id'] = '45';

        $parameter['first_name'] = 'xxxx';
        $parameter['last_name'] = 'xxxxx';
        $parameter['idcard'] = '1212121212121';
        $parameter['dbd'] = '1212121212121';
        $parameter['essential_status'] = 'true';
        $parameter['published_at'] = '2014-10-09 10:00:00';

        $addr['street'] = '5801/85 test';
        $addr['district']['id'] = 'true';
        $addr['district']['th'] = 'ดินแดง';
        $addr['province']['id'] = '1';
        $addr['province']['th'] = 'กรุงเทพมหานคร';
        $addr['city']['id'] = '26';
        $addr['city']['th'] = 'ดินแดง';
        $addr['zipcode']['th'] = '14000';
        $addr['country_id']['th'] = '209';
        $parameter['address'] = $addr;

        $crawler = $this->client->request('PUT', 'api/store/'.$store_id, $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testPutStoreNotHaveLanguage()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $this->managequeueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->managequeueRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store.json');
        $data = json_decode($data);
        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue($data));

        $mock = '[1,2,3]';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getStoreLangeuage')->will($this->returnValue($mock));

        $mock = array('en');
        $this->storeRepository->expects($this->once())->method('language_default')->will($this->returnValue($mock));

        $mock = true;
        $this->storeRepository->expects($this->once())->method('update')->will($this->returnValue($mock));

        $mock = true;
        $this->storeRepository->expects($this->any())->method('insertStoreLanguage')->will($this->returnValue($mock));

        $mock = true;
        $this->storeRepository->expects($this->any())->method('updateStoreLanguage')->will($this->returnValue($mock));

        $mock = true;
        $this->managequeueRepository->expects($this->once())->method('syncShop')->will($this->returnValue($mock));

        $this->cacheRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $store_id = 111;

        $parameter['user_id'] = 988;
        $parameter['category'] = '10';
        $parameter['phone'] = '02111111';
        $parameter['mobile'] = '081111111';
        $parameter['fax'] = '02111111';
        $parameter['email'] = 'takky0002@igetproject.com';
        $parameter['social']['facebook'] = 'https://www.facebook.com/cheekacasestore2';
        $parameter['map']['status'] = 'true';
        $parameter['map']['lat']= '13.790587959026597';
        $parameter['map']['long']= '3100.5145270737305';
        $parameter['country_id'] = '209';
        $parameter['status'] = 'true';
        $parameter['doc_register_status'] = 'processing';
        $parameter['doc_register_verify_at'] = '2014-10-09 10:00:00';
        $parameter['doc_cc_status'] = 'processing';
        $parameter['doc_cc_verify_at'] = '2014-10-09 10:00:00';
        $parameter['updated_at'] = '2014-10-10 10:00:00';
        $parameter['sales_id'] = '45';
        $addr['street'] = '5801/85 test';
        $addr['district']['id'] = 'true';
        $addr['district']['th'] = 'ดินแดง';
        $addr['province']['id'] = '1';
        $addr['province']['th'] = 'กรุงเทพมหานคร';
        $addr['city']['id'] = '26';
        $addr['city']['th'] = 'ดินแดง';
        $addr['zipcode']['th'] = '14000';
        $addr['country_id']['th'] = '209';
        $parameter['address'] = $addr;

        $crawler = $this->client->request('PUT', 'api/store/'.$store_id, $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    // put
    public function testPutStoreNotFound()
    {

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = array();
        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue($data));

        $store_id = 10009;
        $parameter['user_id'] = 100;
        $crawler = $this->client->request('PUT', 'api/store/'.$store_id, $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    // put
    public function testPutStoreFail()
    {
        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store.json');
        $data = json_decode($data);
        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue($data));

        $mock = false;
        $this->storeRepository->expects($this->once())->method('update')->will($this->returnValue($mock));

        $store_id = 111;
        $parameter['user_id'] = 988;
        $parameter['category'] = '10';
        $parameter['phone'] = '02111111';
        $parameter['mobile'] = '081111111';
        $crawler = $this->client->request('PUT', 'api/store/'.$store_id, $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1006', $json);
        $this->assertContains('"status_txt":"Update data error"', $json);
    }

    // put
    public function testPutStoreUserNoMatch()
    {
        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store.json');
        $data = json_decode($data);
        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue($data));

        $store_id = 111;
        $parameter['user_id'] = 100;
        $parameter['category'] = '10';
        $parameter['phone'] = '02111111';
        $parameter['mobile'] = '081111111';
        $crawler = $this->client->request('PUT', 'api/store/'.$store_id, $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1009', $json);
        $this->assertContains('"status_txt":"Permission denied"', $json);

    }

    // put
    public function testPutStoreUserValidateFail()
    {
        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $store_id = 111;
        $parameter['category'] = '10';
        $crawler = $this->client->request('PUT', 'api/store/'.$store_id, $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
    }

    public function testShowStoreSuccess()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_attachments.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('getAttachments')->will($this->returnValue($data));

        $data = (object) json_decode('{"id":"84abcc2061824047bb46d976951c3cd8","name":"84abcc2061824047bb46d976951c3cd8","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/111\/84abcc2061824047bb46d976951c3cd8.jpg","position":"1"}');
        $this->storeRepository->expects($this->any())->method('getAttachmentDesc')->will($this->returnValue($data));

        $parameter['multi_attachment'] = 1;
        $crawler = $this->client->request('GET','api/store/111', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreSuccessAttachFile3()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_attachments.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('getAttachments')->will($this->returnValue($data));

        $data = (object) json_decode('{"id":"84abcc2061824047bb46d976951c3cd8","name":"84abcc2061824047bb46d976951c3cd8","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/111\/84abcc2061824047bb46d976951c3cd8.jpg","position":"3"}');
        $this->storeRepository->expects($this->any())->method('getAttachmentDesc')->will($this->returnValue($data));

        $parameter['multi_attachment'] = 1;
        $crawler = $this->client->request('GET','api/store/111', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreSuccessAttachFile4()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_attachments.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('getAttachments')->will($this->returnValue($data));

        $data = (object) json_decode('{"id":"84abcc2061824047bb46d976951c3cd8","name":"84abcc2061824047bb46d976951c3cd8","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/111\/84abcc2061824047bb46d976951c3cd8.jpg","position":"4"}');
        $this->storeRepository->expects($this->any())->method('getAttachmentDesc')->will($this->returnValue($data));

        $parameter['multi_attachment'] = 1;
        $crawler = $this->client->request('GET','api/store/111', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreSuccessAttachFile2()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_attachments.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('getAttachments')->will($this->returnValue($data));

        $data = (object) json_decode('{"id":"84abcc2061824047bb46d976951c3cd8","name":"84abcc2061824047bb46d976951c3cd8","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/111\/84abcc2061824047bb46d976951c3cd8.jpg","position":"2"}');
        $this->storeRepository->expects($this->any())->method('getAttachmentDesc')->will($this->returnValue($data));

        $parameter['multi_attachment'] = 1;
        $crawler = $this->client->request('GET','api/store/111', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreSuccessAttachFile1Onec()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_attachments.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('getAttachments')->will($this->returnValue($data));

        $data = (object) json_decode('{"id":"84abcc2061824047bb46d976951c3cd8","name":"84abcc2061824047bb46d976951c3cd8","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/111\/84abcc2061824047bb46d976951c3cd8.jpg","position":"1"}');
        $this->storeRepository->expects($this->any())->method('getAttachmentDesc')->will($this->returnValue($data));

        $crawler = $this->client->request('GET','api/store/111');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreSuccessAttachFile2Onec()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_attachments.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('getAttachments')->will($this->returnValue($data));

        $data = (object) json_decode('{"id":"84abcc2061824047bb46d976951c3cd8","name":"84abcc2061824047bb46d976951c3cd8","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/111\/84abcc2061824047bb46d976951c3cd8.jpg","position":"2"}');
        $this->storeRepository->expects($this->any())->method('getAttachmentDesc')->will($this->returnValue($data));

        $crawler = $this->client->request('GET','api/store/111');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreSuccessAttachFile3Onec()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_attachments.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('getAttachments')->will($this->returnValue($data));

        $data = (object) json_decode('{"id":"84abcc2061824047bb46d976951c3cd8","name":"84abcc2061824047bb46d976951c3cd8","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/111\/84abcc2061824047bb46d976951c3cd8.jpg","position":"3"}');
        $this->storeRepository->expects($this->any())->method('getAttachmentDesc')->will($this->returnValue($data));

        $crawler = $this->client->request('GET','api/store/111');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreSuccessAttachFile4Onec()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->userRepository = $this->getMock('UserRepository');
        $this->app->instance('UserRepository', $this->userRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $mock = '{"default":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso&w=35&h=35","base":"http:\/\/image.platform.truelife.com\/19957896\/avatar?app_id=1&secret=a42ca3848f9dd9995fedeb93ebf97805&key=sso"}';
        $mock = json_decode($mock, true);
        $this->userRepository->expects($this->once())->method('getAvatar')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_attachments.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('getAttachments')->will($this->returnValue($data));

        $data = (object) json_decode('{"id":"84abcc2061824047bb46d976951c3cd8","name":"84abcc2061824047bb46d976951c3cd8","mime":"image\/jpeg","extension":"jpg","url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/111\/84abcc2061824047bb46d976951c3cd8.jpg","position":"4"}');
        $this->storeRepository->expects($this->any())->method('getAttachmentDesc')->will($this->returnValue($data));

        $crawler = $this->client->request('GET','api/store/111');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreCacheSuccess()
    {

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_filters.json');
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue($data));

        $crawler = $this->client->request('GET','api/store/111');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStoreNotFound()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = array();
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $store_id = 10009;
        $parameter['user_id'] = 100;
        $crawler = $this->client->request('GET', 'api/store/'.$store_id, $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);

    }

    public function testShowStoreWithPartialFieldsSuccess()
    {
        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);
        $this->cacheRepository->expects($this->once())->method('get')->will($this->returnValue(null));

        $mock = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} &#xe3f; THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"504748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"5","preorder":"11"}}';
        $mock = json_decode($mock);
        $this->storeRepository->expects($this->once())->method('getSettingById')->will($this->returnValue($mock));

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store_show.json');
        $data = (object) json_decode($data);
        $this->storeRepository->expects($this->once())->method('show')->will($this->returnValue($data));

        $parameter['fields'] = 'setting,first_name,last_name,idcard,plaza_category';
        $crawler = $this->client->request('GET','api/store/111',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testShowStore_NoID()
    {
        $parameter['multi_attachment'] = 1;
        $crawler = $this->client->request('GET','api/store/xxx', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    // delete
    public function testDeleteSuccess()
    {
        $this->cacheRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->cacheRepository);

        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $this->managequeueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->managequeueRepository);

        $data = file_get_contents(app_path().'/tests/data/ApiStoreController/store.json');
        $data = json_decode($data);
        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue($data));

        $mock = true;
        $this->storeRepository->expects($this->once())->method('delete')->will($this->returnValue($mock));

        $mock = true;
        $this->managequeueRepository->expects($this->once())->method('syncShop')->will($this->returnValue($mock));

        $this->cacheRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $parameter['user_id'] = 988;
        $crawler = $this->client->request('DELETE','api/store/111', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);

    }

    // delete
    public function testDeleteNotFound()
    {
        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $data = null;
        $this->storeRepository->expects($this->once())->method('getStorebyId')->will($this->returnValue($data));
        $parameter['user_id'] = 988;
        $crawler = $this->client->request('DELETE', 'api/store/10009', $parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    // delete
    public function testDeleteInvalidParameters()
    {
        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);

        $crawler = $this->client->request('DELETE','api/store/111', array());
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

}
