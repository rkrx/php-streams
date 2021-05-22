php-streams
===========

<p style="background-color: red; color: white; font-weight: bold; padding: 10px; margin-top: 10px;">This library is work-in-progress.</p>

As an alternative, have a look at this: https://github.com/fzaninotto/Streamer

This is a generic and framework-agnostic approach to stream interfaces. The goal is to provide an abstraction layer for both stream providers and stream consumers. There is documentation for usage and expected behavior. Proper exceptions and compliance tests are also included.


Streams
-------

Streams are useful for reading and writing from resources. By this I do not mean the stream approach that was introduced with Java8, for example.  Specifically for PHP, streams also have the advantage that streams do not clone their data when passed as function or method parameters, which can result in much lower memory consumption when large strings are used intensively. Resources can be anything capable of outputting or consuming a stream of byte-streams:

* Devices
* Files
* Networks
* Pipes
* Virtual resources
* Converters
* etc

### Why use streams instead of string?

Streams ...

* are and stay charset-agnostic
* can be passed by reference, just like classes
* can be (under certain circumstances) serialized and deserialized without consuming much memory.

Because of abstraction and polymorphy, an application, service, or framework can fall back on a corresponding interface and is henceforth capable of dealing with byte streams of any form.

The interfaces are built with the SOLID-principles in mind, especially the [interface-segregation-principle](http://en.wikipedia.org/wiki/Interface_segregation_principle).

- Each interface should implement only the absolutely necessary methods that are required for a (possibly) existing stream type.
- Any stream implementation should only be required to implement essential functionality.
- Every IoC-aware component should only depend on interfaces, which provide the required functionality.

For example, a logger only needs to depend on one OutputStream. The logger does not need to know anything about the stream size or the current cursor position. A logger should have no knowledge of log file rotation or memory monitoring. This should be a matter for an external component. So the logger could write to any writable stream without having any idea what kind of stream it actually is.

Under certain circumstances, streams can be serializable. This is the case when a stream implements the `SerializableStream` interface. Internally, normally only the state of the stream is serialized. On deserialization, the state is restored and the stream tries to get to the last position in the stream. A serializable memory stream must store the entire contents somewhere during serialization.


Charsets and data-types
-----------------------

PHP does not have support for clearly identified byte arrays as Java does. Each read and write operation is done using strings, which are an array of (currently, as of PHP 5.x, 7.x and 8.x) 8-bit characters. In principle, a string is a byte array, but you shouldn't rely on it to remain so forever. Streams are generally character set agnostic. It is a matter of the particular implementation and its documentation how the incoming and outgoing data is handled. The (upcoming) standard implementation of this library will provide simple 8-bit access to the supported resources.


Overview
--------

![Inheritance](assets/diagram.png)


### Stream

`Stream` is the base-class (marker-class) for a number of other classes. Its main purpose is to provide functionality to connect or disconnect to a stream and give a base type for type-hinting:

```PHP
function handleStream(Stream $stream) {
	if($stream instanceof OutputStream) {
		// ...
	}
	if($stream instanceof InputStream) {
		// ...
	}
	throw new Exception('Unsupported stream type');
}
```

Method         | Return-type | Possible exception(s)
-------------- | ----------- | ---------------------
`connect()`    | `static`    | ResourceLockedException, IOException
`disconnect()` | `static`    | IOException


### InfiniteInputStream

An `InfiniteInputStream` is a read-only stream that has no end by definition.

Examples:

* Virtual resources
  * [(*nix) /dev/random](http://en.wikipedia.org/wiki//dev/random)
  * [(*nix) /dev/null](http://en.wikipedia.org/wiki//dev/null)


### InputStream

An `InputStream` is a read-only stream that has an end.

The `InputStream` publish these methods:

Method                 | Return-type | Possible exception(s)
---------------------- | ----------- | ---------------------
`read($length = null)` | `string`    | IOException
`isAtEnd()`            | `bool`      | -

* `read`: Reads `$length` bytes from the current position. If the current position plus `$length` exceeds the end of stream, the actual content will contain only the remaining bytes till the end of the stream and the cursor gets placed there.
* `isAtEnd`: If `true` the end of the stream was reached with either a read- or seek-operation. This method must not throw an exception.

Examples:

* Pipe
  * [STDIN](http://en.wikipedia.org/wiki/Standard_streams#Standard_input_.28stdin.29)
* Files
* Networkstreams


### OutputStream

An `OutputStream` is a write-only stream. It has no information on its size or the cursor-position in the stream. The `OutputStream` is good for situations were it doesn't matter if a `Stream` has other abilities then writing data.

Method | Return-type | Possible exception(s)
------ | ----------- | ---------------------
`write($data)` | `static` | IOException
`flush()` | `static` | IOException



Examples:

* Pipe
  * [STDOUT](http://en.wikipedia.org/wiki/Standard_streams#Standard_output_.28stdout.29)
  * [STDERR](http://en.wikipedia.org/wiki/Standard_streams#Standard_error_.28stderr.29)
* Files
* Networkstreams


### TruncatableStream

Applies to resources which are truncatable.

Method | Return-type | Possible exception(s)
------ | ----------- | ---------------------
`truncate()` | `static` | IOException


### SeekableStream

Method | Return-type | Possible exception(s)
------ | ----------- | ---------------------
`getSize()` | `int` | IOException
`getPosition()` | `int` | IOException
`setPosition($pos)` | `static` | IOException
`rewind()` | `static` | IOException


### RandomAccessStream

The `VersatileStream` applies to fully accessible resources like local files. It extends `InputStream`, `OutputStream` and `SeekableStream`. This interface should likly be used for read-, writable- and seekable resources.

Examples:

* Local files
* Network files (ftp, sftp, etc)
* I/O-Converters (plain-to-base64 and vice-versa, en- and decryption, etc)


Versioning
----------

www.semver.org
