<?php
namespace Kir\Streams;
use Kir\Streams\Exceptions\IOException;

/**
 * Interface Stream
 *
 * This is a base interface. The main purpose is to give a
 *
 * @abstract
 */
interface Stream {
	/**
	 * @throws IOException
	 * @return $this
	 */
	public function connect();

	/**
	 * @throws IOException
	 * @return $this
	 */
	public function disconnect();
}