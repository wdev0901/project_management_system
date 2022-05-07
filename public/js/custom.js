function applyFilter() {
    $('.antialiased').addClass('waiting');
    // $('.loading').css('display', 'flex');
    $('.nothing').css('display', 'none');
    // $('.min-h-screen').css('opacity', 0.4);
    $product_id = $('#project_id').val();
    $.ajax({
        url: url,
        method: 'POST',
        data: {
            "_token": csrf_val,
            id: $product_id
        },
        success: function(res) {
            var data = JSON.parse(res);
            dataRender(data);
        },
        error: function(err) {
            console.log(err);
        }
    });
}

function dataRender(param) {
    if(param.length == 0) {
        $('#task_list').html(bodyData);
        $('.antialiased').removeClass('waiting');
        $('.nothing').css('display', 'block');
    } else {
        var bodyData = '';
        $.each(param, function(index, task){
            bodyData += '<tr>'+
                            '<td class="px-6 py-4 text-left">'+
                                '<h2 class="font-bold">'+task.title+'</h2><span class="text-sm font-light text-gray-400">Updated'+task.created_at+'</span>'+
                            '</td>'+
                            '<td class="px-6 py-4 text-center">'+task.priority+'</td>'+
                        '</tr>'
        });
        $('.antialiased').removeClass('waiting');
        $('#task_list').html(bodyData);
    }
}