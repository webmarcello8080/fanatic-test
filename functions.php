<?php

foreach (glob( get_stylesheet_directory() . "/classes/*.php") as $filename){
   include_once $filename;
}

new IncludeScript;
new Ajax;