

$().ready(() => {
  cargaTabla();
});

var cargaTabla = () => {
  var html = "";

  $.get("../controllers/prestamos.controllers.php", (lista_prestamos) => {

    $.each(lista_prestamos, (indice, prestamo) => {
      html += `
            <tr>
                <td>${indice + 1}</td>
                <td>${prestamo.nombre_completo}</td>
                <td>${prestamo.titulo}</td>
                <td>${prestamo.fecha}</td>
            </tr> `;
    });
    $("#tabla_prestamos").html(html);
  });
};
