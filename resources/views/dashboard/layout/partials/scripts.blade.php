 <!-- jQuery -->
 <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script>
 <!-- Bootstrap -->
 <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
 <!-- overlayScrollbars -->
 <script src="{{ asset('dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
 <!-- AdminLTE App -->
 <script src="{{ asset('dashboard/dist/js/adminlte.js') }}"></script>

 <!-- PAGE PLUGINS -->
 <!-- jQuery Mapael -->
 <script src="{{ asset('dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
 <script src="{{ asset('dashboard/plugins/raphael/raphael.min.js') }}"></script>
 <script src="{{ asset('dashboard/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
 <script src="{{ asset('dashboard/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
 <!-- ChartJS -->
 <script src="{{ asset('dashboard/plugins/chart.js/Chart.min.js') }}"></script>

 <!-- AdminLTE for demo purposes -->
 <script src="{{ asset('dashboard/dist/js/demo.js') }}"></script>
 <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
 <script src="{{ asset('dashboard/dist/js/pages/dashboard2.js') }}"></script>

 {{-- toastr --}}
 <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

 <script src="{{ asset('assets/js/jquery-confirm.min.js') }}"></script>


 <script>
     // success messages
     @if (session()->has('success'))
         toastr.success('{{ session()->get('success') }}')
     @endif
     // error messages
     @if (session()->has('error'))
         toastr.error('{{ session()->get('error') }}')
     @endif

     //  error validation messages
     @if ($errors->any())
         @foreach ($errors->all() as $error)
             toastr.error('{{ $error }}')
         @endforeach
     @endif
 </script>


 <script>
     $('button.delete-btn').on('click', function() {
         let currentBtn = $(this)
         $.confirm({
             title: 'Delete!',
             content: "You can't restore the deleted item!",
             type: 'red',
             theme:'dark',
             escapeKey: true,
             buttons: {
                 confirm: {
                     btnClass: 'btn-red',
                     keys: ['enter', 'shift'],
                     action: function() {
                         currentBtn.parent('form').submit()
                     }
                 },
                 cancel: {
                 },
             }
         });
     })
 </script>
