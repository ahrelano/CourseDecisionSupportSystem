function startTimer(duration, display) {
    var start = Date.now(),
        diff,
        minutes,
        seconds,
        unanswer = 0,
        times = 11;
    function timer() {
        // get the number of seconds that have elapsed since 
        // startTimer() was called
        diff = duration - (((Date.now() - start) / 1000) | 0);

        // does the same job as parseInt truncates the float
        minutes = (diff / 60) | 0;
        seconds = (diff % 60) | 0;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = "Current test ends in "+minutes + ":" + seconds; 
        if (diff <= 0) {
            // add one second so that the count down starts at the full duration
            // example 05:00 not 04:59
            start = Date.now() + 1000;
            clearInterval(myVar);
            $(".subjectButtons").show();
            $(".result").html("<h1>Time is up!</h1>");
        }
    };
    // we don't want to wait a full second before the timer starts
    timer();
    var myVar = setInterval(timer, 1000);
}
function runTest(btnName, modalID, timelimit) {
    $(".subjectButtons").hide();
    $('#'+modalID).modal('hide');
    $(".subjectButtons").hide();
    $("#"+btnName).remove();
    remove();
    var oneHour = timelimit * 60,
     // var oneHour = 5,
        display = document.querySelector('#time');
    $.ajax({
        url: './realtest-sample/'+btnName, 
        success: function(result){
            $(".result").html(result);
            startTimer(oneHour, display);
    $("#timerBody").removeClass("div-center");
        }
    });
}

function findUnchecked(subject){
    var ok = [],
    question = [],
    list_questions = [];
    $('.unanswer').html('');
    $('input[type="radio"]:not(:checked)').each(function(){
    //get the number
    ok.push($(this).attr('name').slice($(this).attr('name').indexOf("-") + 1));
    //get the question
    question.push($( "."+$(this).attr('name')).html());
    });
    var count_choices = $('.count_choices').val().split(' ');
    var obj = { };
        for (var i = 0; i < ok.length; i++) {
           obj[ok[i]] = (obj[ok[i]] || 0) + 1;
        }
        for (var i = 1; i <= Object.keys(obj).length; i++) {
            if (count_choices[i-1] == obj[i]) {
                list_questions.push($('.'+subject+"-"+i).html());
            }
        }
    var unanswer = "<h3>List of Unanswered Questions</h3>";
    $.each( list_questions, function( i, l ){
        unanswer += "<p>" + l + "</p>"+
                    '<button class="btn btn-primary" data-dismiss="modal" onclick="unansweredModal('+l.split(".")[0]+',0)">View</button>';
    });
    var baguettecss = $('#baguettecss').val(),
        gallerycss = $('#gallerycss').val(),
        baguettejs = $('#baguettejs').val();

    unanswer += '<link rel="stylesheet" href="'+baguettecss+'"/><link rel="stylesheet" href="'+gallerycss+'"/><script src="'+baguettejs+'"></script><script>'+
    'baguetteBox.run(".tz-gallery");'+
'</script> ';
    $('.unanswer').html(unanswer);
}

function viewRadio(){
    var user_answers = "",
        question_number = "";
    $('.unanswer').html('');
    $(".subjectButtons").show();
    $( "#questions" ).append( "<input type=\"hidden\" name=\""+$(".subject_id").val()+"\" value=\""+$(".question_id").val()+"\">" );
    $("input[type='radio']:checked").each(function(){
        user_answers += $(this).val() + " ||| ";
        question_number += $(this).attr('name').slice($(this).attr('name').indexOf("-") + 1) + " ";
    });
    $( "#user_answers" ).append( "<input type=\"hidden\" name=\""+$(".subject_id").val()+"-answers\" value=\""+user_answers+"\">" );
    $( "#user_answer_number" ).append( "<input type=\"hidden\" name=\""+$(".subject_id").val()+"-number\" value=\""+question_number+"\">" );
    $(".subjectButtons").show();
    $("#timerBody").addClass("div-center");
    alert("Please choose another subject to take.");
    $(".result").html("");
    remove();
    if ($(".subjectButtons").length == 1) {
        $(".subjectButtons").hide();
        $( "#allButtons" ).hide();
        $(".result").html("");
        $("#timerBody").remove();
        $(".hideInfo").show();
        $("label").show();
        alert("Your done, view your results.");
    }else{
        $(".subjectButtons").hide();
        $( "#formSubmit" ).submit();
    }
}

function remove(){
    $("#time").remove();
    $( "#timerBody" ).append( "<h1><span id=\"time\"></span></h1>" );
}

$(document).ready(function() {
    $(".hideInfo").hide();
    //disable Enter key
    window.addEventListener('keydown',function(e){if(e.keyIdentifier=='U+000A'||e.keyIdentifier=='Enter'||e.keyCode==13){if(e.target.nodeName=='INPUT'&&e.target.type=='text'){e.preventDefault();return false;}}},true);
});
