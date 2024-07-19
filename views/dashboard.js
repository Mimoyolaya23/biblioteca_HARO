
function init() {
  $("#frm_libros").on("submit", function (e) {
    guardar_editar(e);
  });
  $("#frm_prestamos").on("submit", function (e) {
    guardar_prestamo(e);
  });
}

$().ready(() => {
  cargaTabla();
});

var cargaTabla = () => {
  var html = "";

  $.get("../controllers/libros.controllers.php", (lista_libros) => {

    $.each(lista_libros, (indice, libro) => {
      html += `
            <tr>
                <td>${indice + 1}</td>
                <td>${libro.titulo}</td>
                <td>${libro.autor}</td>
                <td>${libro.genero}</td>
                <td>${libro.anio_publicacion}</td>
                <td>${libro.estado}</td>
            <td>
<button class="btn btn-primary mr-01" onclick="uno(${libro.id_libro
        })">Editar</button> ` +
        // `<button class="btn btn-danger" onclick="eliminar(${libro.id_libro
        // })">Eliminar</button>`+
        `${libro.estado == 'disponible' ? '<button class="btn btn-success" onclick="prestar(' + libro.id_libro + ')">Prestar</button>'
          : '<button class="btn btn-warning" onclick="devolver(' + libro.id_libro + ')">Devolver</button>'}
            </td> </tr> `;
    });
    $("#tabla_libros").html(html);
  });
};

var guardar_editar = (e) => {
  e.preventDefault();
  var frm_libros = new FormData($("#frm_libros")[0]);
  var id_libro = $("#id_libro").val();
  var ruta = "";
  if (id_libro == 0) {
    ruta = "../controllers/libros.controllers.php";
  } else {
    ruta = "../controllers/libros.controllers.php?op=actualizar";
  }

  $.ajax({
    url: ruta,
    type: "POST",
    data: frm_libros,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#modalLibro").modal("hide");
      $("#frm_libros")[0].reset();
      cargaTabla();
    },
  });
};

var uno = async (id) => {
  $.get(
    "../controllers/libros.controllers.php?id=" + id,
    (libro) => {
      console.log(libro);
      $("#id_libro").val(libro.id_libro);
      $("#titulo").val(libro.titulo);
      $("#autor").val(libro.autor);
      $("#genero").val(libro.genero);
      $("#anio").val(libro.anio_publicacion);
      $("#estado").val(libro.estado);
    }
  );

  $("#modalLibro").modal("show");
};

var eliminar = (id_libro) => {
  Swal.fire({
    title: "libros",
    text: "Esta seguro que desea eliminar el libro???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.delete(
        "../controllers/libros.controllers.php?id_libro=",
        { id_libro: id_libro },
        (resultado) => {
          if (resultado) {
            Swal.fire({
              title: "Libros",
              text: "Se eliminar con exito",
              icon: "success",
            });
          } else {
            Swal.fire({
              title: "Libros!",
              text: "No se pudo eliminar",
              icon: "danger",
            });
          }
        }
      );
    }
  });
};

var cargarMiembros = () => {
  $.get("../controllers/miembros.controllers.php", (miembros) => {
    console.log(miembros);
    var selectMiembros = $("#id_miembro");
    selectMiembros.empty();
    selectMiembros.append("<option value=''>Seleccione un Paciente</option>");
    $.each(miembros, (index, miembro) => {
      selectMiembros.append(
        `<option value='${miembro.id_miembro}'>${miembro.nombre} ${miembro.apellido}</option>`
      );
    });
  });
};

var prestar = (id) => {
  cargarMiembros();
  $.get(
    "../controllers/libros.controllers.php?id=" + id,
    (libro) => {
      console.log(libro);
      $("#id_prestamo").val(libro.id_libro);
      $("#titulo_prestamo").val(libro.titulo);
      $("#autor_prestamo").val(libro.autor);
    }
  );

  $("#modalPrestamo").modal("show");
};

var guardar_prestamo = (e) => {
  e.preventDefault();
  var frm_prestamos = new FormData($("#frm_prestamos")[0]);
  ruta = "../controllers/prestamos.controllers.php?op=actualizar";
  $.ajax({
    url: ruta,
    type: "POST",
    data: frm_prestamos,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#modalPrestamo").modal("hide");
      $("#frm_prestamos")[0].reset();
      cargaTabla();
    },
  });
};

var devolver = (id) => {
  Swal.fire({
    title: "Préstamo",
    text: "¿Está seguro que desea devolver el libro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Devolver",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../controllers/libros.controllers.php",
        type: "DEVOLVER",
        data: JSON.stringify({ id_libro: id }),
        contentType: "application/json",
        success: function (response) {
          console.log(response);
          Swal.fire({
            title: "Préstamo",
            text: response.message,
            icon: response.success ? "success" : "error",
          });
          cargaTabla();
        },
        error: function () {
          Swal.fire({
            title: "Error",
            text: "Hubo un problema al intentar devolver el libro",
            icon: "error",
          });
        }
      });
    }
  });
};


init();
