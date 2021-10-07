import 'owl.carousel'
import { Fancybox } from '@fancyapps/ui'

require('./bootstrap')

$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    /* ===================================
        Side Menu
    ====================================== */
    if ($('#sidemenu_toggle').length) {
        $('#sidemenu_toggle').on('click', function () {
            $('.pushwrap').toggleClass('active')
            $('.side-menu').addClass('side-menu-active'),
                $('#close_side_menu').fadeIn(700)
        }),
            $('#close_side_menu').on('click', function () {
                $('.side-menu').removeClass('side-menu-active'),
                    $(this).fadeOut(200),
                    $('.pushwrap').removeClass('active')
            }),
            $('.side-nav .navbar-nav').on('click', function () {
                $('.side-menu').removeClass('side-menu-active'),
                    $('#close_side_menu').fadeOut(200),
                    $('.pushwrap').removeClass('active')
            }),
            $('#btn_sideNavClose').on('click', function () {
                $('.side-menu').removeClass('side-menu-active'),
                    $('#close_side_menu').fadeOut(200),
                    $('.pushwrap').removeClass('active')
            })
    }

    // Navbar Scroll Function
    var $window = $(window)
    $window.scroll(function () {
        var $scroll = $window.scrollTop()
        var $navbar = $('.header-nav')
        if (!$navbar.hasClass('sticky-bottom')) {
            if ($scroll > 250) {
                $navbar.addClass('fixed-menu')
            } else {
                $navbar.removeClass('fixed-menu')
            }
        }
    })

    // Banner Carousel / Owl Carousel
    $('#banner-carousel').owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        loop: true,
        margin: 0,
        nav: true,
        dots: false,
        smartSpeed: 500,
        autoHeight: true,
        autoplay: true,
        autoplayTimeout: 5000,
        navText: [
            '<span class="fa fa-angle-left">',
            '<span class="fa fa-angle-right">'
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1024: {
                items: 1
            }
        }
    })

    // Slide Brands / Owl Carousel
    $('.slide-brands').owlCarousel({
        autoplay: true,
        loop: true,
        margin: 30,
        nav: true,
        dots: true,
        navText: [
            '<span class="fa fa-angle-left">',
            '<span class="fa fa-angle-right">'
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 4,
                nav: false,
                dots: true
            },
            600: {
                items: 6,
                dots: false
            },
            1000: {
                items: 10,
                dots: false
            }
        }
    })

    $('.slick-cars-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: true,
        asNavFor: '.slick-cars-nav',
        prevArrow:
            "<button type='button' class='slick-prev'><i class='fas fa-chevron-left'></i></button>",
        nextArrow:
            "<button type='button' class='slick-next'><i class='fas fa-chevron-right'></i></button>",
        responsive: [
            {
                breakpoint: 922,
                settings: {
                    dots: true
                }
            }
        ]
    })

    $('.slick-cars-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slick-cars-for',
        dots: false,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        prevArrow:
            "<button type='button' class='slick-prev'><i class='fas fa-chevron-left'></i></button>",
        nextArrow:
            "<button type='button' class='slick-next'><i class='fas fa-chevron-right'></i></button>",
        responsive: [
            {
                breakpoint: 922,
                settings: 'unslick'
            }
        ]
    })

    Fancybox.bind('[data-fancybox]', {})

    $('.select').select2({})

    // Jquery Mask
    $('.money').mask('#.##0,00', { reverse: true })
    $('.price_form').mask('#.##0', { reverse: true })
    $('.km').mask('#.##0.000', { reverse: true })
    $('.data').mask('00/00/0000');

    $('.telefone').focusout(function () {
        var phone, element;
        element = $(this);
        element.unmask();
        phone = element.val().replace(/\D/g, '');
        if (phone.length > 10) {
            element.mask("(99) 99999-9999");
        } else {
            element.mask("(99) 9999-99999");
        }
    }).trigger('focusout');

    // Js site

    $('select[name=marca]').on('change', function () {
        var brand = $(this)
            .find(':selected')
            .val()
        var url = $(this).data('url')

        $('select[name=modelo]').html('<option value="0">Carregando...</option>')

        $.ajax({
            url: url,
            method: 'POST',
            data: {
                brand: brand
            },
            dataType: 'text',
            success: function (result) {
                $('select[name=modelo]').html(result)
            }
        })
    })
})
