<?php
namespace Kir\Streams;

interface ClosableOutputStream extends OutputStream, ClosableStream {
	/**
	 * @param string $data
	 * @return $this
	 */
	public function write($data);
}