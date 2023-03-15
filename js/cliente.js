$(document).ready(function () {
    // Cargar los datos por defecto al cargar la página
    cargarDatos("");
  
    // Asignar el evento de búsqueda al input de búsqueda
    $("#busqueda-clientes").keyup(function () {
      var termino = $(this).val();
      cargarDatos(termino);
    });
  });
  
  function cargarDatos(termino) {
    // Hacer la petición AJAX
    $.ajax({
      url: "ajax/carga_clientes.php",
      type: "GET",
      dataType: "json",
      data: { termino: termino },
      success: function (resultados) {
        // Limpiar la tabla antes de agregar los datos
        var tbody = $("#tabla-clientes tbody");
        tbody.empty();
  
        // Agregar los datos a la tabla
        $.each(resultados, function (index, cliente) {
          var tr = $("<tr>");
          tr.append("<td>" + cliente.nombre + "</td>");
          tr.append("<td>" + cliente.telefono + "</td>");
          tr.append("<td>" + cliente.dui + "</td>");
          tr.append("<td>" + cliente.direccion + "</td>");
          tr.append("<td>" + cliente.email + "</td>");
          tr.append("<td>" + cliente.status + "</td>");
          tr.append(
            "<td><button class='editar-cliente' data-id='" +
              cliente.id_cliente +
              "'>Editar</button></td>"
          ); // Botón de edición
          tr.append(
            "<td><button class='eliminar-cliente' data-id='" +
              cliente.id_cliente +
              "'>Eliminar</button></td>"
          ); // Botón de eliminación
          tbody.append(tr);
        });
        // Asignar el evento de click al botón de edición
        $(".editar-cliente").click(function () {
          var idCliente = $(this).data("id");
          //************************************************************************************** */
          // Hacer la petición AJAX para obtener los datos de la cliente a editar
          $.ajax({
            url: "ajax/obtener_cliente.php?id=" + idCliente,
            type: "GET",
            dataType: "json",
            success: function (cliente) {
              // Llenar los campos del formulario con los datos de la cliente a editar
              $("#nombre").val(cliente.nombre);
              $("#telefono").val(cliente.telefono);
              $("#dui").val(cliente.dui);
              $("#direccion").val(cliente.direccion);
              $("#email").val(cliente.email);
              $("#status").val(cliente.status);
  
              // Cambiar el texto del botón de submit para indicar que se está editando
              $("button[type='submit']").text("Editar");
  
              // Agregar el atributo data-id al formulario para enviar el ID de la cliente a editar
              $("#form_clientes").attr("data-id", idCliente);
            },
            error: function () {
              alert("Error al obtener los datos de la cliente");
            },
          });
        });
        /************************************************************************************************* */
        // Asignar el evento de click al botón de eliminación
        $(".eliminar-cliente").click(function () {
          var idCliente = $(this).data("id");
  
          // Hacer la petición AJAX para eliminar el registro
          $.ajax({
            url: "ajax/eliminar_cliente.php?id=" + idCliente,
            type: "GET",
            success: function () {
              alert("cliente eliminada exitosamente");
              // Recargar la tabla de clientes para mostrar los cambios
              cargarDatos("");
            },
            error: function () {
              alert("Error al eliminar la cliente");
            },
          });
        });
      },
      error: function () {
        alert("Error al cargar los datos");
      },
    });
  }
  
  $("#form_clientes").submit(function (event) {
    event.preventDefault(); // detiene el envío del formulario
    guardarcliente(); // llama a la función para guardar la cliente
  });
  function guardarcliente() {
    var datos = $("#form_clientes").serialize(); // serializa los datos del formulario
    $.ajax({
      url: "guardarclient.php", // archivo PHP para procesar los datos
      type: "post",
      data: datos,
      success: function (response) {
        alert("cliente guardada exitosamente");
        $("#form_clientes")[0].reset();
  
        // hacer algo en respuesta exitosa del servidor
        cargarDatos("");
      },
      error: function (xhr, status, error) {
        alert("Error al guardar la cliente");
        // manejar el error del servidor
      },
    });
  }
  