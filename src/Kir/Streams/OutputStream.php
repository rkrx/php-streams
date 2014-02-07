<?php
namespace Kir\Streams;

use Kir\Streams\Exceptions\IOException;

interface OutputStream extends Stream {
	/**
	 * @throws IOException
	 * @param string $data
	 * @return $this
	 */
	public function write($data);
}