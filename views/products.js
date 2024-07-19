function init() {
  $("#frm_products").on("submit", function (e) {
    guardaryeditar(e);
  });
}

$().ready(() => {
  cargaTabla();
});

var cargaTabla = () => {
  var html = "";


  $.get("../controllers/products.controllers.php", (listaproductos) => {
    console.log(listaproductos);
    $.each(listaproductos, (indice, unproducto) => {
      html += `
            <tr>
                <td>${indice + 1}</td>
                <td>${unproducto.nombre}</td>
                <td>${unproducto.precio}</td>
                <td>${unproducto.stock}</td>
            <td>
<button class="btn btn-primary" onclick="uno(${unproducto.id})">Editar</button>
<button class="btn btn-danger" onclick="eliminar(${unproducto.id})">Eliminar</button>
            </td>
            </tr>
        `;
    });
    $("#cuerpoproducts").html(html);
  });
};

var guardaryeditar = (e) => {
  e.preventDefault();
  var frm_products = new FormData($("#frm_products")[0]);
  for (var pair of frm_products.entries()) {
    console.log(pair[0] + ", " + pair[1]);
  }
  var id = $("#id").val();
  var ruta = "";
  if (id == 0) {
    //insertar
    ruta = "../controllers/products.controllers.php";
  } else {
    //actualziar
    ruta = "../controllers/products.controllers.php?op=actualizar";
  }

  $.ajax({
    url: ruta,
    type: "POST",
    data: frm_products,
    contentType: false,
    processData: false,
    success: function (datos) {
      console.log(datos);
      $("#modalProduct").modal("hide");
      $("#frm_products")[0].reset();
      cargaTabla();
    },
  });
};


var uno = async (id) => {
  $.get(
    "../controllers/products.controllers.php?id=" + id,
    (producto) => {
      console.log(producto);
      $("#ProductId").val(producto.id);
      $("#Nombre").val(producto.nombre);
      $("#precio").val(producto.precio);
      $("#stock").val(producto.stock);
    }
  );
  $("#modalProduct").modal("show");
};

var eliminar = (id) => {
  Swal.fire({
    title: "Productos",
    text: "¿Está seguro que desea eliminar el producto?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../controllers/products.controllers.php",
        type: "DELETE",
        data: JSON.stringify({ id: id }), // Envía el ID del producto como datos en formato JSON
        contentType: "application/json", // Indica que se envía JSON
        success: function (response) {
          Swal.fire({
            title: "Productos",
            text: response.message, // Mensaje de éxito o error recibido desde PHP
            icon: response.success ? "success" : "error", // Icono basado en el éxito o error recibido
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
