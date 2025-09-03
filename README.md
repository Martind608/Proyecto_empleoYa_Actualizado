# Proyecto_empleoya
proyecto_bolsa_de_trabajo/: Esta es la carpeta principal de tu proyecto. Contiene todos los archivos y carpetas relacionados con tu bolsa de trabajo.

app/: Esta carpeta contiene la lógica de la aplicación MVC.

controllers/: Aquí se encuentran los controladores de la aplicación. Cada controlador maneja las acciones relacionadas con un perfil de usuario específico o funcionalidad, como la administración, las autoridades, los postulantes, las empresas y la página de inicio.

models/: En esta carpeta se encuentran las clases de modelos que interactúan con la base de datos. Cada modelo representa una entidad de tu aplicación, como los administradores, las autoridades, los postulantes, las empresas, y también contiene la clase Database para la gestión de la conexión a la base de datos.

views/: Aquí se almacenan las vistas de tu aplicación. Las vistas son archivos PHP que muestran la interfaz de usuario. Hay subcarpetas separadas para cada perfil de usuario y una carpeta compartida ("shared") para elementos como el encabezado y el pie de página.

public/: Esta carpeta contiene los archivos accesibles públicamente desde el navegador web.

css/: Aquí puedes colocar archivos CSS para dar estilo a tu sitio web.

js/: Esta carpeta es para archivos JavaScript que pueden mejorar la funcionalidad de tu sitio.

index.php: Este es el punto de entrada principal de tu aplicación. Cuando se accede a tu sitio web, este archivo se ejecuta y actúa como el controlador frontal, enrutando las solicitudes a los controladores adecuados.

config/: Contiene archivos de configuración esenciales para tu aplicación.

database.php: En este archivo puedes definir la configuración de conexión a la base de datos, como el nombre de usuario, la contraseña y el nombre de la base de datos.

routes.php: Aquí puedes definir las rutas de tu aplicación, especificando qué controlador y acción deben manejarse para una URL dada.

.htaccess: Este archivo se utiliza para configurar la reescritura de URL y dirigir todas las solicitudes a index.php. Esto es típico en aplicaciones MVC y permite una estructura de URL más limpia.