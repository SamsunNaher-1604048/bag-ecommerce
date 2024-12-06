
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Untree.co">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- Bootstrap CSS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{asset('public/assets/css/tiny-slider.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/css/global.css')}}" rel="stylesheet"/>

</head>

<body>

@include('includes.nav')
@yield('content')
@include('includes.footer')

<script src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/assets/js/tiny-slider.js')}}"></script>
<script src="{{asset('public/assets/js/custom.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

<script>
    "use strict";
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    @if ($errors->any())
    @foreach ($errors->all() as $emsg)
    toastr.error('{{$emsg}}');
    @endforeach
    @endif

    @if(session()->has('alert'))
    @if(session('alert')[0] == 'danger')
    toastr.error('{{ session('alert')[1] }}');
    @elseif(session('alert')[0] == 'success')
    toastr.success('{{ session('alert')[1] }}');
    @else
    toastr.error('{{ session('alert')[1] }}');
    @endif
    @endif

    function systemAlert(type,message){
        if(type === 'danger'){
            toastr.error(message);
        }else if(type === 'success'){
            toastr.success(message);
        }else{
            toastr.error(message);
        }
    }
</script>

<script>
    $(document).ready(function(){
        $('.add-to-cart-btn').on('click',function (){
            const product_id = $(this).data('product_id')
            addCartData(product_id);
        });

        function addCartData(product_id)
        {
            $.ajax({
                type:'get',
                url:'{{route('cart.add')}}',
                data:{
                    'quantity': $('#quantity').val()??1,
                    'product_id':product_id,
                },
                success:function (response){
                    systemAlert(response.status, response.message);
                    getCartData()
                }
            });
        }

        function getCartData(){
            $.ajax({
                method:'get',
                url:'{{route('cart.count')}}',
                success:function(response){
                    $('#cart-count').html(response.count);
                    if(response.count === 0){
                        $('#cart').append("<tr><td colspan="+'6'+">Cart is empty</td></tr>")
                    }
                    getCartCalculation();
                }
            })
        }

        function getCartCalculation(){
            $.ajax({
                method:'get',
                url:'{{route('cart.calculate')}}',
                success:function (response){
                   $('#sub-total').html(response.sub_total);
                   $('#tax').html(response.tax);
                   $('#discount').html(response.discount);
                   $('#total').html(response.total);
                }
            });
        }

        $('.cart-remove').on('click',function(){
            $.ajax({
                method:'get',
                url:'{{route('cart.remove')}}',
                data:{
                    id:$('.cart-remove').data('id'),
                },
                success:function (response){
                    systemAlert(response.status, response.message);
                    getCartData();
                    $('#'+$('.cart-remove').data('id')).remove();
                }

            })
        })

        $('.cart-update').on('click',function (){

            const cart_id = $(this).data('cart_id')
            const quantity = $('.quantity-input_'+cart_id).val();

            $.ajax({
                method:'get',
                url:'{{route('cart.update')}}',
                data:{
                    quantity: quantity,
                    cart_id: cart_id,
                },
                success:function (response){
                    systemAlert(response.status, response.message);
                    $('.total-price'+cart_id).html(response.totalPrice)
                    getCartCalculation();
                }
            });
        });

        $('.add-product').on('click',function(){
            const product_id = $(this).data('product_id')
            addCartData(product_id);
        });

        getCartData();
    })
</script>


<script>

    $('.wishlist-icon').on('click',function (){
        const $this = $(this);
       $.ajax({
           method:'get',
           url:'{{route('wishlist.add')}}',
           data:{
               product_id:$this.data('product_id'),
           },
           success:function (response){
               systemAlert(response.status, response.message);
               $this.toggleClass("wishlist-active");
               $this.find('i').toggleClass('wishlist-heart-icon-active')
           }
       })
    });

    $('.wishlist-cross-icon').on('click',function(){
        const wishlist_id = $(this).data('wishlist_id');
        $.ajax({
            method:'get',
            url:'{{route('wishlist.remove')}}',
            data:{
                wishlist_id:wishlist_id,
            },
            success:function (response)
            {
                systemAlert(response.status, response.message);
                $('.wishlist'+wishlist_id).remove();
            }
        });
    })

</script>

@stack('js')
</body>

</html>
