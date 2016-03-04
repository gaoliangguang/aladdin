<?php

/**
 * Description of Redis
 *
 * @author 保灵
 */

namespace Think\Session\Driver;

class Redis implements \SessionHandlerInterface
{

    /**
     * Session有效时间
     */
    protected $lifeTime = '';

    /**
     * redis句柄
     */
    protected $redis;

    /**
     * 
     */
    protected $namespace = '';
    protected $session_id;

    /**
     * 打开Session 
     * @access public 
     * @param string $savePath 
     * @param mixed $sessName  
     */
    public function open($savePath, $sessName)
    {
        $this->lifeTime = C('SESSION_EXPIRE') ? C('SESSION_EXPIRE') : ini_get('session.gc_maxlifetime');
        $this->namespace = C('SESSION_NAMESPACE') ? C('SESSION_NAMESPACE') . ':' : 'session:';

        $this->redis = \Think\Redis::getInstance([
                'host' => C('REDIS_HOST') ? C('REDIS_HOST') : '127.0.0.1',
                'port' => C('REDIS_PORT') ? C('REDIS_PORT') : '6379',
                'auth' => C('REDIS_AUTH') ? C('REDIS_AUTH') : '',
                'db'   => C('SESSION_TABLE') ? C('SESSION_TABLE') : 0
        ]);
        if(!$this->redis){
            return false;
        }
        
        //在初次设置的时候，重设PHP本身的session_id并判断session_id是否已经存在
        $id = session_id();
        if (empty($id) || ($id && $_COOKIE[$sessName] != $id))
        {
            do
            {
                $this->session_id = $this->gen_session_id();
            } while ($this->redis->exists($this->namespace . $this->session_id));
            session_id($this->session_id);
        }

        return true;
    }

    /**
     * 关闭Session 
     * @access public 
     */
    public function close()
    {
        $this->redis->close();
        return true;
    }

    /**
     * 读取Session 
     * @access public 
     * @param string $sessID 
     */
    public function read($sessID)
    {
        $data = json_decode($this->redis->get($this->namespace . $sessID), TRUE);
        return serialize($data);
    }

    /**
     * 写入Session 
     * @access public 
     * @param string $sessID 
     * @param String $sessData  
     */
    public function write($sessID, $sessData)
    {
        $json = json_encode(unserialize($sessData),JSON_UNESCAPED_UNICODE|JSON_NUMERIC_CHECK);
        return $this->redis->setex($this->namespace . $sessID, $this->lifeTime, $json);
    }

    /**
     * 删除Session 
     * @access public 
     * @param string $sessID 
     */
    public function destroy($sessID)
    {
        $this->redis->delete($this->namespace . $sessID);
        return true;
    }

    /**
     * Session 垃圾回收
     * @access public 
     * @param string $sessMaxLifeTime 
     */
    public function gc($sessMaxLifeTime)
    {
        return true;
    }

    private function gen_session_id()
    {
        $uid = uniqid("", true);
        $data = $this->namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['SERVER_ADDR'];
        $data .= $_SERVER['SERVER_PORT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = strtoupper(hash('ripemd128', $uid . md5($data)));
        return substr($hash, 0, 32);

    }

}
