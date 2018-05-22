$('#form3').on('submit',function(e){
e.preventDefault();

var url = $(this).attr('action'),
post = $(this).attr('method'),
data = new FormData(this);

$.ajax({
    url: url,
    method: post,
    data: data,
    success: function(data){
        console.log(data);
    },
    error: function(xhr, status, error){
        alert(xhr.responseText);
    },
    processData: false,
    contentType: false
});
}); 