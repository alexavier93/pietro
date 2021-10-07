@extends('layouts.app')

@section('title', '- Sobre Nós')

@section('content')

<div class="page-title-content" style="background: url('{{ asset('assets/images/banner-page/banner-veiculos.jpg') }}')"></div>

<section id="quem-somos" class="py-5">

    <div class="container">

        <div class="row">

            <h2 class="text-center mb-4">QUEM SOMOS</h2>

            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem laudantium, totam rem aperiam, eaque quae tore veritatis quasi architecto bea vitae dicta sunt explico. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ne voluptatem sequi nesciunt. Neque porro quisquam est, qui em ipsum quia dolor sit amet sunt in culpa qui officia deserunt.</p>

            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
        
        </div>
    </div>

    <div class="my-4">

        <div class="row justify-content-center">
            <div class="col-12 col-md-6 p-0">
                <img class="w-100" src="{{ asset('assets/images/carros.jpg') }} " alt="">
            </div>
            <div class="col-12 col-md-6 p-0 d-flex justify-content-start align-items-center bg-gray">

                <div class="p-5 px-lg-3 py-lg-0 px-xl-5 py-xl-0 col-11">
                    <h3>LOREM IPSUM</h3>
                    <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium dolorem laudantium, totam rem aperiam, eaque quae tore veritatis quasi architecto bea vitae dicta sunt explico.</p>
                    <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ne voluptatem sequi nesciunt. Neque porro quisquam est, qui em ipsum quia dolor sit amet sunt in culpa qui officia deserunt.</p>
                </div>
            
            </div>
          </div>

    </div>
    
</section>


@endsection
