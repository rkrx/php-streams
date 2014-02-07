<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface ConnectableStream extends Stream {
	/**
	 * @throws IOException
	 * @return $this
	 */
	public function connect();
}