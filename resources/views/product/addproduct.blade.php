@extends( (isset($data) && array_key_exists('full',$data) && (bool)$data['full'] )?'layouts.app':'layouts.blankApp')


@section('content')



    @php



        if(!isset($Vuedata))$Vuedata=[];
        $jsonData=json_encode($Vuedata,true);


    @endphp



    <product-addproduct :ms-data="{{$jsonData}}"></product-addproduct>





@endsection
