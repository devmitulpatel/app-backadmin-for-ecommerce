
@extends( (isset($data) && array_key_exists('full',$data) && (bool)$data['full'] )?'layouts.app':'layouts.blankApp')


@section('content')



    @php

    $m=\App\Model\Settings\General::find(1);


    $Vuedata=[
    'path'=>[

        'save.general'=>route('settings.general.save')
    ],

    'img'=>[
        'WebsiteLogo'=>asset('img/admin/logo.png'),
        'InvoiceLogo'=>asset('img/admin/logo.png')
        ],
    'inputData'=>settings()->all()

    ];
    $jsonData=json_encode($Vuedata,true);


    @endphp



<setting-general :ms-data="{{$jsonData}}"></setting-general>





@endsection
