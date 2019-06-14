//cts->actionUserAccept
$('.userAccept').click(function(){
    $('#userAcceptModal').modal('show')
    .find('#userAcceptModalContent')
    .load($(this).attr('href'));
    return false;
})