$(document).ready(function(){

    // When user click teleport_button move to the add_new_column element
    $("#teleport_button").click(function(){
        $('html,body').animate({
            scrollTop: $("#add_new_column").offset().top}, 1000);});
    
    // When user click teleport_top button move to the top of the page
    $("#teleport_top").click(function() {
        $('html, body').animate({ 
            scrollTop: 0 
        }, 'fast');
    });
    
});
