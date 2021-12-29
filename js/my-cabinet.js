let aplications = document.querySelectorAll('.application'),
    aplicationList = document.querySelector('.applications-list'),
    filterBtns = document.querySelector('.filter').querySelectorAll('.link'),
    aplicationsBlock = document.querySelector('#aplications-block'),
    hideBlock = document.querySelector('#hide');

function filterAps(filter) {
    elements = [];
    aplications.forEach(e => {
        let status = e.querySelector('#status').innerHTML;
        if (status == filter || filter == "Все") {
            elements.push(e);
        }
    });
    return elements;
}

function showAplications(array) {
    aplicationList.innerHTML = "";
    aplicationsBlock.style.height = "";

    if (array.length > 0) {
        array.forEach(e => {
            aplicationList.appendChild(e);
        });
    
        if (aplicationList.clientHeight > 560) {
            hideSup();
        } else {
            hideBlock.innerHTML = "";
        }
    } else {
        aplicationList.innerHTML = `<li class='application'><h3>Заявки не найдены<h3></li>`;
    }
}

function selectFilter(e) {
    btn = e.target;
    filterBtns.forEach(item => {
        item.classList.remove('selected');
        item.addEventListener('click', selectFilter);
    });
    btn.classList.add('selected');
    btn.removeEventListener('click', selectFilter);
    showAplications(filterAps(btn.dataset.filter));
}

filterBtns.forEach(e => {
    e.addEventListener('click', selectFilter);
});

function hideSup() {
    aplicationsBlock.style.height = (aplicationList.children[0].clientHeight + 15) + "px";
    let hideBtn = createBtn("hide-btn","Показать все");
    hideBtn.addEventListener('click', uncoverSup);
    hideBlock.innerHTML = '';
    hideBlock.appendChild(hideBtn);
}

function uncoverSup() {
    aplicationsBlock.style.height = aplicationList.clientHeight + "px";
    let uncoverBtn = createBtn("uncover-btn","Свернуть");
    uncoverBtn.addEventListener('click', hideSup)
    hideBlock.innerHTML = '';
    hideBlock.appendChild(uncoverBtn);
}

function createBtn(id, text) {
    let btn = document.createElement('span');
    btn.classList.add('link');
    btn.id = id;
    btn.innerHTML = text;
    return btn;
}

window.addEventListener('resize', () => {
    if (hideBlock.children[0].id == "hide-btn") {
        hideSup();
    }
});

window.onload = () => {
    showAplications(filterAps("Все"));
}

