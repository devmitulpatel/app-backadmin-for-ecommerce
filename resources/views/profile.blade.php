
@extends( (isset($data) && array_key_exists('full',$data) && (bool)$data['full'] )?'layouts.app':'layouts.blankApp')


@section('content')



    @php
        ///dd($data);
        $Vuedata=[
        'path'=>[

            'save.profile'=>route('profile.save')
        ],

        'img'=>[
            'WebsiteLogo'=>asset('img/admin/logo.png'),
            'InvoiceLogo'=>asset('img/admin/logo.png')
            ],
        'inputData'=>auth()->user()->toArray()

        ];

/////sdd($Vuedata);


        if(isset($data) && array_key_exists('alert',$data))$Vuedata['alert']=$data['alert'];
        $jsonData=json_encode($Vuedata,true);


    @endphp



    <profile     :ms-data="{{$jsonData}}"></profile>





@endsection
