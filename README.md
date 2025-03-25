<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## API Test - Formularios

Esta API fue creada con el fin de probar formularios enviados desde alguna web, proporcionando endpoints para recibir, validar y almacenar los datos de los formularios enviados desde un sitio web en su mayoría construido con WordPress. La API es sencilla solo para el uso de pruebas.

## Características

- Recepción de formularios en formato JSON
- Validación y sanitización de datos
- Almacenamiento en base de datos
- Eliminación de formularios por el id y de todos los formularios
- Integración con Laravel para facilitar la gestión
- Respuesta en formato JSON con estado y mensaje

## Endpoints

- Listar formularios

`GET /api/forms`

Retorna una lista de todos los formularios almacenados.

- Enviar formulario

`POST /api/receive-form`

Recibe los datos (o se crean) del formulario en formato JSON y los almacena en la base de datos.

- Eliminar todos los formularios

`DELETE /api/forms/delete-all`

Elimina todos los datos de los formularios almacenados

- Eliminar los datos de un formulario dado el id

`DELETE /api/forms/{id}`

Elimina los datos del formulario dado el id

### Ejemplo de lógica en el front (AJAX):

- jQuery:

```
jQuery(document).ready(function ($) {
    console.log('DOM cargado');

    const btnForm = $('#btn-form');

    if (btnForm.length) {
        console.log('Existe el botón');

        btnForm.on('click', function (e) {
            const formName = $('form.elementor-form').attr('name');
            const firstName = $('input#form-field-name').val().trim();
            const lastName = $('input#form-field-field_2b4c96d').val().trim();
            const email = $('input#form-field-email').val().trim();
            const phone = $('input#form-field-field_5f9a809').val().trim();
            const isChecked = $('#form-field-message').prop('checked');

            if (firstName == '' || lastName == '' || email == '') {
                return;
            }

            if (!isChecked) {
                return;
            }

            let data = {
                form_name: formName,
                first_name: firstName,
                last_name: lastName,
                email: email,
                phone: phone,
            };

            $.ajax({
                url: ajax_object.ajaxurl,
                type: "POST",
                dataType: "json",
                data: {
                    action: "process_forms",
                    data: JSON.stringify({
                        form_name: formName,
                        data: data,
                    }),
                },
                success: function () {
                    console.log("Formulario enviado correctamente");
                },
                error: function () {
                    console.error("Error al enviar datos:");
                }
            });
        });

    } else {
        console.error('No se detectó el botón');
    }
});
```

- php:

`function process_forms()
{
    // Verificamos si los datos llegaron correctamente
    if (!isset($_POST['data'])) {
        wp_send_json_error("No se enviaron datos.");
        wp_die();
    }

    $datos = json_decode(stripslashes($_POST['data']), true);

    if (empty($datos['form_name']) || empty($datos['data']['first_name']) || empty($datos['data']['last_name']) || empty($datos['data']['email'])) {
        wp_send_json_error("Los campos nombre, apellido y email son obligatorios.");
        wp_die();
    }

    // CURL:

    // URL del API para Desarrollo y Producción
    // $url = 'https://prod-20.northeurope.logic.azure.com/workflows/0b7c274bcd8e4a57af0ed2992edaeed1/triggers/manual/paths/invoke?api-version=2016-06-01&sp=%2Ftriggers%2Fmanual%2Frun&sv=1.0&sig=eaeyD_wB04VkLcAcNxiZ0-yhr8qm4__B78g64u67nWg';

    // URL del API para pruebas
    $url = 'https://plugins.wpcache.es/api/receive-form';

    $data = array(
        'form_name' => $datos['form_name'],
        'data' => array(
            'first_name' => $datos['data']['first_name'],
            'last_name' => $datos['data']['last_name'],
            'email' => $datos['data']['email'],
            'phone' => $datos['data']['phone'],
        ),
    );
    $data = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        echo $response;
        wp_die();
    } else {
        wp_send_json_error("Error al enviar datos.");
        wp_die();
    }
}
add_action('wp_ajax_process_forms', 'process_forms');
add_action('wp_ajax_nopriv_process_forms', 'process_forms');`

## Instalación

1. Clonar el repositorio
2. Instalar dependencias con `composer install`
3. Crear la base de datos y migraciones con `php artisan migrate`
4. Ejecutar el servidor de desarrollo con `php artisan serve`
5. Acceder a la API en `http://localhost:8000/api`