<?php
namespace Bitstamp\Api;

interface LoggerInterface
{

    public function debug($message);

    public function info($message);

    public function warn($message);

    public function error($message);

}
