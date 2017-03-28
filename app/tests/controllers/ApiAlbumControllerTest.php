<?php

class ApiAlbumControllerTest extends ApiTestCase
{

    public function test_Get_Success()
    {
        
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":12},"record":[{"id":316,"store_id":1,"user_id":205,"title":"Untitled Albumr","status":0,"default_album":"false","size":{"bytes":126990,"format":"124.01 KB"},"thumbnail":[{"id":"8c648eeabeab159d962a4b9eab4cea41","name":"8c648eeabeab159d962a4b9eab4cea41","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/8c648eeabeab159d962a4b9eab4cea41.JPG","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"db9f23d7b768243bf5ac3757434cb435","name":"s","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/db9f23d7b768243bf5ac3757434cb435.JPG","extension":"jpg","mime":"image\/jpeg","position":2}],"count":2,"created_at":{"date":"2014-10-14 21:18:43","timeago":"2 weeks ago","format":"14 October 2014 9:18 PM"},"updated_at":{"date":"2014-10-29 10:42:58","timeago":"19 minutes ago","format":"29 October 2014 10:42 AM"}},{"id":440,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":589089,"format":"575.28 KB"},"thumbnail":[{"id":"9eb7bfff8b33cc2bae90596e120f4c3b","name":"9eb7bfff8b33cc2bae90596e120f4c3b","url":"http:\/\/store.weloveshopping.loc\/upload\/gallery\/1\/9eb7bfff8b33cc2bae90596e120f4c3b.jpg","extension":"jpg","mime":"image\/jpeg","position":1}],"count":1,"created_at":{"date":"2014-10-28 16:42:21","timeago":"18 hours ago","format":"28 October 2014 4:42 PM"},"updated_at":{"date":"2014-10-28 16:42:21","timeago":"18 hours ago","format":"28 October 2014 4:42 PM"}},{"id":409,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":2406721,"format":"2.30 MB"},"thumbnail":[{"id":"efbc7e91e0bec96aecd506cb7151b724","name":"efbc7e91e0bec96aecd506cb7151b724","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/efbc7e91e0bec96aecd506cb7151b724.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"7a4c0f34b2d5b43b6aeef558a9f6a4b9","name":"7a4c0f34b2d5b43b6aeef558a9f6a4b9","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/7a4c0f34b2d5b43b6aeef558a9f6a4b9.jpg","extension":"jpg","mime":"image\/jpeg","position":2},{"id":"ae110e74a912b512b9b08f5454719d41","name":"ae110e74a912b512b9b08f5454719d41","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/ae110e74a912b512b9b08f5454719d41.jpg","extension":"jpg","mime":"image\/jpeg","position":3},{"id":"832e89cd76126da8d094451a217555ec","name":"832e89cd76126da8d094451a217555ec","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/832e89cd76126da8d094451a217555ec.jpg","extension":"jpg","mime":"image\/jpeg","position":4}],"count":6,"created_at":{"date":"2014-10-24 10:32:28","timeago":"5 days ago","format":"24 October 2014 10:32 AM"},"updated_at":{"date":"2014-10-24 11:20:48","timeago":"4 days ago","format":"24 October 2014 11:20 AM"}},{"id":408,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":67826,"format":"66.24 KB"},"thumbnail":[{"id":"b41f87346acb9e24ac08fe9438ba2ffe","name":"b41f87346acb9e24ac08fe9438ba2ffe","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/b41f87346acb9e24ac08fe9438ba2ffe.png","extension":"png","mime":"image\/png","position":1},{"id":"3d6d2d0b34d96d387ea06ce3f6cc916e","name":"3d6d2d0b34d96d387ea06ce3f6cc916e","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/3d6d2d0b34d96d387ea06ce3f6cc916e.png","extension":"png","mime":"image\/png","position":2},{"id":"becb96a854c8108d3748f577581c2a9a","name":"becb96a854c8108d3748f577581c2a9a","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/becb96a854c8108d3748f577581c2a9a.png","extension":"png","mime":"image\/png","position":3}],"count":3,"created_at":{"date":"2014-10-24 09:59:08","timeago":"5 days ago","format":"24 October 2014 9:59 AM"},"updated_at":{"date":"2014-10-24 09:59:09","timeago":"5 days ago","format":"24 October 2014 9:59 AM"}},{"id":387,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":1896748,"format":"1.81 MB"},"thumbnail":[{"id":"bc7033268a7d1ad26358cd7c15badf7d","name":"bc7033268a7d1ad26358cd7c15badf7d","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/bc7033268a7d1ad26358cd7c15badf7d.png","extension":"png","mime":"image\/png","position":1},{"id":"203b61024df5a7bb61f3fda304a3f7ec","name":"203b61024df5a7bb61f3fda304a3f7ec","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/203b61024df5a7bb61f3fda304a3f7ec.png","extension":"png","mime":"image\/png","position":2},{"id":"b2d0d2a250c0284b8ba0987551ea89a6","name":"b2d0d2a250c0284b8ba0987551ea89a6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/b2d0d2a250c0284b8ba0987551ea89a6.png","extension":"png","mime":"image\/png","position":3},{"id":"222a2c60b6e7b46fe65bd6f073f1f0d7","name":"222a2c60b6e7b46fe65bd6f073f1f0d7","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/222a2c60b6e7b46fe65bd6f073f1f0d7.png","extension":"png","mime":"image\/png","position":4}],"count":12,"created_at":{"date":"2014-10-21 18:58:24","timeago":"1 week ago","format":"21 October 2014 6:58 PM"},"updated_at":{"date":"2014-10-21 18:58:25","timeago":"1 week ago","format":"21 October 2014 6:58 PM"}},{"id":386,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":246988,"format":"241.20 KB"},"thumbnail":[{"id":"5e2cb888419c9155061929331dd385da","name":"5e2cb888419c9155061929331dd385da","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/5e2cb888419c9155061929331dd385da.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-21 18:05:59","timeago":"1 week ago","format":"21 October 2014 6:05 PM"},"updated_at":{"date":"2014-10-21 18:05:59","timeago":"1 week ago","format":"21 October 2014 6:05 PM"}},{"id":385,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":246988,"format":"241.20 KB"},"thumbnail":[{"id":"d990545675fca0d22661fa8a5f7a7d9a","name":"d990545675fca0d22661fa8a5f7a7d9a","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/d990545675fca0d22661fa8a5f7a7d9a.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-21 17:46:44","timeago":"1 week ago","format":"21 October 2014 5:46 PM"},"updated_at":{"date":"2014-10-21 17:46:44","timeago":"1 week ago","format":"21 October 2014 5:46 PM"}},{"id":370,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":207412,"format":"202.55 KB"},"thumbnail":[{"id":"3e37cbaabdfe765610a7cc4d33a15b67","name":"3e37cbaabdfe765610a7cc4d33a15b67","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/3e37cbaabdfe765610a7cc4d33a15b67.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 23:12:39","timeago":"1 week ago","format":"20 October 2014 11:12 PM"},"updated_at":{"date":"2014-10-20 23:12:39","timeago":"1 week ago","format":"20 October 2014 11:12 PM"}},{"id":1,"store_id":1,"user_id":205,"title":"Default Album","status":2,"default_album":"true","size":{"bytes":2785696,"format":"2.66 MB"},"thumbnail":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","name":"15c74770fcd2dbc28cff7b87dd1f4ed6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","name":"9b2d8c30c8c5b74cef3917c481153cc4","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","extension":"png","mime":"image\/png","position":2},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","extension":"png","mime":"image\/png","position":3},{"id":"ad6c284c6771f8d11e9d5f740d234f99","name":"ad6c284c6771f8d11e9d5f740d234f99","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","extension":"png","mime":"image\/png","position":4}],"count":11,"created_at":{"date":"2014-08-22 09:58:36","timeago":"2 months ago","format":"22 August 2014 9:58 AM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"1 week ago","format":"20 October 2014 5:36 PM"}},{"id":359,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":298800,"format":"291.80 KB"},"thumbnail":[{"id":"86538754fe871fab059b766aee92d27e","name":"86538754fe871fab059b766aee92d27e","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/86538754fe871fab059b766aee92d27e.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 10:51:07","timeago":"1 week ago","format":"20 October 2014 10:51 AM"},"updated_at":{"date":"2014-10-20 10:51:07","timeago":"1 week ago","format":"20 October 2014 10:51 AM"}},{"id":358,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":54633,"format":"53.35 KB"},"thumbnail":[{"id":"cff745b2f2c4d4f28a828bff2ab6e877","name":"cff745b2f2c4d4f28a828bff2ab6e877","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/cff745b2f2c4d4f28a828bff2ab6e877.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 10:50:09","timeago":"1 week ago","format":"20 October 2014 10:50 AM"},"updated_at":{"date":"2014-10-20 10:50:09","timeago":"1 week ago","format":"20 October 2014 10:50 AM"}},{"id":37,"store_id":1,"user_id":205,"title":"shoe2ds","status":0,"default_album":"false","size":{"bytes":142737,"format":"139.39 KB"},"thumbnail":[{"id":"4739b057a8fc10ce7e4f174af729c8d6","name":"4739b057a8fc10ce7e4f174af729c8d6","url":"http:\/\/store.weloveshopping.loc\/upload\/gallery\/1\/4739b057a8fc10ce7e4f174af729c8d6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"a74db1dd4712035017c4669045c39e47","name":"shoes-bl","url":"\/uploads\/1\/a74db1dd4712035017c4669045c39e47.jpg","extension":"jpg","mime":"image\/jpeg","position":2}],"count":2,"created_at":{"date":"2014-08-26 03:20:21","timeago":"2 months ago","format":"26 August 2014 3:20 AM"},"updated_at":{"date":"2014-10-17 15:54:27","timeago":"1 week ago","format":"17 October 2014 3:54 PM"}}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));


        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);

        $mock = '{"result":[{"id":316,"store_id":1,"user_id":205,"title":"Untitled Albumr","status":0,"default_album":"false","size":{"bytes":126990,"format":"124.01 KB"},"thumbnail":[{"id":"8c648eeabeab159d962a4b9eab4cea41","name":"8c648eeabeab159d962a4b9eab4cea41","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/8c648eeabeab159d962a4b9eab4cea41.JPG","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"db9f23d7b768243bf5ac3757434cb435","name":"s","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/db9f23d7b768243bf5ac3757434cb435.JPG","extension":"jpg","mime":"image\/jpeg","position":2}],"count":2,"created_at":{"date":"2014-10-14 21:18:43","timeago":"2 weeks ago","format":"14 October 2014 9:18 PM"},"updated_at":{"date":"2014-10-29 10:42:58","timeago":"20 minutes ago","format":"29 October 2014 10:42 AM"}},{"id":440,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":589089,"format":"575.28 KB"},"thumbnail":[{"id":"9eb7bfff8b33cc2bae90596e120f4c3b","name":"9eb7bfff8b33cc2bae90596e120f4c3b","url":"http:\/\/store.weloveshopping.loc\/upload\/gallery\/1\/9eb7bfff8b33cc2bae90596e120f4c3b.jpg","extension":"jpg","mime":"image\/jpeg","position":1}],"count":1,"created_at":{"date":"2014-10-28 16:42:21","timeago":"18 hours ago","format":"28 October 2014 4:42 PM"},"updated_at":{"date":"2014-10-28 16:42:21","timeago":"18 hours ago","format":"28 October 2014 4:42 PM"}},{"id":409,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":2406721,"format":"2.30 MB"},"thumbnail":[{"id":"efbc7e91e0bec96aecd506cb7151b724","name":"efbc7e91e0bec96aecd506cb7151b724","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/efbc7e91e0bec96aecd506cb7151b724.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"7a4c0f34b2d5b43b6aeef558a9f6a4b9","name":"7a4c0f34b2d5b43b6aeef558a9f6a4b9","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/7a4c0f34b2d5b43b6aeef558a9f6a4b9.jpg","extension":"jpg","mime":"image\/jpeg","position":2},{"id":"ae110e74a912b512b9b08f5454719d41","name":"ae110e74a912b512b9b08f5454719d41","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/ae110e74a912b512b9b08f5454719d41.jpg","extension":"jpg","mime":"image\/jpeg","position":3},{"id":"832e89cd76126da8d094451a217555ec","name":"832e89cd76126da8d094451a217555ec","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/832e89cd76126da8d094451a217555ec.jpg","extension":"jpg","mime":"image\/jpeg","position":4}],"count":6,"created_at":{"date":"2014-10-24 10:32:28","timeago":"5 days ago","format":"24 October 2014 10:32 AM"},"updated_at":{"date":"2014-10-24 11:20:48","timeago":"4 days ago","format":"24 October 2014 11:20 AM"}},{"id":408,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":67826,"format":"66.24 KB"},"thumbnail":[{"id":"b41f87346acb9e24ac08fe9438ba2ffe","name":"b41f87346acb9e24ac08fe9438ba2ffe","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/b41f87346acb9e24ac08fe9438ba2ffe.png","extension":"png","mime":"image\/png","position":1},{"id":"3d6d2d0b34d96d387ea06ce3f6cc916e","name":"3d6d2d0b34d96d387ea06ce3f6cc916e","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/3d6d2d0b34d96d387ea06ce3f6cc916e.png","extension":"png","mime":"image\/png","position":2},{"id":"becb96a854c8108d3748f577581c2a9a","name":"becb96a854c8108d3748f577581c2a9a","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/becb96a854c8108d3748f577581c2a9a.png","extension":"png","mime":"image\/png","position":3}],"count":3,"created_at":{"date":"2014-10-24 09:59:08","timeago":"5 days ago","format":"24 October 2014 9:59 AM"},"updated_at":{"date":"2014-10-24 09:59:09","timeago":"5 days ago","format":"24 October 2014 9:59 AM"}},{"id":387,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":1896748,"format":"1.81 MB"},"thumbnail":[{"id":"bc7033268a7d1ad26358cd7c15badf7d","name":"bc7033268a7d1ad26358cd7c15badf7d","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/bc7033268a7d1ad26358cd7c15badf7d.png","extension":"png","mime":"image\/png","position":1},{"id":"203b61024df5a7bb61f3fda304a3f7ec","name":"203b61024df5a7bb61f3fda304a3f7ec","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/203b61024df5a7bb61f3fda304a3f7ec.png","extension":"png","mime":"image\/png","position":2},{"id":"b2d0d2a250c0284b8ba0987551ea89a6","name":"b2d0d2a250c0284b8ba0987551ea89a6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/b2d0d2a250c0284b8ba0987551ea89a6.png","extension":"png","mime":"image\/png","position":3},{"id":"222a2c60b6e7b46fe65bd6f073f1f0d7","name":"222a2c60b6e7b46fe65bd6f073f1f0d7","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/222a2c60b6e7b46fe65bd6f073f1f0d7.png","extension":"png","mime":"image\/png","position":4}],"count":12,"created_at":{"date":"2014-10-21 18:58:24","timeago":"1 week ago","format":"21 October 2014 6:58 PM"},"updated_at":{"date":"2014-10-21 18:58:25","timeago":"1 week ago","format":"21 October 2014 6:58 PM"}},{"id":386,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":246988,"format":"241.20 KB"},"thumbnail":[{"id":"5e2cb888419c9155061929331dd385da","name":"5e2cb888419c9155061929331dd385da","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/5e2cb888419c9155061929331dd385da.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-21 18:05:59","timeago":"1 week ago","format":"21 October 2014 6:05 PM"},"updated_at":{"date":"2014-10-21 18:05:59","timeago":"1 week ago","format":"21 October 2014 6:05 PM"}},{"id":385,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":246988,"format":"241.20 KB"},"thumbnail":[{"id":"d990545675fca0d22661fa8a5f7a7d9a","name":"d990545675fca0d22661fa8a5f7a7d9a","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/d990545675fca0d22661fa8a5f7a7d9a.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-21 17:46:44","timeago":"1 week ago","format":"21 October 2014 5:46 PM"},"updated_at":{"date":"2014-10-21 17:46:44","timeago":"1 week ago","format":"21 October 2014 5:46 PM"}},{"id":370,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":207412,"format":"202.55 KB"},"thumbnail":[{"id":"3e37cbaabdfe765610a7cc4d33a15b67","name":"3e37cbaabdfe765610a7cc4d33a15b67","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/3e37cbaabdfe765610a7cc4d33a15b67.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 23:12:39","timeago":"1 week ago","format":"20 October 2014 11:12 PM"},"updated_at":{"date":"2014-10-20 23:12:39","timeago":"1 week ago","format":"20 October 2014 11:12 PM"}},{"id":1,"store_id":1,"user_id":205,"title":"Default Album","status":2,"default_album":"true","size":{"bytes":2785696,"format":"2.66 MB"},"thumbnail":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","name":"15c74770fcd2dbc28cff7b87dd1f4ed6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","name":"9b2d8c30c8c5b74cef3917c481153cc4","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","extension":"png","mime":"image\/png","position":2},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","extension":"png","mime":"image\/png","position":3},{"id":"ad6c284c6771f8d11e9d5f740d234f99","name":"ad6c284c6771f8d11e9d5f740d234f99","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","extension":"png","mime":"image\/png","position":4}],"count":11,"created_at":{"date":"2014-08-22 09:58:36","timeago":"2 months ago","format":"22 August 2014 9:58 AM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"1 week ago","format":"20 October 2014 5:36 PM"}},{"id":359,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":298800,"format":"291.80 KB"},"thumbnail":[{"id":"86538754fe871fab059b766aee92d27e","name":"86538754fe871fab059b766aee92d27e","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/86538754fe871fab059b766aee92d27e.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 10:51:07","timeago":"1 week ago","format":"20 October 2014 10:51 AM"},"updated_at":{"date":"2014-10-20 10:51:07","timeago":"1 week ago","format":"20 October 2014 10:51 AM"}},{"id":358,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":54633,"format":"53.35 KB"},"thumbnail":[{"id":"cff745b2f2c4d4f28a828bff2ab6e877","name":"cff745b2f2c4d4f28a828bff2ab6e877","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/cff745b2f2c4d4f28a828bff2ab6e877.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 10:50:09","timeago":"1 week ago","format":"20 October 2014 10:50 AM"},"updated_at":{"date":"2014-10-20 10:50:09","timeago":"1 week ago","format":"20 October 2014 10:50 AM"}},{"id":37,"store_id":1,"user_id":205,"title":"shoe2ds","status":0,"default_album":"false","size":{"bytes":142737,"format":"139.39 KB"},"thumbnail":[{"id":"4739b057a8fc10ce7e4f174af729c8d6","name":"4739b057a8fc10ce7e4f174af729c8d6","url":"http:\/\/store.weloveshopping.loc\/upload\/gallery\/1\/4739b057a8fc10ce7e4f174af729c8d6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"a74db1dd4712035017c4669045c39e47","name":"shoes-bl","url":"\/uploads\/1\/a74db1dd4712035017c4669045c39e47.jpg","extension":"jpg","mime":"image\/jpeg","position":2}],"count":2,"created_at":{"date":"2014-08-26 03:20:21","timeago":"2 months ago","format":"26 August 2014 3:20 AM"},"updated_at":{"date":"2014-10-17 15:54:27","timeago":"1 week ago","format":"17 October 2014 3:54 PM"}}],"count":12}';
        $mock = json_decode($mock);

        $this->albumRepository->expects($this->any())->method('getList')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/album?store_id=1&user_id=205');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Get_Success_Cache()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        
        $mock = '{"response":{"benchmark":"false","pagination":{"current":1,"limit":20,"total":12},"record":[{"id":316,"store_id":1,"user_id":205,"title":"Untitled Albumr","status":0,"default_album":"false","size":{"bytes":126990,"format":"124.01 KB"},"thumbnail":[{"id":"8c648eeabeab159d962a4b9eab4cea41","name":"8c648eeabeab159d962a4b9eab4cea41","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/8c648eeabeab159d962a4b9eab4cea41.JPG","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"db9f23d7b768243bf5ac3757434cb435","name":"s","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/db9f23d7b768243bf5ac3757434cb435.JPG","extension":"jpg","mime":"image\/jpeg","position":2}],"count":2,"created_at":{"date":"2014-10-14 21:18:43","timeago":"2 weeks ago","format":"14 October 2014 9:18 PM"},"updated_at":{"date":"2014-10-29 10:42:58","timeago":"19 minutes ago","format":"29 October 2014 10:42 AM"}},{"id":440,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":589089,"format":"575.28 KB"},"thumbnail":[{"id":"9eb7bfff8b33cc2bae90596e120f4c3b","name":"9eb7bfff8b33cc2bae90596e120f4c3b","url":"http:\/\/store.weloveshopping.loc\/upload\/gallery\/1\/9eb7bfff8b33cc2bae90596e120f4c3b.jpg","extension":"jpg","mime":"image\/jpeg","position":1}],"count":1,"created_at":{"date":"2014-10-28 16:42:21","timeago":"18 hours ago","format":"28 October 2014 4:42 PM"},"updated_at":{"date":"2014-10-28 16:42:21","timeago":"18 hours ago","format":"28 October 2014 4:42 PM"}},{"id":409,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":2406721,"format":"2.30 MB"},"thumbnail":[{"id":"efbc7e91e0bec96aecd506cb7151b724","name":"efbc7e91e0bec96aecd506cb7151b724","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/efbc7e91e0bec96aecd506cb7151b724.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"7a4c0f34b2d5b43b6aeef558a9f6a4b9","name":"7a4c0f34b2d5b43b6aeef558a9f6a4b9","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/7a4c0f34b2d5b43b6aeef558a9f6a4b9.jpg","extension":"jpg","mime":"image\/jpeg","position":2},{"id":"ae110e74a912b512b9b08f5454719d41","name":"ae110e74a912b512b9b08f5454719d41","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/ae110e74a912b512b9b08f5454719d41.jpg","extension":"jpg","mime":"image\/jpeg","position":3},{"id":"832e89cd76126da8d094451a217555ec","name":"832e89cd76126da8d094451a217555ec","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/832e89cd76126da8d094451a217555ec.jpg","extension":"jpg","mime":"image\/jpeg","position":4}],"count":6,"created_at":{"date":"2014-10-24 10:32:28","timeago":"5 days ago","format":"24 October 2014 10:32 AM"},"updated_at":{"date":"2014-10-24 11:20:48","timeago":"4 days ago","format":"24 October 2014 11:20 AM"}},{"id":408,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":67826,"format":"66.24 KB"},"thumbnail":[{"id":"b41f87346acb9e24ac08fe9438ba2ffe","name":"b41f87346acb9e24ac08fe9438ba2ffe","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/b41f87346acb9e24ac08fe9438ba2ffe.png","extension":"png","mime":"image\/png","position":1},{"id":"3d6d2d0b34d96d387ea06ce3f6cc916e","name":"3d6d2d0b34d96d387ea06ce3f6cc916e","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/3d6d2d0b34d96d387ea06ce3f6cc916e.png","extension":"png","mime":"image\/png","position":2},{"id":"becb96a854c8108d3748f577581c2a9a","name":"becb96a854c8108d3748f577581c2a9a","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/becb96a854c8108d3748f577581c2a9a.png","extension":"png","mime":"image\/png","position":3}],"count":3,"created_at":{"date":"2014-10-24 09:59:08","timeago":"5 days ago","format":"24 October 2014 9:59 AM"},"updated_at":{"date":"2014-10-24 09:59:09","timeago":"5 days ago","format":"24 October 2014 9:59 AM"}},{"id":387,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":1896748,"format":"1.81 MB"},"thumbnail":[{"id":"bc7033268a7d1ad26358cd7c15badf7d","name":"bc7033268a7d1ad26358cd7c15badf7d","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/bc7033268a7d1ad26358cd7c15badf7d.png","extension":"png","mime":"image\/png","position":1},{"id":"203b61024df5a7bb61f3fda304a3f7ec","name":"203b61024df5a7bb61f3fda304a3f7ec","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/203b61024df5a7bb61f3fda304a3f7ec.png","extension":"png","mime":"image\/png","position":2},{"id":"b2d0d2a250c0284b8ba0987551ea89a6","name":"b2d0d2a250c0284b8ba0987551ea89a6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/b2d0d2a250c0284b8ba0987551ea89a6.png","extension":"png","mime":"image\/png","position":3},{"id":"222a2c60b6e7b46fe65bd6f073f1f0d7","name":"222a2c60b6e7b46fe65bd6f073f1f0d7","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/222a2c60b6e7b46fe65bd6f073f1f0d7.png","extension":"png","mime":"image\/png","position":4}],"count":12,"created_at":{"date":"2014-10-21 18:58:24","timeago":"1 week ago","format":"21 October 2014 6:58 PM"},"updated_at":{"date":"2014-10-21 18:58:25","timeago":"1 week ago","format":"21 October 2014 6:58 PM"}},{"id":386,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":246988,"format":"241.20 KB"},"thumbnail":[{"id":"5e2cb888419c9155061929331dd385da","name":"5e2cb888419c9155061929331dd385da","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/5e2cb888419c9155061929331dd385da.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-21 18:05:59","timeago":"1 week ago","format":"21 October 2014 6:05 PM"},"updated_at":{"date":"2014-10-21 18:05:59","timeago":"1 week ago","format":"21 October 2014 6:05 PM"}},{"id":385,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":246988,"format":"241.20 KB"},"thumbnail":[{"id":"d990545675fca0d22661fa8a5f7a7d9a","name":"d990545675fca0d22661fa8a5f7a7d9a","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/d990545675fca0d22661fa8a5f7a7d9a.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-21 17:46:44","timeago":"1 week ago","format":"21 October 2014 5:46 PM"},"updated_at":{"date":"2014-10-21 17:46:44","timeago":"1 week ago","format":"21 October 2014 5:46 PM"}},{"id":370,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":207412,"format":"202.55 KB"},"thumbnail":[{"id":"3e37cbaabdfe765610a7cc4d33a15b67","name":"3e37cbaabdfe765610a7cc4d33a15b67","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/3e37cbaabdfe765610a7cc4d33a15b67.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 23:12:39","timeago":"1 week ago","format":"20 October 2014 11:12 PM"},"updated_at":{"date":"2014-10-20 23:12:39","timeago":"1 week ago","format":"20 October 2014 11:12 PM"}},{"id":1,"store_id":1,"user_id":205,"title":"Default Album","status":2,"default_album":"true","size":{"bytes":2785696,"format":"2.66 MB"},"thumbnail":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","name":"15c74770fcd2dbc28cff7b87dd1f4ed6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","name":"9b2d8c30c8c5b74cef3917c481153cc4","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","extension":"png","mime":"image\/png","position":2},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","extension":"png","mime":"image\/png","position":3},{"id":"ad6c284c6771f8d11e9d5f740d234f99","name":"ad6c284c6771f8d11e9d5f740d234f99","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","extension":"png","mime":"image\/png","position":4}],"count":11,"created_at":{"date":"2014-08-22 09:58:36","timeago":"2 months ago","format":"22 August 2014 9:58 AM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"1 week ago","format":"20 October 2014 5:36 PM"}},{"id":359,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":298800,"format":"291.80 KB"},"thumbnail":[{"id":"86538754fe871fab059b766aee92d27e","name":"86538754fe871fab059b766aee92d27e","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/86538754fe871fab059b766aee92d27e.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 10:51:07","timeago":"1 week ago","format":"20 October 2014 10:51 AM"},"updated_at":{"date":"2014-10-20 10:51:07","timeago":"1 week ago","format":"20 October 2014 10:51 AM"}},{"id":358,"store_id":1,"user_id":205,"title":"Untitled Album","status":0,"default_album":"false","size":{"bytes":54633,"format":"53.35 KB"},"thumbnail":[{"id":"cff745b2f2c4d4f28a828bff2ab6e877","name":"cff745b2f2c4d4f28a828bff2ab6e877","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/cff745b2f2c4d4f28a828bff2ab6e877.png","extension":"png","mime":"image\/png","position":1}],"count":1,"created_at":{"date":"2014-10-20 10:50:09","timeago":"1 week ago","format":"20 October 2014 10:50 AM"},"updated_at":{"date":"2014-10-20 10:50:09","timeago":"1 week ago","format":"20 October 2014 10:50 AM"}},{"id":37,"store_id":1,"user_id":205,"title":"shoe2ds","status":0,"default_album":"false","size":{"bytes":142737,"format":"139.39 KB"},"thumbnail":[{"id":"4739b057a8fc10ce7e4f174af729c8d6","name":"4739b057a8fc10ce7e4f174af729c8d6","url":"http:\/\/store.weloveshopping.loc\/upload\/gallery\/1\/4739b057a8fc10ce7e4f174af729c8d6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"a74db1dd4712035017c4669045c39e47","name":"shoes-bl","url":"\/uploads\/1\/a74db1dd4712035017c4669045c39e47.jpg","extension":"jpg","mime":"image\/jpeg","position":2}],"count":2,"created_at":{"date":"2014-08-26 03:20:21","timeago":"2 months ago","format":"26 August 2014 3:20 AM"},"updated_at":{"date":"2014-10-17 15:54:27","timeago":"1 week ago","format":"17 October 2014 3:54 PM"}}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/album?store_id=1&user_id=205');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Get_Fail_Parameter()
    {

        $crawler = $this->client->request('GET', 'api/album?store_id=1');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Get_Fail_Data()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":[],"code":1004}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));


        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);

        $mock = false;
        $this->albumRepository->expects($this->any())->method('getList')->will($this->returnValue($mock));

        $crawler = $this->client->request('GET', 'api/album?store_id=1&user_id=999');
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }


    public function test_Post_Fail_Parameter()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $parameter = array();
        $crawler = $this->client->request('POST', 'api/album',$parameter);
        $json = $this->client->getResponse()->getContent();
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Post_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);
        $mock = '{"store_id":"1","user_id":"205","title":"ammtest","status":"1","updated_at":"2014-10-21 13:59:33","created_at":"2014-10-21 13:59:33","id":275}';
        $mock = json_decode($mock);
        $this->albumRepository->expects($this->once())->method('createAlbum')->will($this->returnValue($mock));

        $parameter = array(
            'user_id' => 205,
            'store_id' => 1,
            'title' => 'test',
            'status' => 1,
        );

        $crawler = $this->client->request('POST', 'api/album',$parameter);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Update_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);

        $mock = '{"id":267,"user_id":205,"store_id":1,"title":"test","size":0,"count":0,"status":0,"created_at":"2014-10-20 16:40:53","updated_at":"2014-10-21 17:28:57"}';
        $mock = json_decode($mock,true);
        $this->albumRepository->expects($this->once())->method('saveAlbum')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'user_id' => 205,
            'id' => 267,
            'title' => 'test-update'
        );

        $crawler = $this->client->request('PUT', 'api/album/267',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Update_Fail()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);

        $mock = false;
        $mock = json_decode($mock);
        $this->albumRepository->expects($this->once())->method('saveAlbum')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'user_id' => 205,
            'id' => 999,
            'title' => 'test-update'
        );

        $crawler = $this->client->request('PUT', 'api/album/999',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }

    public function test_Update_Fail_Parameter()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));

        $param = array(
            'id' => '267',
        );

        $crawler = $this->client->request('PUT', 'api/album/267',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Delete_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('clear')->will($this->returnValue(true));


        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);

        $mock = '{"result":true,"affected":1,"attachment":[[{"id":"3d066d21f0a4be96f1402fdb472da60a","user_id":205,"store_id":1,"album_id":390,"resource":"upload","name":"3d066d21f0a4be96f1402fdb472da60a","width":1440,"height":900,"mime":"image\/png","size":554100,"url":"http:\/\/store.weloveshopping.loc\/upload\/1\/3d066d21f0a4be96f1402fdb472da60a.png","created_at":"2014-11-17 11:02:43","updated_at":"2014-11-17 11:02:43","deleted_at":null,"public_id":"3d066d21f0a4be96f1402fdb472da60a"}]]}';
        $mock = json_decode($mock,true);
        $this->albumRepository->expects($this->once())->method('deleteAlbum')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'user_id' => 205,
            'id' => '390',
        );

        $crawler = $this->client->request('DELETE', 'api/album/390',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Delete_Fail_InUse()
    {
        
        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);

        $mock = '{"result":false,"attachment":[]}';
        $mock = json_decode($mock,true);
        $this->albumRepository->expects($this->once())->method('deleteAlbum')->will($this->returnValue($mock));

        $param = array(
            'store_id' => 1,
            'user_id' => 205,
            'id' => '248',
        );

        $crawler = $this->client->request('DELETE', 'api/album/248',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1007', $json);
        $this->assertContains('"status_txt":"Delete data error"', $json);
    }

    public function test_Delete_Fail_Parameter()
    {

        $param = array(
            'user_id' => 205,
            'id' => '267',
        );

        $crawler = $this->client->request('DELETE', 'api/album/267',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Show_Fail_Parameter()
    {
        $crawler = $this->client->request('GET', 'api/album/999',array());
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1003', $json);
        $this->assertContains('"status_txt":"Invalid parameter"', $json);
    }

    public function test_Show_Success()
    {
        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","record":[{"id":1,"user_id":205,"title":"Default Album","description":null,"status":2,"default_album":"true","thumbnail":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","name":"15c74770fcd2dbc28cff7b87dd1f4ed6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","extension":"png","mime":"image\/png","position":3},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","name":"9b2d8c30c8c5b74cef3917c481153cc4","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","extension":"png","mime":"image\/png","position":2},{"id":"ad6c284c6771f8d11e9d5f740d234f99","name":"ad6c284c6771f8d11e9d5f740d234f99","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","extension":"png","mime":"image\/png","position":4}],"position":null,"size":{"bytes":2785696,"format":"2.66 MB"},"count":11,"created_at":{"date":"2014-08-22 09:58:36","timeago":"2 months ago","format":"22 August 2014 9:58 AM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"1 week ago","format":"20 October 2014 5:36 PM"}}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));


        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);

        $mock = '[{"id":1,"user_id":205,"title":"Default Album","description":null,"status":2,"default_album":"true","thumbnail":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","name":"15c74770fcd2dbc28cff7b87dd1f4ed6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","extension":"png","mime":"image\/png","position":3},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","name":"9b2d8c30c8c5b74cef3917c481153cc4","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","extension":"png","mime":"image\/png","position":2},{"id":"ad6c284c6771f8d11e9d5f740d234f99","name":"ad6c284c6771f8d11e9d5f740d234f99","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","extension":"png","mime":"image\/png","position":4}],"position":null,"size":{"bytes":2785696,"format":"2.66 MB"},"count":11,"created_at":{"date":"2014-08-22 09:58:36","timeago":"2 months ago","format":"22 August 2014 9:58 AM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"1 week ago","format":"20 October 2014 5:36 PM"}}]';
        $mock = json_decode($mock,true);

        $this->albumRepository->expects($this->any())->method('getByFilter')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
            'user_id' => '205',
        );

        $crawler = $this->client->request('GET', 'api/album/1',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }


    public function test_Show_Success_Cache()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        //$this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":{"benchmark":"false","record":[{"id":1,"user_id":205,"title":"Default Album","description":null,"status":2,"default_album":"true","thumbnail":[{"id":"15c74770fcd2dbc28cff7b87dd1f4ed6","name":"15c74770fcd2dbc28cff7b87dd1f4ed6","url":"http:\/\/store.weloveshopping.in\/upload\/gallery\/1\/15c74770fcd2dbc28cff7b87dd1f4ed6.jpg","extension":"jpg","mime":"image\/jpeg","position":1},{"id":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","name":"4ce83c78c4aee3f3b95f6cf0e8cb4caa","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/4ce83c78c4aee3f3b95f6cf0e8cb4caa.png","extension":"png","mime":"image\/png","position":3},{"id":"9b2d8c30c8c5b74cef3917c481153cc4","name":"9b2d8c30c8c5b74cef3917c481153cc4","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/9b2d8c30c8c5b74cef3917c481153cc4.png","extension":"png","mime":"image\/png","position":2},{"id":"ad6c284c6771f8d11e9d5f740d234f99","name":"ad6c284c6771f8d11e9d5f740d234f99","url":"http:\/\/store.weloveshopping.in\/uploads\/1\/ad6c284c6771f8d11e9d5f740d234f99.png","extension":"png","mime":"image\/png","position":4}],"position":null,"size":{"bytes":2785696,"format":"2.66 MB"},"count":11,"created_at":{"date":"2014-08-22 09:58:36","timeago":"2 months ago","format":"22 August 2014 9:58 AM"},"updated_at":{"date":"2014-10-20 17:36:27","timeago":"1 week ago","format":"20 October 2014 5:36 PM"}}]},"code":0}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue($mock));


        $param = array(
            'store_id' => '1',
            'user_id' => '205',
        );

        $crawler = $this->client->request('GET', 'api/album/1',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":0', $json);
        $this->assertContains('"status_txt":"Success"', $json);
    }

    public function test_Show_Fail_Data()
    {

        $this->CachedRepository = $this->getMock('CachedRepository');
        $this->app->instance('CachedRepository', $this->CachedRepository);
        $this->CachedRepository->expects($this->any())->method('get')->will($this->returnValue(false));

        $mock = '{"response":[],"code":1004}';
        $mock = json_decode($mock,true);
        $this->CachedRepository->expects($this->any())->method('put')->will($this->returnValue($mock));


        $this->albumRepository = $this->getMock('AlbumRepository');
        $this->app->instance('AlbumRepository', $this->albumRepository);

        $mock = false;
        $this->albumRepository->expects($this->any())->method('getByFilter')->will($this->returnValue($mock));

        $param = array(
            'store_id' => '1',
            'user_id' => '555',
        );

        $crawler = $this->client->request('GET', 'api/album/1',$param);
        $json = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertContains('"status_code":1004', $json);
        $this->assertContains('"status_txt":"Data not found"', $json);
    }


}
