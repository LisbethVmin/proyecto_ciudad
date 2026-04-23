<!DOCTYPE html>
<html>
<head>
    <title>Crear Reporte</title>
</head>
<body>

<h1>Crear Reporte</h1>

<form method="POST" action="/reportes" enctype="multipart/form-data">
    @csrf

    <input type="text" name="titulo" placeholder="Título"><br><br>
    <input type="file" name="imagen"><br><br>

    <textarea name="descripcion" placeholder="Descripción"></textarea><br><br>

    <label>Tipo:</label>
    <select name="id_tipo">
        <option value="1">Bache</option>
        <option value="2">Basura</option>
        <option value="3">Alumbrado</option>
        <option value="4">Vandalismo</option>
    </select><br><br>

    <button type="submit">Guardar</button>

</form>

</body>
</html>