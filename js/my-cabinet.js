let aplications = document.querySelectorAll('.application'),
    aplicationList = document.querySelector('.applications-list'),
    filterBtns = document.querySelector('.filter').querySelectorAll('.link');

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

    array.forEach(e => {
        aplicationList.appendChild(e);
    });
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

