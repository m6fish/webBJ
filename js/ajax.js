
$(document).ready(function(){
    first();
    $(".choice").click(function(){
        send($(this).val());
        if($(this).val() == '1'){
            $("button[name='HIT']").hide();
        }
    });

    $(".restart").click(function(){
        location.reload();
    });
});



function first(){
    var targetURL="receiver.php";
    var sendData = "moreCard=2";
    
    var pic = "";

    $.ajax({
    url: targetURL,
    data: sendData,
    type:"POST",
    dataType:'json',

    success: function(jData){
        //alert(msg);
        pic = jData["p1"];
        //$('#cards_p1').append(jData["p1"]);
        $('#cards_b').append(jData["b"]);
        
        $('div.pics').html("<img src = '../asset/pic/" 
            + pic + ".gif' alt = 'Poker' width = '62px'/>");


    },

    error:function(xhr, ajaxOptions, thrownError){ 
        alert("error-first()");
        alert(xhr.status); 
        alert(thrownError); 
    }

    });
    
}

function send(mode){
    //alert("AJAX YES " + n);
    var targetURL="receiver.php";
    var sendData = "moreCard=" + mode;

    var pic = "";

    $.ajax({
    url: targetURL,
    data: sendData,
    type:"POST",
    dataType:'json',

    success: function(jData){
//       alert(jData);
        if (0 == mode) {
            //$('#cards_p1').append(" " + jData['p1']);
            $('#score_p1').text(jData['score_p1']);

            pic = jData['p1'];
            $('div.pics').append("<img src = '../asset/pic/" 
                + pic + ".gif' alt = 'Poker' width = '62px'/>");

        } else if (1 == mode){
            $('#cards_b').append(" " + jData['b']);

            $('#score_p1').text(jData['score_p1']);
            $('#score_b').text(jData['score_b']);

            $('#result').append(jData['result'] + " wins!<br/>");
        }
    },

    error:function(xhr, ajaxOptions, thrownError){ 
        alert(xhr.status); 
        alert(thrownError); 
    }

    });
        
}
