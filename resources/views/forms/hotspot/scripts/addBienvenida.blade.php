<script type="text/javascript">
      //---JPaiva-28-10-2018----------------ACEPTAR-----------------------------
    $('#addBienvenida').click(function(e){
      e.preventDefault();

      var data = $('#myForm').serializeArray();
console.log(data);
      $.ajax({
            url: "{{ url('/addBienvenida') }}",
            type:"POST",
            beforeSend: function (xhr) {
                var token = $('meta[name="csrf-token"]').attr('content');

                if (token) {
                      return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                }
            },
           type:'POST',
           url:"{{ url('/addBienvenida') }}",
           data:data,

           success:function(data){
              
              if ( data[0] == "error") {
                //( typeof data.facturacion != "undefined" )? $('#error1').text(data.facturacion) : null;
              } else {  
                //var obj = $.parseJSON(data); 

                setTimeout(function() {
                  M.toast({ html: '<span>Registro exitoso</span>'});
                }, 2000);  
              }
           },
           error:function(){ 
              alert("error!!!!");
        }
      });    

    });    

</script>