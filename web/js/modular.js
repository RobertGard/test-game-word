
$('.words').on('click', function(event){
    if($(this).hasClass('active')){
        $('#box-words').append(this);
        
        $(this).removeClass('active');
    }else{  
        $('#box-string').append(this);
        
        $(this).addClass('active');
    }
});

function getString(){
    var array = [];
    
    $('.active').each(function( index ) {
       array[index] =  $( this ).text();
    });
    
    return array.join(' ');
}

$('.check-answer').on('click', function(event){
    var id = $(this).data('id');
    var string = getString();
    
    $.ajax({
        url: '/task/check-answer?id='+id,
        data: {string:string},
        type: 'POST',
        success: function(res){
            $('.col-check-answer').hide();
            $('.block-result').append(res);
//            console.log(res);
        },
        error: function(){
            alert('Error !!!');
        }
    });
});