const titleInput = document.getElementById('bookTitleInput')
const authorInput = document.getElementById('AutorInput');
const genreInput = document.getElementById('GenreInput');
const DescriptionInput = document.getElementById('DescriptionInput');
const imgLinkInput = document.getElementById('imgLinkInput');

const title = document.getElementById('title');
const autor = document.getElementById('autor');
const img = document.getElementById('img');
const cardWrapper = document.getElementById('cardWrapper');

function RefreshPreview() {
    

    if (titleInput.value.trim() !== "" || imgLinkInput.value.trim() !== "") {
        cardWrapper.classList.remove('d-none');
    } else {
    cardWrapper.classList.add('d-none');
    }

    title.textContent = titleInput.value || "Název knihy";
    autor.textContent = authorInput.value || "Autor";

    img.src = imgLinkInput.value || "img/undraw_img.webp";
}

titleInput.addEventListener('input', RefreshPreview);
authorInput.addEventListener('input', RefreshPreview);
imgLinkInput.addEventListener('input', RefreshPreview);

img.addEventListener('error', function() {
    img.src = "img/undraw_img.webp";
});