@extends( (isset($data) && array_key_exists('full',$data) && (bool)$data['full'] )?'layouts.app':'layouts.blankApp')


@section('content')



    @php



        if(!isset($Vuedata))$Vuedata=[];
        $jsonData=json_encode($Vuedata,true);


    @endphp



    <product-category :ms-data="{{$jsonData}}"></product-category>





@endsection
