/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/admin/pages/vehicles.js":
/*!**********************************************!*\
  !*** ./resources/js/admin/pages/vehicles.js ***!
  \**********************************************/
/***/ (() => {

getGaleria(); //Buscando os Modelos

$('select[name=brand_id]').on('change', function () {
  var brand = $(this).find(':selected').val();
  var url = $('#urlGetModel').val();
  $('select[name=model_id]').html('<option value="0">Carregando...</option>');
  $.ajax({
    url: url,
    method: 'POST',
    data: {
      brand: brand
    },
    dataType: 'text',
    success: function success(result) {
      $('select[name=model_id]').html(result);
    }
  });
}); //Buscando os Versões

$('select[name=model_id]').on('change', function () {
  var model = $(this).find(':selected').val();
  var url = $('#urlGetVersion').val();
  $('select[name=version_id]').html('<option value="0">Carregando...</option>');
  $.ajax({
    url: url,
    method: 'POST',
    data: {
      model: model
    },
    dataType: 'text',
    success: function success(result) {
      $('select[name=version_id]').html(result);
    }
  });
}); // Buscando as Imagens do imóvel

function getGaleria() {
  var vehicle_id = $('#vehicle_id').val();
  var url = $('#getGaleria').val();
  $.ajax({
    url: url,
    method: 'POST',
    data: {
      vehicle_id: vehicle_id
    },
    dataType: 'json',
    success: function success(data) {
      $('#galeriaVeiculo').html(data);
    }
  });
  return false;
} // Upload Imagens


$(document).on('click', '#uploadGaleria', function () {
  var formData = new FormData();
  var url = $('#urlUploadGaleria').val();
  var vehicle_id = $('#vehicle_id').val();
  var TotalFiles = $('#images')[0].files.length; //Total files

  var images = $('#images')[0];

  for (var i = 0; i < TotalFiles; i++) {
    formData.append('images' + i, images.files[i]);
  }

  formData.append('TotalFiles', TotalFiles);
  formData.append('vehicle_id', vehicle_id);
  $.ajax({
    type: 'POST',
    url: url,
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
    dataType: 'json',
    beforeSend: function beforeSend() {
      $('#galeriaImovel').html('<h5 class="text-center my-4 w-100">Carregando...</h5>');
    },
    success: function success(response) {
      getGaleria();
      setTimeout(function () {
        $('.alert').html(response.success);
        $('.alert').addClass('alert-success').fadeIn('slow');
      }, 200);
      setTimeout(function () {
        $('.alert').hide(400);
      }, 2000);
    },
    error: function error(response) {
      setTimeout(function () {
        $('.alert').html(response.erro);
        $('.alert').addClass('alert-danger').fadeOut('slow');
      }, 200);
      setTimeout(function () {
        $('.alert').hide(400);
      }, 2000);
    }
  });
}); // Excluindo Imagens

$(document).on('click', '.delete_image', function () {
  var id = $(this).data('id');
  var url = $(this).data('url');
  $('.delete').attr('data-id', id);
  $('.delete').attr('data-url', url);
  $('.delete').addClass('deleteImage');
  $('.deleteImage').removeClass('delete');
});
$(document).on('click', '.deleteImage', function () {
  var id = $(this).data('id');
  var url = $(this).data('url');
  $.ajax({
    url: url,
    method: 'POST',
    data: {
      id: id
    },
    dataType: 'json',
    cache: false,
    success: function success(response) {
      $('#modalDelete').modal('toggle');
      $('.deleteImage').addClass('delete');
      $('.deleteImage').removeData('id');
      $('.delete').removeClass('deleteImage');
      getGaleria();
      setTimeout(function () {
        $('.alert').html(response.success);
        $('.alert').addClass('alert-success').fadeIn('slow');
      }, 200);
      setTimeout(function () {
        $('.alert').hide(400);
      }, 2000);
    },
    error: function error(response) {
      setTimeout(function () {
        $('.alert').html(response.erro);
        $('.alert').addClass('alert-danger').fadeOut('slow');
      }, 200);
      setTimeout(function () {
        $('.alert').hide(400);
      }, 2000);
    }
  });
}); // Escolher Capa do Imóvel

$(document).on('change', '.checkCover', function () {
  if (this.checked) {
    var id = $(this).data('id');
    var url = $(this).data('url');
    $.ajax({
      url: url,
      method: 'POST',
      data: {
        id: id
      },
      dataType: 'json',
      cache: false,
      success: function success(response) {
        getGaleria();
        setTimeout(function () {
          $('.alert').html(response.success);
          $('.alert').addClass('alert-success').fadeIn('slow');
        }, 200);
        setTimeout(function () {
          $('.alert').fadeOut('slow');
        }, 2000);
      }
    });
  }
}); // Função para escolher a ordem

/*
$(function () {

    var url = $('#urlSortable').val()

    $('#imageSortable').sortable({
        opacity: 0.7,
        handle: 'span',
        update: function (event, ui) {
            var list_sortable = $(this)
                .sortable('toArray')
                .toString()
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    list_order: list_sortable
                },
                success: function (data) {
                    //finished
                }
            })
        }
    })
    // fim sortable
});*/

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!************************************!*\
  !*** ./resources/js/admin/main.js ***!
  \************************************/
;

(function ($) {
  'use strict';

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).on('click', '.delete', function () {
    var id = $(this).attr('data-id');
    $('#id').val(id);
  }); // Jquery Mask

  $('.money').mask('#.##0,00', {
    reverse: true
  });
  $('.km').mask('#.##0.000', {
    reverse: true
  });
  $('.cm').mask('##0,00', {
    reverse: true
  });
  $('.mes_ano').mask('00/0000');
  $('.summernote').summernote({
    lang: 'pt-BR',
    height: 200,
    fontNames: ['Noto Sans JP', 'Signika', 'Open Sans', 'Arial'],
    fontNamesIgnoreCheck: ['Nunito', 'Segoe UI'],
    fontSizeUnits: ['px', 'pt'],
    styleTags: ['p', {
      title: 'Blockquote',
      tag: 'blockquote',
      className: 'blockquote',
      value: 'blockquote'
    }, 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
    toolbar: [['style'], ['font', ['bold', 'underline', 'clear', 'font']], ['fontname', ['fontname']], ['fontsize', ['fontsize']], ['color', ['color']], ['para', ['ul', 'ol', 'paragraph']], ['table'], ['insert', ['link']], ['view', ['fullscreen', 'codeview', 'help']]]
  });
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 5,
    responsiveClass: true,
    nav: false,
    dots: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 1
      },
      1000: {
        items: 1,
        loop: false
      }
    }
  });
  $('.select').select2({
    placeholder: 'Selecione uma opção'
  });
  $('#dataTables').dataTable({
    order: [[0, 'desc']],
    responsive: true,
    language: {
      "emptyTable": "Nenhum registro encontrado",
      "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "infoEmpty": "Mostrando 0 até 0 de 0 registros",
      "infoFiltered": "(Filtrados de _MAX_ registros)",
      "infoThousands": ".",
      "loadingRecords": "Carregando...",
      "processing": "Processando...",
      "zeroRecords": "Nenhum registro encontrado",
      "search": "Pesquisar",
      "paginate": {
        "next": "Próximo",
        "previous": "Anterior",
        "first": "Primeiro",
        "last": "Último"
      },
      "aria": {
        "sortAscending": ": Ordenar colunas de forma ascendente",
        "sortDescending": ": Ordenar colunas de forma descendente"
      },
      "select": {
        "rows": {
          "_": "Selecionado %d linhas",
          "1": "Selecionado 1 linha"
        },
        "cells": {
          "1": "1 célula selecionada",
          "_": "%d células selecionadas"
        },
        "columns": {
          "1": "1 coluna selecionada",
          "_": "%d colunas selecionadas"
        }
      },
      "buttons": {
        "copySuccess": {
          "1": "Uma linha copiada com sucesso",
          "_": "%d linhas copiadas com sucesso"
        },
        "collection": "Coleção  <span class=\"ui-button-icon-primary ui-icon ui-icon-triangle-1-s\"><\/span>",
        "colvis": "Visibilidade da Coluna",
        "colvisRestore": "Restaurar Visibilidade",
        "copy": "Copiar",
        "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. Para cancelar, clique nesta mensagem ou pressione Esc..",
        "copyTitle": "Copiar para a Área de Transferência",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
          "-1": "Mostrar todos os registros",
          "_": "Mostrar %d registros"
        },
        "pdf": "PDF",
        "print": "Imprimir"
      },
      "autoFill": {
        "cancel": "Cancelar",
        "fill": "Preencher todas as células com",
        "fillHorizontal": "Preencher células horizontalmente",
        "fillVertical": "Preencher células verticalmente"
      },
      "lengthMenu": "Exibir _MENU_ resultados por página",
      "searchBuilder": {
        "add": "Adicionar Condição",
        "button": {
          "0": "Construtor de Pesquisa",
          "_": "Construtor de Pesquisa (%d)"
        },
        "clearAll": "Limpar Tudo",
        "condition": "Condição",
        "conditions": {
          "date": {
            "after": "Depois",
            "before": "Antes",
            "between": "Entre",
            "empty": "Vazio",
            "equals": "Igual",
            "not": "Não",
            "notBetween": "Não Entre",
            "notEmpty": "Não Vazio"
          },
          "number": {
            "between": "Entre",
            "empty": "Vazio",
            "equals": "Igual",
            "gt": "Maior Que",
            "gte": "Maior ou Igual a",
            "lt": "Menor Que",
            "lte": "Menor ou Igual a",
            "not": "Não",
            "notBetween": "Não Entre",
            "notEmpty": "Não Vazio"
          },
          "string": {
            "contains": "Contém",
            "empty": "Vazio",
            "endsWith": "Termina Com",
            "equals": "Igual",
            "not": "Não",
            "notEmpty": "Não Vazio",
            "startsWith": "Começa Com"
          },
          "array": {
            "contains": "Contém",
            "empty": "Vazio",
            "equals": "Igual à",
            "not": "Não",
            "notEmpty": "Não vazio",
            "without": "Não possui"
          }
        },
        "data": "Data",
        "deleteTitle": "Excluir regra de filtragem",
        "logicAnd": "E",
        "logicOr": "Ou",
        "title": {
          "0": "Construtor de Pesquisa",
          "_": "Construtor de Pesquisa (%d)"
        },
        "value": "Valor",
        "leftTitle": "Critérios Externos",
        "rightTitle": "Critérios Internos"
      },
      "searchPanes": {
        "clearMessage": "Limpar Tudo",
        "collapse": {
          "0": "Painéis de Pesquisa",
          "_": "Painéis de Pesquisa (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Nenhum Painel de Pesquisa",
        "loadMessage": "Carregando Painéis de Pesquisa...",
        "title": "Filtros Ativos"
      },
      "thousands": ".",
      "datetime": {
        "previous": "Anterior",
        "next": "Próximo",
        "hours": "Hora",
        "minutes": "Minuto",
        "seconds": "Segundo",
        "amPm": ["am", "pm"],
        "unknown": "-",
        "months": {
          "0": "Janeiro",
          "1": "Fevereiro",
          "10": "Novembro",
          "11": "Dezembro",
          "2": "Março",
          "3": "Abril",
          "4": "Maio",
          "5": "Junho",
          "6": "Julho",
          "7": "Agosto",
          "8": "Setembro",
          "9": "Outubro"
        },
        "weekdays": ["Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinte-feira", "Sexta-feira", "Sábado"]
      },
      "editor": {
        "close": "Fechar",
        "create": {
          "button": "Novo",
          "submit": "Criar",
          "title": "Criar novo registro"
        },
        "edit": {
          "button": "Editar",
          "submit": "Atualizar",
          "title": "Editar registro"
        },
        "error": {
          "system": "Ocorreu um erro no sistema (<a target=\"\\\" rel=\"nofollow\" href=\"\\\">Mais informações<\/a>)."
        },
        "multi": {
          "noMulti": "Essa entrada pode ser editada individualmente, mas não como parte do grupo",
          "restore": "Desfazer alterações",
          "title": "Multiplos valores",
          "info": "Os itens selecionados contêm valores diferentes para esta entrada. Para editar e definir todos os itens para esta entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão seus valores individuais."
        },
        "remove": {
          "button": "Remover",
          "confirm": {
            "_": "Tem certeza que quer deletar %d linhas?",
            "1": "Tem certeza que quer deletar 1 linha?"
          },
          "submit": "Remover",
          "title": "Remover registro"
        }
      },
      "decimal": ","
    }
  }); //Tabs

  var url = location.href.replace(/\/$/, '');

  if (location.hash) {
    var hash = url.split('#');
    $('#tabStep a[href="#' + hash[1] + '"]').tab('show');
    url = location.href.replace(/\/#/, '#');
    history.replaceState(null, null, url);
    setTimeout(function () {
      $(window).scrollTop(0);
    }, 400);
  }

  $('a[data-toggle="tab"]').on('click', function () {
    var newUrl;
    var hash = $(this).attr('href');
    newUrl = url.split('#')[0] + hash;
    newUrl += '/';
    history.replaceState(null, null, newUrl);
  });

  __webpack_require__(/*! ./pages/vehicles.js */ "./resources/js/admin/pages/vehicles.js");
})(jQuery, window, document);
})();

/******/ })()
;