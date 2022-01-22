$( document ).ready(function() {
    $('#category-id').on('change', function() {
    	$('#sub_category').empty();
        var id = $('#category-id').val();
        var old_sub = $('#old_sub').val();
        // alert(id);
        $.ajax({
            type:"GET",
            dataType: "json",
            url: baseUrl+"admin/sub-categories/sub_category/"+id,
            success: function(result){
                if(old_sub != ''){
                   for(var i in result){
                        if(old_sub == i){
                            $('#sub_category').append('<option value="'+i+'" selected>'+result[i]+'</option>');
                        }else{
                            $('#sub_category').append('<option value="'+i+'">'+result[i]+'</option>');
                        }
                    }; 
                }else{
                   for(var i in result){
                        $('#sub_category').append('<option value="'+i+'">'+result[i]+'</option>');
                    };  
                }
            }
        });
    });

    $('#category-id').trigger( "change" );
});