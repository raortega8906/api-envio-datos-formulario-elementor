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

    public function destroyForm($id)
    {
        $form = Form::find($id);
        if($form){
            $form->delete();
            return response()->json([
                'message' => 'Formulario eliminado con éxito'
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'Formulario no encontrado'
            ], 404);
        }
    }

    public function destroyAllForms()
    {
        $forms = Form::all();
        foreach($forms as $form){
            $form->delete();
        }
        return response()->json([
            'message' => 'Todos los formularios han sido eliminados'
        ], 200);
    }

    // Nueva implementacion:
    public function showDownloadView()
    {
        return view('forms.download');
    }

    public function downloadForms()
    {
        $forms = Form::all();

        $filename = "forms_export.csv";
        $handle = fopen('php://output', 'w');

        // Encabezados del CSV
        fputcsv($handle, ['ID', 'Nombre del Formulario', 'Datos', 'Fecha de Creación']);

        foreach ($forms as $form) {
            fputcsv($handle, [
                $form->id,
                $form->form_name,
                json_encode($form->data),
                $form->created_at,
            ]);
        }

        fclose($handle);

        return response()->streamDownload(function () use ($filename) {
            readfile('php://output');
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

}
