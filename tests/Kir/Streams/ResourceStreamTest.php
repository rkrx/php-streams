<?php
namespace Kir\Streams;

use Kir\Streams\Helper\StreamFactory;

class ResourceStreamTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var StreamFactory
	 */
	private $factory = null;

	/**
	 */
	public function testRead() {
		$stream = $this->createStream();
		$data = $stream->read(7);
		$this->assertEquals('This is', $data);
	}

	/**
	 */
	public function testReadAll() {
		$stream = $this->createStream();
		$data = $stream->read();
		$this->assertEquals('This is a test', $data);
	}

	/**
	 */
	public function testWrite() {
		$stream = $this->createStream();
		$stream->write('ABCDEFG');
		$stream->rewind();
		$data = $stream->read();
		$this->assertEquals('ABCDEFG', $data);
	}

	/**
	 */
	public function testPositioning() {
		$stream = $this->createStream();
		$stream->write('0987654321');
		$stream->setPosition(0);
		$this->assertEquals(0, $stream->getPosition(), 'Set position to stream start');
		$stream->setPosition(5);
		$this->assertEquals(5, $stream->getPosition(), 'Set position to 5');
		$this->assertEquals('54321', $stream->read(5));
	}

	/**
	 */
	public function testTruncate() {
		$stream = $this->createStream();

		if($stream instanceof TruncatableStream) {
			$stream->truncate();
			$stream->write('This is a test');
			$stream->truncate(0);
			$this->assertEquals(0, $stream->getPosition());

			$stream->truncate();
			$stream->write('This is a test');
			$stream->truncate(10);
			$this->assertEquals(0, $stream->getPosition());
		}
	}

	/**
	 * @param StreamFactory $factory
	 */
	protected function setFactory(StreamFactory $factory) {
		$this->factory = $factory;
	}

	/**
	 * @return RandomAccessStream
	 */
	private function createStream() {
		return $this->factory->getStream();
	}
}
 