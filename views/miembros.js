
function init() {
  $("#frm_miembros").on("submit", function (e) {
    guardar_editar(e);
  });
}

$().ready(() => {
  cargaTabla();
});

var cargaTabla = () => {
  var html = "";

  $.get("../controllers/miembros.controllers.php", (lista_miembros) => {

    $.each(lista_miembros, (indice, miembro) => {
      html += `
            <tr>
                <td>${indice + 1}</td>
                <td>${miembro.nombre}</td>
                <td>${miembro.apellido}</td>
                <td>${miembro.email}</td>
                <td>${miembro.fecha_suscripcion}</td>
            <td>
<button class="btn btn-primary" onclick="uno(${miembro.id_miembro
        })">Editar</button>
        <button class="btn btn-danger" onclick="eliminar(${miembro.id_miembro
        })">Eliminar</button>
         </td> </tr> `;
    });
    $("#tabla_miembros").html(html);
  });
};

var guardar_editar = (e) => {
  e.preventDefault();
  var frm_miembros = new FormData($("#frm_miembros")[0]);
  var id_miembro = $("#id_miembro").val();
  var ruta = "";
  if (id_miembro == 0) {
    ruta = "../controllers/miembros.controllers.php";
  } else {
    ruta = "../controllers/miembros.controllers.php?op=actualizar";
  }

  $.ajax({
    url: ruta,
    type: "POST",
    data: frm_miembros,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#modalmiembro").modal("hide");
      $("#frm_miembros")[0].reset();
      cargaTabla();
    },
  });
};

var uno = async (id) => {
  $.get(
    "../controllers/miembros.controllers.php?id=" + id,
    (miembro) => {
      console.log(miembro);
      $("#id_miembro").val(miembro.id_miembro);
      $("#nombre").val(miembro.nombre);
      $("#apellido").val(miembro.apellido);
      $("#email").val(miembro.email);
      $("#fecha_suscripcion").val(miembro.fecha_suscripcion);
    }
  );

  $("#modalmiembro").modal("show");
};

var eliminar = (id_miembro) => {
  Swal.fire({
    title: "miembros",
    text: "Esta seguro que desea eliminar el miembro???",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../controllers/miembros.controllers.php",
        type: "DELETE",
        data: JSON.stringify({ id: id_miembro }),
        contentType: "application/json",
        success: function (response) {
          Swal.fire({
            title: "Miembros",
            text: response.message,
            icon: response.success ? "success" : "error",
          });
          cargaTabla();
        },
        error: function () {
          Swal.fire({
            title: "Error",
            text: "Hubo un problema al intentar eliminar el producto",
            icon: "error",
          });
        }
      });
    }
  });
};

init();

