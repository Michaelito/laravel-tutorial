<?php

namespace App\Http\Controllers\API\Tutorial;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\TutorialRepository;
use Validator;


class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repository;

    public function __construct(TutorialRepository $repository)
    {
        $this->repository = $repository;
    } 
        
    //get all
    public function getAll()
    {
        //dd('teste');
        //metodo contruct
        $tutorial = $this->repository->getAll();
        
        //instaciar model               
        //$tutorial = TutorialRepository::getAll();
    
        if(!$tutorial){
        return $this->sendError(null, 401);
        }

        return $this->sendResponse($tutorial, 200);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //dd($id);
        //metodo contruct
        $tutorial = $this->repository->show($id);
        
        //instaciar repository               
        //$tutorial = TutorialRepository::show($request);
    
        if(!$tutorial){
            return $this->sendError(null, 401);
        }

        return $this->sendResponse($tutorial, 200);
    }

    /**
    * Added 
    */
    public function add(Request $request)
    {
    
        $validateData = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required",
            "password" => "required",
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validateData->messages(),
            ], 422);
        }
        
        //metodo contruct
        $tutorial = $this->repository->store($request);
        
        //instaciar repository               
        //$tutorial = TutorialRepository::add($request);
    
        if(!$tutorial){
            return $this->sendError(null, 401);
        }

        return $this->sendResponse($tutorial, 200);
    }

    /**
    * Updated 
    */
    public function update(Request $request)
    {
        
        $validateData = Validator::make($request->all(), [
            "id" => "required",
            "name" => "required",
            "email" => "required",
            "password" => "required",
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validateData->messages(),
            ], 422);
        }
        
        //metodo contruct
        $tutorial = $this->repository->update($request);
        
        //instaciar repository               
        //$tutorial = TutorialRepository::add($request);
    
        if(!$tutorial){
            return $this->sendError(null, 401);
        }

        return $this->sendResponse($tutorial, 200);
    }

    /**
    * Delete 
    */
    public function destroy(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            "id" => "required",
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validateData->messages(),
            ], 422);
        }    
        
        //metodo contruct
        $tutorial = $this->repository->delete($request->id);
        
        //instaciar repository               
        //$tutorial = TutorialRepository::add($request);
    
        if(!$tutorial){
            return $this->sendError(null, 401);
        }

        return $this->sendResponse($tutorial, 200);
    }
}
