<?php

class ApiReportProductsControllerTest extends ApiTestCase
{
    public function test_getSuccess()
    {
        $this->ReportProductsRepository = $this->getMock('ReportProductsRepository');
        $this->app->instance('ReportProductsRepository', $this->ReportProductsRepository);

        $response = '{"status_code":0,"status_txt":"Success","data":"{\"count\":236,\"result\":[{\"store_id\":1014,\"store_slug\":\"Clock_Clock\",\"store_name\":\"Clock_Clock\",\"store_category_name\":\"\\u0e19\\u0e32\\u0e2c\\u0e34\\u0e01\\u0e32\",\"store_status\":1,\"active_product\":0,\"total_product\":0},{\"store_id\":1047,\"store_slug\":\"bigrilakkuma\",\"store_name\":\"Big Rilakkuma\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":0,\"active_product\":0,\"total_product\":2},{\"store_id\":55,\"store_slug\":\"cookiie\",\"store_name\":\"cookiie\",\"store_category_name\":\"\\u0e2a\\u0e31\\u0e15\\u0e27\\u0e4c\\u0e40\\u0e25\\u0e35\\u0e49\\u0e22\\u0e07\\u0e41\\u0e25\\u0e30\\u0e15\\u0e49\\u0e19\\u0e44\\u0e21\\u0e49\",\"store_status\":1,\"active_product\":0,\"total_product\":0},{\"store_id\":1,\"store_slug\":\"dev-store\",\"store_name\":\"dev-store\",\"store_category_name\":\"\\u0e01\\u0e25\\u0e49\\u0e2d\\u0e07\\u0e41\\u0e25\\u0e30\\u0e2d\\u0e38\\u0e1b\\u0e01\\u0e23\\u0e13\\u0e4c\\u0e40\\u0e2a\\u0e23\\u0e34\\u0e21\",\"store_status\":0,\"active_product\":0,\"total_product\":3},{\"store_id\":19,\"store_slug\":\"cookie\",\"store_name\":\"Cookie Shop\",\"store_category_name\":\"\\u0e2a\\u0e31\\u0e15\\u0e27\\u0e4c\\u0e40\\u0e25\\u0e35\\u0e49\\u0e22\\u0e07\\u0e41\\u0e25\\u0e30\\u0e15\\u0e49\\u0e19\\u0e44\\u0e21\\u0e49\",\"store_status\":1,\"active_product\":7,\"total_product\":7},{\"store_id\":184,\"store_slug\":\"teststore\",\"store_name\":\"Test Store by Pu\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":1,\"active_product\":4,\"total_product\":4},{\"store_id\":110,\"store_slug\":\"fdgdfgfg\",\"store_name\":\"6546456457\",\"store_category_name\":\"\\u0e18\\u0e38\\u0e23\\u0e01\\u0e34\\u0e08\\u0e41\\u0e25\\u0e30\\u0e1a\\u0e23\\u0e34\\u0e01\\u0e32\\u0e23\",\"store_status\":0,\"active_product\":0,\"total_product\":0},{\"store_id\":2,\"store_slug\":\"siamit\",\"store_name\":\"SiamiT\",\"store_category_name\":\"\\u0e19\\u0e32\\u0e2c\\u0e34\\u0e01\\u0e32\",\"store_status\":0,\"active_product\":0,\"total_product\":2},{\"store_id\":111,\"store_slug\":\"qajoytest009\",\"store_name\":\"qajoytest009\",\"store_category_name\":\"\\u0e2b\\u0e19\\u0e31\\u0e07\\u0e2a\\u0e37\\u0e2d\",\"store_status\":0,\"active_product\":0,\"total_product\":0},{\"store_id\":105,\"store_slug\":\"bbank002\",\"store_name\":\"bbank002 shop\",\"store_category_name\":\"\\u0e42\\u0e17\\u0e23\\u0e28\\u0e31\\u0e1e\\u0e17\\u0e4c\\u0e21\\u0e37\\u0e2d\\u0e16\\u0e37\\u0e2d\\u0e41\\u0e25\\u0e30\\u0e2d\\u0e38\\u0e1b\\u0e01\\u0e23\\u0e13\\u0e4c\\u0e2a\\u0e37\\u0e48\\u0e2d\\u0e2a\\u0e32\\u0e23\",\"store_status\":0,\"active_product\":0,\"total_product\":0},{\"store_id\":87,\"store_slug\":\"qatest004\",\"store_name\":\"qajoytest004\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":1,\"active_product\":1,\"total_product\":1},{\"store_id\":1017,\"store_slug\":\"shoes-ing\",\"store_name\":\"shoes-ing\",\"store_category_name\":\"\\u0e23\\u0e2d\\u0e07\\u0e40\\u0e17\\u0e49\\u0e32\",\"store_status\":1,\"active_product\":2,\"total_product\":2},{\"store_id\":1030,\"store_slug\":\"qatest031\",\"store_name\":\"\\u0e0a\\u0e37\\u0e48\\u0e2d\\u0e23\\u0e49\\u0e32\\u0e19\\u0e04\\u0e49\\u0e32\\u0e40\\u0e1e\\u0e37\\u0e48\\u0e2d\\u0e17\\u0e33\\u0e01\\u0e32\\u0e23\\u0e17\\u0e14\\u0e2a\\u0e2d\\u0e1a\\u0e2a\\u0e2a\\u0e2a\\u0e2a\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":0,\"active_product\":0,\"total_product\":0},{\"store_id\":95,\"store_slug\":\"qajoytest007\",\"store_name\":\"qajoytest007\",\"store_category_name\":\"\\u0e19\\u0e32\\u0e2c\\u0e34\\u0e01\\u0e32\",\"store_status\":1,\"active_product\":4,\"total_product\":6},{\"store_id\":1013,\"store_slug\":\"clockcodile\",\"store_name\":\"shop\",\"store_category_name\":\"\\u0e19\\u0e32\\u0e2c\\u0e34\\u0e01\\u0e32\",\"store_status\":1,\"active_product\":2,\"total_product\":2},{\"store_id\":1011,\"store_slug\":\"berry\",\"store_name\":\"berry\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":0,\"active_product\":0,\"total_product\":5},{\"store_id\":120,\"store_slug\":\"qajoytest013\",\"store_name\":\"qajoytest013\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":1,\"active_product\":10,\"total_product\":12},{\"store_id\":1031,\"store_slug\":\"shirt1234\",\"store_name\":\"\\u0e23\\u0e49\\u0e32\\u0e19\\u0e04\\u0e49\\u0e32\\u0e02\\u0e32\\u0e22\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":1,\"active_product\":5,\"total_product\":5},{\"store_id\":83,\"store_slug\":\"qajoytest003\",\"store_name\":\"qajoytest003\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":1,\"active_product\":0,\"total_product\":1},{\"store_id\":78,\"store_slug\":\"devwls002\",\"store_name\":\"devwls002\",\"store_category_name\":\"\\u0e40\\u0e2a\\u0e37\\u0e49\\u0e2d\\u0e1c\\u0e49\\u0e32\",\"store_status\":1,\"active_product\":3,\"total_product\":4}]}"}';
        $this->ReportProductsRepository->expects($this->once())->method('getProductSummary')->will($this->returnValue($response));

        $crawler = $this->client->request('GET', 'api/report/products');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
        $this->assertContains('cookiie', $json);
    }
    public function test_getNotSuccess()
    {
        $this->ReportProductsRepository = $this->getMock('ReportProductsRepository');
        $this->app->instance('ReportProductsRepository', $this->ReportProductsRepository);

        $param=array('category_id'=>'a');
        $crawler = $this->client->request('GET', 'api/report/products',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('The category id must be an integer.', $json);
    }
}
