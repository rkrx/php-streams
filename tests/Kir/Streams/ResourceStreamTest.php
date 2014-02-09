<?php
namespace Kir\Streams;

class ResourceStreamTest {
	/**
	 * @var Helper\StreamFactory
	 */
	private $factory = null;

	/**
	 * @var Helper\NondestructiveReadWriteStream
	 */
	private $referenceResource;

	/**
	 */
	public function __construct(Helper\StreamFactory $factory) {
		$this->factory = $factory;

		$sourceStream = new Helper\ResourceStream(__DIR__.'/../../assets/test-data.txt', 'r');
		$this->referenceResource = new Helper\NondestructiveReadWriteStream($sourceStream);
	}

	/**
	 */
	public function testRead() {
		$stream = $this->createStream();
		$data = $stream->read(7);
		\PHPUnit_Framework_Assert::assertEquals('This is', $data);
	}

	/**
	 */
	public function testReadAll() {
		$stream = $this->createStream();
		$data = $stream->read();
		\PHPUnit_Framework_Assert::assertEquals('This is a test', $data);
	}

	/**
	 */
	public function testWrite() {
		$stream = $this->createStream();
		$stream->write('ABCDEFG');
		$stream->rewind();
		$data = $stream->read();
		\PHPUnit_Framework_Assert::assertEquals('ABCDEFG', $data);
	}

	/**
	 */
	public function testPositioning() {
		$stream = $this->createStream();
		$stream->write('0987654321');
		$stream->setPosition(0);
		\PHPUnit_Framework_Assert::assertEquals(0, $stream->getPosition(), 'Set position to stream start');
		$stream->setPosition(5);
		\PHPUnit_Framework_Assert::assertEquals(5, $stream->getPosition(), 'Set position to 5');
		\PHPUnit_Framework_Assert::assertEquals('54321', $stream->read(5));
	}

	/**
	 */
	public function testTruncate() {
		$stream = $this->createStream();

		$this->truncateStream($stream);
		$stream->write('This is a test');
		$this->truncateStream($stream);
		\PHPUnit_Framework_Assert::assertEquals(0, $stream->getPosition());
	}

	private function truncateStream(TruncatableStream $stream) {
		$stream->truncate();
	}

	/**
	 * @return RandomAccessStream
	 */
	private function createStream() {
		return $this->factory->getStream();
	}
}
 