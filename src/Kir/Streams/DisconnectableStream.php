<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface DisconnectableStream extends Stream {
	/**
	 * @throws IOException
	 * @return $this
	 */
	public function disconnect();
}