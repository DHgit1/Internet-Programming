var p1 = [];
var p2 = [];
var t1 = 0;
var t2 = 0;
var name1 = "";
var name2 = "";
var wins1 = 0;
var wins2 = 0;
var total1 = 0;
var total2 = 0;
function readNames(){
    name1 =  $("#player1").val().toUpperCase();
    name2 =  $("#player2").val().toUpperCase();
    if(name1 == ""){
        $("#error1").empty();
        $("#error1").css("color", "red");
        $("#e1").css("color", "red");
        $("#error1").append("*Missing Player Name!");
    } else {
        $("#error1").empty();
        $("#e1").css("color", "lime");
    }
    if(name2 == ""){
        $("#error2").empty();
        $("#error2").css("color", "red");
        $("#e2").css("color", "red");
        $("#error2").append("*Missing Player Name!");
    } else {
        $("#error2").empty();
        $("#e2").css("color", "lime");
    }
    if(name1 != "" && name2 != "") {
        if(name1 == name2){
            $("#error2").empty();
            $("#error2").css("color", "red");
            $("#e2").css("color", "red");
            $("#error2").append("*Duplicate Name!");
        } else {
            $("#begin").hide();
            $("#submit").hide();
            play();
        }
    }
}
function play(){
    for(var i=0; i<5; i++){
        p1.push(Math.floor(Math.random()*(6)+1));
        p2.push(Math.floor(Math.random()*(6)+1));
    }
    for(var i in p1) { t1 += p1[i]; }
    for(var i in p2) { t2 += p2[i]; }
    p1.push(t1);
    p2.push(t2);
    p1.sort((a, b) => a - b);
    p2.sort((a, b) => a - b);
    displayDice();
    displayPoints();
}
function displayDice(){
    $("#div1").append("<b>"+name1+":</b>");
    $("#div2").append("<b>"+name2+":</b>");
    for(var i = 0; i<5; i++) {
        $("#div1").append("<img id='row1' src='img/"+p1[i]+".png'/>");
        $("#div2").append("<img id='row2' src='img/"+p2[i]+".png'/>");
    }
    $("#div1").append("<p>"+p1[p1.length - 1]+"</p>");
    $("#div2").append("<p>"+p2[p2.length - 1]+"</p>");
}
function displayPoints(){
    var totalPoints = p1[p1.length - 1] + p2[p2.length - 1];
    if(p1[p1.length - 1] != p2[p2.length - 1]){
        if(p1[p1.length - 1] > p2[p2.length - 1]){
            wins1 += 1;
            total1 += totalPoints;
            $("#output").append("<h2>"+name1+" won "+totalPoints+" points!</h2>");
        } else {
            wins2 += 1
            total2 += totalPoints;
            $("#output").append("<h2>"+name2+" won "+totalPoints+" points!</h2>");
        }
    } else
        $("#output").append("<h2>Tie Game!<h2>");
    $("#output").append("<h2>"+name1+"'s wins: "+wins1+" Score: "+total1+"</h2>");
    $("#output").append("<h2>"+name2+"'s wins: "+wins2+" Score: "+total2+"</h2>");
    $("#container").show();
}
function resetGame(){
    p1 = [];
    p2 = [];
    t1 = 0;
    t2 = 0;
    $("#div1").empty();
    $("#div2").empty();
    $("#output").empty();
    play();
}
$("#reset").click(function(){
    resetGame();
});
$("#submit").click(function(){
    readNames()
});