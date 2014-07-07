JSON-RPC
==========

[JSON-RPC 2.0](http://www.jsonrpc.org/specification) Server for PHP 5.3

## Features

- Supports batch requests
- Full service independence from the server
- Errors transmitted by throwing standard PHP exceptions (`InvalidArgumentException`, `Exception`)
- PSR-4 compliant code structure
- A small amount of code
- Available via composer

## Usage

Initialize server. For example you can do this in some route callback or controller action.
By default, the server uses a `PhpInput` transport, which receives data from `php://input`.
You can pass custom transport realization via second argument to the server constructor.

```php
$server = new \Acelot\JsonRpc\Server(new \MyNamespace\MyApi());
$server->dispatch();
```

Write your API

```php
namespace MyNamespace;

class MyApi
{
    public function getPost($id)
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('Specify post id');
        }

        /*
         * Post retrieving code here
         */

        return $post;
    }

    public function createPost($title, $body)
    {
        /*
         * Post creating code here. Any exception will be caught and sent to the client in the right form.
         */

        return true;
    }
}
```

Now you can call remote procedures via json:

`{jsonrpc: "2.0", method: "getPost", params: [1], id: null}`

or

`{jsonrpc: "2.0", method: "createPost", params: ["New post", "Hello, world!"], id: null}`

## Requirements

PHP 5.3 or higher

## License

This project is released under the MIT public license.

