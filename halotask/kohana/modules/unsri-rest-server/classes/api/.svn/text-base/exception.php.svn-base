<?php
class Api_Exception extends Kohana_Exception
{
	protected $template = "service_error";

	public function __construct($message)
	{
		parent::__construct($message);
		$this->code = "Kohana Service Error";
	}

	/**
	 * Sends an Internal Server Error header.
	 *
	 * @return  void
	 */
	public function sendHeaders()
	{
		// Send the 500 header
		header('HTTP/1.1 500 Internal Server Error');
		header('Content-type: text/xml');
	}
}
