{{-- Nueva implementacion: --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descargar Formularios</title>
    <script>
        function downloadForms() {
            window.location.href = "{{ route('forms.download') }}";
        }
    </script>
</head>
<body>

    <h1>Descargar Formularios Advantere</h1>
    <button onclick="downloadForms()">Descargar Formularios</button>

</body>
</html>
