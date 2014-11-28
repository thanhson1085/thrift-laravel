<?php

namespace Thrift;

use \Thrift\Protocol\TBinaryProtocol;
use \Thrift\Transport\TSocket;
use \Thrift\Transport\TBufferedTransport;
use \Thrift\Transport\TFramedTransport;
use \Thrift\Exception\TException;

class ThriftClient {

	protected $socket;
	protected $transport;
	protected $protocol;
	protected $client;

	/**
	 * Create all required thrift structures to communicate with the server.
	 * Service client class has to be loaded in the upper class.
	 *
	 * @param string $service_client_class
	 * @param string $host
	 * @param int $port
	 * @param Integer $timeout in seconds (multiplied by 1000 becase thrift
	 * accepts timeout in miliseconds)
	 * @throws Exception
	 */
	public function __construct($service_client_class, $host, $port, $timeout = 30) {
		if (!is_int($timeout))
			throw new \Exception("Timeout parameter has to be an integer value ($timeout passed).");
		$this->socket = new TSocket($host, $port);
		$this->socket->setSendTimeout($timeout * 1000);
		$this->socket->setRecvTimeout($timeout * 1000);
		$this->transport = new TFramedTransport($this->socket, 1024, 1024);
		$this->protocol = new TBinaryProtocol($this->transport);
		$this->client = new $service_client_class($this->protocol);
		$this->transport->open();
	}

	/**
	 * Closes thrift transport.
	 */
	public function __destruct() {
		$this->transport->close();
	}

	/**
	 * Forwards thrift command call directly to thrift communication client.
	 *
	 * @param string $name
	 * @param array $arguments
	 * @return mixed
	 */
	public function __call($name, $arguments)
	{
		return call_user_func_array(array($this->client, $name), $arguments);
	}
}
