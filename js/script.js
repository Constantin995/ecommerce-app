$(document).ready(function(){
    $('#filter').keyup(function(){
        const input = $(this).val();
        $.ajax({

            url: "productsTable.php",
            method: "POST",
            data: {input:input},

            success:function(data){
                $('#searchresult').html(data);
            }
        });
    });
});

$(document).ready(function(){
    $('.comment-delete').click(function(){
        return confirm('Do you want to delete this comment?');
    });
});

$(document).ready(function(){
    $('.product-delete').click(function(){
        return confirm('Do you want to delete this product?');
    });
});

$(document).ready(function(){
    $('.product-delete2').click(function(){
        return confirm('Do you want to delete this product?');
    });
});

$(document).ready(function(){
    $('.edit-product').click(function(e){
        e.preventDefault();

        $.get($(this).attr("href"),function(data){
            $('#result').html(data);
        })
        window.scrollTo(0, 0);
    });
});

$(document).ready(function(){
    setInterval(function(){
        $(".timer-text").css('display', 'none');
      }, 5000);
});



