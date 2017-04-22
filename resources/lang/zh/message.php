<?php
/**
 * Language file for item error/success messages
 *
 */

return array(

    'exists'        => 'Item already exists!',
    '_not_found'     => 'Item [:id] does not exist.',
    '_name_required' => 'The name field is required',

    'success' => array(
        'create' => '項目新增完成.',
        'update' => '項目更新完成.',
        'delete' => '項目已刪除.',
    ),

    'delete' => array(
        'create' => 'There was an issue creating the Item. Please try again.',
        'update' => 'There was an issue updating the Item. Please try again.',
        'delete' => 'There was an issue deleting the Item. Please try again.',
    ),

    'error' => array(
        'item_exists' => 'An Item already exists with that name, names must be unique for Items.',
    ),

);
