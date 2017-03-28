<?php

class InitialStore
{
    /**
     * [html_with_currency description]
     * @param  string $format [description]
     * @return [type] [description]
     */
    public static function createDefaultStoreData($store_id, $user_id)
    {
        self::rollbackDefaultStoreData($store_id);
        Session::put('error', 0);
        if (empty($store_id) || empty($user_id)) {

            Session::put('error', 1);

            return false;
        }

        $store = Store::find($store_id);
        if (count($store) == 0 || ($store->user_id != $user_id)) {
            Session::put('error', 2);

            return false;
        }

        $parameters = array();

        $client = new Client(Config::get('url.api-account'));
        $result_user = $client->get('user/'.$user_id, $parameters);
        $result_user = json_decode($result_user, true);
        if (!isset($result_user['status_code'])) {
            Session::put('error', 3);

            return false;
        }

        $status_code = $result_user['status_code'];
        if ($status_code != 0) {
            Session::put('error', 4);

            return false;
        }

        /* Set Package Default */
        $store_package = new StorePackage();
        $store_package->id = '';
        $store_package->store_id = $store_id;
        $store_package->package_id = 2; // 2 = basic package
        if (!$store_package->save()) {
            Session::put('error', 5);

            return false;
        }

        #Set Navigation Default
        if (!self::createNavigationDefault($store_id, $user_id)) {
            Session::put('error', 6);

            return false;
        }

        #Set Shipping Default
        if (!self::createShippingDefault($store_id, $user_id)) {
            Session::put('error', 7);

            return false;
        }

        #Set Album Default
        if (!self::createAlbumDefault($store_id, $user_id)) {
            Session::put('error', 8);

            return false;
        }

        return true;
    }

    private static function createAlbumDefault($store_id, $user_id)
    {

        $parameters = array(
            'store_id' => $store_id,
            'user_id'  => $user_id,
            'title'    => 'Default Album',
            'status'   => 2
        );

        $client = new Client(Config::get('url.api-store'));
        $album = $client->post('album', $parameters);
        $album = json_decode($album, true);

        if (isset($album['status_code']) && $album['status_code'] == '0') {
            return true;
        }

        $rollback = self::rollbackDefaultStoreData($store_id);

        return false;

    }

    private static function createNavigationDefault($store_id, $user_id)
    {
        $navigation_default = self::getHeaderFooterDefaultData();
        $affectedRow = 0;

        foreach ($navigation_default as $value) {
            $navigation = new Navigation();
            $navigation->store_id   = $store_id;
            $navigation->user_id    = $user_id;
            $navigation->title      = $value['title'];
            $navigation->handle     = $value['handle'];
            $navigation->status     = $value['status'];
            $navigation->save();

            if (empty($navigation->id)) {
                $rollback = self::rollbackDefaultStoreData($store_id);

                return false;
            }

            foreach ($value['link'] as $links) {
                $link = new Link();
                $link->navigation_id    = $navigation->id;
                $link->store_id         = $store_id;
                $link->user_id          = $user_id;
                $link->type             = $links['type'];
                $link->value            = $links['value'];
                $link->position         = $links['position'];
                $link->status           = ($links['status'] == 'false') ? getStatusId($links['status']) : getStatusId('true');

                if (!$link->save()) {
                    $rollback = self::rollbackDefaultStoreData($store_id);

                    return false;
                }

                $lang_list = array('en','th');
                foreach ($lang_list as $store_language) {
                    $link_language = new LinkLanguage();
                    $link_language->link_id     = $link->id;
                    $link_language->language_id = getLangId($store_language);
                    $link_language->title       = $links['title'][$store_language];

                    if (!$link_language->save()) {
                        $rollback = self::rollbackDefaultStoreData($store_id);

                        return false;
                    }

                }
            }
            $affectedRow++;
        }

        if ($affectedRow>0) {
            return true;
        }

        $rollback = self::rollbackDefaultStoreData($store_id);

        return false;
    }

    private static function createShippingDefault($store_id, $user_id)
    {
        $parameters = array(
            'store_id'         => $store_id,
            'user_id'          => $user_id,
            'country_id'       => '209',
            'iso_code_2'       => 'TH',
            'federal_tax_rate' => 0,
            'include_tax'      => 0,
            'status'           => 'true'
        );

        $client = new Client(Config::get('url.api-store'));
        $shipping = $client->post('shipping', $parameters);
        $shipping = json_decode($shipping, true);
        if (isset($shipping['status_code']) && $shipping['status_code'] == '0') {

            $destination_id = isset($shipping['data']['shipping_id']) ? $shipping['data']['shipping_id'] : 0;
            self::createShippingRateDefault($store_id, $user_id, $destination_id);

            return true;
        }

        $rollback = self::rollbackDefaultStoreData($store_id);

        return false;
    }

