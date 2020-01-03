<?php
ignore_user_abort(true);
set_time_limit(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
class MCurl
{
	protected $_urls;
    protected $_result;
    protected $_timeout;
    public function __construct($timeout = 15, $urls = false)
    {
        $this->_timeout = $timeout;
        $this->_urls = $urls ? $urls : array();
        $this->_result = array();
    }
    public function setTimeout($timeout)
    {
        $this->_timeout = $timeout;
    }
    public function setUrls($urls)
    {
        $this->_urls = $urls;  
    }
    public function getResults()
    {
        if(!$this->_result) $this->scan();
        return $this->_result;
    }
    public function scan() 
    {
        $curl = array(); 
		$all_url = array();
        $mh = curl_multi_init();
		$UA = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/533.4 (KHTML, like Gecko) Chrome/5.0.375.99 Safari/533.4';
        
		foreach ($this->_urls as $id => $url)
        {
			$url = str_replace('http://', '', $url);
			$url = str_replace('https://', '', $url);
			$url = 'http://'.$url;
			
            $curl[$id] = curl_init();
            curl_setopt($curl[$id], CURLOPT_URL, $url);
            curl_setopt($curl[$id], CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl[$id], CURLOPT_TIMEOUT, 30);
            curl_setopt($curl[$id], CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($curl[$id], CURLOPT_REFERER, 'http://site.ru');
			curl_setopt($curl[$id], CURLOPT_USERAGENT, $UA);
			curl_setopt($curl[$id], CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl[$id], CURLOPT_SSL_VERIFYPEER, 0);
            curl_multi_add_handle($mh, $curl[$id]);
			$all_url[] = $url;
        }
		
        $running = null;
        do curl_multi_exec($mh, $running);
        while($running > 0);
        foreach($curl as $id => $c)
        {
            $this->_result[$id] = curl_multi_getcontent($c);
            curl_multi_remove_handle($mh, $c);
        }
        curl_multi_close($mh);
    }
}

?>