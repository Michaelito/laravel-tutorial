<?php

namespace App\Repositories\User;

use Illuminate\Http\Request;
use App\Models\Tutorial;


class TutorialRepository
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $model;

    public function __construct(Tutorial $model)
    {
        $this->model = $model;
    } 
        
    /**
    * Show All
    */
    public function getAll()
    {
        //instanciar model
        //$tutorial = Tutorial::get();

        //metodo construct
        $tutorial = $this->model->get();
        
        //return data
        return $tutorial;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //instanciar model
        //$tutorial = Tutorial::where('id', $id)->first();

        //metodo construct
        $tutorial = $this->model->where('id', $id)->first();
        
        //return data
        return $tutorial;
    }

    /**
    * Added 
    */
    public function store(Request $request)
    {
        $tutorial = new Tutorial();
        $tutorial->name = $request->name;
        $tutorial->email = $request->email;
        $tutorial->password = \Hash::make($request->password);
        $tutorial->save();

        return $tutorial;

    }

    /**
    * Added 
    */
    public function update(Request $request)
    {
        //instanciar model
        //$tutorial = Tutorial::where('id', $id)->first();
        
        //metodo construct
        $tutorial = $this->model->where('id', $request->id)->first();
        $tutorial->name = $request->name;
        $tutorial->email = $request->email;
        $tutorial->password = md5($request->password);
        $tutorial->save();

        return $tutorial;

    }

    /**
    * Delete (update status) 
    */
    public function delete($id)
    {
        //instanciar model
        //$tutorial = Tutorial::where('id', $id)->first();
        
        //metodo construct
        $tutorial = $this->model->where('id', $id)->first();
        $tutorial->status = 10;
        $tutorial->save();

        return $tutorial;

    }
}
