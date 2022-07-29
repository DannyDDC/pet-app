<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateResponse;

class ApiController extends Controller
{

    protected $statusCode = 200;
      
    /**
     * Get http code for response.
     *    
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Set Http code for response.
     *  
     * @param int $statusCode 
     * @return int
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

   /**
     * Set the status code and show data -> Method POST
     *
     * @param  array $data
     * @return \Illuminate\Http\Response
     */      
    public function respondCreated($data, $message = 'Successfully created')
    {
       $res = response()->json([
            'message' => $message,
            'resource' => $data
        ]);
        
        return $this->setStatusCode(IlluminateResponse::HTTP_CREATED)
                    ->respond($res);
    }

    /**
     * Set the status code and update data -> Method PUT.
     *
     * @param  array $data
     * @return \Illuminate\Http\Response
     */ 
    public function respondUpdated($data, $message = 'Successfully updated')
    {
      $res = response()->json([
        'message' => $message,
        'resource' => $data
      ]);
      
      return $this->setStatusCode(IlluminateResponse::HTTP_ACCEPTED)
                ->respond($res);
    }

    /**
     * Set the status code DELETE data and show a message -> Method DELETE
     *
     * @param  string $message
     * @return \Illuminate\Http\Response
     */ 
    public function respondDeleted($message = 'Successfully deleted')
    {
         $data = response()->json([
            'message' => $message
        ]);
         return $this->setStatusCode(IlluminateResponse::HTTP_ACCEPTED)
                      ->respond($data);
    }
 
    /**
     * Show a Json With the storaged data -> Method GET.
     *
     * @param  array $data
     * @param  array $headers
     * @return \Illuminate\Http\Response
     */ 
    public function respondListed($data) 
    {
      return $data;
    }
   
    /**
     * Returns response.
     *
     * @param  \Illuminate\Http\Response $response
     * @param  array $headers
     * @return \Illuminate\Http\Response
     */     
    public function respond($response, $headers = [])
    {
      return $response->setStatusCode($this->statusCode); 
    }
    
}
