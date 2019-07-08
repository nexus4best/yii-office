// recheck update 
$('.recheckUpdate').click(function(){
    $('#RecheckModal').modal('show')
    .find('#RecheckModalContent')
    .load($(this).attr('href'));
    return false;
});

// recive update รับของคลังสินค้า
$('.reciveUpdate').click(function(){
    $('#ReciveModal').modal('show')
    .find('#ReciveModalContent')
    .load($(this).attr('href'));
    return false;
});

// ricoh view
$('.RicohView').click(function(){
    $('#ricohViewModal').modal('show')
    .find('#ricohViewModalContent')
    .load($(this).attr('href'));
    return false;
});

// ricoh updateOpenjob
$('.ricohOpenjob').click(function(){
    $('#ricohModalOpenjob').modal('show')
    .find('#ricohModalContentOpenJob')
    .load($(this).attr('href'));
    return false;
});

// ricoh update
$('.ricohUpdate').click(function(){
    $('#ricohModal').modal('show')
    .find('#ricohModalContent')
    .load($(this).attr('href'));
    return false;
});

// ricoh delete
$('.ricohDelete').click(function(){
    $('#deleteRicohModal').modal('show')
    .find('#deleteRicohModalContent')
    .load($(this).attr('href'));
    return false;
});

//cts->actionUndelete

$('.userDelete').click(function(){
    $('#deleteModal').modal('show')
    .find('#deleteModalContent')
    .load($(this).attr('href'));
    return false;
});

// pjax
$(document).on('ready pjax:success', function() {
    $('.userDelete').click(function(e){
       e.preventDefault(); //for prevent default behavior of <a> tag.
       var tagname = $(this)[0].tagName;      
       $('#deleteModal').modal('show')
                  .find('#deleteModalContent')
                  .load($(this).attr('href'));  
   });
});

//cts->actionView

$('.userView').click(function(){
    $('#viewModal').modal('show')
    .find('#viewModalContent')
    .load($(this).attr('href'));
    return false;
});

// pjax
$(document).on('ready pjax:success', function() {
    $('.userView').click(function(e){
       e.preventDefault(); //for prevent default behavior of <a> tag.
       var tagname = $(this)[0].tagName;      
       $('#viewModal').modal('show')
                  .find('#viewModalContent')
                  .load($(this).attr('href'));  
   });
});


//cts->actionUserAccept
$('.userAccept').click(function(){
    $('#userAcceptModal').modal('show')
    .find('#userAcceptModalContent')
    .load($(this).attr('href'));
    return false;
});

// pjax
$(document).on('ready pjax:success', function() {
    $('.userAccept').click(function(e){
       e.preventDefault(); //for prevent default behavior of <a> tag.
       var tagname = $(this)[0].tagName;      
       $('#userAcceptModal').modal('show')
                  .find('#userAcceptModalContent')
                  .load($(this).attr('href'));  
   });
});

//cts->actionSend
$('.sendBranch').click(function(){
    $('#sendModal').modal('show')
    .find('#sendModalContent')
    .load($(this).attr('href'));
    return false;
});

// pjax
$(document).on('ready pjax:success', function() {
    $('.sendBranch').click(function(e){
       e.preventDefault(); //for prevent default behavior of <a> tag.
       var tagname = $(this)[0].tagName;      
       $('#sendModal').modal('show')
                  .find('#sendModalContent')
                  .load($(this).attr('href'));  
   });
});


$(document).on('pjax:send', function() {
    $('#loading').show();
 });
 $(document).on('pjax:complete', function() {
   $('#loading').hide();
 });

 $(document).on("pjax:success", function(){
    $("#tblrepairsearch-createdat, #tblrepairsearch-sendcreatedat").kvDatepicker({
        format:"yyyy-mm-dd",
        autoclose: true,
        //orientation: "bottom auto"
        });
});
 