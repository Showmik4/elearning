<!-- latest jquery-->
<script src="{{url('public/assets/js/jquery-3.5.1.min.js')}}"></script>

<!-- Bootstrap js-->
<script src="{{url('public/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>

<!-- feather icon js-->
<script src="{{url('public/assets/js/icons/feather-icon/feather.min.js')}}"></script>
<script src="{{url('public/assets/js/icons/feather-icon/feather-icon.js')}}"></script>

<!-- scrollbar js-->
<script src="{{url('public/assets/js/scrollbar/simplebar.js')}}"></script>
<script src="{{url('public/assets/js/scrollbar/custom.js')}}"></script>

<!-- Sidebar jquery-->
<script src="{{url('public/assets/js/config.js')}}"></script>
<!-- Select2 js-->
<script src="{{url('public/assets/select2/select2.min.js') }}"></script>

<!-- Plugins JS start-->
<script src="{{url('public/assets/js/sidebar-menu.js')}}"></script>
<script src="{{url('public/assets/js/chart/knob/knob.min.js')}}"></script>
<script src="{{url('public/assets/js/chart/knob/knob-chart.js')}}"></script>
<script src="{{url('public/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
<script src="{{url('public/assets/js/chart/apex-chart/stock-prices.js')}}"></script>
<script src="{{url('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
<script src="{{url('public/assets/js/datepicker/date-picker/datepicker.js')}}"></script>
<script src="{{url('public/assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
<script src="{{url('public/assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<!-- Plugins JS Ends-->

<!-- Theme js-->
<script src="{{url('public/assets/js/script.js')}}"></script>

<!-- CKEDITOR & CKFINDER -->
<script src="https://cdn.ckeditor.com/4.20.0/full/ckeditor.js"></script>

<script>
    CKEDITOR.config.extraAllowedContent = '*(*);*{*}';
</script>

<!-- DataTables js-->
<script src="{{url('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
<script src="{{url('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>

<!--toastr start-->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    toastr.options = {
    "timeOut": "1000", 
    "extendedTimeOut": "500",
    "fadeOut": 50 
    };
    
    @if(session('message'))
    toastr.info('{{ session('message') }}')

    @endif

    @if(session('warning'))
    toastr.warning('{{ session('warning') }}')
    
    @endif

    @if(session('success'))
    toastr.success('{{ session('success') }}')
    
    @endif

    @if(session('error'))
    toastr.error('{{ session('error') }}');
    
    @endif

    //Jquery On ecnyer event bonding
    (function($) {
        $.fn.onEnter = function(func) {
            this.bind('keypress', function(e) {
                if (e.keyCode === 13) func.apply(this, [e]);
            });
            return this;
        };
    })(jQuery);
</script>
<!--toastr end-->

<script>
    $(window).on('load',function(){
        setTimeout(function(){ 
        $('.page-loader').fadeOut('slow');
        },2500);
    }); 
 
</script>

@yield('footer.js')