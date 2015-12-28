<?php
/**
 * Created by PhpStorm.
 * User: design
 * Date: 12/22/2015
 * Time: 11:07 AM
 */

$upload = array(
    //set allowed file types
    'allowedTypes'  =>array('png','jpg','jpeg','gif'),
    //set maxWidth by pixel default 1024px
    'maxWidth'      =>1024,
    //set maxHeight by pixel default 768px
    'maxHeight'     =>768,
    //set maxSize by mb as default 5mb
    'maxSize'       =>5,
    //set path for uploading images
    'path'          =>ROOT.TEAM.'images/uploads/',
    //generate random name of image
    'randomName'    =>TRUE
);