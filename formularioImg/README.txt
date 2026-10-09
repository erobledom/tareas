PROYECTO formularioImg

ARCHIVOS
- index.php: muestra el formulario en GET y procesa los datos en POST.
- captura.html: formulario de jugador con campos y validación previa en JavaScript.
- calavera.png: imagen predeterminada cuando no se adjunta una imagen o la subida falla.
- uploads/: carpeta donde se guardan las imágenes PNG válidas.

INSTALACIÓN EN XAMPP
1. Copia la carpeta formularioImg dentro de C:\xampp\htdocs\
2. Inicia Apache desde el panel de control de XAMPP.
3. Abre http://localhost/formularioImg/ en el navegador.

REGLAS DE IMAGEN
- La imagen es opcional.
- Si se selecciona una imagen, debe ser un PNG válido.
- El tamaño máximo es 10240 bytes (10 KiB, usando 1 KiB = 1024 bytes).
- El servidor vuelve a validar el formato y el tamaño.
