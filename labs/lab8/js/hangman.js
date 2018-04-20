var selectedWord = "";
var selectedHint = "";
var board = [];
var remainingGuesses = 6;
var words = [{word:"snake", hint:"It's a reptile"},
             {word:"monkey", hint:"It's a mammal"},
             {word:"beetle", hint:"It's an insect"},
             {word:"horse", hint:"It has four legs"},
             {word:"dog", hint:"It is man's best friend"}];
var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
if(localStorage.getItem('wordHistory') == null)
    var wordHistory =[];
else
    var wordHistory =  JSON.parse(localStorage.getItem('wordHistory'));
window.onload = startGame();
function startGame(){
    pickWord();
    initBoard();
    createLetters();
    updateBoard();
}
function initBoard(){
    for(var letter in selectedWord)
        board.push("_");
    if(wordHistory[0] == undefined)
        $("#history").hide();
    else
        displayHistory();
}
function pickWord(){
    var randomInt = Math.floor(Math.random() * words.length);
    selectedWord = words[randomInt].word.toUpperCase();
    selectedHint = words[randomInt].hint;
}
function updateBoard(){
    $("#word").empty();
    for (var i=0; i<board.length; i++){
        $("#word").append(board[i] + " ");
    }
    $("#word").append("<br />");
}
function createLetters(){
    for (var letter of alphabet){
        $("#letters").append("<button class='letter btn btn-success' id='" + letter + "'>" + letter + "</button>");
    }
}
function checkLetter(letter){
    var positions = [];
    for (var i=0; i<selectedWord.length;i++){
        console.log(selectedWord)
        if (letter == selectedWord[i]){
            positions.push(i);
        }
    }
    if(positions.length > 0){
        updateWord(positions, letter);
        if(!board.includes('_')){
            endGame(true);
        }
    } else {
        remainingGuesses -= 1;
        updateMan();
    }
    if (remainingGuesses <= 0){
        endGame(false);
    }
}
function updateWord(positions, letter){
    for (var pos of positions){
        board[pos] = letter;
    }
    updateBoard();
}
function updateMan(){
    $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
}
function endGame(win){
    $("#letters").hide();
    if (win){
        $('#won').show();
        addWord();
    }
    else 
        $('#lost').show();
}
function disableButton(btn){
    btn.prop("disabled", true);
    btn.attr("class", "btn btn-danger");
}
function displayHistory(){
    for (var word of wordHistory)
        $("#history").append("<ol><b>"+word+"</b></ol>");
}
function addWord(){
	wordHistory.push(selectedWord);
	localStorage.setItem('wordHistory', JSON.stringify(wordHistory));
}
$("#hint").click(function(){
    $("#hint").hide();
    $("#word").append("<span class='hint'>Hint: " + selectedHint + "</span>");
    remainingGuesses -= 1;
    updateMan();
})
$("#letterBtn").click(function(){
    var boxVal = $("#letterBox").val();
    console.log("You pressed the button and it had the value: " + boxVal);
})
$(".letter").click(function(){
    checkLetter($(this).attr("id"));
    disableButton($(this));
})
$(".replayBtn").on("click", function(){
    location.reload();
})