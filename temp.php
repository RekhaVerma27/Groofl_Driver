<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
         <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

             function test() {
            alert("56789");
                //$('#category').on('click',function(e) {
                 
                 var cat_id = "1";

                 $.ajax({
                       
                       url:"{{ route('subcat') }}",
                       type:"POST",
                       data: {
                           cat_id: 1
                        },
                      
                       success:function (data) { 

                        $('#subcategory').empty();

                        $.each(data.subcategories[0].subcategories,function(index,subcategory){
                         
                            $('#subcategory').append('<option value="'+subcategory.id+'">'+subcategory.category_name+'</option>');
                            
                        })

                       }
                   })
               // });

            }//);
        </script>