<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 2015/4/20
 * Time: 22:46
 */

namespace Base;


class UploadClient {

    const ERROR_FILE_NOT_FOUND = '文件未找到';
    const ERROR_FILE_UNREAD = '文件不可读';
    const ERROR_FILE_SIZE = '文件超过大小限制';
    const ERROR_FILE_TYPE = '文件类型不正确';
    const ERROR_UNKNOWN = '未知错误';

    /**
     * 上传文件类型限制
     */
    protected $_allowType = array(
        'image/jpg',
        'image/jpeg',
        'image/png',
        'image/pjpeg',
        'image/gif',
        'image/bmp',
        'image/x-png'
    );

    /**
     * 上传文件大小限制
     */
    protected $_fileSize = 2048;

    /**
     * 上传文件的类型
     */
    protected $_fileType = '';

    /**
     * 上传文件的错误
     */
    protected $_error = '未知错误';

    public function __construct($config){
        if(isset($config['file_type']) && is_array($config['file_type'])){
            $this->_allowType = $config['file_type'];
        }
        isset($config['file_size']) && $this->_fileSize = $config['file_size'];
    }

    /**
     * 设置host和port
     *
     * @param string $host 主机
     * @param int $port 端口
     */
    public function setHostPort($host, $port = 80){
        $this->_host = $host;
        $this->_port = $port;
    }

    /**
     * 开始上传文件
     *
     * @param string $file_path 本地文件路径(绝对路径)
     */
    public function doUpload($file_path){
        $path = realpath($file_path);
        if(!is_file($path)){
            $this->_error = self::ERROR_FILE_NOT_FOUND;
            return false;
        }
        if(!is_readable($path)){
            $this->_error = self::ERROR_FILE_UNREAD;
            return false;
        }
        // 检查是否支持curl

        // 检查php的版本，php5以上的版本上传文件的方式不同

        // 文件是否可读

        // 检查文件类型
        $this->_checkFileType();

        // 检查文件大小
        $this->_checkFileSize();

        $this->_curl($path);
    }

    /**
     * curl方式上传文件
     * @param string $path 上传文件全路径
     */
    protected function _curl($path){
        // http://segmentfault.com/a/1190000000725185
        if (class_exists('\CURLFile')) {
            $field = array('fieldname' => new \CURLFile(realpath($path)));
        } else {
            $field = array('fieldname' => '@' . realpath($path));
        }
        $data = array(
            ''
        );
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_PORT, $this->_port);
        curl_setopt($ch, CURLOPT_INFILESIZE, $this->_fileSize);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_PORT, $port);
        curl_setopt($ch, CURLOPT_PORT, $port);
    }
}