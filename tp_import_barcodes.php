<?php

/**
 * Barcodes import module ”Alexandra”
 *
 * @author    Konstantinos A. Kogkalidis <konstantinos@tapanda.gr>
 * @copyright 2018 - 2020 © tapanda web & marketing <https://tapanda.gr/en/>
 * @license   Basic license https://tapanda.gr/en/blog/our-business-news/basic-license
 * @link      https://tapanda.gr/en/modules/barcodes-import-module-prestashop-alexandra
 */

// @codingStandardsIgnoreLine
class tp_import_barcodes extends Module
{
    public function __construct()
    {
        $this->name = 'tp_import_barcodes';
        $this->tab = 'quick_bulk_update';
        $this->version = '1.0.0';
        $this->author = 'tapanda.gr';
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        $this->displayName = $this->l('Barcodes import');
        $this->description = $this->l(
            'It gets an xlsx file containing barcodes and assigns them to the respective products'
        );

        parent::__construct();
    }

    public function install()
    {
        return parent::install();
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function getContent()
    {
        return $this->display(__FILE__, 'views/templates/admin/form.tpl');
    }
}
