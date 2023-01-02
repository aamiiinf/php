<?php

function content_header($value)
{
    $result  = '<div class="content-header">';
    $result .= '<div class="container-fluid">';
    $result .= '<div class="row mb-2">';
    $result .= '<div class="col-sm-6">';
    $result .= '<h1 class="m-0">Dashboard</h1>';
    $result .= '</div>';
    $result .= '<div class="col-sm-6">';
    $result .= '<ol class="breadcrumb float-sm-right">';
    $result .= '<li class="d_none"><a href="http://localhost/book/admin/index.php">Dashboard</a><span style="margin: 0 5px">/</span></li>';
    $result .= '<li class="breadcrumb-item active">' . $value;
    $result .= '</li></ol></div></div></div></div>';
    return $result;
}