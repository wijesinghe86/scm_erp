 <!-- Scripts -->
 {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
 <script src="https://code.jquery.com/jquery-1.3.2.min.js"
     integrity="sha256-yDcKLQUDWenVBazEEeb0V6SbITYKIebLySKbrTp2eJk=" crossorigin="anonymous"></script>

 <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
 <script src="{{ asset('assets/js/dashboard.js') }}"></script>

 <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
 <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
 <script src="{{ asset('assets/js/misc.js') }}"></script>
 <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
 <script src="{{ asset('assets/js/todolist.js') }}"></script>
 <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>

 {{-- data_table --}}
 <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

 {{-- data_table design --}}
 <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
 {{-- Alert Message --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
     integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 {{-- Confim Message --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
 {{--  --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"
     integrity="sha512-3j3VU6WC5rPQB4Ld1jnLV7Kd5xr+cq9avvhwqzbH/taCRNURoeEpoPBK9pDyeukwSxwRPJ8fDgvYXd6SkaZ2TA=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
     integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
     integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

 {{--  --}}
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap.min.js" integrity="sha512-F0E+jKGaUC90odiinxkfeS3zm9uUT1/lpusNtgXboaMdA3QFMUez0pBmAeXGXtGxoGZg3bLmrkSkbK1quua4/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
 <script>
     $(document).ready(function() {
         //Javascript method's body can be found in assets/assets-for-demo/js/demo.js --}}
         //  demo.initChartsPages();
     });

     $(document).ready(function() {
         @foreach (['danger', 'warning', 'success', 'info'] as $msg)
             @if (Session::has('alert-' . $msg))
                 var msg = '@php echo Session("alert-".$msg); @endphp';
                 @if ($msg == 'success')
                     setTimeout(() => {
                         alertSuccess(msg);
                     }, 200);
                 @endif
                 @if ($msg == 'danger')
                     setTimeout(() => {
                         alertDanger(msg);
                     }, 500);
                 @endif
                 @if ($msg == 'info')
                     setTimeout(() => {
                         alertInfo(msg);
                     }, 500);
                 @endif
                 @if ($msg == 'warning')
                     setTimeout(() => {
                         alertWarning(msg);
                     }, 500);
                 @endif
             @endif
         @endforeach
     });

     function alertDanger(msg) {
         $.toast({
             heading: 'Oops',
             text: msg,
             icon: 'error',
             loader: true,
             loaderBg: '#fff',
             showHideTransition: 'slide',
             hideAfter: 3000,
             position: 'top-right'
         });
     }

     function alertSuccess(msg) {
         $.toast({
             heading: 'Success',
             text: msg,
             icon: 'success',
             loader: true,
             loaderBg: '#fff',
             showHideTransition: 'slide',
             hideAfter: 3000,
             allowToastClose: false,
             position: 'top-right',
         })
     }

     function alertWarning(msg) {
         $.toast({
             heading: 'Warning',
             text: msg,
             icon: 'warning',
             loader: true,
             loaderBg: '#fff',
             showHideTransition: 'slide',
             hideAfter: 3000,
             allowToastClose: false,
             position: 'top-right',
         })
     }

     function alertInfo(msg) {
         $.toast({
             heading: 'Attention',
             text: msg,
             icon: 'info',
             loader: true,
             loaderBg: '#fff',
             showHideTransition: 'slide',
             hideAfter: 3000,
             allowToastClose: false,
             position: 'top-right',
         })
     }

     //  function delconf(url, title = "Do you want to remove this! ") {
     //      $.confirm({
     //          title: 'Are You Sure,',
     //          content: 'title',
     //          autoClose: 'cancel|8000',
     //          type: 'red',
     //          confirmButton: "Yes",
     //          CancelButton: "Cancel",
     //          theme: 'material',
     //          backgroundDismiss: false,
     //          backgroundDismissAnimation: 'glow',
     //          buttons: {
     //              'Yes, Delete It': function() {
     //                  window.location.href = url;
     //                  confirmButton: "Yes";
     //                  cancelButton: "Cancel";
     //              }
     //              cancel: function() {

     //              },
     //              cancel: function() {
     //                  $.alert('Canceled!');
     //              },
     //              somethingElse: {
     //                  text: 'Something else',
     //                  btnClass: 'btn-blue',
     //                  keys: ['enter', 'shift'],
     //                  action: function() {
     //                      $.alert('Something else?');
     //                  }
     //              }
     //          }
     //      });
     //  }

     $(document).ready(function() {
         $('.data-table').DataTable();
     });
 </script>

 @stack('scripts')
