;(function ($) {
    'use strict'

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $(document).on('click', '.delete', function () {
        var id = $(this).attr('data-id')
        $('#id').val(id)
    })

    // Jquery Mask
    $('.money').mask('#.##0,00', { reverse: true })
    $('.km').mask('#.##0.000', { reverse: true })
    $('.cm').mask('##0,00', { reverse: true })
    $('.mes_ano').mask('00/0000')

    $('.summernote').summernote({
        lang: 'pt-BR',
        height: 200,
        fontNames: ['Noto Sans JP', 'Signika', 'Open Sans', 'Arial'],
        fontNamesIgnoreCheck: ['Nunito', 'Segoe UI'],
        fontSizeUnits: ['px', 'pt'],
        styleTags: [
            'p',
            {
                title: 'Blockquote',
                tag: 'blockquote',
                className: 'blockquote',
                value: 'blockquote'
            },
            'pre',
            'h1',
            'h2',
            'h3',
            'h4',
            'h5',
            'h6'
        ],
        toolbar: [
            ['style'],
            ['font', ['bold', 'underline', 'clear', 'font']],
            ['fontname', ['fontname']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table'],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    })

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
    })

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
                "amPm": [
                    "am",
                    "pm"
                ],
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
                "weekdays": [
                    "Domingo",
                    "Segunda-feira",
                    "Terça-feira",
                    "Quarta-feira",
                    "Quinte-feira",
                    "Sexta-feira",
                    "Sábado"
                ]
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
        },
    });

    //Tabs
    let url = location.href.replace(/\/$/, '')

    if (location.hash) {
        const hash = url.split('#')
        $('#tabStep a[href="#' + hash[1] + '"]').tab('show')
        url = location.href.replace(/\/#/, '#')
        history.replaceState(null, null, url)
        setTimeout(() => {
            $(window).scrollTop(0)
        }, 400)
    }

    $('a[data-toggle="tab"]').on('click', function () {
        let newUrl
        const hash = $(this).attr('href')
        newUrl = url.split('#')[0] + hash
        newUrl += '/'
        history.replaceState(null, null, newUrl)
    });

    require('./pages/vehicles.js');

})(jQuery, window, document)
