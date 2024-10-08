<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Análisis de Datos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        h3 {
            color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #0056b3;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Análisis de Datos</h2>
        <h3>Ejecución de Funciones y Programación Estructurada</h3>

        <?php
        $connection = pg_connect("host=localhost dbname=TALLERTERCERCORTE user=postgres password=haechan");
        if (!$connection) {
            echo "<p style='color: red;'>Error de conexión</p>";
            exit;
        }

        // Función 1: Libros disponibles en un género específico
        $result_libros_disponibles = pg_query($connection, "SELECT libros_disponibles('Topografia') AS total_libros");
        if (!$result_libros_disponibles) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de libros disponibles</p>";
            exit;
        }
        $row_libros_disponibles = pg_fetch_assoc($result_libros_disponibles);
        echo "<h3>Total de libros disponibles en 'Topografia': " . $row_libros_disponibles['total_libros'] . "</h3>";

        // Función 2: Contar préstamos activos
        $result_contar_prestamos = pg_query($connection, "SELECT contar_prestamos_activos() AS total_prestamos");
        if (!$result_contar_prestamos) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de préstamos activos</p>";
            exit;
        }
        $row_contar_prestamos = pg_fetch_assoc($result_contar_prestamos);
        echo "<h3>Total de préstamos activos: " . $row_contar_prestamos['total_prestamos'] . "</h3>";

        // Función 3: Autores más populares
        $result_autores_populares = pg_query($connection, "SELECT * FROM autores_mas_populares()");
        if (!$result_autores_populares) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de autores más populares</p>";
            exit;
        }

        echo "<h3>Autores más populares:</h3>";
        echo "<table>";
        echo "<tr><th>Autor</th><th>Cantidad de Libros</th></tr>";
        while ($row = pg_fetch_assoc($result_autores_populares)) {
            echo "<tr><td>" . $row['autor'] . "</td><td>" . $row['cantidad_libros'] . "</td></tr>";
        }
        echo "</table>";

        // Función 4: Libros más antiguos
        $result_libros_antiguos = pg_query($connection, "SELECT * FROM libros_mas_antiguos(5)");
        if (!$result_libros_antiguos) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de libros más antiguos</p>";
            exit;
        }

        echo "<h3>Libros más antiguos:</h3>";
        echo "<table>";
        echo "<tr><th>Título</th><th>Año de Publicación</th></tr>";
        while ($row = pg_fetch_assoc($result_libros_antiguos)) {
            echo "<tr><td>" . $row['titulo'] . "</td><td>" . $row['año_publicacion'] . "</td></tr>";
        }
        echo "</table>";

        // Función 5: Libros más prestados
        $result_libros_prestados = pg_query($connection, "SELECT * FROM libros_mas_prestados0()");
        if (!$result_libros_prestados) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de libros más prestados</p>";
            exit;
        }

        echo "<h3>Libros más prestados:</h3>";
        echo "<table>";
        echo "<tr><th>Título</th><th>ID</th><th>Cantidad de Veces Prestados</th></tr>";
        while ($row = pg_fetch_assoc($result_libros_prestados)) {
            echo "<tr><td>" . $row['titulo_libros'] . "</td><td>" . $row['id_libros'] . "</td><td>" . $row['mas_prestados'] . "</td></tr>";
        }
        echo "</table>";

        // Función 6: Total de libros
        $result_total_libros = pg_query($connection, "SELECT total_libros() AS total_libros");
        if (!$result_total_libros) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de total de libros</p>";
            exit;
        }
        $row_total_libros = pg_fetch_assoc($result_total_libros);
        echo "<h3>Total de libros disponibles: " . $row_total_libros['total_libros'] . "</h3>";

        // Función 7: Lista de libros por género
        $result_lista_libros = pg_query($connection, "SELECT * FROM lista_libros('Economia')");
        if (!$result_lista_libros) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de lista de libros</p>";
            exit;
        }

        echo "<h3>Libros en el género 'Economia':</h3>";
        echo "<table>";
        echo "<tr><th>Título</th></tr>";
        while ($row = pg_fetch_assoc($result_lista_libros)) {
            echo "<tr><td>" . $row['titulo'] . "</td></tr>";
        }
        echo "</table>";

        // Función 8: Lista de libros por autor y año
        $result_lista_libros1 = pg_query($connection, "SELECT * FROM lista_libros1('Carlos Leonardo Mendoza Priesseng', 2018)");
        if (!$result_lista_libros1) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de lista de libros por autor y año</p>";
            exit;
        }

        echo "<h3>Libros de Carlos Leonardo Mendoza Priesseng publicados en 2018:</h3>";
        echo "<table>";
        echo "<tr><th>Título</th><th>Autor</th><th>Año de Publicación</th></tr>";
        while ($row = pg_fetch_assoc($result_lista_libros1)) {
            echo "<tr><td>" . $row['titulo'] . "</td><td>" . $row['nombre'] . "</td><td>" . $row['año_publicacion'] . "</td></tr>";
        }
        echo "</table>";

        // Función 9: Libros no prestados en los últimos 6 meses
        $result_libros_no_prestados = pg_query($connection, "SELECT * FROM libros_no_prestados()");
        if (!$result_libros_no_prestados) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de libros no prestados</p>";
            exit;
        }

        echo "<h3>Libros no prestados en los últimos 6 meses:</h3>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Título</th></tr>";
        while ($row = pg_fetch_assoc($result_libros_no_prestados)) {
            echo "<tr><td>" . $row['libro_id'] . "</td><td>" . $row['titulo_libro'] . "</td></tr>";
        }
        echo "</table>";

        // Función 10: Promedio de antigüedad de libros
        $result_promedio_antiguedad = pg_query($connection, "SELECT promedio_antiguedad() AS promedio_antiguedad");
        if (!$result_promedio_antiguedad) {
            echo "<p style='color: red;'>Error al ejecutar la consulta de promedio de antigüedad</p>";
            exit;
        }
        $row_promedio_antiguedad = pg_fetch_assoc($result_promedio_antiguedad);
        echo "<h3>Promedio de antigüedad de los libros: " . $row_promedio_antiguedad['promedio_antiguedad'] . " años</h3>";

        // Cerrar la conexión
        pg_close($connection);
        ?>
    </div>
</body>
</html>
