<?php

class ApiOptionGroupControllerTest extends ApiTestCase
{

    private function getConstruct()
    {
        $this->OptionGroupRepository = $this->getMock('OptionGroupRepository');
        $this->app->instance('OptionGroupRepository', $this->OptionGroupRepository);

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
    }
    public function testGetIndexSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $data = '[{"id":24,"option_id":1,"name":"\u0e2a\u0e35\u0e40\u0e22\u0e47\u0e19\u0e15\u0e32","status":0,"option":{"id":1,"store_id":1,"user_id":205,"code":"color","position":0,"status":1,"created_at":"2014-08-05 05:22:25","updated_at":"2014-10-31 17:51:13"},"languages":[{"option_id":1,"language_id":1,"title":"\u0e2a\u0e35"},{"option_id":1,"language_id":2,"title":""}],"group_option":[{"group_id":24,"option_value_id":2},{"group_id":24,"option_value_id":5},{"group_id":24,"option_value_id":8},{"group_id":24,"option_value_id":12},{"group_id":24,"option_value_id":13},{"group_id":24,"option_value_id":14},{"group_id":24,"option_value_id":15}]}]';
        $data = json_decode($data, true);

        $this->OptionGroupRepository->expects($this->once())->method('filters')->will($this->returnValue($data));

        $mock = '{"38":{"id":38,"title":{"th":"S"},"code":"","position":2},"39":{"id":39,"title":{"th":"M"},"code":"","position":4},"40":{"id":40,"title":{"th":"L"},"code":"","position":3},"41":{"id":41,"title":{"th":"S"},"code":"","position":5},"105":{"id":105,"title":{"th":"A"},"code":"","position":6},"102":{"id":102,"title":{"th":"XS"},"code":"","position":1},"106":{"id":106,"title":{"th":"35"},"code":"","position":7},"107":{"id":107,"title":{"th":"36"},"code":"","position":8},"108":{"id":108,"title":{"th":"37"},"code":"","position":9},"109":{"id":109,"title":{"th":"38"},"code":"","position":10},"110":{"id":110,"title":{"th":"39"},"code":"","position":11},"111":{"id":111,"title":{"th":"4"},"code":"","position":12},"112":{"id":112,"title":{"th":"5"},"code":"","position":13},"113":{"id":113,"title":{"th":"6"},"code":"","position":14},"114":{"id":114,"title":{"th":"7"},"code":"","position":15}}';
        $mock = json_decode($mock, true);

        $this->OptionGroupRepository->expects($this->once())->method('getOptionValueLanguage')->will($this->returnValue($mock));

