<?php

/**
 * Inserts a simple table into the Word document.
 *
 * @category   Phpdocx
 * @package    examples
 * @subpackage easy
 * @copyright  Copyright (c) Narcea Producciones Multimedia S.L.
 *             (http://www.2mdc.com)
 * @license    LGPL
 * @version    3.0
 * @link       http://www.phpdocx.com
 * @since      File available since Release 3.0
 */
require_once '../../classes/CreateDocx.inc';

$docx = new CreateDocx();

$valuesTable = array(
    array(
        'agency1',
        12
    ),
    array(
        'agency2',
        22
    ),
    array(
        'agency3',
        22
    ),
    array(
        'agency4',
        22
    ),
    array(
        'agency5',
        22
    ),
);
$paramsTable = array(
    'border' => 'single',
    'jc' => 'left',
    'border_sz' => '100%'
);
$docx->addTable($valuesTable, $paramsTable);
$docx->createDocx('../docx/example5');