getGaleria();

//Buscando os Modelos
$('select[name=brand_id]').on('change', function () {
    var brand = $(this)
        .find(':selected')
        .val()
    var url = $('#urlGetModel').val()

    $('select[name=model_id]').html('<option value="0">Carregando...</option>')

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            brand: brand
        },
        dataType: 'text',
        success: function (result) {
            $('select[name=model_id]').html(result)
        }
    })
})

//Buscando os Versões
$('select[name=model_id]').on('change', function () {
    var model = $(this)
        .find(':selected')
        .val()
    var url = $('#urlGetVersion').val()

    $('select[name=version_id]').html(
        '<option value="0">Carregando...</option>'
    )

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            model: model
        },
        dataType: 'text',
        success: function (result) {
            $('select[name=version_id]').html(result)
        }
    })
})

// Buscando as Imagens do imóvel
function getGaleria () {
    var vehicle_id = $('#vehicle_id').val()
    var url = $('#getGaleria').val()

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            vehicle_id: vehicle_id
        },
        dataType: 'json',
        success: function (data) {
            $('#galeriaVeiculo').html(data)
        }
    })

    return false
}

// Upload Imagens
$(document).on('click', '#uploadGaleria', function () {
    var formData = new FormData()

    var url = $('#urlUploadGaleria').val()
    var vehicle_id = $('#vehicle_id').val()
    let TotalFiles = $('#images')[0].files.length //Total files
    let images = $('#images')[0]

    for (let i = 0; i < TotalFiles; i++) {
        formData.append('images' + i, images.files[i])
    }

    formData.append('TotalFiles', TotalFiles)
    formData.append('vehicle_id', vehicle_id)

    $.ajax({
        type: 'POST',
        url: url,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json',
        beforeSend: function () {
            $('#galeriaImovel').html(
                '<h5 class="text-center my-4 w-100">Carregando...</h5>'
            )
        },
        success: function (response) {
            getGaleria()

            setTimeout(function () {
                $('.alert').html(response.success)
                $('.alert')
                    .addClass('alert-success')
                    .fadeIn('slow')
            }, 200)

            setTimeout(function () {
                $('.alert').hide(400)
            }, 2000)
        },
        error: function (response) {
            setTimeout(function () {
                $('.alert').html(response.erro)
                $('.alert')
                    .addClass('alert-danger')
                    .fadeOut('slow')
            }, 200)

            setTimeout(function () {
                $('.alert').hide(400)
            }, 2000)
        }
    })
})

// Excluindo Imagens
$(document).on('click', '.delete_image', function () {
    var id = $(this).data('id')
    var url = $(this).data('url')

    $('.delete').attr('data-id', id)
    $('.delete').attr('data-url', url)

    $('.delete').addClass('deleteImage')
    $('.deleteImage').removeClass('delete')
})

$(document).on('click', '.deleteImage', function () {
    var id = $(this).data('id')
    var url = $(this).data('url')

    $.ajax({
        url: url,
        method: 'POST',
        data: {
            id: id
        },
        dataType: 'json',
        cache: false,
        success: function (response) {
            $('#modalDelete').modal('toggle')

            $('.deleteImage').addClass('delete')
            $('.deleteImage').removeData('id')
            $('.delete').removeClass('deleteImage')

            getGaleria()

            setTimeout(function () {
                $('.alert').html(response.success)
                $('.alert')
                    .addClass('alert-success')
                    .fadeIn('slow')
            }, 200)

            setTimeout(function () {
                $('.alert').hide(400)
            }, 2000)
        },
        error: function (response) {
            setTimeout(function () {
                $('.alert').html(response.erro)
                $('.alert')
                    .addClass('alert-danger')
                    .fadeOut('slow')
            }, 200)

            setTimeout(function () {
                $('.alert').hide(400)
            }, 2000)
        }
    })
})

// Escolher Capa do Imóvel
$(document).on('change', '.checkCover', function () {
    if (this.checked) {
        var id = $(this).data('id')
        var url = $(this).data('url')

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                id: id
            },
            dataType: 'json',
            cache: false,
            success: function (response) {
                getGaleria()

                setTimeout(function () {
                    $('.alert').html(response.success)
                    $('.alert')
                        .addClass('alert-success')
                        .fadeIn('slow')
                }, 200)

                setTimeout(function () {
                    $('.alert').fadeOut('slow')
                }, 2000)
            }
        })
    }
})

// Função para escolher a ordem
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
