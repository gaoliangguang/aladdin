<?php

/**
 * Description of Redis
 *
 * @author 保灵
 */

namespace Think;

class Redis
{
    private static $reg = [];
    private static $redis = null;
    private static $config = [
            'host' => '127.0.0.1',
            'port' => '6379',
            'auth' => '',
            'db' => 0
    ];
    private function __construct(){}

    public static function getInstance($config)
    {
        self::$config = array_merge(self::$config, $config);
        $key = md5(json_encode(self::$config));
        if (!isset(self::$reg[$key]))
        {
            self::$redis = new \Redis();
            self::$redis->connect(self::$config['host'], self::$config['port']);

            if(!self::auth()){
                return false;
            }
            
            self::$redis->select(self::$config['db']);
            self::$reg[$key] = self::$redis;
        }

        return self::$reg[$key];
    }
    
    private static function auth()
    {
        $result = true;
        if (!empty(self::$config['auth']))
        {
            $result = self::$redis->auth(self::$config['auth']);
        }
        
        return $result;
    }

}