    private static function createShippingRateDefault($store_id, $user_id, $destination_id)
    {
        $client = new Client(Config::get('url.api-store'));

        $rates = array(
            array('name' => 'POST', 'rate_type' => 'flat'),
            array('name' => 'POST', 'rate_type' => 'weight'),
            array('name' => 'POST', 'rate_type' => 'price'),
            array('name' => 'POST', 'rate_type' => 'amount'),
            array('name' => 'EMS',  'rate_type' => 'flat'),
            array('name' => 'EMS',  'rate_type' => 'weight'),
            array('name' => 'EMS',  'rate_type' => 'price'),
            array('name' => 'EMS',  'rate_type' => 'amount'),
        );

        foreach ($rates as $index => $rate) {

            $rate['store_id'] = $store_id;
            $rate['user_id'] = $user_id;
            $rate['shipping_destination_id'] = $destination_id;
            $rate['id'] = '';

            $rate['start_rate'] = 0;
            $rate['end_rate'] = 1;
            $rate['endrate_type'] = 'to';
            $rate['price'] = 0;
            $rate['status'] = 'false';

            $shipping = $client->post('shippingrate', $rate);
            $shipping = json_decode($shipping, true);

            if (isset($shipping['status_code']) && $shipping['status_code'] != '0') {
                $failed = false;
            }
        }

        if (isset($failed)) {
            return false;
        }

        return true;

    }

    private static function rollbackDefaultStoreData($store_id)
    {
        $store_package = StorePackage::where('store_id', '=', $store_id)->delete();

        $navigation = Navigation::where('store_id', '=', $store_id)->delete();
        $link_list = Link::where('store_id', '=', $store_id)->lists('id');
        $links = Link::where('store_id', '=', $store_id)->delete();
        if (!empty($link_list)) {
            $link_language = LinkLanguage::whereIn('link_id', $link_list)->delete();
        }

        $shipping_destination = Shipping::where('store_id', '=', $store_id)->delete();
        $shipping_rate = ShippingRate::where('store_id', '=', $store_id)->delete();

        $album = Album::where('store_id', '=', $store_id)->where('title', '=', 'Default Album')->delete();

    }

    private static function getHeaderFooterDefaultData()
    {

        $navigation_default = array(
            0 => array(
                'title' => 'Main menu',
                'handle' => 'main-menu',
                'status' => 2,
                'link' => array(
                     0 => array(
                        'title'     => array('en' => 'Home', 'th' => 'หน้าแรก'),
                        'type'      => 'frontpage',
                        'position'  => 1,
                        'value'     => '',
                        'status'    => 'true'
                    ),
                    1 => array(
                        'title'     => array('en' => 'Product', 'th' => 'สินค้า'),
                        'type'      => 'product',
                        'position'  => 2,
                        'value'     => '',
                        'status'    => 'true',
                    ),
                    2 => array(
                        'title'     => array('en' => 'Category', 'th' => 'หมวดหมู่สินค้า'),
                        'type'      => 'category',
                        'position'  => 2,
                        'value'     => '',
                        'status'    => 'true',
                    ),
                    3 => array(
                        'title'     => array('en' => 'How to order', 'th' => 'การสั่งซื้อและชำระเงิน'),
                        'type'      => 'howtoorder',
                        'position'  => 3,
                        'value'     => '',
                        'status'    => 'true',
                    ),
                    4 => array(
                        'title'     => array('en' => 'Tracking', 'th' => 'การจัดส่ง'),
                        'type'      => 'tracking',
                        'position'  => 4,
                        'value'     => '',
                        'status'    => 'true',
                    ),
                    5 => array(
                        'title'     => array('en' => 'Information', 'th' => 'ติดต่อร้านค้า'),
                        'type'      => 'information',
                        'position'  => 5,
                        'value'     => '',
                        'status'    => 'true',
                    )
                )

            ),
            1 => array(
                'title' => 'Footer',
                'handle' => 'footer',
                'status' => 2,
                'link' => array(
                    0 => array(
                        'title'     => array('en' => 'Home', 'th' => 'หน้าแรก'),
                        'type'      => 'frontpage',
                        'position'  => 1,
                        'value'     => '',
                        'status'    => 'true'
                    ),
                    1 => array(
                        'title'     => array('en' => 'Product', 'th' => 'สินค้า'),
                        'type'      => 'product',
                        'position'  => 2,
                        'value'     => '',
                        'status'    => 'true',
                    ),
                    2 => array(
                        'title'     => array('en' => 'Category', 'th' => 'หมวดหมู่สินค้า'),
                        'type'      => 'category',
                        'position'  => 2,
                        'value'     => '',
                        'status'    => 'true',
                    ),
                    3 => array(
                        'title'     => array('en' => 'How to order', 'th' => 'การสั่งซื้อและชำระเงิน'),
                        'type'      => 'howtoorder',
                        'position'  => 3,
                        'value'     => '',
                        'status'    => 'true',
                    ),
                    4 => array(
                        'title'     => array('en' => 'Tracking', 'th' => 'การจัดส่ง'),
                        'type'      => 'tracking',
                        'position'  => 4,
                        'value'     => '',
                        'status'    => 'true',
                    ),
                    5 => array(
                        'title'     => array('en' => 'Information', 'th' => 'ติดต่อร้านค้า'),
                        'type'      => 'information',
                        'position'  => 5,
                        'value'     => '',
                        'status'    => 'true',
                    )
                )
            )
        );

        return $navigation_default;
    }

}
