<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Response as HttpConstant;
use Manoj\Exceptions\AppException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $statusCode = 200;

    public
    function getStatusCode()
    {
        return $this->statusCode;
    }


    public
    function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public
    function notFound($message = "Resource not found")
    {
        return response()->json(['error' => $message], HttpConstant::HTTP_NOT_FOUND);
    }

    public
    function getUserByToken()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['user not found'], HttpConstant::HTTP_FORBIDDEN);
        }
        return $user;

    }


    public function getLoggedInUser()
    {
        try {
            return JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            if ($e->getStatusCode() != 400) {
                throw new AppException("User not found", $e->getStatusCode());
            }
            return null;
        }
    }

    public function badRequest($message = "Bad Request")
    {
        return response()->json(['error' => $message], HttpConstant::HTTP_BAD_REQUEST);
    }

    public function respond($item, $headers = [])
    {
        return response()->json($item, $this->getStatusCode(), $headers);
    }

    public function setCurrentPage($offset, $pageSize)
    {
        $currentPage = intval(ceil($offset / $pageSize) + 1);
        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });
    }

    public function respondWithPagination(Paginator $paginator, $data)
    {
        $data = array_merge($data, [
            'paginator' => [
                'totalCount' => $paginator->total(),
                'totalPages' => ceil($paginator->total() / $paginator->perPage()),
                'currentPage' => $paginator->currentPage(),
                'limit' => $paginator->perPage()
            ]
        ]);
        return $this->respond($data);
    }
}
