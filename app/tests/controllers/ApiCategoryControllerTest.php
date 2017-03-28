<?php

class ApiCategoryControllerTest extends ApiTestCase
{
    //Get Index
    public function testGetIndexSuccess()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"250":{"id":250,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"251":{"id":251,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"252":{"id":252,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"253":{"id":253,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"254":{"id":254,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"255":{"id":255,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"256":{"id":256,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"257":{"id":257,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"258":{"id":258,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"259":{"id":259,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"260":{"id":260,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"261":{"id":261,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"262":{"id":262,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"263":{"id":263,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"264":{"id":264,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"265":{"id":265,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"266":{"id":266,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"267":{"id":267,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"268":{"id":268,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"269":{"id":269,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"270":{"id":270,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"271":{"id":271,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"272":{"id":272,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"273":{"id":273,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"274":{"id":274,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"275":{"id":275,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"276":{"id":276,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"277":{"id":277,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"278":{"id":278,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"279":{"id":279,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"280":{"id":280,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"281":{"id":281,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"282":{"id":282,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"283":{"id":283,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"284":{"id":284,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"285":{"id":285,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"286":{"id":286,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"287":{"id":287,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"288":{"id":288,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"289":{"id":289,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"290":{"id":290,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"291":{"id":291,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"292":{"id":292,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"293":{"id":293,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"294":{"id":294,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"295":{"id":295,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"296":{"id":296,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"297":{"id":297,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"298":{"id":298,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"299":{"id":299,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"300":{"id":300,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"301":{"id":301,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"302":{"id":302,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"303":{"id":303,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"304":{"id":304,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"305":{"id":305,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"306":{"id":306,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"307":{"id":307,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"308":{"id":308,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"309":{"id":309,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"310":{"id":310,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"311":{"id":311,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"312":{"id":312,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"313":{"id":313,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"314":{"id":314,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"315":{"id":315,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"316":{"id":316,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"317":{"id":317,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"318":{"id":318,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"319":{"id":319,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"320":{"id":320,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"321":{"id":321,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"322":{"id":322,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0}}';
        $mock = json_decode($mock, true);
        $this->CategoryRepository->expects($this->once())->method('getTotalProduct')->will($this->returnValue($mock));

        $mock = '13';
        $this->CategoryRepository->expects($this->once())->method('listsCount')->will($this->returnValue($mock));

        $mock = '[{"id":322,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":1,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-22 23:24:16","updated_at":"2014-10-22 23:33:41","deleted_at":null,"languages":[{"category_id":322,"language_id":1,"title":"aaayyy","body_html":"","seo_title":"aaayyy","seo_description":""}],"attachments":[{"id":"714a11d284b92ab0a236e182cadc7653","user_id":208,"store_id":2,"album_id":35,"resource":"upload","name":"714a11d284b92ab0a236e182cadc7653","width":81,"height":77,"mime":"image\/jpeg","size":8954,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/2\/714a11d284b92ab0a236e182cadc7653.jpg","created_at":"2014-10-22 23:33:41","updated_at":"2014-10-22 23:33:41","deleted_at":null,"public_id":"714a11d284b92ab0a236e182cadc7653"}]},{"id":319,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:07:05","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":319,"language_id":1,"title":"ccc","body_html":"","seo_title":"ccc","seo_description":""}],"attachments":[]},{"id":317,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":3,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:06:25","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":317,"language_id":1,"title":"aaa","body_html":"","seo_title":"aaa","seo_description":""}],"attachments":[]},{"id":321,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":4,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:07:30","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":321,"language_id":1,"title":"eee","body_html":"","seo_title":"eee","seo_description":""}],"attachments":[]},{"id":315,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":5,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:56","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":315,"language_id":1,"title":"66","body_html":"","seo_title":"66","seo_description":""}],"attachments":[]},{"id":314,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":6,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:53","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":314,"language_id":1,"title":"65","body_html":"","seo_title":"65","seo_description":""}],"attachments":[]},{"id":313,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":7,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:49","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":313,"language_id":1,"title":"64","body_html":"","seo_title":"64","seo_description":""}],"attachments":[]},{"id":318,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":8,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:06:45","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":318,"language_id":1,"title":"bbb","body_html":"","seo_title":"bbb","seo_description":""}],"attachments":[]},{"id":320,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":9,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:07:11","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":320,"language_id":1,"title":"ddd","body_html":"","seo_title":"ddd","seo_description":""}],"attachments":[]},{"id":312,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":10,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:46","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":312,"language_id":1,"title":"63","body_html":"","seo_title":"63","seo_description":""}],"attachments":[]},{"id":311,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":11,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:42","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":311,"language_id":1,"title":"62","body_html":"","seo_title":"62","seo_description":""}],"attachments":[]},{"id":310,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":12,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:38","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":310,"language_id":1,"title":"61","body_html":"","seo_title":"61","seo_description":""}],"attachments":[]},{"id":309,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":13,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:34","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":309,"language_id":1,"title":"60","body_html":"","seo_title":"60","seo_description":""}],"attachments":[]},{"id":308,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":14,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:30","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":308,"language_id":1,"title":"59","body_html":"","seo_title":"59","seo_description":""}],"attachments":[]},{"id":307,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":15,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:27","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":307,"language_id":1,"title":"58","body_html":"","seo_title":"58","seo_description":""}],"attachments":[]},{"id":306,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":16,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:22","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":306,"language_id":1,"title":"57","body_html":"","seo_title":"57","seo_description":""}],"attachments":[]},{"id":305,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":17,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:18","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":305,"language_id":1,"title":"56","body_html":"","seo_title":"56","seo_description":""}],"attachments":[]},{"id":304,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":18,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:14","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":304,"language_id":1,"title":"55","body_html":"","seo_title":"55","seo_description":""}],"attachments":[]},{"id":303,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":19,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:10","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":303,"language_id":1,"title":"54","body_html":"","seo_title":"54","seo_description":""}],"attachments":[]},{"id":302,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":20,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:06","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":302,"language_id":1,"title":"53","body_html":"","seo_title":"53","seo_description":""}],"attachments":[]}]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('listsCategory')->will($this->returnValue($mock));

        $mock = '{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","extension":"png"}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->any())->method('getImage')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/category?store_id=2');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndexWithCacheSuccess()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '{"benchmark":"false","pagination":{"current":1,"limit":20,"total":80},"record":[{"id":391,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":1,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-23 10:11:13","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a81"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":383,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-22 23:17:51","timeago":"4 days ago","format":"22 October 2014 11:17 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a80"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":382,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":3,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-22 23:17:33","timeago":"4 days ago","format":"22 October 2014 11:17 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a79"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":372,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":4,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:33","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a78"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":370,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":5,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:26","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[{"id":"53eb371153c7590e254ea29918b5ad4a","url":"\/uploads\/49\/53eb371153c7590e254ea29918b5ad4a.jpg","name":"53eb371153c7590e254ea29918b5ad4a.jpg","extension":"jpg"}],"title":{"th":"a76"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":369,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":6,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:22","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a75"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":368,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":7,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:19","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a74"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":367,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":8,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:17","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a73"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":366,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":9,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:14","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a72"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":365,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":10,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:12","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a71"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":364,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":11,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:09","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a70"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":363,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":12,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:05","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a69"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":362,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":13,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:02","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a68"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":361,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":14,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:58:00","timeago":"6 days ago","format":"21 October 2014 2:58 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a67"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":360,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":15,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:57:58","timeago":"6 days ago","format":"21 October 2014 2:57 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a66"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":359,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":16,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:57:55","timeago":"6 days ago","format":"21 October 2014 2:57 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a65"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":358,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":17,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:57:52","timeago":"6 days ago","format":"21 October 2014 2:57 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a64"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":357,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":18,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:57:47","timeago":"6 days ago","format":"21 October 2014 2:57 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a63"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":356,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":19,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:57:45","timeago":"6 days ago","format":"21 October 2014 2:57 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a62"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}},{"id":355,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":20,"product_count":0,"disable_product_count":0,"total_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-21 14:57:42","timeago":"6 days ago","format":"21 October 2014 2:57 PM"},"updated_at":{"date":"2014-10-23 10:11:15","timeago":"4 days ago","format":"23 October 2014 10:11 AM"},"images":[],"title":{"th":"a61"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}}]}';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/category?store_id=2');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndexWithImageSuccess()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"250":{"id":250,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"251":{"id":251,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"252":{"id":252,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"253":{"id":253,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"254":{"id":254,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"255":{"id":255,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"256":{"id":256,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"257":{"id":257,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"258":{"id":258,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"259":{"id":259,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"260":{"id":260,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"261":{"id":261,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"262":{"id":262,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"263":{"id":263,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"264":{"id":264,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"265":{"id":265,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"266":{"id":266,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"267":{"id":267,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"268":{"id":268,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"269":{"id":269,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"270":{"id":270,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"271":{"id":271,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"272":{"id":272,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"273":{"id":273,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"274":{"id":274,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"275":{"id":275,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"276":{"id":276,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"277":{"id":277,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"278":{"id":278,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"279":{"id":279,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"280":{"id":280,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"281":{"id":281,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"282":{"id":282,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"283":{"id":283,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"284":{"id":284,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"285":{"id":285,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"286":{"id":286,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"287":{"id":287,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"288":{"id":288,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"289":{"id":289,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"290":{"id":290,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"291":{"id":291,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"292":{"id":292,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"293":{"id":293,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"294":{"id":294,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"295":{"id":295,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"296":{"id":296,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"297":{"id":297,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"298":{"id":298,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"299":{"id":299,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"300":{"id":300,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"301":{"id":301,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"302":{"id":302,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"303":{"id":303,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"304":{"id":304,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"305":{"id":305,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"306":{"id":306,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"307":{"id":307,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"308":{"id":308,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"309":{"id":309,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"310":{"id":310,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"311":{"id":311,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"312":{"id":312,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"313":{"id":313,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"314":{"id":314,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"315":{"id":315,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"316":{"id":316,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"317":{"id":317,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"318":{"id":318,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"319":{"id":319,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"320":{"id":320,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"321":{"id":321,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"322":{"id":322,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0}}';
        $mock = json_decode($mock, true);
        $this->CategoryRepository->expects($this->once())->method('getTotalProduct')->will($this->returnValue($mock));

        $mock = '13';
        $this->CategoryRepository->expects($this->once())->method('listsCount')->will($this->returnValue($mock));

        $mock = '[{"id":322,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":1,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-22 23:24:16","updated_at":"2014-10-22 23:33:41","deleted_at":null,"languages":[{"category_id":322,"language_id":1,"title":"aaayyy","body_html":"","seo_title":"aaayyy","seo_description":""}],"attachments":[{"id":"714a11d284b92ab0a236e182cadc7653","user_id":208,"store_id":2,"album_id":35,"resource":"upload","name":"714a11d284b92ab0a236e182cadc7653","width":81,"height":77,"mime":"image\/jpeg","size":8954,"url":"http:\/\/alpha-store.wls-dev.com\/upload\/gallery\/2\/714a11d284b92ab0a236e182cadc7653.jpg","created_at":"2014-10-22 23:33:41","updated_at":"2014-10-22 23:33:41","deleted_at":null,"public_id":"714a11d284b92ab0a236e182cadc7653"}]},{"id":319,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:07:05","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":319,"language_id":1,"title":"ccc","body_html":"","seo_title":"ccc","seo_description":""}],"attachments":[]},{"id":317,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":3,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:06:25","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":317,"language_id":1,"title":"aaa","body_html":"","seo_title":"aaa","seo_description":""}],"attachments":[]},{"id":321,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":4,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:07:30","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":321,"language_id":1,"title":"eee","body_html":"","seo_title":"eee","seo_description":""}],"attachments":[]},{"id":315,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":5,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:56","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":315,"language_id":1,"title":"66","body_html":"","seo_title":"66","seo_description":""}],"attachments":[]},{"id":314,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":6,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:53","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":314,"language_id":1,"title":"65","body_html":"","seo_title":"65","seo_description":""}],"attachments":[]},{"id":313,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":7,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:49","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":313,"language_id":1,"title":"64","body_html":"","seo_title":"64","seo_description":""}],"attachments":[]},{"id":318,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":8,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:06:45","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":318,"language_id":1,"title":"bbb","body_html":"","seo_title":"bbb","seo_description":""}],"attachments":[]},{"id":320,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":9,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 16:07:11","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":320,"language_id":1,"title":"ddd","body_html":"","seo_title":"ddd","seo_description":""}],"attachments":[]},{"id":312,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":10,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:46","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":312,"language_id":1,"title":"63","body_html":"","seo_title":"63","seo_description":""}],"attachments":[]},{"id":311,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":11,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:42","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":311,"language_id":1,"title":"62","body_html":"","seo_title":"62","seo_description":""}],"attachments":[]},{"id":310,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":12,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:38","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":310,"language_id":1,"title":"61","body_html":"","seo_title":"61","seo_description":""}],"attachments":[]},{"id":309,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":13,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:34","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":309,"language_id":1,"title":"60","body_html":"","seo_title":"60","seo_description":""}],"attachments":[]},{"id":308,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":14,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:30","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":308,"language_id":1,"title":"59","body_html":"","seo_title":"59","seo_description":""}],"attachments":[]},{"id":307,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":15,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:27","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":307,"language_id":1,"title":"58","body_html":"","seo_title":"58","seo_description":""}],"attachments":[]},{"id":306,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":16,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:22","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":306,"language_id":1,"title":"57","body_html":"","seo_title":"57","seo_description":""}],"attachments":[]},{"id":305,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":17,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:18","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":305,"language_id":1,"title":"56","body_html":"","seo_title":"56","seo_description":""}],"attachments":[]},{"id":304,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":18,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:14","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":304,"language_id":1,"title":"55","body_html":"","seo_title":"55","seo_description":""}],"attachments":[]},{"id":303,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":19,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:10","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":303,"language_id":1,"title":"54","body_html":"","seo_title":"54","seo_description":""}],"attachments":[]},{"id":302,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":20,"product_count":0,"disable_product_count":0,"reject_count":0,"product_offline":null,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-21 15:20:06","updated_at":"2014-10-22 23:24:16","deleted_at":null,"languages":[{"category_id":302,"language_id":1,"title":"53","body_html":"","seo_title":"53","seo_description":""}],"attachments":[]}]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('listsCategory')->will($this->returnValue($mock));

        $mock = '{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","extension":"png"}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->any())->method('getImage')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/category?store_id=2&fields=id,parent_id,sort_order,status,title,body_html,images,seo(title,description)&nocache=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetIndex_NoStoreID()
    {
        $crawler = $this->client->request('GET', 'api/category?nocache=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The store id field is required."', $json);
    }

    public function testGetIndex_getTotalProductError()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CategoryRepository->expects($this->once())->method('getTotalProduct')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/category?store_id=2&nocache=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function testGetIndex_listsCategoryError()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"250":{"id":250,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"251":{"id":251,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"252":{"id":252,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"253":{"id":253,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"254":{"id":254,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"255":{"id":255,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"256":{"id":256,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"257":{"id":257,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"258":{"id":258,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"259":{"id":259,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"260":{"id":260,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"261":{"id":261,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"262":{"id":262,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"263":{"id":263,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"264":{"id":264,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"265":{"id":265,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"266":{"id":266,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"267":{"id":267,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"268":{"id":268,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"269":{"id":269,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"270":{"id":270,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"271":{"id":271,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"272":{"id":272,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"273":{"id":273,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"274":{"id":274,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"275":{"id":275,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"276":{"id":276,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"277":{"id":277,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"278":{"id":278,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"279":{"id":279,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"280":{"id":280,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"281":{"id":281,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"282":{"id":282,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"283":{"id":283,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"284":{"id":284,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"285":{"id":285,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"286":{"id":286,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"287":{"id":287,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"288":{"id":288,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"289":{"id":289,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"290":{"id":290,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"291":{"id":291,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"292":{"id":292,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"293":{"id":293,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"294":{"id":294,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"295":{"id":295,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"296":{"id":296,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"297":{"id":297,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"298":{"id":298,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"299":{"id":299,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"300":{"id":300,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"301":{"id":301,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"302":{"id":302,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"303":{"id":303,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"304":{"id":304,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"305":{"id":305,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"306":{"id":306,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"307":{"id":307,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"308":{"id":308,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"309":{"id":309,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"310":{"id":310,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"311":{"id":311,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"312":{"id":312,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"313":{"id":313,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"314":{"id":314,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"315":{"id":315,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"316":{"id":316,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"317":{"id":317,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"318":{"id":318,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"319":{"id":319,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"320":{"id":320,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"321":{"id":321,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0},"322":{"id":322,"parent_id":0,"product_count":0,"disable_product_count":0,"product_offline":null,"total_count":0,"total_child":0}}';
        $mock = json_decode($mock, true);
        $this->CategoryRepository->expects($this->once())->method('getTotalProduct')->will($this->returnValue($mock));

        $mock = '13';
        $this->CategoryRepository->expects($this->once())->method('listsCount')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('listsCategory')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/category?store_id=2&nocache=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    // Show
    public function testGetShowSuccess()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '[{"id":229,"store_id":1,"user_id":205,"parent_id":0,"handle":"","sort_order":"manual","position":1,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-14 21:22:18","updated_at":"2014-10-16 15:04:46","deleted_at":null,"languages":[{"category_id":229,"language_id":1,"title":"YU","body_html":"","seo_title":"YU","seo_description":""}]}]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getShow')->will($this->returnValue($mock));

        $mock = '{"1":{"id":1,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"3":{"id":3,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"4":{"id":4,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"5":{"id":5,"parent_id":0,"product_count":2,"disable_product_count":0,"total_count":2,"total_child":0},"7":{"id":7,"parent_id":0,"product_count":1,"disable_product_count":-1,"total_count":2,"total_child":0},"21":{"id":21,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"22":{"id":22,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"23":{"id":23,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"24":{"id":24,"parent_id":0,"product_count":3,"disable_product_count":0,"total_count":3,"total_child":0},"31":{"id":31,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"69":{"id":69,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"75":{"id":75,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"76":{"id":76,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"77":{"id":77,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"78":{"id":78,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"80":{"id":80,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"83":{"id":83,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"87":{"id":87,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"88":{"id":88,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"89":{"id":89,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"90":{"id":90,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"91":{"id":91,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"92":{"id":92,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"93":{"id":93,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"94":{"id":94,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"95":{"id":95,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"96":{"id":96,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"97":{"id":97,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"98":{"id":98,"parent_id":0,"product_count":-2,"disable_product_count":0,"total_count":-2,"total_child":0},"99":{"id":99,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"100":{"id":100,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"101":{"id":101,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"102":{"id":102,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"103":{"id":103,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"104":{"id":104,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"105":{"id":105,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"106":{"id":106,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"107":{"id":107,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"108":{"id":108,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"109":{"id":109,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"110":{"id":110,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"111":{"id":111,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"112":{"id":112,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"113":{"id":113,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"114":{"id":114,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"115":{"id":115,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"116":{"id":116,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"117":{"id":117,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"118":{"id":118,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"119":{"id":119,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"120":{"id":120,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"121":{"id":121,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"122":{"id":122,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"123":{"id":123,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"124":{"id":124,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"125":{"id":125,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"126":{"id":126,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"127":{"id":127,"parent_id":0,"product_count":2,"disable_product_count":1,"total_count":1,"total_child":0},"128":{"id":128,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"129":{"id":129,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"130":{"id":130,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"131":{"id":131,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"132":{"id":132,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"133":{"id":133,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"134":{"id":134,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"135":{"id":135,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"136":{"id":136,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"137":{"id":137,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"138":{"id":138,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"139":{"id":139,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"140":{"id":140,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"141":{"id":141,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"142":{"id":142,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"143":{"id":143,"parent_id":0,"product_count":2,"disable_product_count":0,"total_count":2,"total_child":0},"144":{"id":144,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"146":{"id":146,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"160":{"id":160,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"161":{"id":161,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"162":{"id":162,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"163":{"id":163,"parent_id":0,"product_count":1,"disable_product_count":1,"total_count":0,"total_child":0},"172":{"id":172,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"173":{"id":173,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"174":{"id":174,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"175":{"id":175,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"176":{"id":176,"parent_id":0,"product_count":1,"disable_product_count":1,"total_count":0,"total_child":0},"177":{"id":177,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"178":{"id":178,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"179":{"id":179,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"180":{"id":180,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"181":{"id":181,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"182":{"id":182,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"188":{"id":188,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"189":{"id":189,"parent_id":0,"product_count":2,"disable_product_count":0,"total_count":2,"total_child":0},"190":{"id":190,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"191":{"id":191,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"192":{"id":192,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"193":{"id":193,"parent_id":0,"product_count":3,"disable_product_count":0,"total_count":3,"total_child":0},"194":{"id":194,"parent_id":0,"product_count":4,"disable_product_count":1,"total_count":3,"total_child":0},"195":{"id":195,"parent_id":0,"product_count":3,"disable_product_count":0,"total_count":3,"total_child":0},"201":{"id":201,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"202":{"id":202,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"203":{"id":203,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"204":{"id":204,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"205":{"id":205,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"206":{"id":206,"parent_id":0,"product_count":2,"disable_product_count":0,"total_count":2,"total_child":0},"207":{"id":207,"parent_id":0,"product_count":2,"disable_product_count":0,"total_count":2,"total_child":0},"208":{"id":208,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"215":{"id":215,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"218":{"id":218,"parent_id":0,"product_count":2,"disable_product_count":0,"total_count":2,"total_child":0},"220":{"id":220,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"221":{"id":221,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"222":{"id":222,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"224":{"id":224,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"225":{"id":225,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"226":{"id":226,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"227":{"id":227,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"228":{"id":228,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"229":{"id":229,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"230":{"id":230,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"231":{"id":231,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"232":{"id":232,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"233":{"id":233,"parent_id":0,"product_count":1,"disable_product_count":1,"total_count":0,"total_child":0},"234":{"id":234,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"235":{"id":235,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"236":{"id":236,"parent_id":0,"product_count":4,"disable_product_count":0,"total_count":4,"total_child":0},"237":{"id":237,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"238":{"id":238,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"239":{"id":239,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"240":{"id":240,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"241":{"id":241,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"242":{"id":242,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"243":{"id":243,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"244":{"id":244,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"245":{"id":245,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"246":{"id":246,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"247":{"id":247,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"248":{"id":248,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"249":{"id":249,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"253":{"id":253,"parent_id":0,"product_count":1,"disable_product_count":1,"total_count":0,"total_child":0},"254":{"id":254,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"255":{"id":255,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"256":{"id":256,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"257":{"id":257,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"270":{"id":270,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"275":{"id":275,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"276":{"id":276,"parent_id":0,"product_count":4,"disable_product_count":0,"total_count":4,"total_child":0},"278":{"id":278,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"279":{"id":279,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"280":{"id":280,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"281":{"id":281,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"282":{"id":282,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"295":{"id":295,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"296":{"id":296,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"297":{"id":297,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"298":{"id":298,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"299":{"id":299,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"300":{"id":300,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"301":{"id":301,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"302":{"id":302,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"303":{"id":303,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"304":{"id":304,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"305":{"id":305,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"306":{"id":306,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"307":{"id":307,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"308":{"id":308,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"309":{"id":309,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"310":{"id":310,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"311":{"id":311,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"312":{"id":312,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"313":{"id":313,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"314":{"id":314,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"315":{"id":315,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"316":{"id":316,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"317":{"id":317,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"318":{"id":318,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"319":{"id":319,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"320":{"id":320,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"321":{"id":321,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"322":{"id":322,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"323":{"id":323,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"324":{"id":324,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"325":{"id":325,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"326":{"id":326,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"327":{"id":327,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"328":{"id":328,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"329":{"id":329,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"330":{"id":330,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"331":{"id":331,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"332":{"id":332,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"333":{"id":333,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"334":{"id":334,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"335":{"id":335,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"336":{"id":336,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"337":{"id":337,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"338":{"id":338,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"339":{"id":339,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"340":{"id":340,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"341":{"id":341,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"342":{"id":342,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"343":{"id":343,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"344":{"id":344,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"345":{"id":345,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"346":{"id":346,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"347":{"id":347,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"348":{"id":348,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"349":{"id":349,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"350":{"id":350,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"351":{"id":351,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"352":{"id":352,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"353":{"id":353,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"354":{"id":354,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"355":{"id":355,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"356":{"id":356,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"357":{"id":357,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"358":{"id":358,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"359":{"id":359,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"360":{"id":360,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"361":{"id":361,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"362":{"id":362,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"363":{"id":363,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"364":{"id":364,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"365":{"id":365,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"366":{"id":366,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"367":{"id":367,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"368":{"id":368,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"369":{"id":369,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"370":{"id":370,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"372":{"id":372,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"376":{"id":376,"parent_id":0,"product_count":3,"disable_product_count":0,"total_count":3,"total_child":0},"381":{"id":381,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"382":{"id":382,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"383":{"id":383,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"384":{"id":384,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"385":{"id":385,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"386":{"id":386,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"391":{"id":391,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"396":{"id":396,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"401":{"id":401,"parent_id":0,"product_count":1,"disable_product_count":0,"total_count":1,"total_child":0},"402":{"id":402,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"403":{"id":403,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"404":{"id":404,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"425":{"id":425,"parent_id":0,"product_count":3,"disable_product_count":0,"total_count":3,"total_child":0},"426":{"id":426,"parent_id":0,"product_count":2,"disable_product_count":0,"total_count":2,"total_child":0},"427":{"id":427,"parent_id":0,"product_count":2,"disable_product_count":0,"total_count":2,"total_child":0},"444":{"id":444,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"445":{"id":445,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"446":{"id":446,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"447":{"id":447,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0},"448":{"id":448,"parent_id":0,"product_count":0,"disable_product_count":0,"total_count":0,"total_child":0}}';
        $mock = json_decode($mock, true);
        $this->CategoryRepository->expects($this->once())->method('getTotalProductInCategory')->will($this->returnValue($mock));

        $mock = '{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","extension":"png"}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getImageShow')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/category/229?store_id=2');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetShowWithCacheSuccess()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '{"benchmark":"false","record":[{"id":391,"store_id":2,"user_id":208,"parent_id":0,"sort_order":"manual","position":1,"product_count":0,"total_product_count":0,"disable_product_count":0,"total_child_count":0,"status":"true","created_at":{"date":"2014-10-23 10:11:13","timeago":"5 days ago","format":"23 October 2014 10:11 AM"},"updated_at":{"date":"2014-10-23 10:11:14","timeago":"5 days ago","format":"23 October 2014 10:11 AM"},"title":{"th":"a81"},"seo":{"title":{"th":"dsf"},"description":{"th":"sdfts"}},"body_html":{"th":""}}]}';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $crawler = $this->client->request('GET', 'api/category/229?store_id=2');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testGetShow_NoStoreID()
    {
        $crawler = $this->client->request('GET', 'api/category/229');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The store id field is required."', $json);
    }

    public function testGetShow_getShowError()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getShow')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/category/229?store_id=1&nocache=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function testGetShow_getTotalProductInCategoryError()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('get')->will($this->returnValue($mock));

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '[{"id":229,"store_id":1,"user_id":205,"parent_id":0,"handle":"","sort_order":"manual","position":1,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-14 21:22:18","updated_at":"2014-10-16 15:04:46","deleted_at":null,"languages":[{"category_id":229,"language_id":1,"title":"YU","body_html":"","seo_title":"YU","seo_description":""}]}]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getShow')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CategoryRepository->expects($this->once())->method('getTotalProductInCategory')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/category/229?store_id=1&nocache=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    // Store
    public function testPostStoreSuccess()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '14';
        $this->CategoryRepository->expects($this->once())->method('chkCateLimitQuota')->will($this->returnValue($mock));

        $this->QuotaRepository = $this->getMock('QuotaRepository');
        $this->app->instance('QuotaRepository', $this->QuotaRepository);

        $mock = '{"language":"20","pages":"200","collection":"200","product_sku":"500","promotion":"200","blogs":"200","storage":5400166400,"category":"200"}';
        $mock = json_decode($mock);
        $this->QuotaRepository->expects($this->once())->method('getQuota')->will($this->returnValue($mock));

        $mock = '';
        $this->CategoryRepository->expects($this->once())->method('chkCateDupTitle')->will($this->returnValue($mock));

        $mock = '{"store_id":"2","user_id":"208","sort_order":"manual","parent_id":"0","position":"0","product_count":"0","status":1,"updated_at":"2014-10-20 10:47:02","created_at":"2014-10-20 10:47:02","id":264}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('insertCategory')->will($this->returnValue($mock));

        $mock = '[{"id":187,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":1,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:19:49","updated_at":"2014-10-09 11:21:11","deleted_at":null,"languages":[{"category_id":187,"language_id":1,"title":"aaaxxx","body_html":"","seo_title":"aaaxxx","seo_description":"saaaa"}],"attachments":[]},{"id":186,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:17:16","updated_at":"2014-10-09 11:21:11","deleted_at":null,"languages":[{"category_id":186,"language_id":1,"title":"xxxx","body_html":"","seo_title":"xxxx","seo_description":""}],"attachments":[]},{"id":185,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":3,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:16:25","updated_at":"2014-10-09 11:21:11","deleted_at":null,"languages":[{"category_id":185,"language_id":1,"title":"aaaa","body_html":"","seo_title":"aaaa","seo_description":""}],"attachments":[]},{"id":184,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":4,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:12:09","updated_at":"2014-10-09 11:21:11","deleted_at":null,"languages":[{"category_id":184,"language_id":1,"title":"asujdfjdsf","body_html":"","seo_title":"asujdfjdsf","seo_description":""}],"attachments":[]},{"id":183,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":5,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:08:15","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":183,"language_id":1,"title":"asd","body_html":"","seo_title":"asd","seo_description":"sdfdsf"}],"attachments":[]},{"id":171,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":6,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-07 10:07:49","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":171,"language_id":1,"title":"xxx","body_html":"","seo_title":"xxx","seo_description":""}],"attachments":[]},{"id":170,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":7,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-07 09:58:42","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":170,"language_id":1,"title":"bbb","body_html":"","seo_title":"","seo_description":""}],"attachments":[]},{"id":169,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":8,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-07 02:47:39","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":169,"language_id":1,"title":"aaa","body_html":"","seo_title":"","seo_description":""}],"attachments":[]},{"id":168,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":9,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-07 02:47:35","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":168,"language_id":1,"title":"aaa","body_html":"","seo_title":"","seo_description":""}],"attachments":[]},{"id":167,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":10,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-06 14:29:06","updated_at":"2014-10-09 11:21:13","deleted_at":null,"languages":[{"category_id":167,"language_id":1,"title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","body_html":"","seo_title":"","seo_description":""}],"attachments":[]},{"id":166,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":11,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-06 14:28:31","updated_at":"2014-10-09 11:21:13","deleted_at":null,"languages":[{"category_id":166,"language_id":1,"title":"aaa","body_html":"","seo_title":"aaa","seo_description":""}],"attachments":[]},{"id":165,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":12,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-06 14:28:19","updated_at":"2014-10-09 11:21:13","deleted_at":null,"languages":[{"category_id":165,"language_id":1,"title":"aaa","body_html":"","seo_title":"aaa","seo_description":""}],"attachments":[]},{"id":74,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":13,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-02 07:05:12","updated_at":"2014-10-09 11:21:13","deleted_at":null,"languages":[{"category_id":74,"language_id":1,"title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","body_html":"","seo_title":"","seo_description":""}],"attachments":[]}]';
        $this->CategoryRepository->expects($this->once())->method('listsCategory')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->any())->method('updateCategory')->will($this->returnValue($mock));

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->once())->method('clear')->will($this->returnValue($mock));

        $crawler = $this->client->request('POST', 'api/category', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testPostStoreNoStoreID()
    {
        $param = array(
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $crawler = $this->client->request('POST', 'api/category', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The store id field is required."', $json);
    }

    public function testPostStore_getQuotaCategory_Error()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '14';
        $this->CategoryRepository->expects($this->once())->method('chkCateLimitQuota')->will($this->returnValue($mock));

        $this->QuotaRepository = $this->getMock('QuotaRepository');
        $this->app->instance('QuotaRepository', $this->QuotaRepository);

        $mock = '';
        $mock = json_decode($mock);
        $this->QuotaRepository->expects($this->once())->method('getQuota')->will($this->returnValue($mock));

        $crawler = $this->client->request('POST', 'api/category', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);
        $this->assertContains('"status_txt":"Connection error"', $json);
    }

    public function testPostStore_getQuotaCategory_OverQuota()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '201';
        $this->CategoryRepository->expects($this->once())->method('chkCateLimitQuota')->will($this->returnValue($mock));

        $this->QuotaRepository = $this->getMock('QuotaRepository');
        $this->app->instance('QuotaRepository', $this->QuotaRepository);

        $mock = '{"language":"20","pages":"200","collection":"200","product_sku":"500","promotion":"200","blogs":"200","storage":5400166400,"category":"200"}';
        $mock = json_decode($mock);
        $this->QuotaRepository->expects($this->once())->method('getQuota')->will($this->returnValue($mock));

        $crawler = $this->client->request('POST', 'api/category', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1008', $json);
        $this->assertContains('"status_txt":"Limit quota"', $json);
    }

    public function testPostStoreDuplicateTitle()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '14';
        $this->CategoryRepository->expects($this->once())->method('chkCateLimitQuota')->will($this->returnValue($mock));

        $this->QuotaRepository = $this->getMock('QuotaRepository');
        $this->app->instance('QuotaRepository', $this->QuotaRepository);

        $mock = '{"language":"20","pages":"200","collection":"200","product_sku":"500","promotion":"200","blogs":"200","storage":5400166400,"category":"200"}';
        $mock = json_decode($mock);
        $this->QuotaRepository->expects($this->once())->method('getQuota')->will($this->returnValue($mock));

        $mock = '169';
        $this->CategoryRepository->expects($this->once())->method('chkCateDupTitle')->will($this->returnValue($mock));

        $crawler = $this->client->request('POST', 'api/category', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1017', $json);
        $this->assertContains('"status_txt":"Duplicate category name"', $json);
    }

    public function testPostStore_insertCategory_Error()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '14';
        $this->CategoryRepository->expects($this->once())->method('chkCateLimitQuota')->will($this->returnValue($mock));

        $this->QuotaRepository = $this->getMock('QuotaRepository');
        $this->app->instance('QuotaRepository', $this->QuotaRepository);

        $mock = '{"language":"20","pages":"200","collection":"200","product_sku":"500","promotion":"200","blogs":"200","storage":5400166400,"category":"200"}';
        $mock = json_decode($mock);
        $this->QuotaRepository->expects($this->once())->method('getQuota')->will($this->returnValue($mock));

        $mock = '';
        $this->CategoryRepository->expects($this->once())->method('chkCateDupTitle')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('insertCategory')->will($this->returnValue($mock));

        $crawler = $this->client->request('POST', 'api/category', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1001', $json);
        $this->assertContains('"status_txt":"Connection error"', $json);
    }

    // Update
    public function testPostUpdateSuccess()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"id":265,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-20 13:17:48","updated_at":"2014-10-20 15:04:49","deleted_at":null}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('updateCategory')->will($this->returnValue($mock));

        $mock = '';
        $this->CategoryRepository->expects($this->once())->method('chkCateDupLanguage')->will($this->returnValue($mock));

        $mock = '[{"category_id":265,"language_id":1,"title":"bbbb","body_html":"","seo_title":"hhh","seo_description":"sdfts"}]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getCategoryLanguage')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('updateCategoryLanguage')->will($this->returnValue($mock));

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testPostUpdate_NoStoreID()
    {
        $param = array(
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $crawler = $this->client->request('PUT', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The store id field is required."', $json);
    }

    public function testPostUpdate_findCategory_DataNotFound()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function testPostUpdate_DuplicationTitle()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"id":265,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-20 13:17:48","updated_at":"2014-10-20 15:04:49","deleted_at":null}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('updateCategory')->will($this->returnValue($mock));

        $mock = '265';
        $this->CategoryRepository->expects($this->once())->method('chkCateDupLanguage')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1017', $json);
        $this->assertContains('"status_txt":"Duplicate category name"', $json);
    }

    public function testPostUpdate_getCategoryLanguage_NoData()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"id":265,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-20 13:17:48","updated_at":"2014-10-20 15:04:49","deleted_at":null}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('updateCategory')->will($this->returnValue($mock));

        $mock = '';
        $this->CategoryRepository->expects($this->once())->method('chkCateDupLanguage')->will($this->returnValue($mock));

        $mock = '';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getCategoryLanguage')->will($this->returnValue($mock));

        $mock = '1';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('insertCategoryLanguage')->will($this->returnValue($mock));

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testPostUpdate_WithSyncProduct_Hide()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'false',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"id":265,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-20 13:17:48","updated_at":"2014-10-20 15:04:49","deleted_at":null}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('updateCategory')->will($this->returnValue($mock));

        $mock = '';
        $this->CategoryRepository->expects($this->once())->method('chkCateDupLanguage')->will($this->returnValue($mock));

        $mock = '[{"category_id":265,"language_id":1,"title":"bbbb","body_html":"","seo_title":"hhh","seo_description":"sdfts"}]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getCategoryLanguage')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('updateCategoryLanguage')->will($this->returnValue($mock));

        $mock = '[450,451,452]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getProductCategory')->will($this->returnValue($mock));

        $this->ManageQueueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->ManageQueueRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->ManageQueueRepository->expects($this->any())->method('syncProduct')->will($this->returnValue($mock));

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testPostUpdate_WithSyncProduct_Show()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"id":265,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":0,"created_by":0,"updated_by":0,"created_at":"2014-10-20 13:17:48","updated_at":"2014-10-20 15:04:49","deleted_at":null}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('updateCategory')->will($this->returnValue($mock));

        $mock = '';
        $this->CategoryRepository->expects($this->once())->method('chkCateDupLanguage')->will($this->returnValue($mock));

        $mock = '[{"category_id":265,"language_id":1,"title":"bbbb","body_html":"","seo_title":"hhh","seo_description":"sdfts"}]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getCategoryLanguage')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('updateCategoryLanguage')->will($this->returnValue($mock));

        $mock = '[450,451,452]';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('getProductCategory')->will($this->returnValue($mock));

        $this->ManageQueueRepository = $this->getMock('ManageQueueRepository');
        $this->app->instance('ManageQueueRepository', $this->ManageQueueRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->ManageQueueRepository->expects($this->any())->method('syncProduct')->will($this->returnValue($mock));

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue($mock));

        $crawler = $this->client->request('PUT', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    // Delete
    public function testDeleteSuccess()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"id":265,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-20 13:17:48","updated_at":"2014-10-20 15:27:06","deleted_at":null}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $mock = '0';
        $this->CategoryRepository->expects($this->once())->method('countProductCategory')->will($this->returnValue($mock));

        $mock = 'true';
        $this->CategoryRepository->expects($this->once())->method('deleteCategory')->will($this->returnValue($mock));

        $mock = '[{"id":187,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":1,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:19:49","updated_at":"2014-10-09 11:21:11","deleted_at":null,"languages":[{"category_id":187,"language_id":1,"title":"aaaxxx","body_html":"","seo_title":"aaaxxx","seo_description":"saaaa"}],"attachments":[]},{"id":186,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:17:16","updated_at":"2014-10-09 11:21:11","deleted_at":null,"languages":[{"category_id":186,"language_id":1,"title":"xxxx","body_html":"","seo_title":"xxxx","seo_description":""}],"attachments":[]},{"id":185,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":3,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:16:25","updated_at":"2014-10-09 11:21:11","deleted_at":null,"languages":[{"category_id":185,"language_id":1,"title":"aaaa","body_html":"","seo_title":"aaaa","seo_description":""}],"attachments":[]},{"id":184,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":4,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:12:09","updated_at":"2014-10-09 11:21:11","deleted_at":null,"languages":[{"category_id":184,"language_id":1,"title":"asujdfjdsf","body_html":"","seo_title":"asujdfjdsf","seo_description":""}],"attachments":[]},{"id":183,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":5,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-08 15:08:15","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":183,"language_id":1,"title":"asd","body_html":"","seo_title":"asd","seo_description":"sdfdsf"}],"attachments":[]},{"id":171,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":6,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-07 10:07:49","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":171,"language_id":1,"title":"xxx","body_html":"","seo_title":"xxx","seo_description":""}],"attachments":[]},{"id":170,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":7,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-07 09:58:42","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":170,"language_id":1,"title":"bbb","body_html":"","seo_title":"","seo_description":""}],"attachments":[]},{"id":169,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":8,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-07 02:47:39","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":169,"language_id":1,"title":"aaa","body_html":"","seo_title":"","seo_description":""}],"attachments":[]},{"id":168,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":9,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-07 02:47:35","updated_at":"2014-10-09 11:21:12","deleted_at":null,"languages":[{"category_id":168,"language_id":1,"title":"aaa","body_html":"","seo_title":"","seo_description":""}],"attachments":[]},{"id":167,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":10,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-06 14:29:06","updated_at":"2014-10-09 11:21:13","deleted_at":null,"languages":[{"category_id":167,"language_id":1,"title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","body_html":"","seo_title":"","seo_description":""}],"attachments":[]},{"id":166,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":11,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-06 14:28:31","updated_at":"2014-10-09 11:21:13","deleted_at":null,"languages":[{"category_id":166,"language_id":1,"title":"aaa","body_html":"","seo_title":"aaa","seo_description":""}],"attachments":[]},{"id":165,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":12,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-06 14:28:19","updated_at":"2014-10-09 11:21:13","deleted_at":null,"languages":[{"category_id":165,"language_id":1,"title":"aaa","body_html":"","seo_title":"aaa","seo_description":""}],"attachments":[]},{"id":74,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":13,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-02 07:05:12","updated_at":"2014-10-09 11:21:13","deleted_at":null,"languages":[{"category_id":74,"language_id":1,"title":"\u0e40\u0e2a\u0e37\u0e49\u0e2d\u0e1c\u0e49\u0e32","body_html":"","seo_title":"","seo_description":""}],"attachments":[]}]';
        $this->CategoryRepository->expects($this->once())->method('listsCategory')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->any())->method('updateCategory')->will($this->returnValue($mock));

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);

        $mock = '';
        $mock = json_decode($mock, true);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue($mock));
        
        $crawler = $this->client->request('DELETE', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function testDelete_NoStoreID()
    {
        $param = array(
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $crawler = $this->client->request('DELETE', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
        $this->assertContains('"message":"The store id field is required."', $json);
    }

    public function testDelete_findCategory_Error()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $crawler = $this->client->request('DELETE', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function testDelete_countProductCategory_moreThanZero()
    {
        $param = array(
            'store_id' => '2',
            'user_id' => '208',
            'sort_order' => 'manual',
            'parent_id' => '0',
            'position' => '0',
            'product_count' => '0',
            'status' => 'true',
            'title' => array(
                'th' => 'aaa'
            ),
            'body_html' => array(
                'th' => ''
            ),
            'seo' => array(
                'title' => array(
                    'th' => 'dsf'
                ),
                'description' => array(
                    'th' => 'sdfdsf'
                )

            )
        );

        $this->CategoryRepository = $this->getMock('CategoryRepository');
        $this->app->instance('CategoryRepository', $this->CategoryRepository);

        $mock = '{"id":265,"store_id":2,"user_id":208,"parent_id":0,"handle":"","sort_order":"manual","position":2,"product_count":0,"disable_product_count":0,"status":1,"created_by":0,"updated_by":0,"created_at":"2014-10-20 13:17:48","updated_at":"2014-10-20 15:27:06","deleted_at":null}';
        $mock = json_decode($mock);
        $this->CategoryRepository->expects($this->once())->method('findCategory')->will($this->returnValue($mock));

        $mock = '1';
        $this->CategoryRepository->expects($this->once())->method('countProductCategory')->will($this->returnValue($mock));

        $crawler = $this->client->request('DELETE', 'api/category/265', $param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1007', $json);
        $this->assertContains('"status_txt":"Delete data error"', $json);
    }

}
