<?php

/**
 * Helper for converting a date to text
 * @author Emmanuel Bouton
 */
class Zend_View_Helper_DateFormat extends \Zend_View_Helper_Abstract
{
    public function dateFormat(\DateTime $datetime)
    {
        return $datetime->format('d/m/Y H:i:s');
    }
}
