<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class FormController extends Controller
{
    public function index(): JsonResponse
    {
        // Devolver datos en formato JSON
        return response()->json([
            'forms' => Form::all()
        ], 200);        
    }

    public function receiveForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'form_name' => 'required|string|max:255',
            'data' => 'required|array', // Validamos que sea un array
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $formulario = Form::create([
                'form_name' => $request->form_name,
                'data' => $request->data, // Guardamos los datos dinámicamente
            ]);

            return response()->json([
                'message' => 'Formulario registrado con éxito',
                'data' => $formulario
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al guardar el formulario',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
