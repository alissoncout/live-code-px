<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Testing\MimeType;
abstract class Controller
{
    public function httpResponse($data, $file = false)
    {
        if($file){
            return $this->downloadFile($data);
        }

        if(!$data['status']){
            return $this->failure($data['message'] ?? "", $data['exception'] ?? null );
        }else{
            return $this->success($data['message'] ?? "", $data['data'] ?? null);
        }
    }

    public function success($message, $data = [], $status = Response::HTTP_OK)
    {
        return response()->json([
            'status' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public function failure($message, $exception,  $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        if (isset($exception)) { $exception = $exception->getTraceAsString(); }
        return response()->json([
            'status' => false,
            'message' => $message,
            'exception' => $exception
        ], $status);
    }

    public function downloadFile($data)
    {
        if(!$data){
            return $this->failure("Failed download", "Data null");
        }

        $headers = [
            'Content-Type'        => 'Content-Type: '.MimeType::from($data['filename']),
            'Content-Disposition' => 'attachment; filename="'. $data['filename'] .'"',
        ];

        return response($data['file'], Response::HTTP_OK, $headers);
    }
}