<?php

class Promotions
{
    /**
     * [html_with_currency description]
     * @param  string $format [description]
     * @return [type] [description]
     */
    public static function getPricePromotion($price, $promotion_type)
    {
        if (empty($price) || empty($promotion_type)) {
            return null;
        }

        $type = $promotion_type['id'];

        switch ($type) {
            case 1:
                $price_promotion = $price-(($price*$promotion_type['discount'])/100);
                break;

            default:
                $price_promotion = null;
                break;
        }

        return $price_promotion;
    }

    public static function getTypePromotion($type, $metafield)
    {
        $promotion_type = array();

        if (empty($type) || empty($metafield)) {
            return $promotion_type;
        }

        $promotion_config = json_decode($metafield, true);

        switch ($type) {
            case 1:
                $promotion_type['id'] = $type;
                $promotion_type['discount'] = $promotion_config['discount'];
                $promotion_type['display_name'] = 'Discount '.$promotion_config['discount'].'%';
                break;

            case 2:
                $promotion_type['id'] = $type;
                $promotion_type['total'] = $promotion_config['total'];
                $promotion_type['unit_type'] = $promotion_config['unit_type'];
                $promotion_type['discount'] = $promotion_config['shipping_discount'];
                $promotion_type['display_name'] = 'Buy '.$promotion_config['total'].' item Get Shipping Discount '.$promotion_config['shipping_discount'];
                break;

            case 3:
                $promotion_type['id'] = $type;
                $promotion_type['total'] = $promotion_config['total'];
                $promotion_type['unit_type'] = $promotion_config['unit_type'];
                $promotion_type['discount'] = $promotion_config['shipping_discount'];
                $promotion_type['display_name'] = 'Buy '.$promotion_config['total'].' baht Get Shipping Discount '.$promotion_config['shipping_discount'];
                break;

            default:
                $promotion_type = array();
                break;
        }

        return $promotion_type;
    }
}
