<?php
/**
 * Created by PhpStorm.
 * User: junade
 * Date: 14/05/2017
 * Time: 05:58
 */

namespace IcyApril\WhatsChanged;


interface VCS
{
    public function __construct($binary = "");

    public function getChangedFiles(): array;
}