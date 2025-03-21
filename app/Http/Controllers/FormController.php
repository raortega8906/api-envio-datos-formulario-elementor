<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::all();

        return view('forms.index', compact('forms'));
    }

    public function recibirFormulario(Request $request)
    {
        // Validar datos
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación',
                'errors' => $validator->errors()
            ], 422);
        }

        // Guardar en la base de datos
        try {
            $formulario = Form::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
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
