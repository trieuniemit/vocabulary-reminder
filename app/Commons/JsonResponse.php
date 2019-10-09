<?php


namespace App\Commons;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
/**
 * Class JsonResponse
 * Simple response object for Laravue application
 * Response format:
 * {
 *   'success': true|false,
 *   'data': [],
 *   'error': ''
 * }
 *
 */
class JsonResponse implements \JsonSerializable
{
    const STATUS_SUCCESS = true;
    const STATUS_ERROR = false;
    /**
     * Data to be returned
     * @var mixed
     */
    private $data = [];
    /**
     * Error message in case process is not success. This will be a string.
     *
     * @var string
     */
    private $error = '';
    private $code;
    /**
     * @var bool
     */
    private $success = false;

    /**
     * JsonResponse constructor.
     * @param mixed $data
     * @param string $error
     * @param integer $code
     */
    public function __construct($code = ResponseCode::fail, $data = [], string $error = '')
    {
        if ($this->shouldBeJson($data)) {
            $this->data = $data;
        }
        $this->code = $code;
        $this->error = $error;
        $this->success = !empty($data);
    }

    /**
     * Success with data
     *
     * @param array $data
     */
    public function success($data = [])
    {
        $this->success = true;
        $this->data = $data;
        $this->error = '';
        $this->code = ResponseCode::success;
    }

    /**
     * Fail with error message
     * @param string $error
     * @param integer $code
     */
    public function fail($code ,$error = '')
    {
        $this->success = false;
        $this->error = $error;
        $this->code = $code;
        $this->data = [];
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'success' => $this->success,
            'data' => $this->data,
            'error' => $this->error,
            'code' => $this->code
        ];
    }

    /**
     * Determine if the given content should be turned into JSON.
     *
     * @param mixed $content
     * @return bool
     */
    private function shouldBeJson($content): bool
    {
        return $content instanceof Arrayable ||
            $content instanceof Jsonable ||
            $content instanceof \ArrayObject ||
            $content instanceof \JsonSerializable ||
            is_array($content);
    }
}
