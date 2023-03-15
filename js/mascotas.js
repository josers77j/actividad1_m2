$(document).ready(function () {
  // Cargar los datos por defecto al cargar la página
  cargarDatos("");

  // Asignar el evento de búsqueda al input de búsqueda
  $("#busqueda-mascotas").keyup(function () {
    var termino = $(this).val();
    cargarDatos(termino);
  });
});

function cargarDatos(termino) {
  // Hacer la petición AJAX
  $.ajax({
    url: "ajax/carga_mascotas.php",
    type: "GET",
    dataType: "json",
    data: { termino: termino },
    success: function (resultados) {
      // Limpiar la tabla antes de agregar los datos
      var tbody = $("#tabla-mascotas tbody");
      tbody.empty();

      // Agregar los datos a la tabla
      $.each(resultados, function (index, mascota) {
        var tr = $("<tr>");
        tr.append("<td>" + mascota.nombre + "</td>");
        tr.append("<td>" + mascota.raza + "</td>");
        tr.append("<td>" + mascota.color + "</td>");
        tr.append("<td>" + mascota.peso + "</td>");
        tr.append("<td>" + mascota.altura + "</td>");
        tr.append("<td>" + mascota.sexo + "</td>");
        tr.append("<td>" + mascota.fech_nacimiento + "</td>");
        tr.append(
          "<td><button class='editar-mascota' data-id='" +
            mascota.id_mascota +
            "'>Editar</button></td>"
        ); // Botón de edición
        tr.append(
          "<td><button class='eliminar-mascota' data-id='" +
            mascota.id_mascota +
            "'>Eliminar</button></td>"
        ); // Botón de eliminación
        tbody.append(tr);
      });
      // Asignar el evento de click al botón de edición
      $(".editar-mascota").click(function () {
        var idMascota = $(this).data("id");
        //************************************************************************************** */
        // Hacer la petición AJAX para obtener los datos de la mascota a editar
        $.ajax({
          url: "ajax/obtener_mascota.php?id=" + idMascota,
          type: "GET",
          dataType: "json",
          success: function (mascota) {
            // Llenar los campos del formulario con los datos de la mascota a editar
            $("#nombre").val(mascota.nombre);
            $("#raza").val(mascota.raza);
            $("#color").val(mascota.color);
            $("#peso").val(mascota.peso);
            $("#altura").val(mascota.altura);
            $("#sexo").val(mascota.sexo);
            $("#fech_nacimiento").val(mascota.fech_nacimiento);

            // Cambiar el texto del botón de submit para indicar que se está editando
            $("button[type='submit']").text("Editar");

            // Agregar el atributo data-id al formulario para enviar el ID de la mascota a editar
            $("#form_mascotas").attr("data-id", idMascota);
          },
          error: function () {
            alert("Error al obtener los datos de la mascota");
          },
        });
      });
      /************************************************************************************************* */
      // Asignar el evento de click al botón de eliminación
      $(".eliminar-mascota").click(function () {
        var idMascota = $(this).data("id");

        // Hacer la petición AJAX para eliminar el registro
        $.ajax({
          url: "ajax/eliminar_mascota.php?id=" + idMascota,
          type: "GET",
          success: function () {
            alert("Mascota eliminada exitosamente");
            // Recargar la tabla de mascotas para mostrar los cambios
            cargarDatos("");
          },
          error: function () {
            alert("Error al eliminar la mascota");
          },
        });
      });
    },
    error: function () {
      alert("Error al cargar los datos");
    },
  });
}

$("#form_mascotas").submit(function (event) {
  event.preventDefault(); // detiene el envío del formulario
  guardarMascota(); // llama a la función para guardar la mascota
});
function guardarMascota() {
  var datos = $("#form_mascotas").serialize(); // serializa los datos del formulario
  $.ajax({
    url: "gmascotas.php", // archivo PHP para procesar los datos
    type: "post",
    data: datos,
    success: function (response) {
      alert("Mascota guardada exitosamente");
      $("#form_mascotas")[0].reset();

      // hacer algo en respuesta exitosa del servidor
      cargarDatos("");
    },
    error: function (xhr, status, error) {
      alert("Error al guardar la mascota");
      // manejar el error del servidor
    },
  });
}
