<div id="mySidenav" class="sidenav " style="z-index: 1990" >


    <section  class="container-fluid sidenav-company-details " >

        <div >
            <div >
            <img id="sidebarlogo"  src="{{ settings()->get('websiteLogo') }}">
            </div>
        </div>

        <h3 >{{ settings()->get('CompanyName') }}</h3>
    </section>



    <div class="btn btn-link btn-block text-center" id="closebtn" v-on:click="toggleSidebar()">
        <i class="far fa-window-close" ></i> Close Menu
    </div>

    <a class="btn btn-link btn-block text-left" >
        <i class="fas fa-bars"></i>  Dashboard
    </a>



    <a class="btn btn-link btn-block text-left"  data-toggle="collapse" data-target="#sales">
        <i class="fas fa-cogs"></i>  Sales <i class="fas fa-chevron-right right p-fix"></i>
    </a>
    <div class="collapse sidebarsub" id="sales">

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Add Customer
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Pending Orders
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Completed Orders
        </a>











    </div>



    <a class="btn btn-link btn-block text-left"  data-toggle="collapse" data-target="#product">
        <i class="fas fa-cogs"></i>  Product <i class="fas fa-chevron-right right p-fix"></i>
    </a>
    <div class="collapse sidebarsub" id="product">
        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Add Product
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Product List
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Add Category
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Category List
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Add Sub Category
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Sub Category List
        </a>









    </div>



    <a class="btn btn-link btn-block text-left"  data-toggle="collapse" data-target="#services">
        <i class="fas fa-cogs"></i>  Services <i class="fas fa-chevron-right right p-fix"></i>
    </a>
    <div class="collapse sidebarsub" id="services">
        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Add Area
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Area List
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Add Delivery Boy
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Delivery Boy List
        </a>











    </div>



    <a class="btn btn-link btn-block text-left"  data-toggle="collapse" data-target="#customer">
        <i class="fas fa-cogs"></i>  Customer <i class="fas fa-chevron-right right p-fix"></i>
    </a>
    <div class="collapse sidebarsub" id="customer">
        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Add Customer
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Customer List
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Add Customer Type
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Customer Type List
        </a>











    </div>






    <a class="btn btn-link btn-block text-left" v-on:click="clickEventFromSideBar('{{route('profile',['compact'=>true])}}')">
        <i class="far fa-address-card"></i>  Profile
    </a>
    <a class="btn btn-link btn-block text-left"  data-toggle="collapse" data-target="#settings">
        <i class="fas fa-cogs"></i>  Settings <i class="fas fa-chevron-right right p-fix"></i>
    </a>
    <div class="collapse sidebarsub" id="settings">
        <a class="btn btn-link btn-block text-left" v-on:click="clickEventFromSideBar('{{route('settings.general',['compact'=>true])}}')" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  General Setting
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Product Setting
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Sales Setting
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Customer Setting
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Tax Setting
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Account Setting
        </a>

        <a class="btn btn-link btn-block text-left" >
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Roles Setting
        </a>

        <a class="btn btn-link btn-block text-left" v-on:click="clickEventFromSideBar('{{route('settings.website',['compact'=>true])}}')">
            <i class="fas fa-level-up-alt fa-rotate-90"></i>  Website Setting
        </a>







    </div>


</div>
