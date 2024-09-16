function test(){

}

function process(){

}

function handle(){

}

$(function(){
    $('#submit').click(function(){
        var text = $("#un").val();
        $("#message").html(text);
        $("#un").val("");
    });
});