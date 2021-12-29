
// Функция для смены изображения на решенных задачах
function switchImg(e) {
    imgBefore = e.target;
    imgAfter = imgBefore.previousElementSibling ?? imgBefore.nextElementSibling;

    imgBefore.setAttribute('hidden', 'hidden');
    imgAfter.removeAttribute('hidden');
}