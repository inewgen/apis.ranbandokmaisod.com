<?php

class ApiPlazaOptionMappingControllerTest extends ApiTestCase
{

    private function getConstruct()
    {
        $this->OptionRepository = $this->getMock('OptionRepository');
        $this->app->instance('OptionRepository', $this->OptionRepository);

        $this->PlazaOptionMappingRepository = $this->getMock('PlazaOptionMappingRepository');
        $this->app->instance('PlazaOptionMappingRepository', $this->PlazaOptionMappingRepository);

        $this->PlazaCategoryRepository = $this->getMock('PlazaCategoryRepository');
        $this->app->instance('PlazaCategoryRepository', $this->PlazaCategoryRepository);

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
    }
    public function testGetIndexSuccess()
    {

        /* get Construct*/
        $this->getConstruct();
        $data_find = '{"plaza_category_id":"10","option_id":"1","created_at":"2014-08-06 04:41:24","updated_at":"2014-08-06 04:41:24"}';
        $this->PlazaOptionMappingRepository->expects($this->once())->method('find')->will($this->returnValue($data_find));
        $param = array(
            'option_id' => 1,
            'plaza_category_id' => 10,
        );
        $this->client->request('GET', 'api/plazacategory/option/mapping', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());
    }

    public function testGetIndexNotSuccess()
    {
        $this->client->request('GET', 'api/plazacategory/option/mapping');
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());
    }

    public function testPostDataSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $data_plaza_category = json_encode(array('plaza_category_id' => 10));
        $this->PlazaCategoryRepository->expects($this->once())->method('find')->will($this->returnValue($data_plaza_category));
        $this->OptionRepository->expects($this->once())->method('getById')->will($this->returnValue(array('plaza_category_id' => 10)));
        $this->PlazaOptionMappingRepository->expects($this->once())->method('find')->will($this->returnValue(json_encode(array())));

        $this->PlazaOptionMappingRepository->expects($this->once())->method('create')->will($this->returnValue(1));
        $this->CachedRepository->expects($this->once())->method('clear')->will($this->returnValue(true));

        $param = array(
            'store_id' => 1,
            'option_id' => 1,
            'plaza_category_id' => 10,
            'user_id' => 205,
        );

        $this->client->request('post', 'api/plazacategory/option/mapping', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());

    }

    public function testUpdateByGroupIdSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $data_plaza_category = json_encode(array('plaza_category_id' => 10));
        $this->PlazaOptionMappingRepository->expects($this->once())->method('createGroupPlazaOption')->will($this->returnValue(1));
        $this->CachedRepository->expects($this->once())->method('clear')->will($this->returnValue(true));

        $param = array(
            'option_id' => 1,
            'group_id'  => 22,
            'plaza_category_id' => 10
        );

        $this->client->request('put', 'api/plazacategory/option/mapping/10', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());

    }

    public function testUpdateByGroupIdsSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $this->PlazaOptionMappingRepository->expects($this->once())->method('destroy')->will($this->returnValue(1));
        $this->PlazaOptionMappingRepository->expects($this->any())->method('createGroupPlazaOption')->will($this->returnValue(1));

        $this->CachedRepository->expects($this->once())->method('clear')->will($this->returnValue(true));

        $group_ids = array(1,2,3);
        $param = array(
            'option_id' => 1,
            'group_ids'  => $group_ids,
            'plaza_category_id' => 10
        );

        $this->client->request('put', 'api/plazacategory/option/mapping/10', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());

    }

    public function testUpdateByApplyLastChildSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $this->PlazaOptionMappingRepository->expects($this->once())->method('resetPlazaOption')->will($this->returnValue(1));

        $cate = file_get_contents(app_path().'/tests/data/ApiPlazaOptionMappingController/plaza_category.json');
        $cate = json_decode($cate, true);
        $this->PlazaOptionMappingRepository->expects($this->any())->method('getChildPlazaCate')->will($this->returnValue($cate));

        $data = '[{"plaza_category_id":10,"option_id":1,"group_id":22,"created_at":"-0001-11-30 00:00:00","updated_at":"-0001-11-30 00:00:00"}]';
        $data = json_decode($data);
        $this->PlazaOptionMappingRepository->expects($this->any())->method('getPlazaOption')->will($this->returnValue($data));

        $data = '[{"plaza_category_id":10,"option_id":1,"group_id":22,"created_at":"-0001-11-30 00:00:00","updated_at":"-0001-11-30 00:00:00"}]';
        $data = json_decode($data);
        $this->PlazaOptionMappingRepository->expects($this->any())->method('getPlazaOption')->will($this->returnValue($data));

        $this->PlazaOptionMappingRepository->expects($this->any())->method('applyOptionForLastChild')->will($this->returnValue(1));

        $this->CachedRepository->expects($this->once())->method('clear')->will($this->returnValue(true));

        $param = array(
            'apply_child' => 'true',
            'plaza_category_id' => 150
        );

        $this->client->request('put', 'api/plazacategory/option/mapping/150', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());

    }

    public function testPostDataDuplicateSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $this->PlazaCategoryRepository->expects($this->once())->method('find')->will($this->returnValue(0));
        $this->OptionRepository->expects($this->once())->method('getById')->will($this->returnValue(0));
        $this->PlazaOptionMappingRepository->expects($this->once())->method('find')->will($this->returnValue(0));

        $param = array(
            'store_id' => 1,
            'option_id' => 1,
            'plaza_category_id' => 10,
            'user_id' => 205,
        );

        $this->client->request('post', 'api/plazacategory/option/mapping', $param);
        $this->assertContains('"status_code":1004', $this->client->getResponse()->getContent());

    }
    public function testPostDataNotSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $data_plaza_category = json_encode(array('plaza_category_id' => 10));
        $this->PlazaCategoryRepository->expects($this->once())->method('find')->will($this->returnValue($data_plaza_category));
        $this->OptionRepository->expects($this->once())->method('getById')->will($this->returnValue(array('plaza_category_id' => 10)));
        $this->PlazaOptionMappingRepository->expects($this->once())->method('find')->will($this->returnValue(json_encode(array())));

        $this->PlazaOptionMappingRepository->expects($this->once())->method('create')->will($this->returnValue(false));

        $param = array(
            'store_id' => 1,
            'option_id' => 1,
            'plaza_category_id' => 10,
            'user_id' => 205,
        );

        $this->client->request('post', 'api/plazacategory/option/mapping', $param);
        $this->assertContains('"status_code":1005', $this->client->getResponse()->getContent());

    }

    public function testPutDataValidateSuccess()
    {
        $param = array(
            'user_id' => 205,
        );

        $this->client->request('put', 'api/plazacategory/option/mapping/150', $param);
        $this->assertContains('"status_code":1006', $this->client->getResponse()->getContent());

    }

    public function testPutDataInvalidParameter()
    {
        $param = array(
            'user_id' => 205,
            'group_ids' => 1
        );

        $this->client->request('put', 'api/plazacategory/option/mapping/150', $param);
        $this->assertContains('"status_code":1003', $this->client->getResponse()->getContent());

    }

    public function testPostDataValidateSuccess()
    {
        $param = array(
            'user_id' => 205,
        );

        $this->client->request('post', 'api/plazacategory/option/mapping', $param);
        $this->assertContains('"status_code":1002', $this->client->getResponse()->getContent());

    }

    public function testDeleteSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $this->PlazaOptionMappingRepository->expects($this->once())->method('destroy')->will($this->returnValue(1));
        $this->CachedRepository->expects($this->once())->method('clear')->will($this->returnValue(true));
        $param = array(
            'plaza_category_id' => 10,
            'option_id' => 1,
            'group_id'  => 22
        );
        $this->client->request('delete', 'api/plazacategory/option/mapping/1', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());
    }

    public function testDeleteNotSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $this->PlazaOptionMappingRepository->expects($this->once())->method('destroy')->will($this->returnValue(0));

        $param = array(
            'plaza_category_id' => 10,
            'option_id' => 1,
            'group_id'  => 22
        );
        $this->client->request('delete', 'api/plazacategory/option/mapping/1', $param);
        $this->assertContains('"status_code":1005', $this->client->getResponse()->getContent());
    }

    public function testDeleteValidateSuccess()
    {

        $param = array(
            'plaza_category_id' => 'x',
        );
        $this->client->request('delete', 'api/plazacategory/option/mapping/1', $param);
        $this->assertContains('"status_code":1002', $this->client->getResponse()->getContent());
    }

}
