<?php
namespace Kir\Streams;

interface OutputStream extends Stream {
	/**
	 * @param string $data
	 * @return $this
	 */
	public function write($data);
}