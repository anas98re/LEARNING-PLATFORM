<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

// Constants
use App\Constants\ErrorMessages;

use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Response;

/**
 * Class ApiController
 * @package App\Http\Api\V1\Controllers
 */
class ApiController extends Controller
{

    protected function success($data, int $code = 200)
    {
        return response()->json([
            'data' => $data,
            'code' => $code
        ]);
    }

    protected function error($errors = null, string  $message = null, int $code)
    {
        return response()->json([
            'message' => $message ?? "An error encountered while performing the operation",

            'errors' => $errors,
            'code' => $code,
        ]);
    }




    /**
     * @var int
     */
    private $status_code = IlluminateResponse::HTTP_OK;

    /**
     * @var string
     */
    private $errorMessage = '';

    /**
     * @var string
     */

    /**
     * ApiController constructor.
     */
    function __construct()
    {
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * @param $statusCode
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->status_code = $statusCode;
        return $this;
    }

    /**
     * @param $errorMessage
     * @return $this
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param null $data
     * @param int $statusCode
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data = null, $statusCode = IlluminateResponse::HTTP_OK, $headers = [])
    {
        $headers['Access-Control-Allow-Origin'] = '*';
        $headers['Access-Control-Allow-Methods'] = 'GET, PUT, POST, DELETE, OPTIONS';
        return response()->json($data, $statusCode, $headers);
    }

    /**
     * @param $code
     * @param string $message
     * @param array $details
     * @param array $headers
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondError($code, $message = "", $details = [], $headers = [])
    {
        //$error = new ErrorObject($code,$message,$details);
        $error = [
            "code" => $code,
            "message" => $message,
            "details" => $details,
        ];

        $headers['Access-Control-Allow-Origin'] = '*';
        $headers['Access-Control-Allow-Methods'] = 'GET, PUT, POST, DELETE, OPTIONS';

        return response()->json([
            "error" => $error,
        ], $this->getStatusCode(), $headers);
    }

    /**
     * @param $data
     * @param string $message
     * @return mixed
     */
    protected function respondCreated($data, $message = "Item created successfully")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)
            ->respond([
                'data' => $data,
                'message' => $message
            ]);
    }

    /**
     * @param $data
     * @param string $message
     * @return mixed
     */
    protected function respondUpdated($data, $message = "Updated successfully")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_OK)
            ->respond([
                'data' => $data,
                'message' => $message
            ]);
    }

    /**
     * @param $data
     * @param string $message
     * @return mixed
     */
    protected function respondDeleted($message = "Item deleted successfully")
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_NO_CONTENT)
            ->respond([
                'message' => $message
            ]);
    }

    /**
     * @param $message
     * @return mixed
     */
    protected function respondUnprocessableEntity($message)
    {
        return $this->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)
            ->respond([
                'message' => $message
            ]);
    }

    /**
     * @param LengthAwarePaginator $items
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination(LengthAwarePaginator $items, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $items->total(),
                'total_pages' => ceil($items->total() / $items->perPage()),
                'current_page' => $items->currentPage(),
                'limit' => $items->perPage()
            ]
        ]);

        return $this->respond($data);
    }

    public function optionRequest()
    {
        header("Access-Control-Allow-Origin: *");

        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin'
        ];
        return Response::make('OK', 200, $headers);
    }
    public function respondJsonArray($data)
    {
        $data = json_encode($data);
        $data = json_decode($data);
        return $data;
    }
}
