<?php

/**
 * Barcodes import module ”Alexandra”
 *
 * @author    Konstantinos A. Kogkalidis <konstantinos@tapanda.gr>
 * @copyright 2018 - 2020 © tapanda web & marketing <https://tapanda.gr/en/>
 * @license   Basic license https://tapanda.gr/en/blog/our-business-news/basic-license
 * @link      https://tapanda.gr/en/modules/barcodes-import-module-prestashop-alexandra
 */

require_once _PS_MODULE_DIR_ . 'tp_import_barcodes/libraries/SimpleXLSX/SimpleXLSX.php';

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
        $output = null;

        if (Tools::isSubmit('submitFile')) {
            $barcode_index = Tools::getValue('barcode_index');

            if (!Validate::isUnsignedInt($barcode_index)) {
                $barcode_index = 1;
            }

            $xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name']);
            self::importBarcodes($xlsx->rows(), $barcode_index);
            $output .= $this->displayConfirmation($this->l('The barcodes have been imported successfully!'));
        } elseif (Tools::isSubmit('submitOverride')) {
            $size = Tools::getValue('size');

            if (!Validate::isUnsignedInt($size)) {
                $output .= $this->displayError($this->l('The size field must contain an unsigned integer value!'));
            } else {
                self::override($size);
                $output .= $this->displayConfirmation(
                    $this->l('You have modified the upc barcode field to contain up to ') .
                        $size . ' ' . $this->l('characters') . ' :)'
                );
            }
        }

        return $output . $this->display(__FILE__, 'views/templates/admin/form.tpl');
    }

    /**
     * It gets an array of barcodes and imports them based on the product id
     *
     * @param array $barcodes
     * @param int   $barcode_index
     * @return void
     */
    public static function importBarcodes(array $barcodes, int $barcode_index = 1)
    {
        unset($barcodes[0]);

        $result = array();

        // We get rid of products that have not been created in our shop
        foreach ($barcodes as $row) {
            if (is_numeric((string) $row[0]) and $row[$barcode_index] != '') {
                $result[] = $row;
            }
        }

        $product_id  = array_column($result, 0);
        $barcode = array_column($result, $barcode_index);

        array_multisort($product_id, SORT_ASC, $barcode, SORT_DESC, $result);

        $query = 'INSERT INTO `' . _DB_PREFIX_ . 'product` (
            `id_product`,
            `upc`,
            `id_tax_rules_group`,
            `available_date`,
            `date_add`,
            `date_upd`
        ) VALUES ';

        $now = date('Y-m-d H:i:s');

        foreach (self::uniqueArray($result, 0) as $row) {
            $product = new Product($row[0]);

            // If the product does exist, assign the barcode
            if (Validate::isLoadedObject($product)) {
                $query .= '(' .
                    (int) $row[0] . ',"' .
                    $row[$barcode_index] . '", 1, "' .
                    $now . '","' .
                    $now . '","' .
                    $now .
                    '"),';
            }
        }

        // All of the products do exist, so we actually need only the upc to be updated!
        $query = rtrim($query, ',') . ' ON DUPLICATE KEY UPDATE `upc` = VALUES(upc)';

        Db::getInstance()->execute($query);
    }

    public static function uniqueArray($my_array, $key)
    {
        $result = array();
        $i = 0;
        $key_array = array();

        foreach ($my_array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $result[$i] = $val;
            }
            $i++;
        }
        return $result;
    }

    public static function override(int $size)
    {
        $query = 'ALTER TABLE `' . _DB_PREFIX_ . 'product` MODIFY `upc` varchar(' . (int) $size . ')';
        Db::getInstance()->execute($query);
        return true;
    }
}
