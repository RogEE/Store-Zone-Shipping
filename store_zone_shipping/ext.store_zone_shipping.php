<?php

if (defined('PATH_THIRD')) {
    require PATH_THIRD.'store/autoload.php';
}

use Store\Exception\ShippingException;
use Store\Model\Order;
use Store\Model\OrderShippingMethod;

class Store_zone_shipping_ext
{

    const VERSION = '0.0.1';

    public $name = 'Store Zone Shipping';
    public $version = self::VERSION;
    public $description = 'A shipping plugin for Exp:resso Store 2.x to enable tiers of rates based on groups of countries/regions.';
    public $settings_exist = 'y';
    public $docs_url = '';
    public $settings = array();

    public function __construct($settings = array())
    {
        $this->settings = $settings;
    }

    public function activate_extension()
    {

        $data = array(
            'class'     => __CLASS__,
            'method'    => 'store_order_shipping_methods',
            'hook'      => 'store_order_shipping_methods',
            'priority'  => 10,
            'settings'  => serialize($this->settings),
            'version'   => $this->version,
            'enabled'   => 'y'
        );

        ee()->db->insert('extensions', $data);

    }

    public function update_extension($current = '')
    {
        if ($current == '' || $current == $this->version) {
            return false;
        }

        ee()->db->where('class', __CLASS__)
            ->update('extensions', array('version' => $this->version));
    }

    public function settings_form($current_settings)
    {

        $vars = $current_settings;

        ee()->cp->add_to_head( ee()->load->view('settings_form_head', $vars, TRUE) );
        ee()->cp->load_package_js('store_zone_shipping.min');

        return ee()->load->view('settings_form', $vars, TRUE);

    }

    function save_settings()
    {
        if (empty($_POST))
        {
            show_error(lang('unauthorized_access'));
        }

        unset($_POST['submit']);

        ee()->lang->loadfile('store_zone_shipping');

        if ( false )
        {
            ee()->session->set_flashdata(
                'message_failure',
                lang('preferences_error')
            );
        }

        ee()->db->where('class', __CLASS__);
        ee()->db->update('extensions', array('settings' => serialize($_POST)));

        ee()->session->set_flashdata(
            'message_success',
            lang('preferences_updated')
        );

        ee()->functions->redirect(
            BASE.AMP.'C=addons_extensions'.AMP.'M=extension_settings'.AMP.'file=store_zone_shipping'
        );

    }

    public function store_order_shipping_methods(Order $order, array $options)
    {

        /*
        // Play nicely with other extensions on this hook.
        if (ee()->extensions->last_call !== false) {
            $options = ee()->extensions->last_call;
        }

        // echo print_r($options, true);

        // Leave things along if we don't have shipping info yet.
        if ($order->shipping_country == '' || $order->shipping_state == '' || $order->shipping_city == '') {
            return $options;
        }

        // $code = "store_zone_shipping";
        // $option = new OrderShippingMethod;
        // $option->id = __CLASS__.':'.$code;
        // $option->name = "NAME";
        // $option->amount = (string) $row->Rate;
        // $option->class = __CLASS__;

        // $options[$option->id] = $option;

        // round($order->order_shipping_weight_lb * 16)
        // $order->order_shipping_width_in
        // $order->shipping_postcode;


*/
        return $options;
    }

}