        $param = array(
            'option_id'         => 7,
            'plaza_category_id' => 10,
            'group_value_all'   => 'true'
        );
        $this->client->request('GET', 'api/option/group', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());
    }

    public function testGetIndexGroupAllSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $data = '[{"id":17,"option_id":7,"name":"\u0e02\u0e19\u0e32\u0e14\u0e2a\u0e30\u0e42\u0e1e\u0e01","status":0,"option":{"id":7,"store_id":1,"user_id":205,"code":"size","position":0,"status":1,"created_at":"2014-10-31 15:27:19","updated_at":"2015-03-12 15:45:02"},"languages":[{"option_id":7,"language_id":1,"title":"\u0e02\u0e19\u0e32\u0e14"}],"group_option":[{"group_id":17,"option_value_id":38},{"group_id":17,"option_value_id":39},{"group_id":17,"option_value_id":40},{"group_id":17,"option_value_id":41},{"group_id":17,"option_value_id":102},{"group_id":17,"option_value_id":105},{"group_id":17,"option_value_id":106},{"group_id":17,"option_value_id":107},{"group_id":17,"option_value_id":108},{"group_id":17,"option_value_id":109},{"group_id":17,"option_value_id":110},{"group_id":17,"option_value_id":111},{"group_id":17,"option_value_id":112},{"group_id":17,"option_value_id":113},{"group_id":17,"option_value_id":114}]},{"id":16,"option_id":7,"name":"\u0e02\u0e19\u0e32\u0e14\u0e40\u0e14\u0e47\u0e01","status":0,"option":{"id":7,"store_id":1,"user_id":205,"code":"size","position":0,"status":1,"created_at":"2014-10-31 15:27:19","updated_at":"2015-03-12 15:45:02"},"languages":[{"option_id":7,"language_id":1,"title":"\u0e02\u0e19\u0e32\u0e14"}],"group_option":[]},{"id":15,"option_id":7,"name":"\u0e02\u0e19\u0e32\u0e14\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","status":0,"option":{"id":7,"store_id":1,"user_id":205,"code":"size","position":0,"status":1,"created_at":"2014-10-31 15:27:19","updated_at":"2015-03-12 15:45:02"},"languages":[{"option_id":7,"language_id":1,"title":"\u0e02\u0e19\u0e32\u0e14"}],"group_option":[]}]';
        $data = json_decode($data, true);
        $i = 0;
        foreach ($data as $v) {
            $data[$i]['option_id'] = (object) $v['option_id'];
            $data[$i]['option'] = (object) $v['option'];
            $data[$i]['languages'] = (object) $v['languages'];
            $data[$i]['group_option'] = (object) $v['group_option'];
            $i++;
        }

        $this->OptionGroupRepository->expects($this->once())->method('filters')->will($this->returnValue($data));

        $groupall = '{"14":{"id":14,"option_id":7,"name":"\u0e02\u0e19\u0e32\u0e14\u0e23\u0e2d\u0e07\u0e40\u0e17\u0e49\u0e3255","status":0},"15":{"id":15,"option_id":7,"name":"\u0e02\u0e19\u0e32\u0e14\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","status":0},"16":{"id":16,"option_id":7,"name":"\u0e02\u0e19\u0e32\u0e14\u0e40\u0e14\u0e47\u0e01","status":0},"17":{"id":17,"option_id":7,"name":"\u0e02\u0e19\u0e32\u0e14\u0e2a\u0e30\u0e42\u0e1e\u0e01","status":0},"20":{"id":20,"option_id":7,"name":"test","status":0},"21":{"id":21,"option_id":7,"name":"test21","status":0}}';
        $groupall = json_decode($groupall, true);
        $this->OptionGroupRepository->expects($this->once())->method('getOptionGroupAll')->will($this->returnValue($groupall));

        $mock = '{"38":{"id":38,"title":{"th":"S"},"code":"","position":2},"39":{"id":39,"title":{"th":"M"},"code":"","position":4},"40":{"id":40,"title":{"th":"L"},"code":"","position":3},"41":{"id":41,"title":{"th":"S"},"code":"","position":5},"105":{"id":105,"title":{"th":"A"},"code":"","position":6},"102":{"id":102,"title":{"th":"XS"},"code":"","position":1},"106":{"id":106,"title":{"th":"35"},"code":"","position":7},"107":{"id":107,"title":{"th":"36"},"code":"","position":8},"108":{"id":108,"title":{"th":"37"},"code":"","position":9},"109":{"id":109,"title":{"th":"38"},"code":"","position":10},"110":{"id":110,"title":{"th":"39"},"code":"","position":11},"111":{"id":111,"title":{"th":"4"},"code":"","position":12},"112":{"id":112,"title":{"th":"5"},"code":"","position":13},"113":{"id":113,"title":{"th":"6"},"code":"","position":14},"114":{"id":114,"title":{"th":"7"},"code":"","position":15}}';
        $mock = json_decode($mock, true);

        $this->OptionGroupRepository->expects($this->once())->method('getOptionValueLanguage')->will($this->returnValue($mock));

        $param = array(
            'option_id'         => 7,
            'plaza_category_id' => 10,
            'group_all'   => 'true'
        );
        $this->client->request('GET', 'api/option/group', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());
    }

    public function testGetShowSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $data = '[{"id":20,"option_id":7,"name":"test","status":0,"option":{"id":7,"store_id":1,"user_id":205,"code":"size","position":0,"status":1,"created_at":"2014-10-31 15:27:19","updated_at":"2015-03-12 15:45:02"},"languages":[{"option_id":7,"language_id":1,"title":"\u0e02\u0e19\u0e32\u0e14"}],"group_option":[{"group_id":20,"option_value_id":38},{"group_id":20,"option_value_id":39},{"group_id":20,"option_value_id":40},{"group_id":20,"option_value_id":41},{"group_id":20,"option_value_id":102},{"group_id":20,"option_value_id":105},{"group_id":20,"option_value_id":106},{"group_id":20,"option_value_id":107},{"group_id":20,"option_value_id":108},{"group_id":20,"option_value_id":109},{"group_id":20,"option_value_id":110},{"group_id":20,"option_value_id":111},{"group_id":20,"option_value_id":112},{"group_id":20,"option_value_id":113},{"group_id":20,"option_value_id":114}]}]';
        $data = json_decode($data, true);

        $this->OptionGroupRepository->expects($this->once())->method('getDetail')->will($this->returnValue($data));

        $mock = '{"38":{"id":38,"title":{"th":"S"},"code":"","position":2},"39":{"id":39,"title":{"th":"M"},"code":"","position":4},"40":{"id":40,"title":{"th":"L"},"code":"","position":3},"41":{"id":41,"title":{"th":"S"},"code":"","position":5},"105":{"id":105,"title":{"th":"A"},"code":"","position":6},"102":{"id":102,"title":{"th":"XS"},"code":"","position":1},"106":{"id":106,"title":{"th":"35"},"code":"","position":7},"107":{"id":107,"title":{"th":"36"},"code":"","position":8},"108":{"id":108,"title":{"th":"37"},"code":"","position":9},"109":{"id":109,"title":{"th":"38"},"code":"","position":10},"110":{"id":110,"title":{"th":"39"},"code":"","position":11},"111":{"id":111,"title":{"th":"4"},"code":"","position":12},"112":{"id":112,"title":{"th":"5"},"code":"","position":13},"113":{"id":113,"title":{"th":"6"},"code":"","position":14},"114":{"id":114,"title":{"th":"7"},"code":"","position":15}}';
        $mock = json_decode($mock, true);

        $this->OptionGroupRepository->expects($this->once())->method('getOptionValueLanguage')->will($this->returnValue($mock));

        $param = array(
            'option_id'         => 7,
            'plaza_category_id' => 10,
            'group_value_all'   => 'true'
        );
        $this->client->request('GET', 'api/option/group/20', $param);
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());
    }

    public function testCreateOptionGroupSuccess()
    {
        /* get Construct*/
        $this->getConstruct();

        $this->OptionGroupRepository->expects($this->once())->method('createOptionGroup')->will($this->returnValue(true));

        $this->OptionGroupRepository->expects($this->any())->method('addOptionValueToGroup')->will($this->returnValue(true));

        $param = array(
            'option_id'        => 7,
            'name'             => 'Size',
            'option_value_ids' => array(5,6)
        );

        $this->client->request('POST', 'api/option/group', $param);
        $this->assertContains('"status_code":0', $this->client->getResponse()->getContent());
    }

    public function testCreateOptionGroupInvalid()
    {
        /* get Construct*/
        $this->getConstruct();

        $param = array(
            'option_id'  => 7
        );

        $this->client->request('POST', 'api/option/group', $param);
        $this->assertContains('"status_code":1003', $this->client->getResponse()->getContent());
    }

    public function testPutOptionGroupSuccess()
    {
        /* get Construct*/
        $this->getConstruct();

        $data = '{"id":22,"option_id":1,"name":"\u0e2a\u0e35\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","status":0}';
        $data = json_decode($data, true);

        $this->OptionGroupRepository->expects($this->once())->method('getShow')->will($this->returnValue($data));

        $this->OptionGroupRepository->expects($this->once())->method('updateOptionGroup')->will($this->returnValue(true));

        $this->OptionGroupRepository->expects($this->any())->method('addOptionValueToGroup')->will($this->returnValue(true));

        $param = array(
            'option_id'        => 7,
            'option_value_ids' => array(5,6)
        );

        $this->client->request('PUT', 'api/option/group/22', $param);
        $this->assertContains('"status_code":0', $this->client->getResponse()->getContent());
    }

    public function testPutOptionGroupInvalid()
    {
        /* get Construct*/
        $this->getConstruct();

        $param = array(
            'option_id'  => 'x'
        );

        $this->client->request('PUT', 'api/option/group', $param);
        $this->assertContains('"status_code":1003', $this->client->getResponse()->getContent());
    }

    public function testGetShowInvalidParameter()
    {
        /* get Construct*/
        $this->getConstruct();

        $this->client->request('GET', 'api/option/group/x');
        $this->assertContains('"status_code":1003', $this->client->getResponse()->getContent());
    }

    public function testGetShowNotFound()
    {
        /* get Construct*/
        $this->getConstruct();

        $this->OptionGroupRepository->expects($this->once())->method('getDetail')->will($this->returnValue(null));

        $this->client->request('GET', 'api/option/group/7');
        $this->assertContains('"status_code":1004', $this->client->getResponse()->getContent());
    }

    public function testGetIndexNotFound()
    {
        /* get Construct*/
        $this->getConstruct();

        $this->OptionGroupRepository->expects($this->once())->method('filters')->will($this->returnValue(null));

        $param = array(
            'option_id'         => 7,
            'plaza_category_id' => 10
        );
        $this->client->request('GET', 'api/option/group', $param);
        $this->assertContains('"status_code":1004', $this->client->getResponse()->getContent());
    }

    public function testGetIndexInvalidParameter()
    {
        /* get Construct*/
        $this->getConstruct();
        $param = array(
            'option_id'         => 0,
        );
        $this->client->request('GET', 'api/option/group', $param);
        $this->assertContains('"status_code":1003', $this->client->getResponse()->getContent());
    }

    public function testDeleteSuccess()
    {
        /* get Construct*/
        $this->getConstruct();

        $data = '{"id":22,"option_id":1,"name":"\u0e2a\u0e35\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","status":0}';
        $data = json_decode($data);

        $this->OptionGroupRepository->expects($this->once())->method('getOptionGroupById')->will($this->returnValue($data));

        $this->OptionGroupRepository->expects($this->once())->method('delete')->will($this->returnValue(1));

        $this->client->request('delete', 'api/option/group/1');
        $this->assertContains('"status_txt":"Success"', $this->client->getResponse()->getContent());
    }

    public function testDeleteNotSuccess()
    {
        /* get Construct*/
        $this->getConstruct();
        $this->client->request('delete', 'api/option/group/x');
        $this->assertContains('"status_code":1003', $this->client->getResponse()->getContent());
    }

}
