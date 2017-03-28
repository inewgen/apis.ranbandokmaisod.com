<?php

class ApiTestCase extends Illuminate\Foundation\Testing\TestCase
{
    public function setUp()
    {
        parent::setUp();
        // instance Store

        // instance Store
        $this->storeRepository = $this->getMock('StoreRepository');
        $this->app->instance('StoreRepository', $this->storeRepository);
        $storeSetting = '{"config":{"upload_allowed":["image\/jpeg","image\/gif","image\/png"],"invoice_prefix":"INV-{{year}}-{{number}}","timezone":"Asia\/Bangkok","google_analytics":"","price_hide_text":"Please contact shop","prepare_shipping":"0"},"currency":{"currency_auto":"1","default":"THB","symbol":"\u0e3f","html_with_currency":"{{amount}} ฿ THB","html_without_currency":"{{amount}} \u0e1a\u0e32\u0e17","email_with_currency":"{{amount}} \u0e3f THB","email_without_currency":"{{amount}} \u0e3f"},"language":{"list":["th"],"default":"th","admin":"th","system":["th"]},"template":{"admin":"default","front":"shindesign"},"quota":{"product_sku":"10","pages":"10","collection":"10","category":"10","blogs":"10","storage":"514748367","language":"10","promotion":"10"},"paging":{"product":"12","category":"4","collection":"12"},"policy":{"refund":"My Policy refund","privacy":"My policy privacy","terms":"My terms"},"unit":{"length":"cm","system":["metric","imperial"],"default":"metric","weight":"kg"},"print":{"receipt":"true","order":"true","tracking":"true","logo":"1","sender":"true","receiver":"true","showlogo":"true"},"shipping":{"instock":"2","preorder":"2"}}';
        $storeSetting = json_decode($storeSetting);
        $this->storeRepository->expects($this->any())->method('getSettingById')->will($this->returnValue($storeSetting));

        // instance Authen
        $this->packageRepository = $this->getMock('StorePackageRepository');
        $this->app->instance('StorePackageRepository', $this->packageRepository);
        $quota = '{"language":"20","pages":"200","collection":"200","product_sku":"500","promotion":"200","blogs":"200","storage":5400166400,"category":"200"}';
        $quota = json_decode($quota);
        $this->packageRepository->expects($this->any())->method('getQuota')->will($this->returnValue($quota));

    }

    /**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
    public function createApplication()
    {
        $unitTesting = true;

        $testEnvironment = 'testing';

        return require __DIR__.'/../../bootstrap/start.php';
    }

}
