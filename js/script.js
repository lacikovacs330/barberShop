$('body').on('click', '.addName', function () {
    let html = ' ' +
        '        <div class="row pt-3 gifts" style="width: 100%; margin: 0; justify-content: center; text-align: center">\n' +
        '            <div class="inputs" style="width: 100%; justify-content: center">\n' +
        '                <input type="text" class="form-control" id="asd" name="asd" style="width: 50%" placeholder="Szolgáltatás...">\n' +
        '                <input type="text" class="form-control" id="asd1" name="asd1" style="width: 50%" placeholder="Ár...">\n' +
        '            </div>\n' +
        '            <div class="buttons" style="width: 100%;">\n' +
        '                <button type="button" class="btn btn-danger addName">\n' +
        '                    <i class="bi bi-dash">+</i>\n' +
        '                </button>\n' +
        '                <button type="button" class="btn btn-danger removeName">\n' +
        '                    <i class="bi bi-dash">-</i>\n' +
        '                </button>\n' +
        '            </div>\n' +
        '        </div>';

    $('.gifts').last().after(html);
});

$('body').on('click', '.removeName', function () {
    $(this).closest('.gifts').remove();
});