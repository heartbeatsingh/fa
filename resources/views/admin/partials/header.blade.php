<div id="logo-group" style="padding-left: 10px;">

    <!-- PLACE YOUR LOGO HERE -->
    <span id=""> <img src="{{ URL::to('/') }}/public/images/logo.png" alt="Welcome Admin"> </span>
    <!-- END LOGO PLACEHOLDER -->
</div>



<!-- #TOGGLE LAYOUT BUTTONS -->
<!-- pulled right: nav area -->
<div class="pull-right">

  

    <!-- logout button -->
    <div id="logout" class="btn-header transparent pull-right">
        <span> <a href="{{ url('/logout') }}" title="Logout" data-action="userLogout" data-logout-msg="Are you sure you want to logout?"><i class="fa fa-sign-out"></i></a> </span>
    </div>
    <!-- end logout button -->


</div>
<!-- end pulled right: nav area -->