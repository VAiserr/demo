function generateForm(e) {
    console.log(e.target.id)
    let form;

    if(e.target.value == 2) {
        form = `
            <form enctype="multipart/form-data" action="/aplications/change?status=new" method="POST" onsubmit="return validateForm(event)">
                <ul class="panel-row" id="errs"></ul>
                <div class="input-group flex f-center"><h3>Фото доказательство</h3></div>
                <div class="panel-row"><input type="file" name="image" id="input" class="auth-input"></div>
                <div class="panel-row">
                    <input type="hidden" value="${e.target.id}" name="apl_id">
                    <input type="hidden" value="2" name="status">
                    <input type="submit" value="Отправить" class="sub-btn auth-input">
                </div>
            </form>
        `;
    } else if(e.target.value == 3) {
        form = `
            <form action="/aplications/change?status=new" method="POST" onsubmit="return validateForm(event)">
                <ul class="panel-row" id="errs"></ul>
                <div class="input-group flex f-center"><h3>Причина отказа</h3></div>
                <div class="panel-row"><textarea class="auth-input" name="cause" id="input" rows="2"></textarea></div>
                <div class="panel-row">
                    <input type="hidden" value="3" name="status">
                    <input type="hidden" value="${e.target.id}" name="apl_id">
                    <input type="submit" value="Отправить" class="sub-btn auth-input">
                </div>
            </form>
        `;
    }

    document.querySelector("#apl-" + e.target.id).innerHTML = form;
}

function validateForm(e) {
    let errsField = e.target.querySelector('#errs');
    let input = e.target.querySelector('#input');
    let errs = [];
    if (input.value == '')
        errs.push("Поле не может быть пустым");

    if (input.value.length > 250)
        errs.push("Обьем сообщения не больше 250 символов");

    if (errs.length > 0) {
        errs.forEach(element => {
            errsField.innerHTML = `<li class="selected"> ${element} </li>`;
            input.value = '';
        });
        return false
    } else return true;
}