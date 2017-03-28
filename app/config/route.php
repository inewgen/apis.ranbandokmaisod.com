<?php

return array(
    'preload' => array(
        'api/checkout' => array(
            'include' => array(
                'api/promotion',
                'api/shipping',
                'api/shippingrate',
                'api/payment'
            )
        ),
        'api/orders' => array(
            'include' => array(
                '/images',
            )
        ),
        'api/shipping' => array(
            'include' => array(
                'api/shippingrate',
            )
        ),
        'api/orderproduct' => array(
            'include' => array(
                'api/orders',
            )
        ),
        'api/product' => array(
            'include' => array(
                'api/store', // for generate sitemap
                'api/product',
            )
        ),
        'api/category' => array(
            'include' => array(
                'api/store', // for generate sitemap
            )
        ),
        'api/collection' => array(
            'include' => array(
                'api/store', // for generate sitemap
            )
        ),
        'api/page' => array(
            'include' => array(
                'api/store', // for generate sitemap
            )
        ),
        'api/blog' => array(
            'include' => array(
                'api/store', // for generate sitemap
            )
        ),
        'api/promotion' => array(
            'include' => array(
                'api/store', // for generate sitemap
            )
        ),
        'api/sitemap' => array(
            'include' => array(
                'api/store', // for generate sitemap
            )
        ),
        'api' => array(
            'include' => array(
                'api/product',
                'api/store'
            )
        ),
        'api/store/register' => array(
            'include' => array(
                'api/product',
                'api/shipping',
                'api/shippingrate',
                'api/forum',
            )
        )
    ),
);
