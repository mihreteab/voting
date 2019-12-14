var inputCount = 0;
$(document).ready(function(){
    $("#add-button").click(function(){
        $("#input-wrapper").append(`<input id="input-${inputCount}" placeholder="Value ${inputCount}" />`);
        inputCount++;
    });
});