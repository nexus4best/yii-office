//cts->actionView
$('.userView').click(function(){
    $('#viewModal').modal('show')
    .find('#viewModalContent')
    .load($(this).attr('href'));
    return false;
})

//cts->actionUserAccept
$('.userAccept').click(function(){
    $('#userAcceptModal').modal('show')
    .find('#userAcceptModalContent')
    .load($(this).attr('href'));
    return false;
})

//cts->actionSend
$('.sendBranch').click(function(){
    $('#sendModal').modal('show')
    .find('#sendModalContent')
    .load($(this).attr('href'));
    return false;
})