// ricoh
$('.ricohUpdate').click(function(){
    $('#ricohModal').modal('show')
    .find('#ricohModalContent')
    .load($(this).attr('href'));
    return false;
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
 