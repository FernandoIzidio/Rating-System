<?php

namespace app\config;


class RootProject{
    public $controllers;
    public $connection;
    public $models;
    public $tests;
    public $cache;
    public $views;
    private static $path;

    private static function configureProjectRoot(){
        if (!isset(self::$path)){
        
        $cfgproject = new self();
        $base = "../app";
        $cfgproject->controllers = $base . "/cache";
        $cfgproject->controllers = $base . "/controllers";
        $cfgproject->connection = $base . "/database/config";
        $cfgproject->models = $base . "/models";
        $cfgproject->tests = $base . "/tests";
        $cfgproject->views = $base . "/views";
        
        self::$path = $cfgproject;
    }
    }

    public static function getRootPath(){
        self::configureProjectRoot();
        return self::$path;
    }

}