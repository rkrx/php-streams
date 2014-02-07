<?php
namespace Kir\Streams;

interface OutputStream extends ClosableStream {
	/**
	 * @param string $data
	 * @return $this
	 */
	public function write($data);
}