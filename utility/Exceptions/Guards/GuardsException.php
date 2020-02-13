<?php

Namespace Exceptions\Guards;

class GuardsException extends \Exception
{
	public function __construct($error)
	{
        $trace = $this->getTrace()[0];

        $this->title = 'Guard Exception';
        
		$this->message = $error;

        $this->file = $trace['file'];        
		$this->line = $trace['line'];

	}
}