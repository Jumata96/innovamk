<script type="text/javascript">
    //------Jmazuelos--29-08-2020-------------GRABAR-----------------------------------

    /* $(document).ready(function(){
        $('.datepicker').datepicker({  
             minDate: dateToday });
    });
       */

    var dateToday = new Date(); $(function() { 
        $( ".datepicker" ).datepicker({ 
                numberOfMonths: 3,
                showButtonPanel: true, 
                dateFormat: "mm/dd/yy",
                minDate: dateToday  ,
                beforeShow: function(){    
                    $(".ui-datepicker").css('font-size', 12) 
                }
        }); 
        });

        $('#testDate1').datepicker({
            container: 'body'
        })

 document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.datepicker');
    var instances = M.Datepicker.init(elems,{});
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems);
});

    $('#addPromesaGuardar').on('click',function(){
        console.log('ingreso a promesa');
        var data = $('#frmPago').serializeArray();
        $.ajax({
            url: "{{ url('/promesas/grabar') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/promesas/grabar') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                ( typeof data.detalle != "undefined" )? $('#errorPromesa1').text(data.detalle) : null;
                ( typeof data.fechaPromesa != "undefined" )? $('#errorPromesa2').text(data.fechaPromesa) : null;
                 
                
              } else {   

                
                /* location.reload(); */

              }
              
           },

           error:function(){ 
              alert("error!!!!");
        }
        });

    });

</script>

