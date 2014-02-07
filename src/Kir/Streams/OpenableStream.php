<?php
namespace Kir\Streams;

interface OpenableStream extends ClosableStream {
	/**
	 * @return $this
	 */
	public function open();
} 