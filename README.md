JSON-RPC 2.0 Server for PHP 5.3
==========

# Usage
---

```php
/*
 * Initialize server. For example you can do this in some route callback or controller action.
 */
$server = new \Acelot\JsonRpc\Server(new \MyNamespace\MyApi());
$server->dispatch();
```

`\MyNamespace\MyApi.php`

```php
class MyApi
{
    /*
     * Call via this json:
     * {jsonrpc: "2.0", method: "getPost", params: [1], id: null}
     */
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

    /*
     * Call via this json:
     * {jsonrpc: "2.0", method: "createPost", params: ["New post", "Hello, world!"], id: null}
     */
    public function createPost($title, $body)
    {
        /*
         * Post creating code here. Any exception will be caught and sent to the client in the right form.
         */

        return true;
    }
}
```