<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivo;
session_start();
class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    public function formulario1(){
        return view("formularios.formulario1");
    }
}